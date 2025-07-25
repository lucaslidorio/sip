
@extends('site.legislativo.layouts.default')

@section('content')
<div class="container ">
  {{ Breadcrumbs::render('vereador', $vereador) }}
<div class="row">
  <div class="col-md-4">
    <img src="{{config('app.aws_url').$vereador->img }}" class="card-img rounded" alt="{{$vereador->titulo}}" 
    style="max-width: 400px; margim:10px;" >
  </div>
  <div class="col-md-8">
    <h5 class="card-title mt-1 font-weight-bold"><strong> Nome: </strong>{{$vereador->nome}}</h5>
    <p class="card-text"><strong>Nome Parlamentar: </strong> {{$vereador->nome_parlamentar}}</p>
    <div class="row">
      <div class="col-md-6">
          <p class="card-text"><strong>Data de Nascimento : </strong>
           {{\Carbon\Carbon::parse($vereador->data_nascimento)->format('d/m/Y')}}
          </p>   
          <p class="card-text"><strong>Estado Civil : </strong> {{$vereador->estado_civil}}</p>
          <p class="card-text"><strong>Naturalidade : </strong> {{$vereador->naturalidade}}</p>
          <p class="card-text"><strong>Ocupação Profissional : </strong> {{$vereador->ocupacao_profissional}}</p>
          <p class="card-text"><strong>Escolaridade : </strong> {{$vereador->escolaridade}}</p>
          <p class="card-text"><strong>Endereço do Parlamentar : </strong> {{$vereador->endereco}}</p>
          <p class="card-text"><strong>Endereço do Gabinete : </strong> {{$vereador->endereco_gabinete}}</p>
          <p class="card-text"><strong>Atual : </strong> {{$vereador->atual == 1 ? 'Sim':'Não'}}</p>

      </div>
      <div class="col-md-6">
        <p class="card-text"><strong>E-mail : </strong> {{$vereador->email}}</p>
        <p class="card-text"><strong>Telefone Pessoal : </strong> {{$vereador->telefone}}</p>
        <p class="card-text"><strong>Telefone do Gabinete : </strong> {{$vereador->telefone_gabinete}}</p>
        <p class="card-text"><strong>Facebook : </strong>
          <a href="{{$vereador->facebook}}" class="link link-primary" target="_blank"
            data-toggle="tooltip" data-placement="top" title="Visitar perfil no facebook">
            <i class="fab fa-facebook-square" style="font-size: 30px"></i>
          </a>             
        <p class="card-text"><strong>Instagram : </strong>
          <a href="{{$vereador->instagram}}" class="link link-primary" target="_blank"
            data-toggle="tooltip" data-placement="top" title="Visitar perfil no instagram">
            <i class="fab fa-instagram-square" style="font-size: 30px; color: #dd2a7b;"></i>
          </a>        
          
          
        <p class="card-text"><strong>Partido Político : </strong> </p>
        <figure class="figure">
          <img src="{{config('app.aws_url').$vereador->party->img }}" class="figure-img img-fluid rounded" 
          alt="{{$vereador->party->nome}}" style="max-width: 150px">
          <figcaption class="figure-caption">{{$vereador->party->sigla}} - {{$vereador->party->nome}}</figcaption>
        </figure> 
        
      </div>
    </div>
  </div> 

</div>

<div class="row">
  <div class="row border-top mt-3 pl-4 pr-4" style="padding-right:20px; " >
    <p class="card-text text-justify  "><strong>Biografia:</strong> <br> {{$vereador->biografia}}</p>
  </div>
</div>
</div>
@endsection