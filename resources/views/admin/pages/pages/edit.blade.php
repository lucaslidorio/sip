@extends('adminlte::page')
@section('plugins.Summernote', true)
@section('title', "Atualizar a página")

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Editar página -  <strong>{{$page->nome}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('pages.index')}}">páginas </a></li>
          <li class="breadcrumb-item ">Editar páginas</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('pages.update', $page->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')

            @include('admin.pages.pages._partials.form')

        </form>
    </div>
</div>
@stop
@section('js')
  <script>
    $(function () {
     $('[data-toggle="tooltip"]').tooltip()
    }) 
      //inicia o summernote  
      $(document).ready(function() {
      $('#summernote').summernote({
      height: 500,
      lang: 'pt-BR'
      });
    });
  </script>
@endsection
