@extends('adminlte::page')
@section('title', 'Processos')
@section('content_header')
@section('plugins.Sweetalert2', true)
@include('sweetalert::alert')

<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Processos</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
        <li class="breadcrumb-item ">Processos</li>
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
            @can('nova-funcoes')
            <a href="{{route('processos.create')}}" class="btn bg-gradient-success  " data-toggle="tooltip"
              data-placement="top" title="Cadastrar novo Processo"><i class="fas fa-plus"></i> Novo</a>
        
            @endcan
            
          </div>
          <div class="col-md-4">
            <div class="card-tools">
              <form action="{{route('processos.search')}}" method="post" class="form form-inline  float-right">
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
              <th>Número</th>   
              <th>Modalidade</th>          
              <th>Critério de Julgamento</th>    
              <th>Data Publicação</th>    
              <th>Início da Sessão</th>   
              <th>Situação</th>  
              <th>Objeto</th>
              
                          
              <th width="20%" class="text-center">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($processos as $processo)
      
            <tr >
              <td>{{$processo->numero}}/{{$processo->data_publicacao->year}}</td>              
              <td>{{$processo->modalidade->nome}}</td>
              <td>{{$processo->criterio_julgamento->nome}}</td>
              <td>{{$processo->data_publicacao->format('d-m-Y H:i:s') }}</td>
              <td>{{$processo->inicio_sessao->format('d-m-Y H:i:s')}}</td>
              <td>{{$processo->situacao->nome}}</td>
              <td>{{ \Illuminate\Support\Str::limit($processo->objeto, 50, '...') }}</td>
              
                <td class="text-center">
                  @can('ver-processo-compras')
                  <a href="{{route('processos.show', $processo->id)}}" data-id="{{$processo->id}}"
                    class="btn  bg-gradient-info btn-flat mt-0 " data-toggle="tooltip" data-placement="top"  
                    title="Ver Detalhes">                
                    <i class="far fa-eye"></i>
                  </a>
                  @endcan
                  @can('editar-processo-compras')
                  <a href="{{route('processos.edit', $processo->id)}}" 
                    class="btn  bg-gradient-primary btn-flat  " data-toggle="tooltip" data-placement="top" 
                    title="Editar">
                    <i class="fas fa-edit" ></i>
                  </a>
                  @endcan
                  @can('editar-processo-compras')
                <a href="{{route('processoAttachmentCreate.create', $processo->id)}}" data-id="{{$processo->id}}"
                  class="btn  bg-gradient-success btn-flat mt-0" data-toggle="tooltip" data-placement="top"  
                  title="Anexar Arquivos">
                  <i class="fas fa-paperclip" ></i>
                </a>
                @endcan

                @can('excluir-processo-compras')
                <a href="{{route('processos.destroy', $processo->id)}}" data-id="{{$processo->id}}"
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
        @if (isset($pesquisar))
        {!!$processos->appends($pesquisar)->links()!!}
        @else
        {!!$processos->links()!!}
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