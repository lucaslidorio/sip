@extends('adminlte::page')

@section('title', 'Cadastrar novo link')
@section('plugins.Select2', true)
@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Cadastrar novo link</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('links.index')}}">links </a></li>
          <li class="breadcrumb-item ">Novo link</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop
@section('content')


<div class="card">
    <div class="card-body">
      <form action="{{route('links.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.pages.links._partials.form')
      </form>
    </div>
</div>
@stop
@section('js')
  <script>
    $(function () {
     $('[data-toggle="tooltip"]').tooltip()
    }) 
  </script>
@endsection
