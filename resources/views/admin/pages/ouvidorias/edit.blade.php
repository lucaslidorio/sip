@extends('adminlte::page')
@section('title', "Responder Ouvidoria de protocolo $ouvidoria->codigo")
@section('content_header')
@section('plugins.icheck-bootstrap', true)
@section('plugins.Select2', true)
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Responder a ouvidoria de protocolo  <strong>{{$ouvidoria->codigo}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('ouvidorias.index')}}">Proposituras </a></li>
          <li class="breadcrumb-item ">Responder manifestacao</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('ouvidorias.update', $ouvidoria->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.pages.ouvidorias._partials.form')
        </form>
    </div>
</div>
@stop
@section('js')
  <script>
     //Inicia os tooltip
     $(function () {
          $('[data-toggle="tooltip"]').tooltip()
      })  //Alert de confirmação de exclusão
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
