@extends('adminlte::page')
@section('title', "Atualizar o função")
@section('content_header')
@section('plugins.Summernote', true)
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Editar -  <strong>{{$citizenLetter->titulo}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('citizenLetters.index')}}">Carta ao Cidadão </a></li>
          <li class="breadcrumb-item ">Editar a Carta</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('citizenLetters.update', $citizenLetter->id)}}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.pages.citizenLetters._partials.form')
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
      height: 400,
      lang: 'pt-BR'
      });
    }); 
  </script>
@endsection
