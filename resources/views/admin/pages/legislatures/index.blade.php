@extends('adminlte::page')
@section('title', 'Legislaturas')
@section('content_header')
@include('sweetalert::alert')


<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Legislaturas</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
        <li class="breadcrumb-item ">Legislaturas</li>
      </ol>
    </div>
  </div>
</div>
<!--Alerta -->

@stop

@section('content')
<div class="col-12">
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-md-8">
          
          {{-- <a href="{{route('legislatures.create')}}" class="btn bg-gradient-success  " data-toggle="tooltip" data-placement="top"
          title="Cadastrar nova comissão" ><i
              class="fas fa-plus"></i> Novo</a> --}}
        </div>
        <div class="col-md-4">
          <div class="card-tools">
            {{-- <form action="{{route('legislatures.search')}}" method="post" class="form form-inline  float-right">
              @csrf
              <div class="input-group input-group-sm" style="width: 250px;">
                <input type="text" name="pesquisa" class="form-control float-right" placeholder="Nome, Objetivo">
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
            <th>Descrição</th>              
            <th>Ordem</th>
            <th>Data Início</th>
            <th>Data Fim</th>
            <th>Atual</th>
                        
            <th width="20%" class="text-center">Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($legislatures as $legislature)
              
         
          <tr class="{{$legislature->atual == 1 ? 'text-primary' : ''}}">
            <td>{{$legislature->descricao}}</td>              
            <td>{{$legislature->ordem}}ª</td>
            <td>{{\Carbon\Carbon::parse($legislature->data_inicio)->format('d/m/Y')}}</td>
            <td>{{\Carbon\Carbon::parse($legislature->data_fim)->format('d/m/Y')}}</td>
            <td>{{$legislature->atual == 1 ? 'Sim' : 'Não'}}</td>
            
              <td class="text-center">
                @can('ver-legislatura')
                <a href="{{route('legislatures.show', $legislature->id)}}" data-id="{{$legislature->id}}"
                  class="btn  bg-gradient-info btn-flat mt-0" data-toggle="tooltip" data-placement="top"  
                  title="Ver Detalhes">
                  <i class="far fa-eye"></i>
                </a>
                @endcan
                
                @can('ver-vereador')
                <a href="{{route('legislatureCouncilors.index', $legislature->id )}}" data-id="{{$legislature->id}}"
                  class="btn  bg-gradient-info btn-flat mt-0" data-toggle="tooltip" data-placement="top"  
                  title="Vereadores">
                  <i class="fas fa-users" ></i>
                </a>
                @endcan
              

              {{-- <a href="{{route('legislatures.destroy', $legislature->id)}}" data-id="{{$legislature->id}}"
                class="btn  bg-gradient-danger btn-flat delete-confirm mt-0" data-toggle="tooltip" data-placement="top"  
                title="Excluir">
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
      {!!$legislatures->appends($pesquisar)->links()!!}
      @else
      {!!$legislatures->links()!!}
      @endif
    </div>
  </div>
  <!-- /.card -->
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