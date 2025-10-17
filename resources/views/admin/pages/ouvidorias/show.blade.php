@extends('adminlte::page')

@section('title', "Detalhe da ouvidoria")

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Detalhes da  Manifestação -  <strong>{{$ouvidoria->nome}}</strong></h1> 
        
      </div>
      
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('ouvidorias.index')}}">Parlamentares </a></li>
          <li class="breadcrumb-item ">Detalhes</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop


@section('content')

<div class="card mb-3 m-3">
  <div class="card-body">
  <div class="row no-gutters border-bottom pb-2 pt-2 pl-3">
    <h5 class="text-bold mr-5">Dados Pessoais</h5>
    @if (count($ouvidoria->resposta_ouvidoria) > 0)
    <div class="alert alert-success pb-1 pt-1 mb-0" role="alert">
      Manifestação Respondida
    </div>
    @endif   
   </div>
  @if (!$ouvidoria->anonimo)
  <div class="row no-gutters ">
  
    <div class="col-md-6" style="padding-left: 15px">
      <h5 class="card-title mt-1"><strong> Anônimo: </strong>{{$ouvidoria->anonimo ? 'Sim' : 'Não'}}</h5>
      <p class="card-text"><strong>Nome: </strong>{{$ouvidoria->nome}} </p>
      <p class="card-text"><strong>Data de Nascimento : </strong>
        <td>{{\Carbon\Carbon::parse($ouvidoria->data_nascimento)->format('d/m/Y')}}</td>
      </p>
      <p class="card-text"><strong>CPF : </strong> {{$ouvidoria->cpf}}</p>
      <p class="card-text"><strong>E-mail : </strong>{{$ouvidoria->email}} </p>
      <p class="card-text"><strong>Genero : </strong>{{$ouvidoria->genero == 1 ? 'Masculino' : 'Feminino'}} </p>
      <p class="card-text"><strong>Idade : </strong>{{$ouvidoria->idade}} </p>
      <p class="card-text"><strong>Filhos : </strong>{{$ouvidoria->quant_filhos}} </p>
    </div>
    <div class="col-md-6" style="padding-left: 15px">
      <p class="card-text"><strong>Telefone : </strong>{{$ouvidoria->telefone}} </p>
      <p class="card-text"><strong>Celular : </strong> {{$ouvidoria->celular}}</p>
      <p class="card-text"><strong>Endereço : </strong>{{$ouvidoria->endereço}}</p>
      <p class="card-text"><strong>Número : </strong> {{$ouvidoria->numero_endereco}}</p>
      <p class="card-text"><strong>Bairro : </strong>{{$ouvidoria->bairro}} </p>
      <p class="card-text"><strong>Cidade : </strong>{{$ouvidoria->cidade}} {{$ouvidoria->uf}} </p>
      <p class="card-text"><strong>Cidade : </strong>{{$ouvidoria->complemento}} </p>
      <p class="card-text"><strong>Oculpacao : </strong>{{$ocupacao[$ouvidoria->ocupacao]}} </p>
    </div>  
  </div>  
  @else
    <div class="alert alert-dark" role="alert">
      <h5 class="text-bold">Manifestação anônima</h5>
    </div>
  @endif
  
  <div class="row no-gutters border-bottom pb-2 pt-2 pl-3">
    <h5 class="text-bold">Dados da Manifestação</h5> 
   </div>
   <div class="row no-gutters " > 
      <div class="col-md-4" style="padding-left: 15px">  
        <p class="card-text"><strong>Orgão : </strong>{{$ouvidoria->orgao_ouvidoria ? $ouvidoria->orgao_ouvidoria->nome : ''}} </p>
      </div>  
      <div class="col-md-4" style="padding-left: 15px">  
        <p class="card-text"><strong>Assunto : </strong>{{$ouvidoria->assunto_ouvidoria ? $ouvidoria->assunto_ouvidoria->nome : ''}} </p>
      </div>
      <div class="col-md-4" style="padding-left: 15px">    <p class="card-text"><strong>Perfil : </strong>{{$ouvidoria->perfil_ouvidoria ? $ouvidoria->perfil_ouvidoria->nome : ''}} </p>
      </div>   
  </div>
  <div class="row pr-3 m-3" style="padding-right:20px" >
    <p class="card-text text-justify"><strong>Manifestação:</strong><br>
      {{$ouvidoria->manifestacao}}</p>       
  </div>
  <div class="pl-3">
    <p>Anexos</p>   
    @foreach ($ouvidoria->anexos as $anexo) 
                      
                  <a href="{{config('app.aws_url')."{$anexo->anexo}" }}" 
                    target="_blank" class="mb-2 text-reset"
                    data-toggle="tooltip" data-placement="top" 
                        title={{$anexo->nome_original}} >
                      <i class="fas fa-paperclip fa-2x  mr-2"></i>
                     
                  </a>                             
                  @endforeach 
  </div>
  @foreach ($ouvidoria->resposta_ouvidoria as $resposta)
    <div class="row pr-3 m-3" style="padding-right:20px" >
      <p class="card-text text-justify"><strong>Resposta:</strong><br>
        <span class="font-italic">{{{$resposta->resposta}}}</span></p>            
    </div>
    <div class="row float-right d-inline pr-5">
      <span class="float-right">Respondido por: {{$resposta->user->name}},
         em {{\Carbon\Carbon::parse(  $resposta->created_at)->format('d/m/Y h:m')}} </span>
    </div>
  @endforeach 
  </div>
  <div class="card-footer">
    <a class="btn btn-secondary" href={{route('ouvidorias.index')}} role="button" data-toggle="tooltip" 
      data-placement="top" title="Voltar">
      <i class="fas fa-angle-double-left" ></i> Voltar
    </a>
    <a class="btn btn-primary" href={{route('ouvidorias.edit', ['id'=>$ouvidoria->id])}} role="button" data-toggle="tooltip" 
    data-placement="top" title="Responder">
    <i class="fas fa-reply" ></i> Responder
  </a>
  </div>
 
</div>


@section('js')
<script>  
  //inicia o tooltip
  $(function () {
   $('[data-toggle="tooltip"]').tooltip()
  }) 
 
</script>
    
@endsection
@stop
