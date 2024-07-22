@extends('adminlte::page')

@section('title', "Solicitações de Credenciamento")

@section('content_header')

<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Solicitações de Credenciamentos - <strong>{{$processo->numero}}/ {{$processo->data_publicacao->year}}</strong>
      </h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
        <li class="breadcrumb-item "> <a href="{{route('processos.index')}}">Processos </a></li>
        <li class="breadcrumb-item ">Solicitações de Credenciamentos</li>
      </ol>
    </div>
  </div>
</div>

@include('sweetalert::alert')
@stop

@section('content')


<div class="card mb-3 mt-3">
  <div class="row no-gutters border-bottom " style="padding:15px">
    <div class="col-md-4" style="padding-left: 15px">
      <p class="card-text"><strong> Número: </strong>{{$processo->numero}}/{{$processo->data_publicacao->year}}</p>
      <p class="card-text"><strong>Modalidade: </strong>
        {{ \Illuminate\Support\Str::upper($processo->modalidade->nome)}}</p>
      <td>
    </div>
    <div class="col-md-4" style="padding-left: 15px">
      <p class="card-text"><strong>Data de Publicação: </strong> {{$processo->data_publicacao->format('d-m-Y H:i:s')}}
      </p>
      <p class="card-text"><strong>Critério de Julgamento : </strong> {{$processo->criterio_julgamento->nome}}</p>

    </div>
    <div class="col-md-4" style="padding-left: 15px">
      <p class="card-text"><strong>Data de Validade : </strong> {{$processo->data_validade->format('d-m-Y H:i:s')}}</p>
      <p class="card-text"><strong>Situação :
        </strong>
        <small class="badge
        @switch($processo->situacao->id)
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
          "> {{$processo->situacao->nome}}
        </small>
      </p>
    </div>
  </div>



  <div class="row " style="padding:15px">
    
      @foreach($counts['movements'] as $movementTypeId => $movementData)      
      <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box" >        
          @switch($movementTypeId)
                  @case(1)
                    <span class="info-box-icon bg-teal" >            
                      <i class="fas fa-shopping-cart"></i>         
                    </span>                      
                  @break
                  @case(2)
                    <span class="info-box-icon bg-teal">            
                      <i class="far fa-paper-plane bg-teal"></i>         
                    </span>                     
                  @break
                  @case(3)
                    <span class="info-box-icon bg-blue">            
                      <i class="fas fa-download bg-blue"></i>         
                    </span>
                      @break
                  @case(4)
                    <span class="info-box-icon bg-warning">            
                      <i class="far fa-question-circle"></i>         
                    </span>                      
                      @break
                  @case(5)
                    <span class="info-box-icon bg-green">            
                      <i class="fas fa-check-square"></i>         
                    </span>
                      @break
                  @case(6)
                    <span class="fas info-box-icon bg-orange">            
                      <i class="fas fa-check-square"></i>         
                    </span>
                      @break
                  @case(7)
                  <span class="fas info-box-icon bg-danger">            
                    <i class="fas fa-hand-paper"></i>         
                  </span>
                      @break 
                  @case(8)
                    <span class="far info-box-icon bg-danger">            
                      <i class="fas fa-times-circle"></i>         
                    </span>
                     @break    
                  @case(9)
                    <span class="far info-box-icon bg-teal">            
                      <i class="fas fa-times-circle"></i>         
                    </span>
                      @break                 
                  @default
                  <i class="fas fa-chevron-circle-down bg-blue"></i>
                  @endswitch
          <div class="info-box-content">
            <span class="info-box-text text-wrap">{{ $movementData['nome'] }}</span>
            <span class="info-box-number">{{ $movementData['count'] }}</span>
          </div>
        </div>
      </div>    
                  
      @endforeach
      <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
          <span class="info-box-icon bg-info"><i class="fas fa-grip-lines"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total</span>
            <span class="info-box-number">{{$counts['total'] }}</span>
          </div>
        </div>
      </div>       
      <div class="col-md-12  pt-2">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Fonecedores</h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Razão Social</th>
                      <th>Cnpj</th>
                      <th>Contato</th>
                      <th>Status</th>
                      <th>Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($credenciadosData as $data)
                    <tr data-widget="expandable-table" aria-expanded="false">
                      <td>{{$loop->iteration}}</td>
                      <td>{{$data['credenciado']->dadoPessoa->razao_social}}</td>
                      <td>{{$data['credenciado']->dadoPessoa->cnpj ?? 'Não Informado' }}</td>
                      <td>{{$data['credenciado']->dadoPessoa->email}}</br>{{$data['credenciado']->dadoPessoa->telefone}}
                        - {{$data['credenciado']->dadoPessoa->celular}}</td>
                      <td>
                        @if($data['ultima_movimentacao'])
                        <span class="bg 
                    @switch($data['ultima_movimentacao']->tipoMovimentacao->id)
                      @case(1)
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
                          {{ $data['ultima_movimentacao']->tipoMovimentacao->nome }}</span><br>
                        <i class="text-muted">{{$data['ultima_movimentacao']->observacao }}</i>
                        <i class="text-muted d-block float-right">Movimentado em:
                          {{$data['ultima_movimentacao']->created_at->format('d-m-Y H:i:s') }}</i>
                        @else

                        @endif
                      </td>

                      <td>
                        @canany(['ver-processo-compras'])
                        <a href="#" data-id="{{$data['credenciado']->id}}" class="btn  bg-gradient-info btn-flat mt-0 "
                          data-toggle="tooltip" data-placement="top" title="Ver Detalhes">
                          <i class="far fa-eye"></i>
                        </a>
                        @endcanany

                      </td>
                    </tr>
                    <tr class="expandable-body">
                      <td colspan="6">
                        <p><strong>Documentos Anexados:</strong></p>
                        <p>
                          @forelse ($data['credenciado']->documentos as $documento)
                          <a href="{{config('app.aws_url')." {$documento->anexo}" }}" target="_blank" class="mb-4 mr-3
                            text-reset" >
                            <i class="far fa-file-pdf fa-2x text-danger mr-2"></i>
                            <span class="mr-2"> {{$documento->nome_original}}</span>
                          </a>
                          @empty
                          Nenhum documento encontrado
                          @endforelse
                        </p>
                        <div class="row float-right">
                          @can('editar-processo-compras')
                          <a class="btn  btn-success
                          @if ($data['credenciado']->movimentacoes->contains('tipo_movimentacao_id', 3))
                          disabled
                          @endif
                        " href={{route('credenciamento.receberCredenciamento', $data['credenciado']->id)}}
                            role="button"
                            data-toggle="tooltip" data-placement="top" title="Receber Credenciamento">
                            <i class="fas fa-download"></i> Receber</a>

                          <button type="button" class="btn btn-primary ml-2 
                          @if (!$data['credenciado']->movimentacoes->contains('tipo_movimentacao_id', 3)) disabled @endif
                          " data-toggle="modal" data-target="#movimentacaoModal"
                            data-id="{{ $data['credenciado']->id }}">
                            <i class="far fa-play-circle"></i> Movimentar
                          </button>
                          @endcan
                          @can('ver-processo-compras')
                          <a class="btn  btn-secondary ml-2 " href={{route('credenciamento.showTimeline',
                            $data['credenciado']->id)}} role="button"
                            data-toggle="tooltip" data-placement="top" title="Acompanhar Credenciamento">
                            <i class="fas fa-search"></i> Acompanhar</a>
                          @endcan

                        </div>

              </div>
              </td>
              </tr>
              @empty

              @endforelse

              </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    <div class="card-footer" style="padding-left: 34px">

    </div>
  </div>
</div>
  <!-- Modal -->
  <div class="modal fade" id="movimentacaoModal" tabindex="-1" role="dialog" aria-labelledby="movimentacaoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="movimentacaoModalLabel">Solicitar Complementação</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="complementacaoForm" method="POST" action="{{ route('credenciamento.movimentarCredenciamento') }}">
            @csrf
            <div class="form-group">
              <label for="tipo_movimentacao_id">Movimentação</label>
              <select name="tipo_movimentacao_id" id="tipo_movimentacao_id" class="form-control">
                <option value="">Selecione</option>
                @foreach($tiposMovimentacoes as $tipoMovimentacao)
                <option value="{{ $tipoMovimentacao->id }}">{{ $tipoMovimentacao->nome }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="observacao">Observação</label>
              <textarea class="form-control" id="observacao" name="observacao" rows="3"></textarea>
            </div>
            <input type="hidden" name="credenciamento_id" id="credenciamento_id" value="">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" form="complementacaoForm" class="btn btn-primary">Salvar</button>
        </div>
      </div>
    </div>
  </div>

  @section('js')
  <script>
    //inicia o tooltip
  $(function () {
   $('[data-toggle="tooltip"]').tooltip()
  })  
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
    $('#movimentacaoModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) //  Botão que acionou o modal
        if (button.hasClass('disabled')) {
        return false; // Impede a abertura do modal se o botão estiver desabilitado
    }
        var credenciamentoId = button.data('id') // Extrair informação dos dados-* do botão
        var modal = $(this)
        modal.find('#credenciamento_id').val(credenciamentoId)
    })

  </script>

  @endsection

  @stop