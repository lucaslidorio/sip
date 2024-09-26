@extends('adminlte::page')
@section('title', 'Atualizar Documento')
@section('plugins.Select2', false)
@section('plugins.Summernote', true)
@section('plugins.icheck-bootstrap', true)

@section('content_header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Editar documento - <strong>{{$documento->titulo}}</strong></h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
        <li class="breadcrumb-item "> <a href="{{route('documentos.index')}}">Documentos </a></li>
        <li class="breadcrumb-item ">Editar o Documento</li>
      </ol>
    </div>
  </div>
</div>

@include('sweetalert::alert')
@stop

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{route('documentos.update', $documento->id)}}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      @include('admin.pages.documentosDof._partials.form')

    </form>
  </div>
</div>

@endsection

@section('js')
<script>
  //inicia o tooltip
    $(function () {
     $('[data-toggle="tooltip"]').tooltip()
    }) 
  
    //inicia o summernote  
    $(document).ready(function() {
      $('#summernote').summernote({
      height: 400,
      lang: 'pt-BR'
      });

      // Obtém o valor do tipo de matéria carregado na página
    var tipoMateriaId = $('#tipo_materia').val(); 

    // Função para carregar subtipos com base no tipo selecionado
    function carregarSubTipos(tipoMateriaId, subTipoSelecionado = null) {
        if (tipoMateriaId) {
            $.ajax({
                url: '/admin/diario/subtipos/' + tipoMateriaId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#sub_tipo_materia').empty(); // Limpa o select de subtipos
                    $('#sub_tipo_materia').append('<option value="" selected></option>'); // Adiciona a opção padrão

                    // Preenche o select com os subtipos retornados
                    $.each(data, function(key, value) {
                        var selected = (subTipoSelecionado == value.id) ? 'selected' : ''; // Marca o subtipo já selecionado
                        $('#sub_tipo_materia').append('<option value="' + value.id + '" ' + selected + '>' + value.nome + '</option>');
                    });
                }
            });
        } else {
            $('#sub_tipo_materia').empty(); // Limpa o select de subtipos se nenhum tipo for selecionado
            $('#sub_tipo_materia').append('<option value="" selected></option>'); // Adiciona a opção padrão
        }
    }

    // Ao carregar a página, verifica se já existe um tipo de matéria selecionado e carrega os subtipos
    if (tipoMateriaId) {
        var subTipoSelecionado = $('#sub_tipo_materia').data('selected'); // Subtipo selecionado
        carregarSubTipos(tipoMateriaId, subTipoSelecionado);
    }
    // Quando o tipo de matéria for alterado, carrega os subtipos dinamicamente
    $('#tipo_materia').on('change', function() {
        var tipoMateriaId = $(this).val(); // Obtenha o id do tipo selecionado
        carregarSubTipos(tipoMateriaId);
    });





    });

    //Inicia os tooltip
    $(function () {
          $('[data-toggle="tooltip"]').tooltip()
      })  

      //Alert de confirmação de exclusão
      $('.delete-confirm').on('click', function (event) {
      event.preventDefault();
      const url = $(this).attr('href');    
            Swal.fire({
            title: 'Deseja continuar?',
            text: "Este registro e seus detalhes serão excluídos permanentemente!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText:'Cancelar',
            confirmButtonText: 'Sim, Exclua!'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = url +"#galeria";
            }
          })  
  });


</script>
@endsection