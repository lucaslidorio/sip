@extends('adminlte::page')
@section('title', "Atualizar o secretaria")
@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Editar entidade -  <strong>{{$tenant->nome}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('tenants.index')}}">Entidades </a></li>
          <li class="breadcrumb-item ">Editar o Entidade</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop


@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('tenants.update', $tenant->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
