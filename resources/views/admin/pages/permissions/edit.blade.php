@extends('adminlte::page')

@section('title', "Atualizar a permissão")

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Editar permissão  <strong>{{$permission->nome}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('permissions.index')}}">Perfis </a></li>
          <li class="breadcrumb-item ">Editar permissão</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop



@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{route('permissions.update', $permission->id)}}" method="POST">
            @csrf
            @method('PUT')

            @include('admin.pages.permissions._partials.form')

        </form>
    </div>
</div>


@stop
