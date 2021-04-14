@extends('adminlte::page')
@section('title', 'Comissões')
@section('content_header')
@include('sweetalert::alert')

<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Membros da comissão - <strong>
       {{$commission->nome}}
      </strong></h1>
       
      
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
        <li class="breadcrumb-item "><a href="{{route('commissions.index')}}">Comissões</a>
        <li class="breadcrumb-item ">Membros</li>
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
            
            <a href="{{route('comissionMembersCreate.create', $commission->id )}}" class="btn bg-gradient-success  " data-toggle="tooltip" data-placement="top"
            title="Adicionar novo membro" ><i
                class="fas fa-plus"></i> Novo</a>
          </div>
          <div class="col-md-4">
            <div class="card-tools">
              <form action="#" method="post" class="form form-inline  float-right">
                @csrf
                <div class="input-group input-group-sm" style="width: 250px;">
                  <input type="text" name="pesquisa" class="form-control float-right" placeholder="Nome, Objetivo" disabled>
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
              <th>Membros</th>              
              <th>Partido</th>
              <th>Função </th>                                     
              <th width="20%" class="text-center">Ações</th>
            </tr>
          </thead>
          <tbody>    
            @if (count($dataCommission) >= 1)
              @foreach ($dataCommission as $dados)
              <tr>                
                <td>{{$dados->members->nome}}</td>              
                <td>{{$dados->members->party->nome}}</td>
                <td>{{$dados->functions->nome}}</td>          
                <td class="text-center">                  
                      <a href="{{route('comissionMembersDestroy.destroy',$dados->id )}}" data-id="{{$dados->id}}"
                        class="btn  bg-gradient-danger btn-flat delete-confirm mt-0" data-toggle="tooltip" data-placement="top"  
                        title="Remover">
                        <i class="fas fa-trash-alt" ></i>
                      </a>                    
                </td>   
              </tr>              
              @endforeach       
           @else
            <tr >
                <td colspan="4">
                  <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Atenção</h5>
                     Ainda não existe membros adicionado nessa comissão!
                        clique no botão "NOVO" no canto superior esquerdo para adicionar um novo membro membros
                  </div>
                </td>
              </tr>
            @endif
                        
              
              
                             
            
        </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        {{-- @if (isset($pesquisar))
        {!!$commissions->appends($pesquisar)->links()!!}
        @else
        {!!$commissions->links()!!}
        @endif --}}
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