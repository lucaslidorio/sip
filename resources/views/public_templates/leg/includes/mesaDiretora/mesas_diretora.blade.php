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
<div class="row" style="height: 60px; background-color: #f5f5f5">
    <div class="container ">
        <div class="row mt-4">
            <div class="col-8">
                <p class="fs-1">Mesas Diretoras</p>
            </div>
            <div class="col-4 fs-4">{{Breadcrumbs::render('mesas_diretora')}}</div>
        </div>
    </div>
</div>
<div class="container py-4">    
    
    @forelse($mesas as $mesa)
    <div class="card mb-4 shadow ">
        <div class="card-header cor-padrao-bg text-white {{ !$mesa->atual ? 'bg-secondary text-white' : '' }}">
            <h3 class="mb-0 mt-2">
                {{ $mesa->nome }}
                @if($mesa->atual)
                <span class="badge bg-success ms-2">Atual</span>
                @endif
            </h3>
            <small>{{ $mesa->bienio->descricao }} |
                {{ \Carbon\Carbon::parse($mesa->bienio->data_inicio)->format('d/m/Y') }} a
                {{ \Carbon\Carbon::parse($mesa->bienio->data_fim)->format('d/m/Y') }}
            </small>
        </div>
        <div class="card-body">
            <p class="fs-4"><strong>Objetivo:</strong><br> {!! nl2br(e($mesa->objetivo)) !!}</p>

            <h4 class="mt-3 fw-bold">Membros:</h4>

            <!-- Wrapper para scroll horizontal em mobile -->
            <div class="d-flex flex-nowrap overflow-auto pb-2">
                @foreach($mesa->membros as $membro)
                @php
                $img = $membro->vereador->img ?? 'uteis/no-image256.jpg';
                $isPresidente = strtolower($membro->funcao->nome) === 'presidente';
                @endphp

                <a href="{{ route('camara.vereador', $membro->vereador->id) }}"
                    class="vereador-card text-decoration-none text-dark me-3">
                    <div class="text-center" style="min-width: 140px;">
                        <div class="foto-wrapper mb-2">
                            <img src="{{ config('app.aws_url') . $membro->vereador->img }}"
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
                            <small>{{  $membro->vereador->nome ?? $membro->vereador->nome_parlamentar  }}</small>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

        </div>
    </div>
    @empty
    <div class="alert alert-info">Nenhuma mesa diretora cadastrada.</div>
    @endforelse
</div>


<!-- Paginação -->




</div>
</div>


@endsection