@extends('public_templates.gov.layouts.app')

@section('title', 'Resultados da Pesquisa - ' . $tenant->nome)
@section('description', 'Resultados da pesquisa por "' . $pesquisar . '" no site de ' . $tenant->nome)

@section('content')
<div class="container section-padding">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('site.index') }}">
                    <i class="fas fa-home"></i> Início
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Resultados da Pesquisa
            </li>
        </ol>
    </nav>

    <!-- Cabeçalho da Pesquisa -->
    <div class="search-header mb-5">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="search-title text-primary-color">
                    <i class="fas fa-search me-3"></i>
                    Resultados da Pesquisa
                </h1>
                <p class="search-subtitle text-muted">
                    @if($resultados->count() > 0)
                        Encontramos {{ $resultados->count() }} resultado(s) para "<strong>{{ $pesquisar }}</strong>"
                    @else
                        Nenhum resultado encontrado para "<strong>{{ $pesquisar }}</strong>"
                    @endif
                </p>
            </div>
            <div class="col-lg-4">
                <!-- Nova Pesquisa -->
                <div class="search-form">
                    <form action="{{ route('site.pesquisar') }}" method="GET">
                        <div class="input-group">
                            <input type="text" 
                                   name="pesquisar" 
                                   class="form-control" 
                                   placeholder="Nova pesquisa..."
                                   value="{{ $pesquisar }}"
                                   required>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Resultados -->
        <div class="col-lg-8">
            @if($resultados->count() > 0)
            <div class="search-results">
                @foreach($resultados as $resultado)
                <div class="result-item mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <!-- Tipo de Conteúdo -->
                            <div class="result-meta mb-2">
                                <span class="badge bg-primary me-2">
                                    {{ $resultado['tabela'] }}
                                </span>
                                @if(isset($resultado['data']))
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ \Carbon\Carbon::parse($resultado['data'])->format('d/m/Y') }}
                                </small>
                                @endif
                            </div>
                            
                            <!-- Título -->
                            <h3 class="result-title h5 mb-3">
                                <a href="{{ $resultado['url'] }}" class="text-decoration-none text-dark">
                                    {{ $resultado['titulo'] ?? $resultado['nome'] ?? 'Sem título' }}
                                </a>
                            </h3>
                            
                            <!-- Conteúdo/Descrição -->
                            @if(isset($resultado['conteudo']) && $resultado['conteudo'])
                            <p class="result-content text-muted">
                                {{ $resultado['conteudo'] }}
                            </p>
                            @elseif(isset($resultado['biografia']) && $resultado['biografia'])
                            <p class="result-content text-muted">
                                {{ $resultado['biografia'] }}
                            </p>
                            @elseif(isset($resultado['descricao']) && $resultado['descricao'])
                            <p class="result-content text-muted">
                                {{ Str::limit($resultado['descricao'], 200) }}
                            </p>
                            @endif
                            
                            <!-- Link -->
                            <div class="result-actions">
                                <a href="{{ $resultado['url'] }}" class="btn btn-outline-primary btn-sm">
                                    Ver detalhes <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <!-- Nenhum Resultado -->
            <div class="no-results text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-search fa-4x text-muted"></i>
                </div>
                <h3 class="h4 text-muted mb-3">Nenhum resultado encontrado</h3>
                <p class="text-muted mb-4">
                    Não encontramos nenhum conteúdo relacionado à sua pesquisa.<br>
                    Tente usar palavras-chave diferentes ou mais específicas.
                </p>
                
                <!-- Sugestões -->
                <div class="search-suggestions">
                    <h5 class="text-primary-color mb-3">Sugestões:</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">• Verifique a ortografia das palavras</li>
                        <li class="mb-2">• Use termos mais gerais</li>
                        <li class="mb-2">• Tente sinônimos das palavras utilizadas</li>
                        <li class="mb-2">• Use menos palavras na pesquisa</li>
                    </ul>
                </div>
                
                <!-- Acesso Rápido -->
                <div class="quick-access mt-4">
                    <h6 class="text-muted mb-3">Ou acesse diretamente:</h6>
                    <div class="d-flex gap-2 justify-content-center flex-wrap">
                        <a href="{{ route('site.noticias.todas') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-newspaper me-1"></i> Notícias
                        </a>
                        <a href="{{ route('site.agenda') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-calendar me-1"></i> Agenda
                        </a>
                        <a href="#" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-gavel me-1"></i> Licitações
                        </a>
                        <a href="#" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-balance-scale me-1"></i> Transparência
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <aside class="search-sidebar">
                <!-- Filtros de Resultado -->
                @if($resultados->count() > 0)
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Filtrar Resultados</h3>
                    <div class="filter-options">
                        @php
                            $tipos = $resultados->groupBy('tabela');
                        @endphp
                        
                        <div class="mb-3">
                            <label class="form-label">Tipo de Conteúdo</label>
                            <div class="filter-checkboxes">
                                @foreach($tipos as $tipo => $items)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $tipo }}" id="filter{{ $tipo }}" checked>
                                    <label class="form-check-label" for="filter{{ $tipo }}">
                                        {{ $tipo }} ({{ $items->count() }})
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <button type="button" class="btn btn-primary btn-sm w-100" onclick="applyFilters()">
                            <i class="fas fa-filter me-2"></i>
                            Aplicar Filtros
                        </button>
                    </div>
                </div>
                @endif

                <!-- Pesquisas Relacionadas -->
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Pesquisas Relacionadas</h3>
                    <div class="related-searches">
                        @php
                            $palavras = explode(' ', $pesquisar);
                            $relacionadas = [];
                            
                            // Gerar algumas sugestões baseadas nas palavras da pesquisa
                            foreach($palavras as $palavra) {
                                if(strlen($palavra) > 3) {
                                    $relacionadas[] = $palavra . ' prefeitura';
                                    $relacionadas[] = $palavra . ' municipal';
                                }
                            }
                            $relacionadas = array_unique(array_slice($relacionadas, 0, 6));
                        @endphp
                        
                        @if(count($relacionadas) > 0)
                        @foreach($relacionadas as $relacionada)
                        <a href="{{ route('site.pesquisar', ['pesquisar' => $relacionada]) }}" 
                           class="btn btn-outline-secondary btn-sm me-2 mb-2">
                            {{ $relacionada }}
                        </a>
                        @endforeach
                        @else
                        <div class="text-muted small">
                            <p>Tente pesquisar por:</p>
                            <a href="{{ route('site.pesquisar', ['pesquisar' => 'notícias']) }}" class="btn btn-outline-secondary btn-sm me-2 mb-2">notícias</a>
                            <a href="{{ route('site.pesquisar', ['pesquisar' => 'agenda']) }}" class="btn btn-outline-secondary btn-sm me-2 mb-2">agenda</a>
                            <a href="{{ route('site.pesquisar', ['pesquisar' => 'licitações']) }}" class="btn btn-outline-secondary btn-sm me-2 mb-2">licitações</a>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Acesso Rápido -->
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Acesso Rápido</h3>
                    <div class="d-grid gap-2">
                        <a href="{{ route('site.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-home me-2"></i> Página Inicial
                        </a>
                        <a href="{{ route('site.noticias.todas') }}" class="btn btn-outline-primary">
                            <i class="fas fa-newspaper me-2"></i> Notícias
                        </a>
                        <a href="{{ route('site.agenda') }}" class="btn btn-outline-primary">
                            <i class="fas fa-calendar me-2"></i> Agenda
                        </a>
                        <a href="#" class="btn btn-outline-primary">
                            <i class="fas fa-gavel me-2"></i> Licitações
                        </a>
                        <a href="#" class="btn btn-outline-primary">
                            <i class="fas fa-balance-scale me-2"></i> Transparência
                        </a>
                    </div>
                </div>

                <!-- Ajuda -->
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Dicas de Pesquisa</h3>
                    <div class="search-tips">
                        <ul class="list-unstyled small text-muted">
                            <li class="mb-2">
                                <i class="fas fa-lightbulb text-warning me-2"></i>
                                Use aspas para pesquisar frases exatas
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-lightbulb text-warning me-2"></i>
                                Combine palavras-chave relacionadas
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-lightbulb text-warning me-2"></i>
                                Use termos específicos para melhores resultados
                            </li>
                            <li class="mb-0">
                                <i class="fas fa-lightbulb text-warning me-2"></i>
                                Evite palavras muito comuns (de, da, para, etc.)
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Contato -->
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Não encontrou?</h3>
                    <p class="small text-muted mb-3">
                        Se não encontrou o que procurava, entre em contato conosco.
                    </p>
                    <div class="contact-info">
                        @if($tenant->telefone)
                        <p class="mb-2">
                            <i class="fas fa-phone text-primary me-2"></i>
                            <a href="tel:{{ $tenant->telefone }}">{{ $tenant->telefone }}</a>
                        </p>
                        @endif
                        
                        @if($tenant->email)
                        <p class="mb-0">
                            <i class="fas fa-envelope text-primary me-2"></i>
                            <a href="mailto:{{ $tenant->email }}">{{ $tenant->email }}</a>
                        </p>
                        @endif
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.search-header {
    padding: 2rem 0;
    background: linear-gradient(135deg, var(--primary-lighter) 0%, var(--bg-secondary) 100%);
    border-radius: var(--border-radius-xl);
    margin-bottom: 2rem;
    padding: 2rem;
}

.search-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.search-subtitle {
    font-size: 1.25rem;
}

.result-item .card {
    transition: var(--transition-normal);
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-sm);
}

.result-item .card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

.result-title a:hover {
    color: var(--primary-color) !important;
}

.result-content {
    line-height: 1.6;
}

.no-results {
    background: var(--bg-secondary);
    border-radius: var(--border-radius-xl);
    padding: 3rem 2rem;
}

.search-suggestions ul {
    text-align: left;
    display: inline-block;
}

.sidebar-widget {
    background: var(--bg-primary);
    border-radius: var(--border-radius-lg);
    padding: 1.5rem;
    margin-bottom: 2rem;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--gray-200);
}

.sidebar-widget-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--primary-color);
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid var(--primary-lighter);
}

.filter-checkboxes .form-check {
    margin-bottom: 0.5rem;
}

.related-searches .btn {
    font-size: 0.875rem;
}

.contact-info a {
    color: var(--text-primary);
    text-decoration: none;
}

.contact-info a:hover {
    color: var(--primary-color);
}

.search-tips ul li {
    padding: 0.5rem 0;
    border-bottom: 1px solid var(--gray-200);
}

.search-tips ul li:last-child {
    border-bottom: none;
}

@media (max-width: 768px) {
    .search-title {
        font-size: 2rem;
    }
    
    .search-subtitle {
        font-size: 1.1rem;
    }
    
    .search-header {
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .quick-access .btn {
        font-size: 0.875rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
function applyFilters() {
    const checkboxes = document.querySelectorAll('.filter-checkboxes input[type="checkbox"]');
    const resultItems = document.querySelectorAll('.result-item');
    
    // Obter tipos selecionados
    const selectedTypes = Array.from(checkboxes)
        .filter(cb => cb.checked)
        .map(cb => cb.value);
    
    // Mostrar/ocultar resultados baseado nos filtros
    resultItems.forEach(item => {
        const badge = item.querySelector('.badge');
        const type = badge ? badge.textContent.trim() : '';
        
        if (selectedTypes.length === 0 || selectedTypes.includes(type)) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
    
    // Atualizar contador de resultados visíveis
    const visibleResults = Array.from(resultItems).filter(item => item.style.display !== 'none').length;
    const subtitle = document.querySelector('.search-subtitle');
    if (subtitle) {
        const searchTerm = '{{ $pesquisar }}';
        subtitle.innerHTML = `Mostrando ${visibleResults} resultado(s) para "<strong>${searchTerm}</strong>"`;
    }
}

// Destacar termos de pesquisa nos resultados
document.addEventListener('DOMContentLoaded', function() {
    const searchTerm = '{{ $pesquisar }}';
    const terms = searchTerm.toLowerCase().split(' ');
    
    // Destacar nos títulos e conteúdos
    const resultContents = document.querySelectorAll('.result-title, .result-content');
    
    resultContents.forEach(element => {
        let html = element.innerHTML;
        
        terms.forEach(term => {
            if (term.length > 2) {
                const regex = new RegExp(`(${term})`, 'gi');
                html = html.replace(regex, '<mark>$1</mark>');
            }
        });
        
        element.innerHTML = html;
    });
});
</script>
@endpush

