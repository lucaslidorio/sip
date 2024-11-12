
@extends('site.legislativo.layouts.default')
@section('content')
{{ Breadcrumbs::render('processo_compras') }} 
<div class="card rounded-0">
  <div class="card-header ">
    <h4 class="text-center">Processos de Compras</h4>
    <p  class="text-center fs-5">Processo de compras</p>
    <form action="{{ route('processoCompras.index') }}" method="get">
      <div class="row">
        <div class="col-lg-4">
          <label for="type_session_id" class="form-label">Modalidade:</label>
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
        <div class="col-lg-4">
          <label for="legislature_id" class="form-label">Julgamento:</label>
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
        <div class="col-lg-4">
          <label for="legislature_id" class="form-label">Situação:</label>
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
                  
      </div>
      <div class="row">
        <div class="col-lg-4">
          <label for="legislature_id" class="form-label">Pesquisa:</label>
          <div class="input-group">
            <input type="text" name="pesquisa" id="pesquisa" class="form-control" placeholder="Objeto, descricão">
          </div>
        </div>
        <div class="col-sm-4 col-lg-2 pt-lg-4 mt-2">              
          <button class="btn btn-primary " type="submit">
            <i class="bi bi-funnel"></i>
            Filtrar
          </button>
        </div>
      </div>
    </form>
  </div>
  <div class="card-body">
    <div class="accordion accordion-flush" id="accordionFlushExample">
      @foreach ($processos as $processo)
      <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingOne">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#id{{$processo->id}}" aria-expanded="false" aria-controls="flush-collapseOne">
            <div class="row">
              <div class="col-2"><strong>Numero: <br></strong> {{ $processo->numero }}/{{ $processo->data_publicacao->year }}</div>
              <div class="col-2"><strong>Modalidade:<br> </strong>{{ $processo->modalidade->nome }}</div>              
              <div class="col-2"><strong >Objeto:<br></strong> {{ Str::limit($processo->objeto, 50) }}</div>              
              <div class="col-3"><strong>Publicado em:<br></strong> {{ $processo->data_publicacao->format('d-m-Y H:i:s') }} </div>
              <div class="col-3"><strong>Situação:<br></strong>
                <span class="badge 
                @switch($processo->situacao->id)
                @case(32)
                    bg-info
                    @break
                @case(33)
                    bg-success
                    @break
                @case(34)
                @case(35)
                    bg-info
                    @break
                @case(34)
                    bg-info
                    @break
                @case(36)
                    bg-warning
                    @break
                @case(37)
                @case(38)
                    bg-danger
                    @break
                @default
                    bg-secondary
              @endswitch">{{ $processo->situacao->nome }}</span></div>
            </div>
          </button>
        </h2>
        <div id="id{{$processo->id}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body">
            <div class="card-body">                                     
              <div class="row">
                  <div class="col-12">
                    <p class="card-text"><strong>Objeto: </strong> {{$processo->objeto}}</p>  
                    <p class="card-text"><strong>Decrição: </strong> {{$processo->descricao}}</p>  
                    <p class="card-text"><strong>Quantidade de lote: </strong>{{$processo->qtd_lotes}}</p>                   
                  </div>          
              </div> 
                <table class="table  table-hover table-borderless border-top border-bottom mt-2 table-sm ">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Anexo</th>
                      <th scope="col">Descrição</th>
                      <th scope="col">Tipo de documento</th>
                      <th scope="col">Dowloads</th>
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
                          <i class="bi bi-file-earmark-pdf" style="font-size: 2rem; color: rgb(247, 23, 23);"></i>
                          <span class="mr-2"> {{$attachment->nome_original}}</span>
                        </a>
                      </td>
                      <td>
                        {{$attachment->nome}}
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
                <h5 class=""> <strong>Fornecedores Credênciados</strong></h5>
                <table class="table  table-hover  mt-2 table-sm ">                
                  <thead>                    
                    <tr>                      
                      <th scope="col">#</th>
                      <th scope="col">Razão Social</th>
                      <th scope="col">Cnpj</th>
                      <th scope="col">Situação</th>                      
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($processo->credenciamentos as $credenciado) <tr>
                      <th scope="row">{{$loop->iteration}}</th>
                      <td>
                        {{$credenciado->dadoPessoa->razao_social}}
                      </td>
                      <td>
                        {{ mascararCpfCnpj($credenciado->dadoPessoa->cnpj) }}                       
                      </td>
                      <td>
                        <span class="mr-2"> {{$credenciado->ultimaMovimentacao->tipoMovimentacao->nome}}</span>
                      </td>                      
                    </tr>
                    @endforeach                    
                  </tbody>
                </table>
         </div>

          </div>
        </div>
      </div>     
      @endforeach
    </div>  
  </div>
  <div class="card-footer text-muted">
    @if (!empty($filters))
    {!!$processos->appends($filters)->links()!!}
    @else
    {!!$processos->links()!!}
    @endif
  </div>
</div>

 
</section>
@endsection