@extends('adminlte::page')

@section('title', "Detalhe da carta ao cidadão")

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Detalhes -  <strong>{{$citizenLetter->titulo}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('citizenLetters.index')}}">Carta ao Cidadão </a></li>
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
      <p> <strong>Titúlo: </strong>{{$citizenLetter->titulo}} </p>    
      <p> <strong>Conteúdo: </strong></p>  
      <p>{!!$citizenLetter->conteudo!!}</p>
     
  </div>
@stop
