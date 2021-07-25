@extends('adminlte::page')
@section('title', "Permissões do plano {$plan->nome} ")
@section('content_header')
@include('sweetalert::alert')


<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Perfis do plano - <strong>{{$plan->nome}}</strong></h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
        <li class="breadcrumb-item"><a href="{{route('plans.index')}}">Perfis</a></li>
        <li class="breadcrumb-item ">Perfil do plano</li>
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
            
            <a href="{{route('plans.profiles.available', $plan->id)}}" class="btn bg-gradient-primary  " data-toggle="tooltip" data-placement="top"
            title="Adicionar novo perfil" ><i
                class="fas fa-plus"></i> Adicionar novo perfil</a>
          </div>
          <div class="col-md-4">
            <div class="card-tools">
              <form action="{{route('plans.search')}}" method="post" class="form form-inline  float-right">
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
              <th>Nome</th>
              <th width="20%" class="">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($profiles as $profile)
      
            <tr >
                 <td>{{$profile->nome}}</td>   
                 <td>
                   <a href="{{route('plans.profiles.detach',[$plan->id, $profile->id])}}" data-id="{{$plan->id}}"
                    class="btn  bg-gradient-danger btn-flat delete-confirm mt-0" data-toggle="tooltip" data-placement="top"  
                    title="Remover Perfil">
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
        {!!$profiles->appends($pesquisar)->links()!!}
        @else
        {!!$profiles->links()!!}
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