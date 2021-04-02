@extends('adminlte::page')

@section('title', 'Cadastrar novo usuário')

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Cadastrar novo usuário</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('users.index')}}">Usuários </a></li>
          <li class="breadcrumb-item ">Novo usuário</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop

@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{route('users.store')}}" method="POST">
            @csrf
            @include('admin.pages.users._partials.form')
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
