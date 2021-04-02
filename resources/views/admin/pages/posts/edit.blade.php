@extends('adminlte::page')
@section('title', 'Atualizar post')
@section('plugins.Select2', false)
@section('plugins.Summernote', true)
@section('plugins.icheck-bootstrap', true)

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Editar postagem -  <strong>{{$post->titulo}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('posts.index')}}">Postagens </a></li>
          <li class="breadcrumb-item ">Editar o Postagem</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('posts.update', $post->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.pages.posts._partials.form')

        </form>
    </div>
</div>

@endsection

@section('js')
<script src="../../../dashboard/js/summernote-pt-br.js"></script>
<script>  
//inicia o tooltip
    $(function () {
     $('[data-toggle="tooltip"]').tooltip()
    }) 
  
    //inicia o summernote  
    $(document).ready(function() {
      $('#summernote').summernote({
      lang: 'pt-BR'
      });
    });

    //Inicia os tooltip
    $(function () {
          $('[data-toggle="tooltip"]').tooltip()
      })  //Alert de confirmação de exclusão
      $('.delete-confirm').on('click', function (event) {
      event.preventDefault();
      const url = $(this).attr('href');    
            Swal.fire({
            title: 'Deseja continuar?',
            text: "Este registro e seus detalhes serão excluídos permanentemente!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText:'Cancelar',
            confirmButtonText: 'Sim, Exclua!'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = url +"#galeria";
            }
          })  
  });
  </script>
@endsection
