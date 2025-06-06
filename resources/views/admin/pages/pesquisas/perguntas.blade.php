@extends('adminlte::page')
@section('title', 'Perguntas')
@section('content_header')
@section('plugins.Sweetalert2', true)
@include('sweetalert::alert')

<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Perguntas - {{ $questionario->titulo }}</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('pesquisa.index') }}">Pesquisas</a></li>
        <li class="breadcrumb-item active">Perguntas</li>
      </ol>
    </div>
  </div>
</div>

@stop
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-8">
            <a href="{{ route('perguntas.create', $questionario->id) }}" class="btn bg-gradient-success" data-toggle="tooltip" data-placement="top" title="Cadastrar nova pergunta">
              <i class="fas fa-plus"></i> Nova Pergunta
            </a>
          </div>
        </div> 
      </div>     

      <div class="card-body table-responsive p-0">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>número</th>
              <th>Pergunta</th>
              <th width="20%" class="text-center">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($perguntas as $pergunta)
              <tr>
                <td>{{ $pergunta->id }}</td>
                <td>{{ $pergunta->numero }}</td>
                <td>{{ $pergunta->pergunta }}</td>
                <td class="text-center">
                  @can('editar-pesquisa')
                  <a href="{{ route('perguntas.edit', $pergunta->id) }}" class="btn bg-gradient-primary btn-flat" data-toggle="tooltip" title="Editar">
                    <i class="fas fa-edit"></i>
                  </a>
                  @endcan
                  @can('excluir-pesquisa')
                  <a href="{{route('perguntas.destroy', $pergunta->id)}}" data-id="{{$pergunta->id}}"
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

      <div class="card-footer">
        {!! $perguntas->links() !!}
      </div>
    </div>
  </div>
</div>
@stop

@section('js')
<script>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })

  $('.delete-confirm').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    Swal.fire({
      title: 'Deseja continuar?',
      text: "Este registro será excluído permanentemente!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Sim, excluir!'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = url;
      }
    })
  });
</script>
@stop
