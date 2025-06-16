@extends('adminlte::page')
@section('title', "Atualizar Pronunciamento")
@section('content_header')
@section('plugins.Select2', true)
@section('plugins.Summernote', true)
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Editar Pronunciamento do Vereador <strong> {{$pronunciamento->councilor->nome}}</strong>  na <strong>{{$pronunciamento->session->nome}}</strong> </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('pronunciamentos.index')}}">Pronunciamentos </a></li>
          <li class="breadcrumb-item ">Editar a Pronunciamento</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('pronunciamentos.update', $pronunciamento->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.pages.pronunciamentos._partials.form')
        </form>
    </div>
</div>
@stop
@section('js')
  <script>
     $(function () {
          $('[data-toggle="tooltip"]').tooltip()

          $.fn.select2.defaults.set( "theme", "bootstrap" );   
          $('.select2').select2();
      })  
      //inicia o summernote  
    $(document).ready(function() {
      $('#summernote').summernote({
      height: 400,
      lang: 'pt-BR'
      });
    });     
      
      
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
              window.location.href = url;
            }
          })  
  });
  </script>
@endsection
