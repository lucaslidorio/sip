@extends('adminlte::page')

@section('title', "Atualizar tipo de matéria")

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Editar matéria -  <strong>{{$tipoMateria->nome}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('tipoMaterias.index')}}">Matérias </a></li>
          <li class="breadcrumb-item ">Editar tipo de matéria</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('tipoMaterias.update', $tipoMateria->id)}}" method="POST">
            @csrf
            @method('put')

            @include('admin.pages.tipoMaterias._partials.form')

        </form>
    </div>
</div>
@stop
@section('js')
  <script>
    $(function () {
     $('[data-toggle="tooltip"]').tooltip()
    }) 
  </script>
@endsection
