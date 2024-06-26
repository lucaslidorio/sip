@extends('adminlte::page')

@section('title', "Detalhes do Proceso")

@section('content_header')

<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Detalhes da processo - <strong>{{$processo->numero}}/ {{$processo->data_publicacao->year}}</strong></h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
        <li class="breadcrumb-item "> <a href="{{route('processos.index')}}">Processos </a></li>
        <li class="breadcrumb-item ">Detalhes</li>
      </ol>
    </div>
  </div>
</div>

@include('sweetalert::alert')
@stop

@section('content')


<div class="card mb-3 mt-3">
  <div class="row no-gutters " style="padding:15px">
    <div class="col-md-4" style="padding-left: 15px">
      <p class="card-text"><strong> Número: </strong>{{$processo->numero}}/{{$processo->data_publicacao->year}}</p>
      <p class="card-text"><strong>Modalidade: </strong>
        {{ \Illuminate\Support\Str::upper($processo->modalidade->nome)}}</p>
      <p class="card-text"><strong>Quantidade de lotes: </strong> {{$processo->qtd_lotes}}</p>
      <td>
    </div>
    <div class="col-md-4" style="padding-left: 15px">
      <p class="card-text"><strong>Data de Publicação: </strong> {{$processo->data_publicacao->format('d-m-Y H:i:s')}}
      </p>
      <p class="card-text"><strong>Critério de Julgamento : </strong> {{$processo->criterio_julgamento->nome}}</p>

    </div>
    <div class="col-md-4" style="padding-left: 15px">
      <p class="card-text"><strong>Início da Sessão : </strong> {{$processo->inicio_sessao->format('d-m-Y H:i:s')}}</p>
      <p class="card-text"><strong>Situação : </strong> {{$processo->situacao->nome}}</p>

    </div>

    <div class="col-md-12" style="padding-left: 25px">
      <div class="row border-top mt-3 ">
        <p class="card-text text-justify"><strong>Descricao:</strong> <br> {{$processo->descricao}}</p>
      </div>
      <div class="row border-top mt-3 ">
        <p class="card-text text-justify"><strong>Objeto:</strong> <br> {{$processo->objeto}}</p>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="row border-top mt-3 " style="padding-left: 25px">
      <table class="table  table-hover table-borderless border-top mt-2 table-sm ">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Anexo</th>
            <th scope="col">Descrição</th>
            <th scope="col">Tipo de documento</th>
            <th scope="col">Downloads</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($processo->anexos as $attachment) <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>
              <a href="{{ url('/processos/download/' . $attachment->id) }}"
                target="_blank" class="mb-2 text-reset"
                data-toggle="tooltip" data-placement="top"
               
                title="Clique para abrir o documento" >
                <i class="far fa-file-pdf fa-2x text-danger mr-2"></i>
                <span class="mr-2"> {{$attachment->nome_original}}</span>
              </a>
            </td>
            <td>
              {{$attachment->descricao}}
            </td>
            <td>
              <span class="mr-2"> {{$attachment->type_document->nome}}</span>
            </td>
            <td>
              <span class="mr-2"> {{$attachment->qtd_download}}</span>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>


  <div class="card-footer" style="padding-left: 34px">
  @can('editar-processo-compras')
  <a class="btn btn-primary" href={{route('processos.edit', ['id'=>$processo->id])}} role="button"
    data-toggle="tooltip"
    data-placement="top" title="Editar Processo">
    <i class="fas fa-edit"></i> Editar</a>    
  @endcan
  @can('ver-processos-usuario-externo')
  <a class="btn btn-success" href={{route('processos.edit', ['id'=>$processo->id])}} role="button"
    data-toggle="tooltip"
    data-placement="top" title="Solicitar Credenciamento ao processo">
    <i class="fas fa-shopping-cart"></i> Credenciar</a>    
  @endcan
    
  </div>



</div>

@section('js')
<script>
  //inicia o tooltip
  $(function () {
   $('[data-toggle="tooltip"]').tooltip()
  })  

  // document.addEventListener('DOMContentLoaded', function() {
  //       const links = document.querySelectorAll('.download-link');
       
  //       links.forEach(link => {
  //           link.addEventListener('click', function(event) {
  //               const attachmentId = this.getAttribute('data-id');

  //                // Construir a URL base dinamicamente
  //                const baseUrl = '{{ url("/") }}';
  //                const storeDownloadUrl = `${baseUrl}/processos/storeDownload/${attachmentId}`;
  //                console.log(storeDownloadUrl);

  //               // Enviar a requisição AJAX
  //               const xhr = new XMLHttpRequest();
  //               xhr.open('POST', storeDownloadUrl, true);
  //               xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
  //               xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

  //               xhr.onreadystatechange = function() {
  //                   if (xhr.readyState === XMLHttpRequest.DONE) {
  //                       if (xhr.status === 200) {
  //                           console.log('Download registrado com sucesso.');
  //                       } else {
  //                           console.log('Erro ao registrar download.');
  //                       }
  //                   }
  //               };

  //               xhr.send();
  //           });
  //       });
  //   });
</script>

@endsection

@stop