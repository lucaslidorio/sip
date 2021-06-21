@extends('adminlte::page')
@section('title', 'Sessões')
@section('content_header')
@include('sweetalert::alert')

<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Sessões</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
        <li class="breadcrumb-item ">Sessões</li>
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
            
            <a href="{{route('sessions.create')}}" class="btn bg-gradient-success  " data-toggle="tooltip" data-placement="top"
            title="Publicar noca sessão" ><i
                class="fas fa-plus"></i> Novo</a>
          </div>
          <div class="col-md-4">
            <div class="card-tools">
              {{-- <form action="{{route('sessions.search')}}" method="post" class="form form-inline  float-right">
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
              <th>Nome</th>              
              <th>Data</th>
              <th>Hora</th>
              <th>Tipo</th>  
              <th>Legislatura</th>         
                          
              <th width="20%" class="text-center">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($sessions as $sessao)               
            
            <tr >
              <td>{{$sessao->nome}}</td>              
              <td>{{\Carbon\Carbon::parse($sessao->data)->format('d/m/Y')}}</td> 
              <td>{{$sessao->hora}}</td>   
              <td>{{$sessao->typeSession->nome}}</td>
              <td>{{$sessao->legislature->descricao}}</td>  
              <td class="text-center">
                <a href="{{route('sessions.edit', $sessao->id)}}" 
                  class="btn  bg-gradient-primary btn-flat  " data-toggle="tooltip" data-placement="top" 
                  title="Editar">
                  <i class="fas fa-edit" ></i>
                </a>

                <a href="{{route('sessions.show', $sessao->id)}}" data-id="{{$sessao->id}}"
                  class="btn  bg-gradient-info btn-flat mt-0" data-toggle="tooltip" data-placement="top"  
                  title="Ver Detalhes">
                  <i class="far fa-eye"></i>
                </a>
                <a href="{{route('sessionAttachmentCreate.create', $sessao->id)}}" data-id="{{$sessao->id}}"
                  class="btn  bg-gradient-success btn-flat mt-0" data-toggle="tooltip" data-placement="top"  
                  title="Anexar Arquivos">
                  <i class="fas fa-paperclip" ></i>
                </a>

                
                 @if ($sessao->councilors_present()->count() > 0)
                <a href="{{route('sessionPresentEdit.edit', $sessao->id)}}" data-id="{{$sessao->id}}"
                  class="btn  bg-gradient-primary btn-flat mt-0" data-toggle="tooltip" data-placement="top"  
                  title="Editar presença">
                  <i class="fas fa-user-tie" ></i>
                </a>
                    
                @else
                <a href="{{route('sessionPresentCreate.create', $sessao->id)}}" data-id="{{$sessao->id}}"
                  class="btn  bg-gradient-dark btn-flat mt-0" data-toggle="tooltip" data-placement="top"  
                  title="Lançar presença">
                  <i class="fas fa-user-tie" ></i>
                </a>
                @endif 
                
               
                {{-- <a href="{{route('sessions.destroy', $sessao->id)}}" data-id="{{$sessao->id}}"
                  class="btn  bg-gradient-danger btn-flat delete-confirm mt-0" data-toggle="tooltip" data-placement="top"  
                  title="Excluir" disabled="disabled">
                  <i class="fas fa-trash-alt" ></i>
                </a> --}}
                
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
       
      </div> 
      <!-- /.card-body -->
      <div class="card-footer">
        @if (isset($pesquisar))
        {!!$sessions->appends($pesquisar)->links()!!}
        @else
        {!!$sessions->links()!!}
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