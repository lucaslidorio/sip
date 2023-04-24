@extends('adminlte::page')
@section('title', 'Cadastrar novo post')
@section('plugins.Select2', false)
@section('plugins.Summernote', true)
@section('plugins.icheck-bootstrap', true)

@section('content_header')
@section('css')
  <link rel="stylesheet" href="../../dashboard/css/dropzone.css">
@endsection
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
        <form action="{{route('posts.store')}}"  method="POST" enctype="multipart/form-data" >
            @csrf
            @include('admin.pages.posts._partials.form')
          

        </form>
    </div>
</div>

@endsection
@section('js')
<script src="../../dashboard/js/summernote-pt-br.js"></script> 
<script src="../../dashboard/js/dropzone.js"></script>   
<script>  
    //inicia o tooltip
    $(function () {
     $('[data-toggle="tooltip"]').tooltip()
    }) 
  
    //inicia o summernote  
    $(document).ready(function() {
      $('#summernote').summernote({
      height: 400,
      lang: 'pt-BR'
      });
    });
  </script>
@endsection


