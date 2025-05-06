@extends('public_templates.leg.default')

@section('content')
<style>
     /* Remove fundo do link no hover e aplica zoom sutil */
.vereador-card {
    transition: transform 0.3s ease;
    background: transparent !important;
}

.vereador-card:hover {
    background: transparent !important;
    text-decoration: none;
}

.vereador-img {
    transition: transform 0.3s ease, filter 0.3s ease;
}

.vereador-card:hover .vereador-img {
    transform: scale(1.03); /* menos agressivo */
    filter: brightness(1.08);
}

.foto-wrapper {
    overflow: hidden;
    border-radius: 50%;
    width: 120px;
    height: 120px;
    margin: 0 auto;
}
    
    </style>
<div class="container py-4">
    <h2 class="mb-4">Comissões Legislativas</h2>
    <div class="card mb-4 shadow">
    <div class="card-header cor-padrao-bg text-white">
        <h3 class="mb-0 mt-2">
            {{ $comissao->nome }}
        </h3>
        @if($comissao->tipo)
            <h5>Tipo: {{ $comissao->tipo_texto }}</h5> {{-- Personalize isso se quiser traduzir o tipo --}}
        @endif
    </div>

    <div class="card-body">
        @if($comissao->objetivo)
            <p class="fs-4"><strong>Objetivo:</strong><br> {!! nl2br(e($comissao->objetivo)) !!}</p>
        @endif

        <h4 class="mt-3 fw-bold">Membros:</h4>

        <div class="d-flex flex-nowrap overflow-auto pb-2">
            @forelse($comissao->membros as $membro)
                @php
                    $img = $membro->vereador->img ?? 'uteis/no-image256.jpg';
                    $isPresidente = strtolower($membro->funcao->nome) === 'presidente';
                @endphp

                <a href="{{ route('camara.vereador', $membro->vereador->id) }}"
                   class="vereador-card text-decoration-none text-dark me-3">
                    <div class="text-center" style="min-width: 140px;">
                        <div class="foto-wrapper mb-2">
                            <img src="{{ config('app.aws_url') . $img }}"
                                 alt="Foto de {{ $membro->vereador->nome }}"
                                 loading="lazy"
                                 class="img-fluid rounded-circle vereador-img"
                                 style="
                                    width: 120px;
                                    height: 120px;
                                    object-fit: contain;
                                    border: 4px solid {{ $isPresidente ? '#FFD700' : '#dee2e6' }};
                                 "
                            >
                        </div>
                        <div>
                            <strong>{{ $membro->funcao->nome ?? '-' }}</strong><br>
                            <p>{{ $membro->vereador->nome_parlamentar ?? $membro->vereador->nome }}</p>
                        </div>
                    </div>
                </a>
            @empty
                <div class="alert alert-warning mt-2">Nenhum membro cadastrado.</div>
            @endforelse
        </div>

        <h4 class="mt-5 fw-bold">Matérias analisadas:</h4>

@if($materias->count())
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>Data</th>
                    <th>Assunto</th>
                    <th>Descrição</th>
                    <th class="text-center">Ver</th>
                </tr>
            </thead>
            <tbody>
                @foreach($materias as $item)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($item->data)->format('d/m/Y') }}</td>
                        <td>{{ $item->assunto }}</td>
                        <td>{{ Str::limit(strip_tags($item->descricao), 100) }}</td>
                        <td class="text-center">
                            <a href="{{ route('camara.propositura.show', $item->proposition_id) }}"
                               class="btn btn-primary cor-padrao-bg text-white btn-sm fs-4">
                               Detalhes
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $materias->links() }}
    </div>
@else
    <div class="alert alert-secondary">Nenhuma proposição vinculada à comissão.</div>
@endif

    </div>
</div>


</div>

@endsection