@extends('public_templates.gov.layouts.app')

@section('title', 'Secretarias - ' . $tenant->nome)
@section('description', 'Conheça as secretarias municipais de ' . $tenant->nome . ' e seus serviços')

@section('content')
<div class="container section-padding">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            {{ Breadcrumbs::render('secretarias') }}
        </ol>
    </nav>

    <!-- Cabeçalho da Página -->
    <div class="page-header text-center mb-5">
        <h1 class="page-title text-primary-color">
            <i class="fas fa-building me-3"></i>
            Secretarias Municipais
        </h1>
        <p class="page-subtitle text-muted">
            Conheça as secretarias que compõem a estrutura administrativa municipal e os serviços oferecidos
        </p>
    </div>

    <!-- Filtros -->
    <div class="filters-section mb-5">
        <div class="card">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-10">
                        <label for="searchSecretaria" class="form-label">Buscar secretaria (nome, sigla ou slogan)</label>
                        <input type="text" 
                               class="form-control" 
                               id="searchSecretaria" 
                               placeholder="Digite o nome, sigla ou slogan da secretaria..."
                               onkeyup="filterSecretarias()">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-outline-secondary w-100" onclick="clearFilters()">
                            <i class="fas fa-times me-1"></i> Limpar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grid de Secretarias -->
    <div class="secretarias-grid" id="secretariasGrid">
        @foreach($secretarias as $secretaria)
            <div class="secretaria-card"
                 data-nome="{{ \Illuminate\Support\Str::lower($secretaria->nome) }}"
                 data-sigla="{{ \Illuminate\Support\Str::lower($secretaria->sigla) }}"

                 data-area="{{ \Illuminate\Support\Str::slug($secretaria->sigla ?? $secretaria->nome) }}">
                <div class="card h-100">
                    <div class="card-header text-white" style="background: {{ $secretaria->cor_destaque ?? 'var(--primary-color)' }}">
                        <div class="d-flex align-items-center">
                            <div class="secretaria-icon me-3">
                                <i class="{{ $secretaria->icone ?: 'fas fa-building' }}"></i>
                            </div>
                            <div>
                                <h3 class="h5 mb-0">{{ $secretaria->nome }}</h3>
                                @if(!empty($secretaria->slogan) || !empty($secretaria->sigla))
                                    <small>{{ $secretaria->slogan ?? $secretaria->sigla }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(!empty($secretaria->sobre))
                            <p class="card-text">
                                {!! $secretaria->sobre !!}
                            </p>
                        @endif
                        @if($secretaria->telefone || $secretaria->email || $secretaria->endereco)
                            <h6 class="text-primary-color">Contato</h6>
                            <div class="contact-info">
                                @if($secretaria->telefone || $secretaria->celular)
                                    <p class="mb-1"><i class="fas fa-phone me-2"></i> {{ $secretaria->telefone }} - {{ $secretaria->celular }}</p>
                                @endif
                                @if($secretaria->email)
                                    <p class="mb-1"><i class="fas fa-envelope me-2"></i> {{ $secretaria->email }}</p>
                                @endif
                                @if($secretaria->endereco)
                                    <p class="mb-0"><i class="fas fa-map-marker-alt me-2"></i> {{ $secretaria->endereco }}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                    <div class="card-footer">
                        <div class="mt-3">
                            <a href="{{ route('site.secretarias.show', $secretaria->sigla) }}" class="btn btn-outline-primary btn-sm me-2">
                                <i class="fas fa-info-circle me-1"></i> Mais Detalhes
                            </a>
                            @if($secretaria->email)
                            <a href="mailto:{{ $secretaria->email }}" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-envelope me-1"></i> Contato
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Nenhum resultado -->
    <div id="noResults" class="no-results text-center py-5" style="display: none;">
        <div class="mb-4">
            <i class="fas fa-search fa-3x text-muted"></i>
        </div>
        <h3 class="h4 text-muted">Nenhuma secretaria encontrada</h3>
        <p class="text-muted">
            Tente ajustar os filtros ou fazer uma nova busca.
        </p>
        <button type="button" class="btn btn-primary" onclick="clearFilters()">
            Ver todas as secretarias
        </button>
    </div>

    <!-- Informações Gerais -->
    <div class="info-section mt-5">
        <div class="card">
            <div class="card-body">
                <h3 class="h4 text-primary-color mb-3">
                    <i class="fas fa-info-circle me-2"></i>
                    Informações Gerais
                </h3>
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="h6 text-primary-color">Horário de Funcionamento</h5>
                        <p class="mb-3">
                            <i class="fas fa-clock me-2"></i>
                            {{$tenant->dia_atendimento}}<br>
                            
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="h6 text-primary-color">Atendimento ao Público</h5>
                        <p class="mb-3">
                            <i class="fas fa-location-arrow me-2"></i>
                            {{ $tenant->endereco ?? 'Endereço não informado' }}
                            {{ $tenant->numero ?? ' ' }}
                            {{ $tenant->bairro ?? ' ' }}
                            {{ $tenant->cidade ?? ' ' }}
                        <br>
                            <i class="fas fa-phone me-2"></i>
                            Central de Atendimento: {{$tenant->telefone}}<br>
                        </p>
                    </div>
                </div>
                <div class="alert alert-info">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <strong>Importante:</strong> Para alguns serviços é necessário agendamento prévio. 
                    Entre em contato com a secretaria responsável para mais informações.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.page-header {
    padding: 2rem 0;
}

.page-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.page-subtitle {
    font-size: 1.25rem;
    max-width: 700px;
    margin: 0 auto;
}

.secretarias-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 2rem;
    margin-bottom: 2rem;
}

.secretaria-card .card {
    transition: var(--transition-normal);
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-sm);
}

.secretaria-card .card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.secretaria-icon {
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.services-list {
    list-style: none;
    padding-left: 0;
    margin-bottom: 1rem;
}

.services-list li {
    padding: 0.25rem 0;
    position: relative;
    padding-left: 1.5rem;
}

.services-list li:before {
    content: "•";
    color: var(--primary-color);
    font-weight: bold;
    position: absolute;
    left: 0;
}

.contact-info {
    font-size: 0.9rem;
    line-height: 1.4;
}

.contact-info p {
    margin-bottom: 0.5rem;
}

.filters-section .card {
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-sm);
}

.no-results {
    background: var(--bg-secondary);
    border-radius: var(--border-radius-xl);
    padding: 3rem 2rem;
}

.info-section .card {
    background: var(--primary-lighter);
    border: 1px solid var(--primary-color);
}

@media (max-width: 768px) {
    .page-title {
        font-size: 2rem;
    }
    
    .page-subtitle {
        font-size: 1.1rem;
    }
    
    .secretarias-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .secretaria-icon {
        width: 40px;
        height: 40px;
        font-size: 1.25rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
function filterSecretarias() {
    const searchTerm = (document.getElementById('searchSecretaria').value || '').toLowerCase().trim();
    const cards = document.querySelectorAll('.secretaria-card');
    let visibleCount = 0;

    cards.forEach(card => {
        const nome = card.dataset.nome || '';
        const sigla = card.dataset.sigla || '';
        const slogan = card.dataset.slogan || '';
        const bodyText = card.querySelector('.card-text')?.textContent?.toLowerCase() || '';

        const matchesSearch =
            !searchTerm ||
            nome.includes(searchTerm) ||
            sigla.includes(searchTerm) ||
            slogan.includes(searchTerm) ||
            bodyText.includes(searchTerm);

        if (matchesSearch) {
            card.style.display = 'block';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });

    const noResults = document.getElementById('noResults');
    noResults.style.display = visibleCount === 0 ? 'block' : 'none';
}

function clearFilters() {
    document.getElementById('searchSecretaria').value = '';
    filterSecretarias();
}

// Animação de entrada dos cards
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.secretaria-card');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
            }
        });
    });

    cards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });
});
</script>
@endpush

