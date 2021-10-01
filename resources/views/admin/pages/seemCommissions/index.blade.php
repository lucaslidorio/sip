@extends('adminlte::page')
@section('title', 'Parecer')
@section('content_header')
@include('sweetalert::alert')

<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Parecer das comissões</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
        <li class="breadcrumb-item ">Pereceres</li>
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
            <a href="{{route('seemCommissions.create')}}" class="btn bg-gradient-success  " data-toggle="tooltip" data-placement="top"
            title="Cadastrar nova propositura" ><i
                class="fas fa-plus"></i> Novo</a>
          </div>
          <div class="col-md-4">
            <div class="card-tools">
              <form action="{{route('seemCommissions.search')}}" method="post" class="form form-inline  float-right">
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
              <th scope="col">#</th>
              <th scope="col">Comissão</th>
              <th scope="col">Propositura</th>  
              <th scope="col">Data</th>                         
              <th scope="col">Autoria</th>               
              <th scope="col">Arquivo</th>
              <th scope="col" width="20%" class="text-center">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($seemCommissions as $seemCommission)               
           
            <tr >
              <th scope="row">{{$loop->iteration}}</th>
              <td>{{$seemCommission->commission->nome}}</td>
              <td>{{$seemCommission->proposition->type_proposition->nome}} 
                  {{$seemCommission->proposition->numero}}/{{\Carbon\Carbon::parse($seemCommission->proposition->data)->format('Y')}}</td> 
              <td>{{\Carbon\Carbon::parse($seemCommission->data)->format('d/m/Y')}}</td>             
                
              <td>               
                 {{$seemCommission->autoria}}
              </td>            
              <td>                
                  @foreach ($seemCommission->attachments as $attachment)                   
                  <a href="{{config('app.aws_url')."{$attachment->anexo}" }}" 
                    target="_blank" class="mb-2 text-reset"
                    data-toggle="tooltip" data-placement="top" 
                        title={{$attachment->nome_original}} >
                      <i class="far fa-file-pdf fa-2x text-danger mr-2"></i>
                  </a>                              
                  @endforeach                
              </td> 

                <td class="text-center">
                  
                <a href="{{route('seemCommissions.show', $seemCommission->id)}}" data-id="{{$seemCommission->id}}"
                  class="btn  bg-gradient-info btn-flat mt-0" data-toggle="tooltip" data-placement="top"  
                  title="Ver Detalhes">
                  <i class="fas fa-address-book" ></i>
                </a>

                <a href="{{route('seemCommissions.edit', $seemCommission->id)}}" 
                  class="btn  bg-gradient-primary btn-flat  " data-toggle="tooltip" data-placement="top" 
                  title="Editar">
                  <i class="fas fa-edit" ></i>
                </a>

                <a href="{{route('seemCommissions.destroy', $seemCommission->id)}}" data-id="{{$seemCommission->id}}"
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
        {!!$seemCommissions->appends($pesquisar)->links()!!}
        @else
        {!!$seemCommissions->links()!!}
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