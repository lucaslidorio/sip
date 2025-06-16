@extends('adminlte::page')
@section('title', 'Pronunciamento')
@section('content_header')
@section('plugins.Select2', true)
@section('plugins.Sweetalert2', true)
@include('sweetalert::alert')

<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Pronunciamentos</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
        <li class="breadcrumb-item "><a href="{{route('pronunciamentos.index')}}">Pronunciamentos</a></li>
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
          <div class="col-md-2 col-12 pb-1">
            @can('nova-pronunciamento')
            <a href="{{route('pronunciamentos.create')}}" class="btn bg-gradient-success  " data-toggle="tooltip"
              data-placement="top" title="Cadastrar nova pronunciamento"><i class="fas fa-plus"></i> Novo</a>
            @endcan
          </div>
          <div class="col-md-10 col-12">
            <form action="{{ route('pronunciamentos.index') }}" method="get" class="row g-2">
              {{-- Filtro por Legislatura --}}
              <div class="col-6 col-md-3">
                <select class="form-control" name="legislatura_id" id="legislatura_id">
                  <option value="">Todas as Legislaturas</option>
                  @foreach($legislaturas as $legislatura)
                  <option value="{{ $legislatura->id }}" {{ request()->query('legislatura_id') == $legislatura->id ?
                    'selected' : '' }}>
                    {{ $legislatura->descricao }}
                  </option>
                  @endforeach
                </select>
              </div>

              {{-- Filtro por Sessão --}}
              <div class="col-6 col-md-3">
                <select class="form-control select2" name="session_id" id="session_id">
                  <option value="">Todas as Sessões</option>
                  @foreach($sessoes as $sessao)
                  <option value="{{ $sessao->id }}" {{ request()->query('session_id') == $sessao->id ? 'selected' : ''
                    }}>
                    {{ $sessao->nome }} - {{ \Carbon\Carbon::parse($sessao->data)->format('d/m/Y') }}
                  </option>
                  @endforeach
                </select>
              </div>

              {{-- Filtro por Ano --}}
              <div class="col-6 col-md-2">
                <select class="form-control" name="ano" id="ano">
                  <option value="">Ano</option>
                  @for ($i = date('Y'); $i >= 2018; $i--)
                  <option value="{{ $i }}" {{ request()->query('ano') == $i ? 'selected' : '' }}>
                    {{ $i }}
                  </option>
                  @endfor
                </select>
              </div>

              {{-- Campo de pesquisa por nome do vereador --}}
              <div class="col-md-4">
                <div class="input-group">
                  <input type="text" name="pesquisa" id="pesquisa" class="form-control"
                    value="{{ request()->query('pesquisa') }}" placeholder="Nome do vereador">
                  <button type="submit" class="btn btn-info" title="Pesquisar">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>


      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Vereador</th>
              <th scope="col">Sessão</th>
              <th scope="col">Data Sessão</th>
             
              <th scope="col" width="20%" class="text-center">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pronunciamentos as $pronunciamento)
            <tr>
              <th scope="row">{{$loop->iteration}}</th>
              <td>{{$pronunciamento->councilor->nome}}</td>
              <td>{{$pronunciamento->session->nome}}</td>
              <td>{{\Carbon\Carbon::parse($pronunciamento->session->data)->format('d/m/Y')}} </td>
              <td class="text-center">
                @can('ver-pronunciamento')
                <a href="{{route('pronunciamentos.show', $pronunciamento->id)}}" data-id="{{$pronunciamento->id}}"
                  class="btn  bg-gradient-info btn-flat mt-0" data-toggle="tooltip" data-placement="top"
                  title="Ver Detalhes">
                  <i class="far fa-eye"></i>
                </a>
                @endcan

                @can('editar-pronunciamento')
                <a href="{{route('pronunciamentos.edit', $pronunciamento)}}"
                  class="btn  bg-gradient-primary btn-flat  " data-toggle="tooltip" data-placement="top" title="Editar">
                  <i class="fas fa-edit"></i>
                </a>
                @endcan

                @can('excluir-pronunciamento')
                <a href="{{route('pronunciamentos.destroy', $pronunciamento->id)}}" data-id="{{$pronunciamento->id}}"
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
        @if (isset($filters))
        {!!$pronunciamentos->appends($filters)->links()!!}
        @else
        {!!$pronunciamentos->links()!!}
        @endif
      </div>
    </div>
    <!-- /.card -->
  </div>
</div>
@stop
@section('js')
<script>
  $(function () {    
     $.fn.select2.defaults.set( "theme", "bootstrap" );
    $('.select2').select2();
    })
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