@extends('adminlte::page')

@section('title', 'Cadastrar nova categoria')

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Cadastrar nova categoria</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('categorias.index')}}">Categorias </a></li>
          <li class="breadcrumb-item ">Nova categoria</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop



@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{route('categorias.store')}}" method="POST">
            @csrf
            @include('admin.pages.categorias._partials.form')

        </form>
    </div>
</div>


@stop
