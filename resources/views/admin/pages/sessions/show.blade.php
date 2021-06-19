@extends('adminlte::page')
@section('plugins.icheck-bootstrap', true)
@section('title', "Detalhes da Sessão")

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Detalhes da  Sessão -  <strong>{{$session->nome}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('sessions.index')}}">Sessões </a></li>
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
        <p class="card-text"><strong>Nome: </strong> {{$session->nome}}</p>  
        <p class="card-text"><strong>Tipo: </strong> {{$session->typeSession->nome}}</p>  
        <p class="card-text"><strong>Data: </strong>{{\Carbon\Carbon::parse($session->data)->format('d/m/Y')}}</p>
        <p class="card-text"><strong>Hora: </strong>  {{$session->hora}}</p>        
        <p class="card-text"><strong>Legislatura: </strong> {{$session->legislature->descricao}}</p>
        <p class="card-text"><strong>Sessão Legislativa: </strong> {{$session->section->descricao}}</p>
        <p class="card-text"><strong>Periódo Legislativo: </strong> {{$session->period->nome}}</p>
        <p class="card-text"><strong>Descrição: </strong> {{$session->descricao}}</p>
      </div>
      <div class="col-sm-6">
           <h5><strong> Vereadores Presentes </strong></h5>

           @foreach ($councilors as $councilor)          
           <div class="icheck-primary">
              <input type="checkbox" class="lista" name="councilors[]" value="{{$councilor->id}}" id="{{$councilor->id}}"
               
                      @foreach ($session->councilors_present as $sessionCouncilor)                                           
                              {{$councilor->id == $sessionCouncilor->id ? 'checked' : ''}}        
                      @endforeach               
             
              disabled />
            <label class="check" for="{{$councilor->id}}"> {{$councilor->nome}}</label>     
          </div> 
                
          @endforeach
     
      </div>
    </div> 
    <table class="table  table-hover table-borderless border-top mt-2 table-sm ">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Anexo</th>
          <th scope="col">Descrição</th>
          <th scope="col">Tipo de documento</th>
          
        </tr>
      </thead>
      <tbody>
        @foreach ($session->attachments as $attachment) 
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
          <td>
             <a href="{{config('app.aws_url')."{$attachment->anexo}" }}" 
              target="_blank" class="mb-2 text-reset"
              data-toggle="tooltip" data-placement="top" 
                  title="Clique para abrir o documento" >
                <i class="far fa-file-pdf fa-2x text-danger mr-2"></i>
                <span class="mr-2"> {{$attachment->nome_original}}</span>                
            </a>
          </td>
          <td>
            {{$attachment->descricao}}
          </td>
          <td>
            <span class="mr-2"> {{$attachment->type_document->nome}}</span> 
          </td>
          </tr>
        @endforeach  
      
      </tbody>
    </table>
    </div>  
  </div>
 
@stop
@section('js')
  <script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    }) 
  </script>
@endsection
