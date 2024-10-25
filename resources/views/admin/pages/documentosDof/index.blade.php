@extends('adminlte::page')
@section('title', 'Documentos')
@section('content_header')
@section('plugins.Sweetalert2', true)
@include('sweetalert::alert')


<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Documentos</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
        <li class="breadcrumb-item ">Documentos Dof</li>
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
            @can('novo-documento')
            <a href="{{route('documentos.create')}}" class="btn bg-gradient-success  " data-toggle="tooltip"
              data-placement="top" title="Cadastrar novo Post"><i class="fas fa-plus"></i> Novo</a>
            @endcan

          </div>
          <div class="col-md-4">
            <div class="card-tools">
              <form action="{{route('documentos.search')}}" method="post" class="form form-inline  float-right">
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
              <th scope="col">Titulo</th>
              <th scope="col">Tipo de Matéria</th>
              <th scope="col">Sub tipo</th>
              <th scope="col">Criado por</th>
              <th scope="col">Criado em</th>
              <th scope="col">Publicado em</th>
              <th width="20%" class="text-center">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($documentos as $documento)

            <tr>
              <th scope="row">{{$loop->iteration}}</th>
              <td>{{$documento->titulo}}</td>
              <td>{{$documento->tipoMateria->nome}}</td>
              <td>{{$documento->subTipoMateria->nome}}</td>
              <td style="font-size: 12px;">
                {{$documento->user->name}} <br>
                <i class="text-muted"> Última alteração: {{$documento->userLastUpdate->name}}</i>
              </td>
              <td>{{$documento->created_at}}
              <td>{{\Carbon\Carbon::parse($documento->data_publicacao)->format('d/m/Y')}}
              </td>

              <td class="text-center">               
                @can('ver-documento')
                <a href="{{route('documentos.show', $documento->uuid)}}" data-uuid="{{$documento->uuid}}"
                  class="btn  bg-gradient-info btn-flat mt-0" data-toggle="tooltip" data-placement="top"
                  title="Ver Detalhes">
                  <i class="far fa-eye"></i>
                </a>
                @endcan

                @can('editar-documento')
                <a href="{{route('documentos.edit', $documento->id)}}" class="btn  bg-gradient-primary btn-flat  "
                  data-toggle="tooltip" data-placement="top" title="Editar">
                  <i class="fas fa-edit"></i>
                </a>
                @endcan
                @can('excluir-documento')
                <a href="{{route('documentos.destroy', $documento->id)}}" data-id="{{$documento->id}}"
                  class="btn  bg-gradient-danger btn-flat delete-confirm mt-0" data-toggle="tooltip"
                  data-placement="top" title="Excluir">
                  <i class="fas fa-trash-alt"></i>
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
        {!!$documentos->appends($pesquisar)->links()!!}
        @else
        {!!$documentos->links()!!}
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
      // Inicializa tooltips
      $('[data-toggle="tooltip"]').tooltip();
  });

  // Alert de confirmação de exclusão
  $('.delete-confirm').on('click', function (event) {
      event.preventDefault(); // Impede o comportamento padrão do link

      const url = $(this).attr('href'); // Obtém a URL de exclusão

      Swal.fire({
          title: 'Deseja continuar?',
          text: "Este registro e seus detalhes serão excluídos permanentemente!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Sim, Exclua!'
      }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = url; // Redireciona para a URL se confirmado
          }
      });
  });     

</script>
@stop