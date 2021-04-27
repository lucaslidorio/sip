@extends('adminlte::page')

@section('title', 'Cadastrar nova Comissão')
@section('plugins.inputmask', false)
@section('plugins.Select2', true)
@section('plugins.icheck-bootstrap', true)

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Adicionar membros para - <strong>{{$directorTable->nome}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('directorTables.index')}}">Mesa Diretora </a></li>
          <li class="breadcrumb-item "> <a href="{{route('directorTableMembers.index', $directorTable->id )}}">Membros </a></li>          
          <li class="breadcrumb-item ">Adicionar Membros</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop



@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{route('directorTablesStore.store', $directorTable->id)}}" method="POST">
            @csrf
            @include('admin.pages.directorTables.members._partials.form')

        </form>
    </div>
</div>
@stop
@section('js')
  <script>
    $(directorTable () {
     $('[data-toggle="tooltip"]').tooltip()
    }) 
  </script>
@endsection


