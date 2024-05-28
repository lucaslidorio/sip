@extends('adminlte::page')
@section('title', "Atualizar o processos")
@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Editar processo -  <strong>{{$processo->numero}} /{{$processo->data_publicacao->year}} - 
        {{$processo->modalidade->nome}}
        </strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('processos.index')}}">Processos </a></li>
          <li class="breadcrumb-item ">Editar o Processos</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('processos.update', $processo->id)}}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.pages.processos._partials.form')
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
