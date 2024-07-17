@extends('adminlte::page')
@section('title', 'Perfis')
@section('content_header')
@section('plugins.Sweetalert2', true)
@include('sweetalert::alert')


<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Fornecedores</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
        <li class="breadcrumb-item "><a href="{{route('fornecedores.index')}}">Fornecedores</a></li>
      </ol>
    </div>
  </div>
</div>
<!--Alerta -->

@stop

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-8"> 
          </div>
          <div class="col-md-4">
            <div class="card-tools">
              <form action="{{route('fornecedores.index')}}" method="post" class="form form-inline  float-right">
                @csrf
                <div class="input-group input-group-sm" style="width: 250px;">
                  <input type="text" name="pesquisa" class="form-control float-right" placeholder="Nome, CNPJ, email...">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div> 

      </div>
     
   
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Nome Resp.</th>
              <th>email</th>
              <th>Razão Social</th>              
              <th>Nome Fantasia</th>
              <th>CNPJ</th>              
              <th width="20%" class="text-center">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($fornecedores as $fornecedor)
      
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$fornecedor->usuario->name}}</td> 
              <td>{{$fornecedor->usuario->email}}</td>
              <td>{{$fornecedor->razao_social}}</td>              
              <td>{{$fornecedor->nome_fantasia}}</td>
              <td>{{$fornecedor->cnpj}}
              <td class="text-center">
                <a href="{{route('fornecedores.show', $fornecedor->id)}}" data-id="{{$fornecedor->id}}"
                  class="btn  bg-gradient-info btn-flat mt-0" data-toggle="tooltip" data-placement="top"  
                  title="Ver Detalhes">
                  <i class="far fa-eye"></i>
                </a>          
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        @if (isset($pesquisar))
        {!!$fornecedores->appends($pesquisar)->links()!!}
        @else
        {!!$fornecedores->links()!!}
        @endif
      </div>
    </div>
    <!-- /.card -->
  </div>
</div>
@stop

@section('js')
<script>
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
            window.location.href = url;
          }
        })  
});
</script>
@stop