@extends('adminlte::page')

@section('title', 'Cadastrar nova perfil')

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Cadastrar novo perfil</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('profiles.index')}}">Perfil </a></li>
          <li class="breadcrumb-item ">Novo perfil</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop



@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{route('profiles.store')}}" method="POST">
            @csrf
            @include('admin.pages.profiles._partials.form')

        </form>
    </div>
</div>


@stop
