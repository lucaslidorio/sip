
@extends('site.legislativo.layouts.default')
@section('content')
{{Breadcrumbs::render('diario_oficial')}} 
<div class="card rounded-0">
  <div class="card-header ">
    <h4 class="text-center">Diário Oficial</h4>
    <p  class="text-center fs-5">Diário Oficial</p>
    <form action="{{ route('publicacoes.dof') }}" method="get">
      <div class="row">
        <div class="col-lg-4">
          <label for="tipo_materia_id" class="form-label">Tipo de matéria:</label>
          <select class="form-control" name="tipo_materia_id" id="tipo_materia_id" style="width: 100%;">
            <option value="" selected>Selecione uma materia</option>
            @foreach ($tiposMateria as $materia)
            <option value="{{$materia->id}}" {{ request()->query('tipo_materia_id') == $materia->id ?
              'selected' : '' }}>
              {{$materia->nome}}
            </option>
            @endforeach
          </select>          
        </div>
        <div class="col-sm-6 col-md-12 col-lg-6 col-xl-4 col-xxl-3">          
          <label for="data_inicio" class="form-label">Data Início:</label>
          <div class="input-group">
            <div class="input-group-prepend">                
              <span class="input-group-text  "><i class="bi bi-calendar3"></i></span>
            </div>
            <input type="date" class="form-control" id="data_inicio" name="data_inicio" value="">
          </div>          
      </div>
      <div class="col-sm-6 col-md-12 col-lg-6 col-xl-4 col-xxl-3">          
        <label for="data_fim" class="form-label">Data Fim:</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
          </div>
          <input type="date" class="form-control " id="data_fim" name="data_fim" value="">
        </div>          
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
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Titulo</th>
          <th scope="col"> Conteúdo</th>
          <th scope="col">Tipo de Matéria</th><th scope="col">Publicado em</th>
          <th width="20%" class="text-center">Visualizar</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($documentos as $documento)
        <tr>
          <th scope="row">{{$loop->iteration}}</th>
          <td>{{$documento->titulo}}</td>
          <td style="font-size: 12px;">{!! \Illuminate\Support\Str::limit($documento->conteudo, 80, '...') !!}</td>
          <td>{{$documento->tipoMateria->nome}}</td> 
          <td>{{\Carbon\Carbon::parse($documento->data_publicacao)->format('d/m/Y')}}
          </td>
          <td class="text-center">
            <a href="{{route('publicacoes.dofVerDocumento', $documento->uuid)}}" data-id=""
            class="btn  rounded-0 text-light btn-color " data-toggle="tooltip" data-placement="top"  
            title="Ver Detalhes" >
            <i class="bi bi-eye"></i> Abrir</i>
          </a>
        </td>
        </tr>
        @endforeach
      </tbody>
    </table>   
  </div>
  <div class="card-footer text-muted">
    @if (!empty($filters))
    {!!$documentos->appends($filters)->links()!!}
    @else
    {!!$documentos->links()!!}
    @endif
  </div>
</div>

 
</section>
@endsection