@extends('adminlte::page')

@section('title', "Detelhe do Parlamentar")

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Detalhes do  Parlamentar -  <strong>{{$councilor->nome}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('councilors.index')}}">Parlamentares </a></li>
          <li class="breadcrumb-item ">Detalhes</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop



@section('content')

<div class="card mb-3 mt-3">
  <div class="row no-gutters " style="padding:20px">
    <div class="col-md-2">
      <img src="{{url("storage/{$councilor->img}")}}" class="card-img rounded" alt="{{$councilor->titulo}}" 
      style="max-width: 240px; margim:10px;" >
    </div>
    <div class="col-md-5" style="padding-left: 15px" >     
        <h5 class="card-title mt-1"><strong> Nome: </strong>{{$councilor->nome}}</h5>
        <p class="card-text"><strong>Nome Parlamentar: </strong> {{$councilor->nome_parlamentar}}</p>
        <p class="card-text"><strong>Data de Nascimento : </strong>
          <td>{{\Carbon\Carbon::parse($councilor->data_nascimento)->format('d/m/Y')}}</td>
        </p>
        <p class="card-text"><strong>CPF : </strong> {{$councilor->cpf}}</p>
        <p class="card-text"><strong>Estado Civil : </strong> {{$councilor->estado_civil}}</p>
        <p class="card-text"><strong>Naturalidade : </strong> {{$councilor->naturalidade}}</p>
        <p class="card-text"><strong>Ocupação Profissional : </strong> {{$councilor->ocupacao_profissional}}</p>
        <p class="card-text"><strong>Escolaridade : </strong> {{$councilor->escolaridade}}</p>
        <p class="card-text"><strong>Endereço do Parlamentar : </strong> {{$councilor->endereco}}</p>
        <p class="card-text"><strong>Atual : </strong> {{$councilor->atual == 1 ? 'Sim':'Não'}}</p>
        <td>
    </div>
    <div class="col-md-5" style="padding-left: 15px">  
        <p class="card-text"><strong>Endereço do Gabinete : </strong> {{$councilor->endereco_gabinete}}</p>
        <p class="card-text"><strong>Telefone Pessoal : </strong> {{$councilor->telefone}}</p>
        <p class="card-text"><strong>Telefone do Gabinete : </strong> {{$councilor->telefone_gabinete}}</p>
        <p class="card-text"><strong>Facebook : </strong>
          <a href="{{$councilor->facebook}}" class="link link-primary" target="_blank"
            data-toggle="tooltip" data-placement="top" title="Visitar perfil no facebook">
            <i class="fab fa-facebook-square" style="font-size: 30px"></i>
          </a>             
        <p class="card-text"><strong>Instagram : </strong>
          <a href="{{$councilor->instagram}}" class="link link-primary" target="_blank"
            data-toggle="tooltip" data-placement="top" title="Visitar perfil no instagram">
            <i class="fab fa-instagram-square" style="font-size: 30px; color: #dd2a7b;"></i>
          </a>         
          
          
        <p class="card-text"><strong>Partido Político : </strong> </p>
        <figure class="figure">
          <img src="{{url("storage/{$councilor->party->img}")}}" class="figure-img img-fluid rounded" 
          alt="{{$councilor->party->nome}}" style="max-width: 150px">
          <figcaption class="figure-caption">{{$councilor->party->sigla}} - {{$councilor->party->nome}}</figcaption>
        </figure>      
        
        
        
      
    </div>
    <div class="row border-top mt-3 " style="padding-right:20px" >
      <p class="card-text text-justify"><strong>Biografia:</strong> <br> {{$councilor->biografia}}</p>
    </div>
    
  </div>
  <div class="card-footer">
    <a class="btn btn-primary" href={{route('councilors.edit', ['id'=>$councilor->id])}} role="button" data-toggle="tooltip" 
    data-placement="top" title="Editar parlamentar">
    <i class="fas fa-edit" ></i> Editar</a>
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
