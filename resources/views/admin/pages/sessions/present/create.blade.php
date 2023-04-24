@extends('adminlte::page')

@section('title', 'Lançar Presença')
@section('plugins.inputmask', false)
@section('plugins.Select2', true)
@section('plugins.icheck-bootstrap', true)

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Laçar presença para  <strong>{{$session->nome}} {{$session->typeSession->nome}} - {{$session->legislature->descricao}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('sessions.index')}}">Sessões </a></li>                   
          <li class="breadcrumb-item ">Presença </li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop



@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{route('sessionPresentStore.store', $session->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.pages.sessions.present._partials.form')

        </form>
    </div>
</div>
@stop
@section('js')
  <script>
    $(function () {
     $('[data-toggle="tooltip"]').tooltip()
    }) ;

//marca todos os imput ao clicar em MARCAR TODOS
$(document).ready(function () {
    $('#todos').click(function () {
      var val = this.checked;
        $('.lista').each(function () {
          $(this).prop('checked', val);
          });    
    }); 
});   

  </script>
@endsection


