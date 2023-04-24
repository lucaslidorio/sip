@extends('adminlte::page')
@section('title', "Atualizar o atas")
@section('content_header')
@section('plugins.icheck-bootstrap', true)
@section('plugins.Select2', true)
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Editar ata -  <strong>{{$minute->nome}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('minutes.index')}}">Atas </a></li>
          <li class="breadcrumb-item ">Editar a Atas</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('minutes.update', $minute->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.pages.minutes._partials.form')
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
              window.location.href = url +"#galeria";
            }
          })  
  });
  </script>
@endsection
