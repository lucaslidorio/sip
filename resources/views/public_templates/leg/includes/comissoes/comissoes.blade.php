@extends('public_templates.leg.default')

@section('content')

<div class="container py-4">
    <h2 class="mb-4">Comissões Legislativas</h2>

    <div class="row">
        @foreach($comissoes as $comissao)
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100 position-relative overflow-hidden">
                    <!-- Ícone de fundo -->
                    <i class="fas fa-paste position-absolute" style="
                        right: 20px;
                        bottom: 35px;
                        font-size: 6rem;
                        color: rgb(35, 119, 183);
                        z-index: 0;
                    "></i>
    
                    <div class="card-body position-relative" style="z-index: 1;">
                        <h5 class="card-title fw-bold fs-4 ">{{ $comissao->nome }}</h5>
    
                        @if($comissao->objetivo)
                            <p class="card-text">{{ Str::limit(strip_tags($comissao->objetivo), 120) }}</p>
                        @endif
    
                        <a href="{{ route('camara.comissao.show', $comissao->id) }}" 
                           class="btn btn-primary cor-padrao-bg text-white btn-sm fs-4">
                            Ver detalhes
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
</div>


<!-- Paginação -->




</div>
</div>


@endsection