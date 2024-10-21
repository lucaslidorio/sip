@extends('adminlte::page')
@section('title', 'Funções')
@section('content_header')
@section('plugins.Select2', true)
@include('sweetalert::alert')

<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Funções</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
        <li class="breadcrumb-item"><a href="{{route('userFunctions.index')}}">Funções e Usuários</a></li>
        
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
            @can('nova-funcoes')
            <a href="{{route('userFunctions.create')}}" class="btn bg-gradient-success  " data-toggle="tooltip" data-placement="top"
            title="Vincular nova função ao usuário" ><i
                class="fas fa-plus"></i> Novo</a>
            @endcan
            
          </div>
          <div class="col-md-4">
            <div class="card-tools">
              <form action="{{route('userFunctions.index')}}" method="get" class="form form-inline  float-right">
                @csrf
                <div class="input-group input-group-sm" style="width: 250px;">
                  <input type="text" name="pesquisa" class="form-control float-right" placeholder="Nome, Descrição">
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
              <th>Usuário</th>              
              <th>Função</th>
              <th>Início</th>
              <th>Fim</th>
              <th>Situação</th>
              
                          
              <th width="20%" class="text-center">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($usersFunctions as $user)
      
            <tr >
              <td>{{$user->user->name}}</td>              
              <td>{{$user->function->nome}}</td>
              <td>{{\Carbon\Carbon::parse($user->data_inicio)->format('d/m/Y')}}</td>
              <td>{{ $user->data_fim ? \Carbon\Carbon::parse($user->data_fim)->format('d/m/Y') : '' }}</td>
              <td> <span class="badge {{ $user->situacao == 1 ? 'badge-primary' : 'badge-danger' }}">{{$user->situacao_nome}}</span></td>              
                <td class="text-center">
                  @can('editar-funcoes')
                  <a href="{{route('userFunctions.edit', $user->id)}}" 
                    class="btn  bg-gradient-primary btn-flat  " data-toggle="tooltip" data-placement="top" 
                    title="Editar">
                    <i class="fas fa-edit" ></i>
                  </a>
                  @endcan
                @can('excluir-funcoes')
                <a href="{{route('userFunctions.destroy', $user->id)}}" data-id="{{$user->id}}"
                  class="btn  bg-gradient-danger btn-flat delete-confirm mt-0" data-toggle="tooltip" data-placement="top"  
                  title="Excluir">
                  <i class="fas fa-trash-alt" ></i>
                </a>
                @endcan                
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        @if(isset($pesquisa))
        {!! $usersFunctions->appends(['pesquisa' => $pesquisa])->links() !!}
        @else
        {!! $usersFunctions->links() !!}
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