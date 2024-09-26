@extends('adminlte::page')
@section('title', 'Cadastrar novo post')
@section('plugins.Select2', false)
@section('plugins.Summernote', true)
@section('plugins.icheck-bootstrap', true)

@section('content_header')
{{-- @section('css')
  <link rel="stylesheet" href="../../dashboard/css/dropzone.css">
@endsection --}}
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Cadastrar no documento</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('documentos.index')}}">Documentos </a></li>
          <li class="breadcrumb-item ">Novo Documentos</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop

@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{route('documentos.store')}}"  method="POST">
            @csrf
            @include('admin.pages.documentosDof._partials.form')
          

        </form>
    </div>
</div>

@endsection
@section('js')
{{-- <script src="../../dashboard/js/summernote-pt-br.js"></script> 
<script src="../../dashboard/js/dropzone.js"></script>    --}}
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


      // Quando o tipo de matéria é selecionado
      $('#tipo_materia').on('change', function() {
            var tipoMateriaId = $(this).val(); // Obtenha o id do tipo selecionado

            if(tipoMateriaId) {
                $.ajax({
                    url: '/admin/diario/subtipos/' + tipoMateriaId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#sub_tipo_materia').empty(); // Limpa o select de subtipos
                        $('#sub_tipo_materia').append('<option value="" selected></option>'); // Adiciona a opção padrão

                        // Preenche o select com os subtipos retornados
                        $.each(data, function(key, value) {
                            $('#sub_tipo_materia').append('<option value="'+ value.id +'">'+ value.nome +'</option>');
                        });
                    }
                });
            } else {
                $('#sub_tipo_materia').empty(); // Limpa o select de subtipos se nenhum tipo for selecionado
                $('#sub_tipo_materia').append('<option value="" selected></option>'); // Adiciona a opção padrão
            }
        });


    });




  </script>
@endsection


