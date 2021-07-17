@extends('adminlte::page')
@section('title', 'Cadastrar Carta ao Cidadão')
@section('plugins.inputmask', false)
@section('plugins.Summernote', true)
@section('plugins.icheck-bootstrap', true)

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Cadastrar carta ao cidadão</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('functions.index')}}">Carta ao Cidadão </a></li>
          <li class="breadcrumb-item ">Nova Carta</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop



@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{route('citizenLetters.store')}}" method="POST">
            @csrf
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
        height: 200,
      lang: 'pt-BR'
      });
    });
  </script>
@endsection


