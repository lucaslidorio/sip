@extends('adminlte::page')
@section('title', "Atualizar o comissão")
@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Editar comissão -  <strong>{{$commission->nome}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('commissions.index')}}">Comisões </a></li>
          <li class="breadcrumb-item ">Editar a Comissão</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('commissions.update', $commission->id)}}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.pages.commissions._partials.form')
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
