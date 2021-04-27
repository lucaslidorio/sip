@extends('adminlte::page')
@section('title', "Atualizar o Mesa Diretora")
@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Editar messa diretora -  <strong>{{$directorTable->nome}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('directorTables.index')}}">Mesa Diretora </a></li>
          <li class="breadcrumb-item ">Editar a Mesa Diretora</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('directorTables.update', $directorTable->id)}}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.pages.directorTables._partials.form')
        </form>
    </div>
</div>
@stop
@section('js')
  <script>
    $(directorTable () {
     $('[data-toggle="tooltip"]').tooltip()
    }) 
  </script>
@endsection
