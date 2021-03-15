@extends('adminlte::page')

@section('title', "Detelhea da post")

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Detalhes do post -  <strong>{{$post->nome}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('posts.index')}}">Secretarias </a></li>
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
              <strong>Nome:</strong> {{$post->nome}}
          </li>

          <li>
              <strong>Sigla:</strong> {{$post->sigla}}
          </li>    
          <li>
            <strong>Responsável:</strong> {{$post->nome_responsavel}}
          </li>
          <li>
            <strong>Telefone:</strong> {{$post->telefone}}
          </li>

          <li>
              <strong>Celular:</strong> {{$post->celular}}
          </li>
          <li>
              <strong>Endereço:</strong> {{$post->endereco}}
          </li>
          <li>
            <strong>E-mail:</strong> {{$post->email}}
          </li>          
          <li>
            <strong>Situação:</strong> {{$post->situacao ==1 ? 'Ativo':'Inativo'}}
          </li>
          <li>
            <strong>Sobre:</strong> {{$post->sobre}}
          </li>
          
      </ul>     
     
  </div>
@stop
