@extends('adminlte::page')

@section('title', "Detelhea da secretaria")

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Detalhes da  secretaria -  <strong>{{$secretary->nome}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('secretaries.index')}}">Secretarias </a></li>
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
              <strong>Nome:</strong> {{$secretary->nome}}
          </li>

          <li>
              <strong>Sigla:</strong> {{$secretary->sigla}}
          </li>    
          <li>
            <strong>Responsável:</strong> {{$secretary->nome_responsavel}}
          </li>
          <li>
            <strong>Telefone:</strong> {{$secretary->telefone}}
          </li>

          <li>
              <strong>Celular:</strong> {{$secretary->celular}}
          </li>
          <li>
              <strong>Endereço:</strong> {{$secretary->endereco}}
          </li>
          <li>
            <strong>E-mail:</strong> {{$secretary->email}}
          </li>          
          <li>
            <strong>Situação:</strong> {{$secretary->situacao ==1 ? 'Ativo':'Inativo'}}
          </li>
          <li>
            <strong>Sobre:</strong> {{$secretary->sobre}}
          </li>
          
      </ul>     
     
  </div>
@stop
