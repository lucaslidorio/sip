@extends('adminlte::page')

@section('title', "Atualizar o menu")

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Editar menu -  <strong>{{$menu->nome}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('menus.index')}}">menus </a></li>
          <li class="breadcrumb-item ">Editar menus</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('menus.update', $menu->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')

            @include('admin.pages.menus._partials.form')

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
