@extends('adminlte::page')

@section('title', 'Cadastrar nova Configuração')
@section('plugins.Select2', false)
@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Cadastrar nova Configuração</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('ouvidoria.configuracao.index')}}">Configuração Ouvidoria</a></li>
          <li class="breadcrumb-item ">Nova</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop
@section('content')

<form action="{{route('ouvidoria.configuracao.store')}}" method="POST" enctype="multipart/form-data">
  @csrf
  @include('admin.pages.configuracaoOuvidoria._partials.form')
</form>

@stop
@section('js')
  <script>
    $(function () {
     $('[data-toggle="tooltip"]').tooltip()
    }) 
  </script>
@endsection
