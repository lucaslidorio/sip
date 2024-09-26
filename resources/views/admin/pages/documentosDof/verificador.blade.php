@extends('adminlte::page')

@section('title', "Detalhes do documento")

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1> </strong></h1>
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
          
    <h3>Verificação de Autenticidade</h3>
    @if($documentoIntegro)
    <div class="alert alert-success">
        O documento é íntegro e não foi alterado desde a última assinatura válida.
    </div>
    @else
        <div class="alert alert-danger">
            O documento foi alterado após a última assinatura. <strong>Data de modificação {{$dataAlteracao}}</strong> 
        </div>
    @endif
    

    <div class="row">
      <!-- Coluna de Assinaturas Válidas -->
      <div class="col-md-6">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">Assinaturas Válidas</h3>
          </div>        
          <div class="card-body">
             <div class="direct-chat-infos clearfix pl-2">
                  @if($assinaturasValidas->count() > 0)
                    @foreach($assinaturasValidas as $assinatura)
                    <p class="font-weight-bold mb-0"> {{ $assinatura->user->name }} </p>
                    <p class="mb-0">Data da assinatura: {{ $assinatura->data_assinatura->format('d/m/Y H:i:s') }}</p>
                    <p class=" mb-0">Código de Verificação: <span class="font-weight-bold">{{ $assinatura->codigo_verificacao }}</span></p>
                    <hr>
                    @endforeach
                  @else
                    <p>Não há assinaturas válidas.</p>
                  @endif
                </div>            
                    
          </div>      
      </div>      
  </div>
  <div class="col-md-6"><!-- Coluna de Assinaturas Inválidas -->
    
      <div class="card card-danger card-outline">
        <div class="card-header">
          <h3 class="card-title">Assinaturas Inválidas</h3>
        </div>        
        <div class="card-body">        
          
              <div class=" clearfix pl-2">
                @if($assinaturasInvalidas->count() > 0)
                  @foreach($assinaturasInvalidas as $assinatura)
                  <p class="font-weight-bold mb-0"> {{ $assinatura->user->name }} </p>
                  <p class="mb-0">Data da assinatura: {{ $assinatura->data_assinatura->format('d/m/Y H:i:s') }}</p>
                  <p class="mb-0">Código de Verificação: <span class="font-weight-bold">{{ $assinatura->codigo_verificacao }}</span></p>
                  <p class="mb-0">Data da alteração do documento: {{ $assinatura->updated_at->format('d/m/Y H:i:s') }}</p>
                  <hr>
                  @endforeach
                @else
                  <p>Não há assinaturas Inválidas.</p>
                @endif                       
          </div>        
        </div>  
    </div>
  </div>
</div>    
  </div>
  <div class="card-footer">
   {{$documento->uuid}}
  </div>
@stop
