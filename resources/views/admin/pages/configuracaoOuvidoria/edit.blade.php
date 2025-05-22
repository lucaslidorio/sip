@extends('adminlte::page')

@section('title', "Editar configuração")

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Editar configuração</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('ouvidoria.configuracao.index')}}">Configuração Ouvidoria </a></li>
          <li class="breadcrumb-item ">Editar </li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('ouvidoria.configuracao.update', $configuracao->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')

            @include('admin.pages.configuracaoOuvidoria._partials.form')

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
