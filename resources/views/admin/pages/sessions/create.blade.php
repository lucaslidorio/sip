@extends('adminlte::page')

@section('title', 'Cadastrar nova Comissão')
@section('plugins.inputmask', true)
@section('plugins.icheck-bootstrap', false)
@section('plugins.Select2', true)

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Cadastrar nova sessão</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('sessions.index')}}">Sessões </a></li>
          <li class="breadcrumb-item ">Nova Sessão</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop



@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{route('sessions.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.pages.sessions._partials.form')

        </form>
    </div>
</div>
@stop
@section('js')
  <script>
    $(minute () {
     $('[data-toggle="tooltip"]').tooltip()
    }) 
  </script>
@endsection


