@extends('adminlte::page')

@section('title', 'Cadastrar nova secretaria')

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Cadastrar nova secretaria</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('secretaries.index')}}">Secretarias </a></li>
          <li class="breadcrumb-item ">Nova Secretaria</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop



@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{route('secretaries.store')}}" method="POST">
            @csrf
            @include('admin.pages.secretaries._partials.form')

        </form>
    </div>
</div>


@stop
