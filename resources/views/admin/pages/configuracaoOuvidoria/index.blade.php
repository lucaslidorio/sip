@extends('adminlte::page')
@section('title', 'Configuração')
@section('content_header')
@section('plugins.Sweetalert2', true)
@include('sweetalert::alert')

<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Configuração</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
        <li class="breadcrumb-item ">Configuração Ouvidoria</li>
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
            @can('novo-ouvidoria')          
            @if($configuracoes->isEmpty())
            <a href="{{route('ouvidoria.configuracao.create')}}" class="btn bg-gradient-success  " data-toggle="tooltip"
              data-placement="top" title="Cadastrar nova configuração"><i class="fas fa-plus"></i> Novo</a>
            @endif          
            @endcan
          </div>
          <div class="col-md-4">
            <div class="card-tools">
              {{-- <form action="{{route('parties.search')}}" method="post" class="form form-inline  float-right">
                @csrf
                <div class="input-group input-group-sm" style="width: 250px;">
                  <input type="text" name="pesquisa" class="form-control float-right" placeholder="Nome, Sigla">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </form> --}}
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
              <th>Nome Responsável</th>
              <th>e-mail</th>
              <th>telefone</th> 
              <th>celular</th>             
              <th width="20%" class="text-center">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($configuracoes   as $configuracao)
            
            <tr >
              <td>{{$configuracao->id}}</td>              
              <td>{{$configuracao->nome_responsavel}}</td>
              <td>{{$configuracao->email}}</td>
              <td>{{$configuracao->telefone}}</td>
              <td>{{$configuracao->celular}}</td>
              <td class="text-center">
                @can('editar-partido')
                <a href="{{route('ouvidoria.configuracao.edit', $configuracao->id)}}" 
                  class="btn  bg-gradient-primary btn-flat  " data-toggle="tooltip" data-placement="top" 
                  title="Editar">
                  <i class="fas fa-edit" ></i>
                </a>
                @endcan
                
                {{-- @can('excluir-ouvidoria')
                <a href="{{route('parties.destroy', $configuracao->id)}}" data-id="{{$configuracao->id}}"
                  class="btn  bg-gradient-danger btn-flat delete-confirm mt-0" data-toggle="tooltip" data-placement="top"  
                  title="Excluir">
                  <i class="fas fa-trash-alt" ></i>
                </a>
                @endcan --}}
               
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        @if (isset($pesquisar))
        {!!$configuracoes->appends($pesquisar)->links()!!}
        @else
        {!!$configuracoes->links()!!}
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