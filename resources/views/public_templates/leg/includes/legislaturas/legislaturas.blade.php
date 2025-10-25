@extends('public_templates.leg.default')

@section('content')
<div class="row " style="height: 60px; background-color: #f5f5f5">
    <div class="container  ">
        <div class="row mt-4">
            <div class="col-8">
                <p class="fs-1">Legislaturas</p>
            </div>
            <div class="col-4 fs-4">{{ Breadcrumbs::render('legislaturas') }} </div>
        </div>
    </div>
</div>

<div class="container py-4">
    

    <div class="row">
        @forelse($legislaturas as $legislatura)
            <div class="col-md-4 mb-4">               

                <div class="card shadow-sm h-100 position-relative overflow-hidden">
                    <!-- Ícone como background -->
                    <i class="fas fa-scroll position-absolute " style="
                        right: 20px;
                        bottom:35px;
                        font-size: 6rem;
                        color: rgb(35, 119, 183);
                        z-index: 0;
                    "></i>
                
                    <div class="card-body position-relative" style="z-index: 1;">
                        <h5 class="card-title">
                            {{ $legislatura->descricao }}
                            @if($legislatura->atual)
                                <span class="badge bg-success ms-2">Atual</span>
                            @endif
                        </h5>
                
                        <p class="mb-1"><strong>Início:</strong> {{ \Carbon\Carbon::parse($legislatura->data_inicio)->format('d/m/Y') }}</p>
                        <p class="mb-3"><strong>Fim:</strong> {{ \Carbon\Carbon::parse($legislatura->data_fim)->format('d/m/Y') }}</p>
                
                        <a href="{{ route('camara.legislatura.vereadores', $legislatura->id) }}" 
                           class="btn btn-primary cor-padrao-bg text-white d-inline-flex align-items-center justify-content-center">
                            Ver vereadores
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    Nenhuma legislatura encontrada.
                </div>
            </div>
        @endforelse
    </div>
    
</div>


<!-- Paginação -->




</div>
</div>


@endsection