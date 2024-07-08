@extends('adminlte::page')

@section('title', "Solicitações de Credenciamento")

@section('content_header')

<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Solicitações de Credenciamentos - <strong>{{$processo->numero}}/ {{$processo->data_publicacao->year}}</strong></h1>
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
  <div class="row no-gutters " style="padding:15px">
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
      <p class="card-text"><strong>Início da Sessão : </strong> {{$processo->inicio_sessao->format('d-m-Y H:i:s')}}</p>
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

  <div class="col-md-12 border-top pt-2">

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
                @forelse($credenciadosData  as $data)
                <tr data-widget="expandable-table" aria-expanded="false">
                  <td>{{$loop->iteration}}</td>
                  <td>{{$data['credenciado']->dadoPessoa->razao_social}}</td>                  
                  <td>{{$data['credenciado']->dadoPessoa->cnpj ?? 'Não Informado' }}</td>
                  <td>{{$data['credenciado']->dadoPessoa->email}}</br>{{$data['credenciado']->dadoPessoa->telefone}} - {{$data['credenciado']->dadoPessoa->celular}}</td>
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
                      <i class="text-muted d-block float-right">Movimentado em: {{$data['ultima_movimentacao']->created_at->format('d-m-Y H:i:s') }}</i>
                    @else

                    @endif
                  </td>
                  
                  <td>
                    @canany(['ver-processo-compras'])
                    <a href="#" data-id="{{$data['credenciado']->id}}"
                      class="btn  bg-gradient-info btn-flat mt-0 " data-toggle="tooltip" data-placement="top"
                      title="Ver Detalhes">
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
                        <a href="{{config('app.aws_url')."{$documento->anexo}" }}" target="_blank" class="mb-4 mr-3  text-reset" >
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
                        "                           
                          href={{route('credenciamento.receberCredenciamento', $data['credenciado']->id)}} role="button"
                          data-toggle="tooltip"                        
                         
                          data-placement="top" title="Receber Credenciamento">
                          <i class="fas fa-download"></i> Receber</a>  

                          <a class="btn  btn-warning ml-2" href={{route('credenciamento.receberCredenciamento', $data['credenciado']->id)}} role="button"
                            data-toggle="tooltip"
                            data-placement="top" title="Solicitar Complementação">
                          <i class="fas fa-question"></i> Complementação </a> 
                        
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


    {{-- <div class="row border-top mt-3 " style="padding-left: 25px">
      <table class="table  table-hover table-borderless border-top mt-2 table-sm ">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Anexo</th>
            <th scope="col">Descrição</th>
            <th scope="col">Tipo de documento</th>
            <th scope="col">Downloads</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($processo->anexos as $attachment) <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>
              <a href="{{ url('/processos/download/' . $attachment->id) }}"
                target="_blank" class="mb-2 text-reset"
                data-toggle="tooltip" data-placement="top"
               
                title="Clique para abrir o documento" >
                <i class="far fa-file-pdf fa-2x text-danger mr-2"></i>
                <span class="mr-2"> {{$attachment->nome_original}}</span>
              </a>
            </td>
            <td>
              {{$attachment->descricao}}
            </td>
            <td>
              <span class="mr-2"> {{$attachment->type_document->nome}}</span>
            </td>
            <td>
              <span class="mr-2"> {{$attachment->qtd_download}}</span>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div> --}}
  </div>


  <div class="card-footer" style="padding-left: 34px">
  @can('editar-processo-compras')
  <a class="btn btn-primary" href={{route('processos.edit', ['id'=>$processo->id])}} role="button"
    data-toggle="tooltip"
    data-placement="top" title="Editar Processo">
    <i class="fas fa-edit"></i> Editar</a>    
  @endcan
  @can('ver-processos-usuario-externo')
  <a class="btn btn-success" href="#" role="button"
    data-toggle="tooltip"
    data-placement="top" title="Solicitar Credenciamento ao processo"
    onclick="confirmCredenciamento(event, '{{ route('credenciamento.create', $processo->id) }}')">
    <i class="fas fa-shopping-cart"></i> Credenciar</a>    
  @endcan
    
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
</script>

@endsection

@stop