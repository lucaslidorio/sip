@extends('adminlte::page')

@section('title', "Atualizar o perfil")

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Editar Usuário -  <strong>{{$user->name}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('users.index')}}">Usuários </a></li>
          <li class="breadcrumb-item ">Editar o Usuário</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop



@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{route('users.update', $user->id)}}" method="POST">
            @csrf
            @method('PUT')

            @include('admin.pages.users._partials.form')

        </form>
    </div>
</div>


@stop
