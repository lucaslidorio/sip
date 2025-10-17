@extends('public_templates.leg.default')

@section('content')
<div class="row" style="height: 60px; background-color: #f5f5f5">
  <div class="container ">
      <div class="row mt-4">
          <div class="col-8">
              <p class="fs-1">Proposituras</p>
          </div>
          <div class="col-4 fs-4">{{Breadcrumbs::render('propositura', $propositura)}}</div>
      </div>
  </div>
</div>
<div class="container">
   
    @include('public_templates.leg.includes.proposituras.form_pesquisa') 
    <!-- Tabela de Proposituras -->
    <h3 class="mb-4">
        Detalhes
    </h3>
    <table class="table table-bordered">
        <thead>
            <tr>       
              <th scope="col">Número:</th>  
              <th scope="col"> {{$propositura->numero}} / {{ $propositura->data->format('Y') }}
                 {{ $propositura->type_proposition->nome }}
              </th>               
            </tr>
          </thead>
          <tbody>        
            <tr>
              <th scope="row">Autor(es)</th>
              <td>
                @if ($propositura->author->isNotEmpty())
                  @foreach ($propositura->author as $autor)
                    <p>{{ $autor->nome }} - {{ $autor->party->sigla }}</p>
                  @endforeach
                @else
                  <p>Poder Executivo</p>
                @endif
              </td>             
            </tr>
            <tr>
              <th scope="row">Data</th>
              <td>{{\Carbon\Carbon::parse($propositura->data)->format('d/m/Y')}}</td>
            </tr>
            <tr>
              <th scope="row">Descrição (caput)</th>
              <td colspan="2">{!!$propositura->descricao!!}</td>                
            </tr>
            <tr>
              <th scope="row">Situação</th>
              <td colspan="2">
                <span class="badge " style="background-color: #0b468e">{{$propositura->situation->nome}}</span>  
              </td>                
            </tr>
            <tr>
              <th scope="row">Anexo(s)</th>
              <td >
                @foreach ($propositura->attachments as $anexo)
                <a href="{{config('app.aws_url')."{$anexo->anexo}" }}" 
                  target="_blank" class="mb-2 text-reset me-3"
                  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Clique para abrir o documento" 
                      title="Clique para abrir o documento" >
                      <i class="far fa-file-pdf text-danger fs-1"></i>
                      
                    <span class="mr-2"> {{$anexo->nome_original}}</span>                
                </a>
                @endforeach
              </td>                
            </tr>
    
            <tr>
                <th scope="row">Votação</th>              
                <td>
                  @if($propositura->votos->count() > 0)
                    <table class="table table-bordered mb-0">
                      <thead>
                        <tr>
                          <th scope="col">Vereador</th>
                          <th scope="col">Voto</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($propositura->votos as $voto)
                          <tr>
                            <td>{{ $voto->vereador->nome }} <strong>({{ $voto->vereador->nome_parlamentar}})</strong> </td>
                            <td>{{ $voto->tipoVoto->nome }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    <div class="col-12 mb-3">
                        
                        <h4 class="bg-primary-subtle p-3" >Votação realizada na:
                        <strong>{{$voto->sessao->numero}} {{$voto->sessao->nome}}
                            {{$voto->sessao->typeSession->nome}}</strong></strong> realizada no dia
                        {{ \Carbon\Carbon::parse($voto->sessao->data)->format('d/m/Y') ?? '-' }}
                        as {{ $voto->sessao->hora ?? '-' }}

                        </h4>
                    </div>
                    </table>
                  @else
                    <div class="alert alert-secondary mb-0" role="alert">
                      A propositura não possui votos.
                    </div>
                  @endif
                </td>
              </tr>
              <tr>
                <th scope="row">Parecer(es) da Comissão:</th>               
              <td>
                @if($propositura->pareceres->count())                           
                <ul class="list-unstyled">
                    @foreach($propositura->pareceres as $parecer)
                        <li class="">
                          <p><i class="fas fa-scroll me-2 text-primary fs-1"></i>
                            COMISSÃO:  <strong>{{ $parecer->commission->nome ?? '---' }}</strong></p>
                            <p>{{ $parecer->assunto }}</p>
                            <a href="{{ route('camara.parecer.show', $parecer->id) }}" class="btn btn-primary cor-padrao-bg text-white btn-sm fs-4">
                                Ver Parecer
                            </a>
                        </li>
                      <hr>
                    @endforeach
                </ul>
            @else
                <div class="alert alert-secondary mb-0" role="alert">
                  A propositura nao possui pareceres.
                </div>  
            @endif
              </td>
              </tr>
              
          </tbody>
        
    </table>
    <!-- Paginação -->
   
</div>


</div>
</div> 


@endsection