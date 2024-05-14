@extends('site.legislativo.layouts.default')

@section('content')
{{Breadcrumbs::render('propositura', $propositura)}}
<div class="card rounded-0">
  <div class="card-header ">
    <h4 class="text-center">PROPOSITURAS DOS PODER LEGISLATIVO </h4>
    <p class="text-center fs-5"><strong> {{$propositura->type_proposition->nome}} nº: {{$propositura->numero}} </strong></p>             
  </div>
  <div class="card-body">
    <table class="table table-hover">
      <thead>
        <tr>       
          <th scope="col">Número:</th>  
          <th scope="col">{{$propositura->numero}}</th>               
        </tr>
      </thead>
      <tbody>        
        <tr>
          <th scope="row">Autor(s)</th>
          <td>
            @foreach ($propositura->author as $autor)
            <p>{{$autor->nome}} - {{$autor->party->sigla}}</p>                
            @endforeach
          </td>             
        </tr>
        <tr>
          <th scope="row">Data</th>
          <td>{{\Carbon\Carbon::parse($propositura->data)->format('d/m/Y')}}</td>
        </tr>
        <tr>
          <th scope="row">Descrição (caput)</th>
          <td colspan="2">{{$propositura->descricao}}</td>                
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
              target="_blank" class="mb-2 text-reset"
              data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Clique para abrir o documento" 
                  title="Clique para abrir o documento" >
                  <i class="bi bi-file-earmark-pdf text-danger fs-3"></i>
                  
                <span class="mr-2"> {{$anexo->nome_original}}</span>                
            </a>
            @endforeach
          </td>                
        </tr>

        <tr>
          <th scope="row">Votação</th>
          <td >
            @if(count($votos)> 0 )
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Vereador</th>
                  <th scope="col">Voto</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($votos as $voto)
                <tr>
                  <td>{{$voto->vereador}}</td>
                  <td>{{$voto->voto}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @else
            <div class="alert alert-secondary" role="alert">
              A propositura não possui votos.
            </div>
            @endif

          </td>                
        </tr>
      </tbody>
    </table>
  </div> 
  <div class="card-footer text-muted">
    {{-- @if (!empty($filters))
    {!!$proposituras->appends($filters)->links()!!}
    @else
    {!!$proposituras->links()!!}
    @endif --}}
  </div>
</div>


</section>
@endsection