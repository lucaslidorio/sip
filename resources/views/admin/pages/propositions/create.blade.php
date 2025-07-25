@extends('adminlte::page')
@section('title', 'Cadastrar nova Proposição')
@section('plugins.inputmask', false)
@section('plugins.icheck-bootstrap', true)
@section('plugins.Select2', true)
@section('plugins.Summernote', true)

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Cadastrar nova proposição</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('propositions.index')}}">Proposições </a></li>
          <li class="breadcrumb-item ">Nova Proposição</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop



@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{route('propositions.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.pages.propositions._partials.form')

        </form>
    </div>
</div>
@stop
@section('js')

<script>  
    //inicia o tooltip
    $(function () {
     $('[data-toggle="tooltip"]').tooltip()
     $.fn.select2.defaults.set( "theme", "bootstrap" );   
     $('.select2').select2();
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



