@extends('adminlte::page')
@section('plugins.Summernote', true)
@section('title', "Atualizar o secretaria")
@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Editar secretaria -  <strong>{{$secretary->nome}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('secretaries.index')}}">Secretarias </a></li>
          <li class="breadcrumb-item ">Editar o Secretaria</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('secretaries.update', $secretary->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.pages.secretaries._partials.form')
        </form>
    </div>
</div>
@stop
@section('js')
  <script>
    $(function () {
     $('[data-toggle="tooltip"]').tooltip()
    }) 
    $(document).ready(function() {
      $('#summernote').summernote({
      height: 400,
      lang: 'pt-BR'
      });
    });
  </script>
@endsection
