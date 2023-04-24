@extends('adminlte::page')

@section('title', 'Cadastrar nova Comissão')
@section('plugins.inputmask', true)
@section('plugins.icheck-bootstrap', true)

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Cadastrar nova comissão</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('commissions.index')}}">Comissões </a></li>
          <li class="breadcrumb-item ">Nova Comissão</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop



@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{route('commissions.store')}}" method="POST">
            @csrf
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


