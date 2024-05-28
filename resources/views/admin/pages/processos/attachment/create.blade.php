@extends('adminlte::page')

@section('title', 'Cadastrar novo Anexo')
@section('plugins.inputmask', false)
@section('plugins.Select2', true)
@section('plugins.icheck-bootstrap', true)

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Anexar Documento - <strong>{{$processo->numero}} /{{$processo->data_publicacao->year}} -
          {{$processo->modalidade->nome}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('processos.index')}}">Processos </a></li>                   
          <li class="breadcrumb-item ">Adicionar anexo</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop



@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{route('processoAttachmentStore.store', $processo->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.pages.processos.attachment._partials.form')

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


