@extends('adminlte::page')

@section('title', "Detalhes do documento")
@section('plugins.icheck-bootstrap', true)

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1> <strong>{{$documento->titulo}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('documentos.index')}}">Documentos </a></li>
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
      <ul class="list-unstyled">
          <li>
              <strong>Titulo:</strong>  {{$documento->titulo}}
          </li>

          <li>
              <strong>Data Publicação:</strong> {{ date('d/m/Y', strtotime($documento->data_publicacao)) }}
          </li>
          <li>
            <strong>Tipo de Matéria:</strong> {{$documento->tipoMateria->nome}}
          </li>
          <li>
            <strong>Sub tipo de Matéria:</strong> {{$documento->subTipoMateria->nome}}
          </li> 
          <li>
              <strong>Conteúdo:</strong> 
              <p class="text-justify">{!!$documento->conteudo!!}</p>
          </li>
                   
          
          

          
          
      </ul>     
     
  </div>
  <div class="card-footer">
    <div class="text-right">      
      <small><strong>Criado por: </strong><small >{{$documento->user->name}} <strong>em </strong>  {{ $documento->created_at }}</small></small> <br>
      <small><strong>Útima alteração por: </strong>{{$documento->userLastUpdate->name}} <strong>em </strong>  {{ $documento->updated_at }} </span></small>
    </div>
   
    @if($documento->assinaturas->count() > 0)
      <x-assinatura :assinaturas="$documento->assinaturas->where('status', true)" :municipio="config('app.municipio')" 
      :codigoverificacao="$documento->codigo_verificacao" :iddocumento="$documento->uuid" />
    @endif
   
  </div>
@stop
