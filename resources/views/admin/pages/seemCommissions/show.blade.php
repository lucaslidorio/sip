@extends('adminlte::page')
@section('plugins.icheck-bootstrap', true)
@section('title', "Detalhes da Ata")

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Detalhes da  ata -  <strong>{{$seemCommission->commission->nome}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('seemCommissions.index')}}">Pareceres</a></li>
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
    <div class="row">
      <div class="col-sm-6">
        <p class="card-text"><strong>Comissão: </strong> {{$seemCommission->commission->nome}}</p>    
        <p class="card-text"><strong>Propositura: </strong> 
          {{$seemCommission->proposition->type_proposition->nome}} 
                  {{$seemCommission->proposition->numero}} / 
                  {{\Carbon\Carbon::parse($seemCommission->proposition->data)->format('Y')}}
        </p>
        <p class="card-text"><strong>Data: </strong>  {{\Carbon\Carbon::parse($seemCommission->data)->format('d/m/Y')}}</p>
        <p class="card-text"><strong>Autoria: </strong> {{$seemCommission->autoria}}</p>
        <p class="card-text"><strong>Assunto: </strong> {{$seemCommission->assunto}}</p>
        <p class="card-text"><strong>Descrição: </strong> {{$seemCommission->descricao}}</p>
    
      </div>
     
  </div>
  <div class="row border-top mt-2 ">
    <div class="col-sm-12 " id=""> 
      <strong>Anexos:</strong>                             ​           
      @foreach ($seemCommission->attachments as $attachment)            
          <div class="row ">
          <a href="{{config('app.aws_url')."{$attachment->anexo}" }}" target="_blank" class="mb-2 text-reset" >
              <i class="far fa-file-pdf fa-2x text-danger mr-2"></i>
              <span class="mr-2"> {{$attachment->nome_original}}</span>
          </a> 
        </div>          
      @endforeach           
   </div>
  </div>
@stop
