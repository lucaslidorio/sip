@extends('adminlte::page')

@section('title', 'Cadastrar nova função')
@section('plugins.inputmask', true)
@section('plugins.Select2', true)

@section('plugins.icheck-bootstrap', true)

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Vincular usuário  função</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item"><a href="{{route('userFunctions.index')}}">Funções e Usuários </a></li>
          <li class="breadcrumb-item">Novo</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop



@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{route('userFunctions.store')}}" method="POST">
            @csrf
            @include('admin.pages.userFunctions._partials.form')

        </form>
    </div>
</div>
@stop
@section('js')
  <script>
    $(function () {
     $('[data-toggle="tooltip"]').tooltip()
     $.fn.select2.defaults.set( "theme", "bootstrap" );   
     $('.select2').select2();
    }) 


  $(document).ready(function() {
    
});
  </script>
@endsection


