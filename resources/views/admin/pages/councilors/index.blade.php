@extends('adminlte::page')
@section('title', 'Secretarias')
@section('content_header')
@section('plugins.Sweetalert2', true)
@include('sweetalert::alert')


<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Parlamentares</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
        <li class="breadcrumb-item ">Parlamentares</li>
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
            @can('nova-vereador')
            <a href="{{route('councilors.create')}}" class="btn bg-gradient-success  " data-toggle="tooltip" data-placement="top"
            title="Cadastrar novo vereador" ><i
                class="fas fa-plus"></i> Novo</a>
            @endcan
            
          </div>
          <div class="col-md-4">
            <div class="card-tools">
              <form action="{{route('councilors.search')}}" method="post" class="form form-inline  float-right">
                @csrf
                <div class="input-group input-group-sm" style="width: 250px;">
                  <input type="text" name="pesquisa" class="form-control float-right" placeholder="Nome, Nome parlamentar">
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
              <th>Nome</th>              
              <th>Nome Parlamentar</th>
              <th>E-mail</th>
              <th>Telefone</th>
              <th >Partido</th> 
              <th class="text-center">Atual</th> 
                                              
              <th width="20%" class="text-center">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($councilors as $councilor) 
                 
            <tr >
              <td>{{$councilor->nome}}</td>              
              <td>{{$councilor->nome_parlamentar}}</td>
              <td>{{$councilor->email}}</td>
              <td>{{$councilor->telefone}}</td>
              <td>{{$councilor->party->sigla}}</td>
              
              <td>{{$councilor->atual == 1 ? 'Sim':'Não'}}
                
                <td class="text-center text-nowrap" >
                  @can('ver-vereador')
                  <a href="{{route('councilors.show', $councilor->id)}}" data-id="{{$councilor->id}}"
                    class="btn  bg-gradient-info btn-flat mt-0" data-toggle="tooltip" data-placement="top"  
                    title="Ver Detalhes">
                    <i class="far fa-eye"></i>
                  </a>
                  @endcan
                  
                  @can('editar-vereador')
                  <a href="{{route('councilors.edit', $councilor->id)}}" 
                    class="btn  bg-gradient-primary btn-flat  " data-toggle="tooltip" data-placement="top" 
                    title="Editar">
                    <i class="fas fa-edit" ></i>
                  </a>
                  @endcan
                  
                  @can('excluir-vereador')
                  <a href="{{route('councilors.destroy', $councilor->id)}}" data-id="{{$councilor->id}}"
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
        {!!$councilors->appends($pesquisar)->links()!!}
        @else
        {!!$councilors->links()!!}
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