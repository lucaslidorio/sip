@extends('adminlte::page')

@section('title', "Atualizar o perfil")

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Detalhes do  Usuário -  <strong>{{$user->name}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('users.index')}}">Usuários </a></li>
          <li class="breadcrumb-item ">Detalhes</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop



@section('content')
<div class="card">
  <div class="card-body">
      <ul>
          <li>
              <strong>Nome:</strong> {{$user->name}}
          </li>
          <li>
              <strong>Email:</strong> {{$user->email}}
          </li>
          <li>
              <strong>Matrícula:</strong> R$ {{$user->matricula}}
          </li>
          
      </ul>     
     
  </div>
@stop
