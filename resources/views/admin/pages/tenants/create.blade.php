@extends('adminlte::page')

@section('title', 'Cadastrar nova secretaria')
@section('plugins.inputmask', true)
@section('plugins.icheck-bootstrap', false)

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Cadastrar nova entidade</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('tenants.index')}}">Entidade </a></li>
          <li class="breadcrumb-item ">Nova Entidade</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop



@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{route('tenants.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.pages.tenants._partials.form')

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


