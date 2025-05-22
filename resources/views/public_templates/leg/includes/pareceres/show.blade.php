@extends('public_templates.leg.default')
<style>
    .text-justify {
        text-align: justify;
        text-justify: inter-word;
    }
</style>
@section('content')
<div class="row border-top" style="height: 60px; background-color: #f5f5f5">
    <div class="container">
        <div class="row mt-4">
            <div class="col-8">
                <p class="fs-1">Parecer sobre: <strong> {{ $parecer->proposition->tipo->nome ?? '-' }} Nº {{
                        $parecer->proposition->numero ?? '' }}</strong></p>
            </div>
            <div class="col-4 fs-4">{{ Breadcrumbs::render('parecer', $parecer) }}</div>
        </div>
    </div>
</div>

<div class="container my-5">
    <!-- Formulário de Filtro -->
    @include('public_templates.leg.includes.pareceres.form_pesquisa')

    <div class="card shadow-sm">
        <div class="card-body fs-4">
            <h4 class="card-title mb-3 fw-bold ">{{ $parecer->assunto }}</h4>
            <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($parecer->data)->format('d/m/Y') }}</p>
            <p><strong>Comissão Responsável:</strong> {{ $parecer->commission->nome ?? '-' }}</p>
            <p><strong>Propositura Relacionada:</strong>
                @if($parecer->proposition)
                <a href="{{ route('camara.propositura.show', $parecer->proposition_id) }}">
                    {{ $parecer->proposition->tipo->nome ?? 'Propositura' }} {{ $parecer->proposition->numero ?? '' }}
                </a>
                @else
                -
                @endif
            </p>
            <hr>
            <h4 class="fs-4 text-uppercase fw-bold">Descrição do Parecer</h4>
            <div class="mt-3 ">
                <p class="text-justify">
                    {{$parecer->descricao}}
                </p>
            </div>
        </div>
        <!-- Anexos -->
        <div class="card mb-4">
            <div class="card-header cor-padrao-bg text-white">
                <h5 class="mb-0">Anexos</h5>
            </div>
            <ul class="list-group list-group-flush">
                @forelse ($parecer->attachments as $anexo)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>
                        <strong>{{ $anexo->type_document->nome ?? '-' }}</strong> - {{ $anexo->descricao ??
                        $anexo->nome_original }}
                    </span>
                    <a href="{{config('app.aws_url')."{$anexo->anexo}" }}" target="_blank" class="btn btn-lg
                        btn-outline-primary">Visualizar</a>
                </li>
                @empty
                <li class="list-group-item text-muted">Nenhum anexo disponível.</li>
                @endforelse
            </ul>
        </div>
        <div class="card-footer">
            <a href="{{ route('camara.pareceres') }}" class="btn btn-primary cor-padrao-bg text-white btn-sm fs-4">
                <i class="fas fa-arrow-left"></i> Voltar para a lista
            </a>
        </div>
    </div>

</div>
@endsection