@extends('adminlte::page')

@section('title', "Atualizar o perfil")

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Editar perfil  <strong>{{$profile->nome}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('profiles.index')}}">Perfis </a></li>
          <li class="breadcrumb-item ">Editar Categoria</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop



@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{route('profiles.update', $profile->id)}}" method="POST">
            @csrf
            @method('PUT')

            @include('admin.pages.profiles._partials.form')

        </form>
    </div>
</div>


@stop
