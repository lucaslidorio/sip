@extends('adminlte::page')
@section('title', 'Links')
@section('content_header')
@section('plugins.Sweetalert2', false)
@include('sweetalert::alert')

<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>links</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
        <li class="breadcrumb-item ">links</li>
      </ol>
    </div>
  </div>
</div>

@stop
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-8">
            
            <a href="{{route('links.create')}}" class="btn bg-gradient-success  " data-toggle="tooltip" data-placement="top"
            title="Cadastrar novo link" ><i
                class="fas fa-plus"></i> Novo</a>
          </div>
          <div class="col-md-4">
            <div class="card-tools">
              <form action="{{route('links.index')}}" method="post" class="form form-inline  float-right">
                @csrf
                <div class="input-group input-group-sm" style="width: 250px;">
                  <input type="text" name="pesquisa" class="form-control float-right" placeholder="Nome, Sigla">
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
              <th>Nome</th> 
              <th>Url</th> 
              <th>Target</th> 
              <th>Tipo</th> 
              <th>Ordem</th>
              <th>posicao</th>
              <th>icone</th>        
              <th width="20%" class="text-center">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($links as $link)            
            <tr >
              <td>{{$link->id}}</td>              
              <td>{{$link->nome}}</td> <td>{{$link->url}}</td>
              <td>{{($link->target ? 'Sim': 'Não')}}</td>
              <td>{{$tipo[$link->tipo]}}</td>
              <td>{{$link->ordem}}</td>
              <td>{{$posicao[$link->posicao]}}</td>  
              
              <td><img src="{{config('app.aws_url')."{$link->icone}" }}" alt="{{$link->nome}}" style="max-width: 100px;;"></td>
             <td class="text-center">
                <a href="{{route('links.edit', $link->id)}}" 
                  class="btn  bg-gradient-primary btn-flat  " data-toggle="tooltip" data-placement="top" 
                  title="Editar">
                  <i class="fas fa-edit" ></i>
                </a>

                <a href="{{route('links.destroy', $link->id)}}" data-id="{{$link->id}}"
                  class="btn  bg-gradient-danger btn-flat delete-confirm mt-0" data-toggle="tooltip" data-placement="top"  
                  title="Excluir">
                  <i class="fas fa-trash-alt" ></i>
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
        {!!$links->appends($pesquisar)->links()!!}
        @else
        {!!$links->links()!!}
        @endif
      </div>
    </div>
    <!-- /.card -->
  </div>
</div>
@stop

@section('js')
<script>
//Swal.fire('Any fool can use a computer');  
  //Inicia os tooltip
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })  
    //Alert de confirmação de exclusão
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