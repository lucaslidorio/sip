@extends('adminlte::page')

@section('title', "Detalhes do post")
@section('plugins.icheck-bootstrap', true)

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Detalhes do post -  <strong>{{$post->titulo}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('posts.index')}}">Posts </a></li>
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
              <strong>Titulo:</strong>  {{$post->titulo}}
          </li>

          <li>
              <strong>Data Publicação:</strong> {{ date('d/m/Y', strtotime($post->data_publicacao)) }}
          </li>    
          <li>
            <strong>Data Expiração:</strong> {{ date('d/m/Y', strtotime($post->data_expiracao)) }}
          </li>
          <li>
            <strong>Secretária:</strong> {{$post->secretary->sigla}} - {{$post->secretary->nome}}
          </li>
          <li>                   
            
            <strong>Categorias:</strong> &nbsp;             
              @foreach ($post->categories as $category)  
                <div class="icheck-primary icheck-inline">
                  <input type="checkbox" name="categories[]" value="{{$category->id}}" id="{{$category->id}}" checked disabled />
                  <label for="{{$category->id}}"> {{$category->nome}}</label>
                </div>    
              @endforeach 
                           
          </li>
          <li>
            <strong>Imagem Destaque:</strong><br>
            <img src="{{url("storage/{$post->img_destaque}")}}" alt="{{$post->titulo}}" style="max-width: 200px">
          </li>
          <li>
              <strong>Conteúdo:</strong> 
              <p class="text-justify">{!!$post->conteudo!!}</p>
          </li>
                   
          
          <li>
            <strong>Galeria:</strong> <br>
            @foreach ($post->imagens as $imagem)
              <img src="{{url("storage/{$imagem->img}")}}" alt="{{$post->titulo}}" style="max-width: 200px">         
            @endforeach
          </li>

          <li>
            <br>
            <strong>Postado por: </strong><span class="text-muted">{{$post->user->name}}</span>
          </li>
          
      </ul>     
     
  </div>
@stop
