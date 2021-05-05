@extends('adminlte::page')

@section('title', "Detalhe da entidade")

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-8">
        <h1>Detalhes da  entidade -  <strong>{{$tenant->nome}}</strong></h1>
      </div>
      <div class="col-sm-4">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('secretaries.index')}}">Entidades </a></li>
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
    <div class="row no-gutters " style="padding:20px">
      
      <div class="col-md-6" style="padding-left: 15px" >     
          <h5 class="card-title mt-1"><strong> Nome: </strong>{{$tenant->nome}}</h5>
          <p class="card-text"><strong>Endereço: </strong> {{$tenant->endereco}}</p>
          <p class="card-text"><strong>Numero : </strong> {{$tenant->numero}} </p>
           
          <p class="card-text"><strong>Bairro : </strong> {{$tenant->bairro}}</p>
          <p class="card-text"><strong>Cidade: </strong> {{$tenant->cidade}}</p>
          <p class="card-text"><strong>Telefone : </strong> {{$tenant->telefone}}</p>
          <p class="card-text"><strong>Celular : </strong> {{$tenant->celular}}</p>
          <p class="card-text"><strong>E-mail: </strong> {{$tenant->email}}</p>
          <p class="card-text"><strong>Cnpj : </strong> {{$tenant->cnpj}}</p>
          <p class="card-text"><strong>Dias de atendimento : </strong> {{$tenant->dia_atendimento}}</p>
                   <td>
      </div>
      <div class="col-md-6" style="padding-left: 15px">            
          <p class="card-text"><strong>Facebook : </strong>
            <a href="{{$tenant->facebook}}" class="link link-primary" target="_blank"
              data-toggle="tooltip" data-placement="top" title="Visitar perfil no facebook">
              <i class="fab fa-facebook-square" style="font-size: 30px"></i>
            </a>    
            <p class="card-text"><strong>YouTube : </strong>
              <a href="{{$tenant->youtube}}" class="link link-primary" target="_blank"
                data-toggle="tooltip" data-placement="top" title="Visitar perfil no YouTube">
                <i class="fab fa-youtube" style="font-size: 30px; color: red;"></i>
              </a>         
                       
          <p class="card-text"><strong>Instagram : </strong>
            <a href="{{$tenant->instagram}}" class="link link-primary" target="_blank"
              data-toggle="tooltip" data-placement="top" title="Visitar perfil no instagram">
              <i class="fab fa-instagram-square" style="font-size: 30px; color: #dd2a7b;"></i>
            </a> 
            <p class="card-text"><strong>Twitter : </strong>
              <a href="{{$tenant->twitter}}" class="link link-primary" target="_blank"
                data-toggle="tooltip" data-placement="top" title="Visitar perfil no twitter">
                <i class="fab fa-twitter" style="font-size: 30px; color: rgb(64, 113, 219);"></i>
              </a>         
                      
            
            
          <p class="card-text"><strong>Brasão : </strong> </p>
          <figure class="figure">
            <img src="{{env('AWS_URL')."/{$tenant->brasao}" }}" class="figure-img img-fluid rounded" 
            alt="{{$tenant->brasao}}" style="max-width: 150px">          
          </figure> 
          <p class="card-text"><strong>Bandeira : </strong> </p>
          <figure class="figure">
            <img src="{{env('AWS_URL')."/{$tenant->bandeira}" }}" class="figure-img img-fluid rounded" 
            alt="{{$tenant->bandeira}}" style="max-width: 150px">          
          </figure>    
          
      </div>
      
      
    </div>
  </div>
@stop
