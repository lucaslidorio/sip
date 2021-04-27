@extends('adminlte::page')

@section('title', 'Cadastrar novo partido')
@section('plugins.Select2', true)
@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Cadastrar novo partido</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('parties.index')}}">Partidos </a></li>
          <li class="breadcrumb-item ">Novo partido</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop
@section('content')

<form action="{{route('parties.store')}}" method="POST" enctype="multipart/form-data">
  @csrf
  @include('admin.pages.parties._partials.form')
</form>
{{-- <div class="card">
    <div class="card-body">
        <form action="{{route('parties.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.pages.parties._partials.form')
        </form>
    </div>
</div> --}}
@stop
@section('js')
  <script>
    $(function () {
     $('[data-toggle="tooltip"]').tooltip()
    }) 
  </script>
@endsection
