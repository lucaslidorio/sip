@extends('adminlte::page')

@section('title', 'Cadastrar nova Comissão')
@section('plugins.inputmask', false)
@section('plugins.Select2', true)
@section('plugins.icheck-bootstrap', false)

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Adicionar vereador para - <strong>{{$legislature->descricao}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('legislatures.index')}}">Legislaturas </a></li>
          <li class="breadcrumb-item "> <a href="{{route('legislatureCouncilors.index', $legislature->id )}}">Vereadores </a></li>          
          <li class="breadcrumb-item ">Adicionar Vereador</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop



@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{route('legislatureCouncilorsStore.store', $legislature->id)}}" method="POST">
            @csrf
            @include('admin.pages.legislatures.members._partials.form')

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


