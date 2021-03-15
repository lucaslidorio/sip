@extends('adminlte::page')

@section('title', 'Cadastrar novo post')
@section('plugins.Select2', true)
@section('plugins.icheck-bootstrap', true)

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Cadastrar novo post</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('posts.index')}}">Postagens </a></li>
          <li class="breadcrumb-item ">Nova Secretaria</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop



@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{route('posts.store')}}" method="POST">
            @csrf
            @include('admin.pages.posts._partials.form')

        </form>
    </div>
</div>

@stop

@section('js')
<script src="../../dashboard/js/main.js"></script>
  
@endsection


