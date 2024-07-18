@extends('adminlte::page')
@section('title', 'Planos')
@section('content_header')
@section('plugins.Sweetalert2', true)
@include('sweetalert::alert')

<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Planos</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
        <li class="breadcrumb-item ">Planos</li>
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
            
            <a href="{{route('plans.create')}}" class="btn bg-gradient-success  " data-toggle="tooltip" data-placement="top"
            title="Cadastrar novo plano" ><i
                class="fas fa-plus"></i> Novo</a>
          </div>
          <div class="col-md-4">
            <div class="card-tools">
              {{-- <form action="{{route('plans.search')}}" method="post" class="form form-inline  float-right">
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
              <th>Preço</th>              
              <th>Descrição</th>
              <th width="20%" class="text-center">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($plans as $plan)
      
            <tr >
                 <td>{{$plan->nome}}</td>
                 <td>R$ {{number_format($plan->preco, 2, ',', '.')}}</td>              
                 <td>{{$plan->descricao}}</td>
                 <td class="text-center">
                  <a href="{{route('plans.profiles', $plan->id)}}" data-id="{{$plan->id}}"
                    class="btn  bg-gradient-info btn-flat mt-0" data-toggle="tooltip" data-placement="top"  
                    title="Ver perfis do plano">
                    <i class="fas fa-lock" ></i>
                  </a>                
                  <a href="{{route('plans.edit', $plan->id)}}" 
                    class="btn  bg-gradient-primary btn-flat  " data-toggle="tooltip" data-placement="top" 
                    title="Editar">
                    <i class="fas fa-edit" ></i>
                  </a>            

                  <a href="{{route('plans.destroy', $plan->id)}}" data-id="{{$plan->id}}"
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
        {!!$plans->appends($pesquisar)->links()!!}
        @else
        {!!$plans->links()!!}
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