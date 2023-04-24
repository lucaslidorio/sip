@extends('adminlte::page')

@section('title', 'Cadastrar nova Legislação')
@section('plugins.inputmask', false)
@section('plugins.Summernote', true)
@section('plugins.icheck-bootstrap', true)
@section('plugins.Select2', true)

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Cadastrar nova Legislação</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('legislations.index')}}">Legislações </a></li>
          <li class="breadcrumb-item ">Nova Legislação</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop


@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{route('legislations.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.pages.legislations._partials.form')

        </form>
    </div>
</div>
@stop
@section('js')
  <script src="../../dashboard/js/summernote-pt-br.js"></script> 
  <script>  
      //inicia o tooltip
      $(function () {
       $('[data-toggle="tooltip"]').tooltip()
      }) 
    
      //inicia o summernote  
      $(document).ready(function() {
        $('#summernote').summernote({
        lang: 'pt-BR'
        });
      });
    </script>
@endsection


