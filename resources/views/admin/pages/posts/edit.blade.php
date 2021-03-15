@extends('adminlte::page')

@section('title', "Atualizar  posts")

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Editar postagem -  <strong>{{$post->nome}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('posts.index')}}">Postagens </a></li>
          <li class="breadcrumb-item ">Editar o Postagem</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop



@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{route('posts.update', $post->id)}}" method="POST">
            @csrf
            @method('PUT')

            @include('admin.pages.posts._partials.form')

        </form>
    </div>
</div>


@stop
