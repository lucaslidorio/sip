@extends('adminlte::page')
@section('title', 'Processos')
@section('content_header')
@section('plugins.Sweetalert2', true)
@include('sweetalert::alert')
{{-- Script css para configurar a notificação acima dos botões --}}
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Processos</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item "><a href="{{route('processos.index')}} ">Processos</a></li>
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
          <div class="col-md-2">
            <div class="input-group input-group-sm">
              @can('novo-processo-compras')
              <a href="{{route('processos.create')}}" class="btn bg-gradient-success  " data-toggle="tooltip"
                data-placement="top" title="Cadastrar novo Processo">
                <i class="fas fa-plus"></i> Novo</a>
              @endcan
            </div>
          </div>
          <div class="col-md-10">
            <form action="{{route('processos.index')}}" method="GET" class="form form-inline  ">
              @csrf
              <div class="col-3">
                <select class="form-control" name="modalidade_id" id="modalidade_id" style="width: 100%;">
                  <option value="" selected>Selecione uma modalidade</option>
                  @foreach ($modalidades as $modalidade)
                  <option value="{{$modalidade->id}}" {{ request()->query('modalidade_id') == $modalidade->id ?
                    'selected' : '' }}>
                    {{$modalidade->nome}}
                  </option>
                  @endforeach
                </select>
              </div>
              <div class="col-3">
                <select class="form-control" name="criterio_julgamento_id" id="criterio_julgamento_id"
                  style="width: 100%;">
                  <option value="" selected>Selecione um Julgamento</option>
                  @foreach ($criteriosJulgamento as $criterio)
                  <option value="{{$criterio->id}}" {{ request()->query('criterio_julgamento_id') == $criterio->id ?
                    'selected' : '' }}>
                    {{$criterio->nome}}
                  </option>
                  @endforeach
                </select>
              </div>
              <div class="col-2">
                <select class="form-control" name="proceeding_situation_id" id="proceeding_situation_id"
                  style="width: 100%;">
                  <option value="" selected>Seleciona uma situação</option>
                  @foreach ($situacoes as $situacao)
                  <option value="{{$situacao->id}}" {{ request()->query('proceeding_situation_id') == $situacao->id ?
                    'selected' : '' }}>
                    {{$situacao->nome}}
                  </option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-4">
                <div class="input-group">
                  <input type="text" name="pesquisa" id="pesquisa" class="form-control" placeholder="Objeto, descricão">
                  <span class="input-group-append">
                    <button type="submit" class="btn btn-info btn-flat" data-toggle="tooltip" data-placement="top"
                      title="Pesquisar"><i class="fas fa-search"></i></button>
                  </span>
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
              <th>Número</th>
              <th>Modalidade</th>
              <th>Critério de Julgamento</th>
              <th>Data Publicação</th>
              <th>Válido Até</th>
              <th>Situação</th>
              <th>Objeto</th>
              @can('ver-processos-usuario-externo')
              <th>Meu Status</th>
              @endcan
              <th width="20%" class="text-center">Ações</th>

            </tr>
          </thead>
          <tbody>
            @foreach ($paginatedData as $data)

            @php
              $movementCounts = $data['processo']->countCredenciamentosWithLastMovements();
            @endphp

            <tr>
              <td>{{$data['processo']->numero }}/{{$data['processo']->data_publicacao->year }}</td>
              <td>{{$data['processo']->modalidade->nome}}</td>
              <td>{{$data['processo']->criterio_julgamento->nome}}</td>
              <td>{{$data['processo']->data_publicacao->format('d-m-Y H:i:s') }}</td>
              <td>{{$data['processo']->data_validade->format('d-m-Y H:i:s')}}</td>
              <td>
                <small class="badge
                @switch($data['processo']->situacao->id)
                @case(32)
                    badge-info
                    @break
                @case(33)
                    badge-success
                    @break
                @case(34)
                @case(35)
                    badge-info
                    @break
                @case(34)
                    badge-info
                    @break
                @case(36)
                    badge-warning
                    @break
                @case(37)
                @case(38)
                    badge-danger
                    @break
                @default
                    badge-secondary
              @endswitch
            "> {{$data['processo']->situacao->nome}}
                </small>
              </td>
              <td>{{ \Illuminate\Support\Str::limit($data['processo']->objeto, 100, '...') }}</td>
              @can('ver-processos-usuario-externo')
              <td>
                @if($data['ultima_movimentacao'])
                <span class="bg 
                  @switch($data['ultima_movimentacao']->tipoMovimentacao->id)                    @case(1)
                        bg-warning
                        @break
                    @case(2)
                        bg-info
                        @break
                    @case(3)
                        bg-primary
                        @break
                    @case(4)
                    @case(6)
                        bg-warning
                        @break
                    @case(5)
                        bg-success
                        @break
                    @case(7)
                    @case(8)
                        bg-danger
                        @break
                    @default
                        bg-secondary
                    @endswitch
                    ">
                  {{ $data['ultima_movimentacao']->tipoMovimentacao->nome }}</span></br>
                <i class="text-muted">{{$data['ultima_movimentacao']->observacao }}</i></br>
                <i class="text-muted d-block float-right">Movimentado em:
                  {{$data['ultima_movimentacao']->created_at->format('d-m-Y H:i:s') }}</i>
                @else
                @endif
              </td>
              @endcan
              <td class="text-center">
                @can('ver-processo-compras')
                <a href="{{route('processos.credenciados', $data['processo']->id)}}" data-id="{{$data['processo']->id}}"
                  class="btn  bg-gradient-secondary btn-flat mt-0 position-relative" data-toggle="tooltip"
                  data-placement="top" title="Ver Solicitações de Credenciamento">

                  @if ($movementCounts['nao_recebido'] > 0)
                  <span class="badge bg-success position-absolute top-0 start-100 translate-middle">{{ $movementCounts['nao_recebido'] }}</span>

                  @endif
                 
                  <i class="fas fa-luggage-cart"></i>
                </a>
                @endcan
                @can('ver-processos-usuario-externo')
                @if($data['ultima_movimentacao'])
                @if($data['ultima_movimentacao']->tipoMovimentacao->id == 1 ||
                $data['ultima_movimentacao']->tipoMovimentacao->id == 2)
                <a href="#" data-id="{{$data['processo']->id}}" class="btn  bg-gradient-success btn-flat mt-0"
                  data-toggle="tooltip" data-placement="top" title="Solicitar Credenciamento"
                  onclick="confirmCredenciamento(event, '{{ route('credenciamento.create', $data['processo']->id) }}')">
                  <i class="fas fa-shopping-cart"></i>
                </a>
                @else
                <a href="{{route('credenciamento.showTimeline',  $data['credenciamento_id'])}}"
                  data-id="{{$data['processo']->id}}" data-id="{{$data['processo']->id}}"
                  class="btn  bg-gradient-secondary btn-flat mt-0" data-toggle="tooltip" data-placement="top"
                  title="Acompanhar Credenciamento">
                  <i class="fas fa-search"></i>
                </a>
                @endif

                @if($data['ultima_movimentacao']->tipoMovimentacao->id == 4)
                <a href="{{route('credenciamento.createEnviarComplementacao', [$data['processo']->id, $data['credenciamento_id']])}}"
                  data-id="{{$data['processo']->id}}" class="btn  bg-gradient-warning btn-flat mt-0"
                  data-toggle="tooltip" data-placement="top" title="Complementar Informações">
                  <i class="fas fa-question"></i>
                </a>
                @endif

                @elseif($data['processo']->proceeding_situation_id == 33)
                <a href="#" data-id="{{$data['processo']->id}}" class="btn  bg-gradient-success btn-flat mt-0"
                  data-toggle="tooltip" data-placement="top" title="Solicitar Credenciamento"
                  onclick="confirmCredenciamento(event, '{{ route('credenciamento.create', $data['processo']->id) }}')">
                  <i class="fas fa-shopping-cart"></i>
                </a>
                @else
                @endif
                @endcan
                @canany(['ver-processo-compras', 'ver-processos-usuario-externo'])
                <a href="{{route('processos.show', $data['processo']->id)}}" data-id="{{$data['processo']->id}}"
                  class="btn  bg-gradient-info btn-flat mt-0 " data-toggle="tooltip" data-placement="top"
                  title="Ver Detalhes do Processo">
                  <i class="far fa-eye"></i>
                </a>
                @endcanany
                @can('editar-processo-compras')
                <a href="{{route('processos.edit', $data['processo']->id)}}" class="btn  bg-gradient-primary btn-flat  "
                  data-toggle="tooltip" data-placement="top" title="Editar">
                  <i class="fas fa-edit"></i>
                </a>
                @endcan
                @can('editar-processo-compras')
                <a href="{{route('processoAttachmentCreate.create', $data['processo']->id)}}"
                  data-id="{{$data['processo']->id}}" class="btn  bg-gradient-success btn-flat mt-0"
                  data-toggle="tooltip" data-placement="top" title="Anexar Arquivos">
                  <i class="fas fa-paperclip"></i>
                </a>
                @endcan
                @can('excluir-processo-compras')
                <a href="{{route('processos.destroy', $data['processo']->id)}}" data-id="{{$data['processo']->id}}"
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
        {!!$paginatedData->appends($pesquisar)->links()!!}
        @else
        {!!$paginatedData->links()!!}
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
function confirmCredenciamento(event, url) {
        event.preventDefault();
        
        Swal.fire({
            title: 'Você tem certeza?',
            text: "Você deseja solicitar o credenciamento?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, continuar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }

</script>
@stop