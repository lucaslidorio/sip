@extends('adminlte::page')

@section('title', "Detalhes do documento")
@section('plugins.icheck-bootstrap', true)

@section('content_header')

<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1> <strong>{{$documento->titulo}}</strong></h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
        <li class="breadcrumb-item "> <a href="{{route('documentos.index')}}">Documentos </a></li>
        <li class="breadcrumb-item ">Detalhes</li>
      </ol>
    </div>
  </div>
</div>

@include('sweetalert::alert')
@stop



@section('content')
<div class="card">
  <div class="card-body">
    <ul class="list-unstyled">
      <li>
        <strong>Titulo:</strong> {{$documento->titulo}}
      </li>

      <li>
        <strong>Data Publicação:</strong> {{ date('d/m/Y', strtotime($documento->data_publicacao)) }}
      </li>
      <li>
        <strong>Tipo de Matéria:</strong> {{$documento->tipoMateria->nome}}
      </li>
      <li>
        <strong>Sub tipo de Matéria:</strong> {{$documento->subTipoMateria->nome}}
      </li>
      <li>
        <strong>Conteúdo:</strong>
        <p class="text-justify">{!!$documento->conteudo!!}</p>
      </li>






    </ul>

  </div>
  <div class="card-footer">

    <div class="row">
      <div class="col-md-6">
        @can('assinar-documento')
        <a href="javascript:void(0);" data-uuid="{{$documento->uuid}}"
          class="btn bg-gradient-warning btn-flat mt-0 sign-document" data-toggle="tooltip" data-placement="top"
          title="Assinar">
          <i class="fas fa-pencil-alt"></i>
        </a>
        @endcan
      </div>
      <div class="col-md-6">
        <div class="text-right">
          <small><strong>Criado por: </strong><small>{{$documento->user->name}} <strong>em </strong> {{
              $documento->created_at }}</small></small> <br>
          <small><strong>Útima alteração por: </strong>{{$documento->userLastUpdate->name}} <strong>em </strong> {{
            $documento->updated_at }} </span></small>
        </div>
      </div>


    </div>


    @if($documento->assinaturas->count() > 0)
    <x-assinatura :assinaturas="$documento->assinaturas->where('status', true)" :municipio="config('app.municipio')"
      :codigoverificacao="$documento->codigo_verificacao" :iddocumento="$documento->uuid" />
    @endif

  </div>
  @stop
  @section('js')
  <script>
    $(function () {
    $('[data-toggle="tooltip"]').tooltip()
    }) //Alert de confirmação de exclusão
        
    $(document).on('click', '.sign-document', function() { var uuid = $(this).data('uuid'); // Ainda usamos o UUID para assinar o documento depois
    // Faz uma requisição AJAX para buscar as funções do usuário logado
    $.ajax({
        url: '/admin/diario/documentos/get-functions/user',
        type: 'GET',
        success: function(funcoes) {
            // Funções retornadas com sucesso
            // Cria o HTML para o select de funções
            var funcaoSelect = '<select id="funcao_id" class="swal2-input">';
            if (funcoes.length > 0) {
                $.each(funcoes, function(index, funcao) {
                    funcaoSelect += '<option value="' + funcao.function.id + '">' + funcao.function.nome + '</option>';
                });
            } else {
                funcaoSelect += '<option value="">Nenhuma função disponível</option>';
            }
            funcaoSelect += '</select>';

            // Exibe o modal SweetAlert com o select de funções e o input de senha
            Swal.fire({
                title: 'Assinar Documento',
                html:
                    '<label for="funcao_id">Selecione sua Função</label>' +'<br>'+
                    funcaoSelect +
                    '<br>' +
                    '<label for="password">Digite sua senha para confirmar a assinatura:</label>' +
                    '<input type="password" id="password" class="swal2-input" placeholder="Senha" required>',
                focusConfirm: false,
                showCancelButton: true,
                confirmButtonText: 'Assinar',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    var password = document.getElementById('password').value;
                    var funcaoId = document.getElementById('funcao_id').value;

                    if (!password || !funcaoId) {
                        Swal.showValidationMessage('Por favor, preencha todos os campos');
                        return false;
                    }

                    // Faz a requisição AJAX para assinar o documento
                    return $.ajax({
                        url:  uuid + '/sign',  // Rota da assinatura
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            password: password, // Senha fornecida pelo usuário
                            funcao_id: funcaoId // Função selecionada
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Documento assinado com sucesso!',
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                            // Após o SweetAlert fechar, recarregar a página
                                 window.location.reload();  // Recarrega a página para atualizar o estado do documento
                          });
                           // Atualizar ou redirecionar conforme necessário
                        },
                        error: function(xhr) {
                          console.log("Status do erro:", xhr.status);  // Exibe o status do erro no console
                        console.log("Resposta do erro:", xhr.responseText);  // Exibe a resposta completa do servidor no console

                            if (xhr.status === 403) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Erro ao assinar o documento',
                                    text: 'Você já assinou este documento e ele não foi alterado.',
                                });
                            } else if (xhr.status === 401) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Erro ao assinar o documento',
                                    text: 'Verifique se a senha está correta.',
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Erro ao assinar o documento',
                                    text: 'Ocorreu um erro interno. Por favor, tente novamente.',
                                    footer: '<pre>' + xhr.responseText + '</pre>',  // Exibe a resposta completa no modal
                                });
                            }
                        }
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            });
        },
        error: function(xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'Não foi possível carregar as funções. Tente novamente mais tarde.'
            });
        }
    });
});
  </script>
  @stop