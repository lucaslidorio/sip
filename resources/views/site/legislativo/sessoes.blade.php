
@extends('site.legislativo.layouts.default')

@section('content')
{{ Breadcrumbs::render('sessoes') }} 
<div class="card rounded-0">
  <div class="card-header ">
    <h4 class="text-center">Sessões</h4>
    <p  class="text-center fs-5">Sessões Ordinárias, Extraodinárias e Solene</p>
    <form action="{{ route('camara.sessoes') }}" method="get">
      <div class="row">
        <div class="col-lg-5">
          <label for="type_session_id" class="form-label">Tipo:</label>
          <select id="type_session_id" name="type_session_id" class="form-select">
            <option value="" selected>Selecione uma opção</option>
                  @foreach ($tipos_sessao as $tipo)
                      <option value="{{ $tipo->id }}"
                          {{ request()->query('type_session_id') == $tipo->id ? 'selected' : '' }}>
                          {{ $tipo->nome }}
                      </option>
                  @endforeach
          </select>
        </div>
        <div class="col-lg-5">
          <label for="legislature_id" class="form-label">Legislatura:</label>
          <select id="legislature_id" name="legislature_id" class="form-select">
            <option value="" selected>Selecione uma opção</option>
            @foreach ($legislaturas as $legislatura)
                <option value="{{ $legislatura->id }}"
                    {{ request()->query('legislature_id') == $legislatura->id ? 'selected' : '' }}>
                    {{ $legislatura->descricao }}
                </option>
            @endforeach
          </select>
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
      @foreach ($sessoes as $sessao)
      <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingOne">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#id{{$sessao->id}}" aria-expanded="false" aria-controls="flush-collapseOne">
            <div class="row">
              <div class="col-2">{{ $sessao->nome }}</div>
              <div class="col-2 block">{{ $sessao->typeSession->nome }}</div>
              <div class="col-2">{{\Carbon\Carbon::parse($sessao->data)->format('d/m/Y')}} - {{$sessao->hora}}</div>
              <div class="col-3">{{ $sessao->legislature->descricao }}</div>
              <div class="col-3">{{ $sessao->section->descricao }} -
                  {{ $sessao->section->ano }}</div>
          </div>
          </button>
        </h2>
        <div id="id{{$sessao->id}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body">
            <div class="card-body">
                                     
              <div class="row">
                  <div class="col-sm-6">
                    <p class="card-text"><strong>Nome: </strong> {{$sessao->nome}}</p>  
                    <p class="card-text"><strong>Tipo: </strong> {{$sessao->typeSession->nome}}</p>  
                    <p class="card-text"><strong>Data: </strong>{{\Carbon\Carbon::parse($sessao->data)->format('d/m/Y')}}</p>
                    <p class="card-text"><strong>Hora: </strong>  {{$sessao->hora}}</p>        
                    <p class="card-text"><strong>Legislatura: </strong> {{$sessao->legislature->descricao}}</p>
                    <p class="card-text"><strong>Sessão Legislativa: </strong> {{$sessao->section->descricao}}</p>
                    <p class="card-text"><strong>Periódo Legislativo: </strong> {{$sessao->period->nome}}</p>
                    <p class="card-text"><strong>Descrição: </strong> {{$sessao->descricao}}</p>
                  </div>
                  <div class="col-sm-6">
                       <h5 class="font-weight-bold"> Vereadores Presentes </h5>
            
                       @foreach ($sessao->legislature->councilors; as $councilor)          
                       <div class="icheck-primary">
                          <input type="checkbox" class="lista font-weight-bold" name="councilors[]" value="{{$councilor->id}}" id="{{$councilor->id}}"
                           
                                  @foreach ($sessao->councilors_present as $sessionCouncilor)                                           
                                          {{$councilor->id == $sessionCouncilor->id ? 'checked' : ''}}        
                                  @endforeach               
                         
                                  disabled/>
                        <label class="check font-weight-bold" for="{{$councilor->id}}"> {{$councilor->nome}}</label>     
                      </div> 
                            
                      @endforeach
                      @if($sessao->link_transmissao)
                      <a target="__blank" href="{{$sessao->link_transmissao}}">
                          <div class="alert alert-primary d-inline-flex " role="alert">
                              <h6><i class="fas fa-video text-danger" ></i> Assistir Transmissão</h6> 
                            </div>
                          </a> 
                      @endif
                  </div>
                 
                </div> 
                
                <table class="table  table-hover table-borderless border-top mt-2 table-sm ">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Anexo</th>
                      <th scope="col">Descrição</th>
                      <th scope="col">Tipo de documento</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($sessao->attachments as $attachment) 
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                      <td>
                         <a href="{{config('app.aws_url')."{$attachment->anexo}" }}" 
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
    {!!$sessoes->appends($filters)->links()!!}
    @else
    {!!$sessoes->links()!!}
    @endif
  </div>
</div>

 
</section>
@endsection