@extends('adminlte::page')
@section('title', "Atualizar o atas")
@section('content_header')
@section('plugins.Select2', true)
@section('plugins.Summernote', true)
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Editar Propositura -  <strong>{{$proposition->type_proposition->nome}} - {{$proposition->numero}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('propositions.index')}}">Proposituras </a></li>
          <li class="breadcrumb-item ">Editar a Propositura</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('propositions.update', $proposition->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.pages.propositions._partials.form')
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
