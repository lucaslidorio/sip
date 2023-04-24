@extends('adminlte::page')

@section('title', 'Cadastrar nova Comissão')
@section('plugins.inputmask', false)
@section('plugins.Select2', true)
@section('plugins.icheck-bootstrap', false)

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Cadastrar mesa diretora</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('directorTables.index')}}">Mesa Diretora </a></li>
          <li class="breadcrumb-item ">Nova Mesa Diretora</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop



@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{route('directorTables.store')}}" method="POST">
            @csrf
            @include('admin.pages.directorTables._partials.form')

        </form>
    </div>
</div>
@stop
@section('js')
  <script>
    $(commission () {
     $('[data-toggle="tooltip"]').tooltip()
    }) 
  </script>
@endsection


