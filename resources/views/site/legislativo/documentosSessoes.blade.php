@extends('site.legislativo.layouts.default')

@section('content')
{{ Breadcrumbs::render('documentos_sessao') }}
<div class="card rounded-0">
  <div class="card-header ">
    <h4 class="text-center">Documentos das sessões</h4>
    <p class="text-center fs-5">Atas, ordem do dia, editais de convocação</p>


    <form action="{{ route('camara.documentosSessoes') }}" method="get">
      <div class="row">

        <div class="col-lg-12 col-md-12 col-xl-4 col-xxl-4">
          <label for="type_document_id" class="form-label">Tipo:</label>
          <select id="type_document_id" name="type_document_id" class="form-select">
            <option value="" selected>Selecione uma opção</option>
            @foreach ($tipos_documento as $tipo)
            <option value="{{ $tipo->id }}" {{ request()->query('type_document_id') == $tipo->id ? 'selected' : '' }}>
              {{ $tipo->nome }}
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
       

        <div class="col-sm-6 col-md-12 col-sm-4 col-lg-6 col-xl-4 col-xxl-2 pt-lg-4 mt-2 ">              
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
          <th scope="col">Data Públicação</th>
          <th scope="col">Arquivo</th>
          <th scope="col">Tipo</th>
          <th scope="col">Descrição</th>
          <th scope="col">Sessão</th>

        </tr>
      </thead>
      <tbody>
        @foreach ($anexos as $anexo)
        <tr>
          <th scope="row">{{\Carbon\Carbon::parse($anexo->created_at)->format('d/m/Y')}}</th>
          <td> <a href="{{config('app.aws_url')."{$anexo->anexo}" }}"
              target="_blank" class="mb-2 text-reset"
              data-toggle="tooltip" data-placement="top"
              title="Clique para abrir o documento" >
              <i class="bi bi-file-earmark-pdf text-danger fs-4"></i>
              <span class="mr-2"> {{$anexo->nome_original}}</span>
            </a></td>
          <td>{{$anexo->type_document->nome}}</td>
          <td>{{$anexo->descricao}}</td>
          <td>{{$anexo->session->nome}} - {{$anexo->session->legislature->descricao}}</td>
        </tr>
        @endforeach

      </tbody>
    </table>
  </div>
  <div class="card-footer text-muted">
    @if (!empty($filters))
    {!!$anexos->appends($filters)->links()!!}
    @else
    {!!$anexos->links()!!}
    @endif
  </div>
</div>


</section>
@endsection