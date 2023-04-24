@extends('site.legislativo.layouts.default')

@section('content')
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

        {{-- @foreach ($proposituras as $propositura)
        <tr>
            <th scope="row">{{$propositura->numero}}</th>
            <td>{{\Carbon\Carbon::parse($propositura->data)->format('d/m/Y')}}</td>
            <td>{{$propositura->type_proposition->nome}}</td>
            <td>{{$propositura->descricao}}</td>
            <td><span class="badge" style="background-color: #0b468e">{{$propositura->situation->nome}}</span></td>
            <td class="text-center">
                <a href="{{route('propositura.show', $propositura->id)}}" data-id=""
                class="btn text-white " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ver Detalhes"  
                title="Ver Detalhes" style="background-color: #0b468e"> 
                <i class="far fa-eye " > Abrir</i>
               </a>
            </td>          
        </tr>
        @endforeach --}}
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