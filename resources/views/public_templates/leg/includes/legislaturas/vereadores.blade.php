@extends('public_templates.leg.default')

@section('content')
<style>
.vereador-img {
    transition: transform 0.5s ease, filter 0.5s ease, box-shadow 0.5s ease;
}

.position-relative:hover .vereador-img {
    transform: scale(1.08);
    filter: brightness(1.15);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
}

</style>
<div class="row " style="height: 60px; background-color: #f5f5f5">
    <div class="container  ">
        <div class="row mt-4">
            <div class="col-8">
                <p class="fs-1">Vereadores da Legislatura {{ $legislatura->descricao }}</p>
            </div>
            <div class="col-4 fs-4">{{ Breadcrumbs::render('legislatura', $legislatura) }}</div>
             
        </div>
    </div>
</div>
<div class="container py-4">  
   

    <div class="row">
        @forelse($legislatura->vereadores as $vereador)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="position-relative" style="overflow: hidden; height: 280px;">
                        <img
                            src="{{ $vereador->img ? config('app.aws_url') . "{$vereador->img}" : config('app.aws_url') . 'uteis/no-image256.jpg' }}"
                            alt="{{ $vereador->nome }}"
                            class="img-fluid vereador-img"
                            style="width: 100%; height: 280px; object-fit: contain; background-color: #fff"
                        />
                    </div>
    
                    <div class="card-body text-center">
                        <h5 class="card-title">{{   $vereador->nome ?? $vereador->nome_parlamentar }}</h5>
                        <a href="{{ route('camara.vereador', $vereador->id) }}" class="btn btn-primary cor-padrao-bg text-white btn-sm fs-4">
                            Ver detalhes
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning">
                    Nenhum vereador vinculado a esta legislatura.
                </div>
            </div>
        @endforelse
    </div>
    
    <hr class="my-5">

<h3 class="mb-4">Outras Legislaturas</h3>

<div class="row">
    @forelse($outrasLegislaturas as $outra)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm position-relative overflow-hidden">
                <i class="fas fa-scroll position-absolute " style="
                right: 20px;
                bottom:35px;
                font-size: 6rem;
                color: rgb(35, 119, 183);
                z-index: 0;
            "></i>

                <div class="card-body position-relative" style="z-index: 1;">
                    <h5 class="card-title">
                        {{ $outra->descricao }}
                        @if($outra->atual)
                            <span class="badge bg-success ms-2">Atual</span>
                        @endif
                    </h5>

                    <p class="mb-1"><strong>Início:</strong> {{ \Carbon\Carbon::parse($outra->data_inicio)->format('d/m/Y') }}</p>
                    <p class="mb-3"><strong>Fim:</strong> {{ \Carbon\Carbon::parse($outra->data_fim)->format('d/m/Y') }}</p>

                    <a href="{{ route('camara.legislatura.vereadores', $outra->id) }}" class="btn btn-primary cor-padrao-bg text-white btn-sm fs-4">
                        Ver vereadores
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info">
                Nenhuma outra legislatura encontrada.
            </div>
        </div>
    @endforelse
</div>


</div>
<!-- Paginação -->

</div>
</div>


@endsection