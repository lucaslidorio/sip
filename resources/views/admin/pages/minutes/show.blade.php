@extends('adminlte::page')
@section('plugins.icheck-bootstrap', true)
@section('title', "Detelhea da Ata")

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Detalhes da  ata -  <strong>{{$minute->nome}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('minutes.index')}}">Atas </a></li>
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
        <p class="card-text"><strong>Nome: </strong> {{$minute->nome}}</p>    
        <p class="card-text"><strong>Descrição: </strong> {{$minute->descricao}}</p>
        <p class="card-text"><strong>Tipo: </strong>  {{$minute->type->nome}}</p>
        <p class="card-text"><strong>Legislatura: </strong> {{$minute->legislature->descricao}}</p>
        <p class="card-text"><strong>Sessão: </strong> {{$minute->section->descricao}}</p>
    
      </div>
      <div class="col-sm-6">
        <p class="card-text"><strong>Vereadores Presentes: </strong></p>
        <div class="card-body ">
          @foreach ($councilors as $councilor)            
          <div class="icheck-primary icheck-block  {{ $errors->has('councilors') ? 'is-invalid' : '' }}" >
             <input type="checkbox" name="councilors[]" value="{{$councilor->id}}" id="{{$councilor->id}}" disabled
              @isset($minute)
                     @foreach ($minute->councilors as $minuteCouncilor)                                           
                             {{$councilor->id == $minuteCouncilor->id ? 'checked' : ''}}        
                     @endforeach               
              @endisset  />
           <label for="{{$councilor->id}}"> {{$councilor->nome}}</label>     
         </div>                
         @endforeach      
     
      </div>
    </div>   
  </div>
  <div class="row border-top mt-2 ">
    <div class="col-sm-12 " id=""> 
      <strong>Anexos:</strong>                             ​           
      @foreach ($minute->attachments as $attachment)            
          <div class="row ">
          <a href="{{url("storage/{$attachment->anexo}")}}" target="_blank" class="mb-2 text-reset" >
              <i class="far fa-file-pdf fa-2x text-danger mr-2"></i>
              <span class="mr-2"> {{$attachment->nome_original}}</span>
          </a> 
        </div>          
      @endforeach           
   </div>
  </div>
@stop
