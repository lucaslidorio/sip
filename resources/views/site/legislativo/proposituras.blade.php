@extends('site.legislativo.layouts.default')

@section('content')
<div class="card rounded-0">
  <div class="card-header ">
    <h4 class="text-center">PROPOSITURAS DOS PODER LEGISLATIVO </h4>
    <p class="text-center fs-5">Indicações, moções, pareceres, projetos de leis, etc...</p>


    <form action="{{ route('camara.proposituras') }}" method="get">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-xl-4 col-xxl-4">
          <label for="sessao" class="form-label">Tipo de Documento:</label>
          <select id="type_proposition_id" name="type_proposition_id" class="form-select">
            <option value="" selected>Selecione uma opção</option>
            @foreach ($tipos_propositura as $tipo)
            <option value="{{ $tipo->id }}" {{ request()->query('type_proposition_id') == $tipo->id ? 'selected' : '' }}>
              {{ $tipo->nome }}
            </option>
            @endforeach
          </select>
        </div>
        <div class="col-lg-12 col-md-12 col-xl-4 col-xxl-4">
          <label for="proceeding_situation_id" class="form-label">Situação:</label>
          <select id="proceeding_situation_id" name="proceeding_situation_id" class="form-select">
            <option value="" selected>Selecione uma opção</option>
            @foreach ($situacoes as $situacao)
            <option value="{{ $situacao->id }}" {{ request()->query('proceeding_situation_id') == $situacao->id ? 'selected' : '' }}>
              {{ $situacao->nome }}
            </option>
            @endforeach
          </select>
        </div>

        <div class="col-sm-6 col-md-12 col-lg-6 col-xl-4 col-xxl-3">          
          
            <label class="form-label" for="ano">Ano:</label>
            <select class="form-select" id="ano" name="ano">
                <option value="" selected >Ano</option> 
                <option value="2018" {{ request()->query('ano') == '2018' ? 'selected': ''}}>2018 </option> 
                <option value="2019" {{ request()->query('ano') == '2019' ? 'selected': ''}}>2019 </option>                       
                <option value="2020" {{ request()->query('ano') == '2020' ? 'selected': ''}}>2020 </option> 
                <option value="2021" {{ request()->query('ano') == '2021' ? 'selected': ''}}>2021 </option>  
                <option value="2022" {{ request()->query('ano') == '2022' ? 'selected': ''}}>2022 </option>  
                <option value="2023" {{ request()->query('ano') == '2023' ? 'selected': ''}}>2023 </option>  
                <option value="2024" {{ request()->query('ano') == '2024' ? 'selected': ''}}>2024 </option>                              
            </select>           
               
        </div>
        <div class="col-sm-6 col-md-12 col-lg-6 col-xl-4 col-xxl-3">          
          <label class="form-label" for="ordenacao">Ordenar por:</label>
          <select class="form-select" id="ordenacao" name="ordenacao">
            <option value="" selected >Nenhum</option> 
            <option value="ASC" {{ request()->query('ordenacao') == 'ASC' ? 'selected': ''}} >Número crescente </option> 
            <option value="DESC" {{ request()->query('ordenacao') == 'DESC' ? 'selected': ''}}>Número decrescente </option>                                             
        </select>                                
        </div>        
        <div class="col-sm-6 col-md-12 col-sm-4 col-lg-6 col-xl-4 col-xxl-2 pt-lg-4 mt-2 ">              
          <button class="btn rounded-0 text-white " type="submit" style="background-color: #0b468e">
            <i class="bi bi-funnel"></i>
            Filtrar
          </button>
        </div>
      </div>
    </form>
  </div>
  <div class="card-body">
    <table class="table table-hover">
      <thead>
        <tr>       
          <th scope="col">Número</th>
          <th scope="col">Data</th>
          <th scope="col">Tipo</th>
          <th scope="col">Descrição</th>
          <th scope="col">Situação</th>
          <th scope="col" class="text-center">Ações</th>              
        </tr>
      </thead>
      <tbody>
        @foreach ($proposituras as $propositura)
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
        @endforeach
      </tbody>
    </table>
  </div> 
  <div class="card-footer text-muted">
    @if (!empty($filters))
    {!!$proposituras->appends($filters)->links()!!}
    @else
    {!!$proposituras->links()!!}
    @endif
  </div>
</div>


</section>
@endsection