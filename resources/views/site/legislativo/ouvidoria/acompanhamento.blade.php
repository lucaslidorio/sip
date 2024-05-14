
@extends('site.legislativo.layouts.default')

@section('content')
@if($ouvidoria != null)
{{ Breadcrumbs::render('ouvidora_acompanhamento', $ouvidoria) }} 
@endif 
<div class="row">
    <h4 class="font-blue">ACOMPANHAMENTO DE MANIFESTAÇÃO </h4>    
    <div class="col sm-12"> 
        @if($ouvidoria == null)
        <div class="alert alert-danger" role="alert">
            <h6><strong>NÃO FOI POSSÍVEL ENCONTRAR UMA MANIFESTAÇÃO COM O PROTOCOLO INFORMADO.</strong></h6>
            <p><strong>Verifique o protocolo informado e tente novamente:</strong></p>
        </div>
        @else
        <div class="alert alert-success" role="alert">
            <h6><strong>INFORMAÇÃO DA MANIFESTAÇÃO</strong></h6>
            <p><strong>Sigiloso: </strong>{{$ouvidoria->sigiloso == 0 ? 'Não':'Sim'}}</p>
            <p><strong>Assunto: </strong>{{$ouvidoria->assunto_ouvidoria ? $ouvidoria->assunto_ouvidoria->nome : 'Não informado' }} </p>
            <p><strong>Data Protocolo: </strong>{{\Carbon\Carbon::parse($ouvidoria->created_at)->format('d/m/Y')}}</p>
            <h6><strong>Protocolo : {{$ouvidoria->codigo}} </strong></h6>
        </div>
        <div class="alert alert-secondary" role="alert">
            <h6><strong>MANIFESTAÇÃO</strong></h6>
            <p>{{$ouvidoria->manifestacao}}</p>
        </div>
        
        @foreach($ouvidoria->resposta_ouvidoria as $key => $resposta_ouvidoria)
        <div class="ml-5 alert alert-info" role="alert">
            <h6><strong>RESPOSTA</strong></h6>
            <p>{{$resposta_ouvidoria->resposta}}</p>
            <p class="text-right">Respondido por: {{$resposta_ouvidoria->user->name}} em {{\Carbon\Carbon::parse(  $resposta_ouvidoria->created_at)->format('d/m/Y h:m')}}</p>
        </div>
        @endforeach
        @endif    
       
        
    </div>
</div>
@endsection