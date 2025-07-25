@extends('adminlte::page')
@section('title', 'Lesgislação')
@section('content_header')
@include('sweetalert::alert')

<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Legislação</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
        <li class="breadcrumb-item ">Legislação</li>
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
            @can('nova-legislacao')
            <a href="{{route('legislations.create')}}" class="btn bg-gradient-success  " data-toggle="tooltip" data-placement="top"
            title="Publicar nova lei" ><i
                class="fas fa-plus"></i> Novo</a>
            @endcan
          </div>
          <div class="col-md-4">
            <div class="card-tools">
              {{-- <form action="{{route('legislations.search')}}" method="post" class="form form-inline  float-right">
                @csrf
                <div class="input-group input-group-sm" style="width: 250px;">
                  <input type="text" name="pesquisa" class="form-control float-right" placeholder="Nome, Descrição">
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
              <th scope="col">#</th>
              <th scope="col">Tipo</th>
              <th scope="col">Número</th>                        
              <th scope="col">Data</th>
              <th scope="col">Caput</th>
              <th scope="col">Anexo</th>
              
              <th scope="col" width="20%" class="text-center">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($legislations as $legislation)               
           
            <tr >
              <th>{{$loop->iteration}}</th>
              <th scope="row">{{$legislation->type_legislations->nome}}</th>
              <td>{{$legislation->numero}}</td>     
              <td>{{\Carbon\Carbon::parse($legislation->data)->format('d/m/Y')}}</td>        
              <td class="font-italic"><small>{{$legislation->caput}} </small> </td>    
                                        
              <td>                
                  @foreach ($legislation->attachments as $attachment)                   
                  <a href="{{config('app.aws_url')."{$attachment->anexo}" }}" 
                    target="_blank" class="mb-2 text-reset"
                    data-toggle="tooltip" data-placement="top" 
                        title={{$attachment->nome_original}} >
                      <i class="far fa-file-pdf fa-2x text-danger mr-2"></i>
                  </a>                             
                  @endforeach                 
              </td> 

                <td class="text-center">
                @can('ver-legislacao')
                <a href="{{route('legislations.show', $legislation->id)}}"
                  class="btn  bg-gradient-info btn-flat mt-0" data-toggle="tooltip" data-placement="top"  
                  title="Ver Detalhes">
                  <i class="far fa-eye"></i>
                </a> 
                @endcan
                
                @can('editar-legislacao')
                <a href="{{route('legislations.edit', $legislation->id)}}" 
                  class="btn  bg-gradient-primary btn-flat  " data-toggle="tooltip" data-placement="top" 
                  title="Editar">
                  <i class="fas fa-edit" ></i>
                </a>
                @endcan
                

                @can('excluir-legislacao')
                <a href="{{route('legislations.destroy', $legislation->id)}}" data-id="{{$legislation->id}}"
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
        {!!$legislations->appends($pesquisar)->links()!!}
        @else
        {!!$legislations->links()!!}
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

        $('.popover-dismiss').popover({
            trigger: 'focus'
        })
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