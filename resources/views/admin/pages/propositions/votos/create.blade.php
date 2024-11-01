@extends('adminlte::page')

@section('title', 'Votação')
@section('plugins.inputmask', false)
@section('plugins.icheck-bootstrap', true)

@section('content_header')

{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/loading.js/1.9.0/loading.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/loading.js/1.9.0/loading.min.js"></script> --}}

<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Laçar presença para a propositura Nº.  <strong>{{$proposition->numero}}</strong></h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
        <li class="breadcrumb-item "> <a href="{{route('propositions.index')}}">Proposições </a></li>
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
    <form action="{{route('storeVotoCouncilor.store', $proposition->id)}}" method="POST" enctype="multipart/form-data">
      @csrf
      @include('admin.pages.propositions.votos._partials.form')

    </form>
  </div>
</div>
@stop
@section('js')
<script>
  $(function () {
     $('[data-toggle="tooltip"]').tooltip();
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