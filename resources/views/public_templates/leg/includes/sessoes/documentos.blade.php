@extends('public_templates.leg.default')

@section('content')
<div class="row" style="height: 60px; background-color: #f5f5f5">
    <div class="container ">
        <div class="row mt-4">
            <div class="col-8">
                <p class="fs-1">Documentos das Sessões</p>
            </div>
            <div class="col-4 fs-4">{{Breadcrumbs::render('documentos_sessoes')}}</div>
        </div>
    </div>
  </div>
<div class="container">
    
    <h5>Aqui você encontra, atas, ordem do dia, editais de convocação, matérias deliberadas e outros documentos pertinente a sessões.</h5>
   
    <div class="card mb-3" >
        <div class="card-header cor-padrao-bg" >
            <h5 class="card-title text-white fs-3">PESQUISE EM DOCUMENTOS DAS SESSÕES</h5>           
        </div>
        <div class="card-body"> 
    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="tipo_id" class="form-label">Tipo de Documento</label>
            <div class="input-group input-group-lg">
            <select name="tipo_id" id="tipo_id" class="form-select "  style="font-size: 1.5rem !important;">
                <option value="">Todos</option>
                @foreach($tipos as $tipo)
                    <option value="{{ $tipo->id }}" {{ $tipoSelecionado == $tipo->id ? 'selected' : '' }}>
                        {{ $tipo->nome }}
                    </option>
                @endforeach
            </select>
            </div>
        </div>

        <div class="col-md-3">
            <label for="data_inicio" class="form-label">Data Início</label>
            <div class="input-group input-group-lg">  
            <input type="date" name="data_inicio" id="data_inicio" value="{{ $dataInicio }}" class="form-control"  style="font-size: 1.5rem !important;">
            </div>
        </div>

        <div class="col-md-3">
            <label for="data_fim" class="form-label">Data Fim</label>
            <div class="input-group input-group-lg">  
            <input type="date" name="data_fim" id="data_fim" value="{{ $dataFim }}" class="form-control" style="font-size: 1.5rem !important;">
            </div>
        </div>

        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-lg btn-primary  cor-padrao-bg text-white mt-3 fs-3" style="font-size: 1.5rem !important;">Pesquisar</button>
        </div>
    </form>
        </div>
    </div>

    @if($documentos->count())
        <div class="table-responsive">
            <table class="table table-bordered table-hover fs-5">
                <thead class="table-light">
                    <tr class="fs-5">
                        <th>Data</th>
                        <th>Tipo</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th class="text-center">Ação</th>
                    </tr>
                </thead>
                <tbody class="fs-5">
                    @foreach($documentos as $doc)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($doc->created_at)->format('d/m/Y') }}</td>
                            <td>{{ $doc->type->nome ?? '-' }}</td>
                            <td>{{ $doc->nome_original ?? '-' }}</td>
                            <td>{{ $doc->descricao ?? '-' }}</td>
                            <td class="text-center">
                                <a href="{{ config('app.aws_url') . $doc->anexo }}" target="_blank"
                                   class="btn btn-lg btn-primary cor-padrao-bg text-white"
                                   style="font-size: 1.5rem !important; padding: 0.75rem 1.5rem !important;">
                                    Abrir
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $documentos->appends(request()->query())->links() }}
    @else
        <div class="alert alert-warning">Nenhum documento encontrado com os filtros aplicados.</div>
    @endif

</div> 


@endsection