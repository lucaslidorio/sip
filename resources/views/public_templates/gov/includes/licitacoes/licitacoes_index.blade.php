{{-- Página de Licitações/Processos de Compras --}}
@extends('public_templates.gov.layouts.app')

@section('title', 'Licitações e Processos de Compras')

@section('content')
<div class="container section-padding">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            {{ Breadcrumbs::render('processo_compras') }}
        </ol>
    </nav>
    <div class="row">
        {{-- Conteúdo Principal (Col-lg-8) --}}
        <div class="col-lg-8">
            {{-- Cabeçalho da Página --}}
            <div class="page-header mb-4">
                 
                <h1 class="page-title">
                    <i class="fas fa-gavel me-3"></i>
                    Processos de Compras
                </h1>
                <p class="page-subtitle text-muted">
                    Transparência nos processos compras e credênciamentos públicas
                </p>
            </div>

            {{-- Estatísticas --}}
            <div class="stats-summary mb-4">
                <div class="row">
                    <div class="col-6 col-md-4">
                        <div class="stat-card">
                            <div class="stat-card-inner">
                                <div class="stat-icon">
                                    <i class="fas fa-file-contract"></i>
                                </div>
                                <div class="stat-data">
                                    <span class="stat-number">{{ $totalProcessos ?? 0 }}</span>
                                    <span class="stat-label">Total</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="stat-card">
                            <div class="stat-card-inner">
                                <div class="stat-icon">
                                    <i class="fas fa-hourglass-half"></i>
                                </div>
                                <div class="stat-data">
                                    <span class="stat-number">{{ $processosAtivos ?? 0 }}</span>
                                    <span class="stat-label">recebendo proposta</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="stat-card">
                            <div class="stat-card-inner">
                                <div class="stat-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="stat-data">
                                    <span class="stat-number">{{ $processosHomologados ?? 0 }}</span>
                                    <span class="stat-label">Homologado</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Filtros de Busca --}}
            <div class="filters-section mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-filter me-2"></i>
                            Filtros de Busca
                        </h5>
                    </div>
                    <div class="card-body">
                        <form id="filtrosForm" method="GET" action="{{ route('site.compras.index') }}">
                            <div class="row g-3">
                                {{-- Busca Textual --}}
                                <div class="col-md-12">
                                    <label for="busca" class="form-label">Buscar por objeto ou descrição</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-search"></i>
                                        </span>
                                        <input type="text" 
                                               class="form-control" 
                                               id="busca" 
                                               name="busca" 
                                               value="{{ request('busca') }}"
                                               placeholder="Digite o objeto ou descrição...">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search me-1"></i> Buscar
                                        </button>
                                    </div>
                                </div>

                                {{-- Modalidade --}}
                                <div class="col-md-4">
                                    <label for="modalidade" class="form-label">Modalidade</label>
                                    <select class="form-select" id="modalidade" name="modalidade">
                                        <option value="">Todas</option>
                                        @if(isset($modalidades))
                                            @foreach($modalidades as $modalidade)
                                            <option value="{{ $modalidade->id }}" 
                                                    {{ request('modalidade') == $modalidade->id ? 'selected' : '' }}>
                                                {{ $modalidade->nome }}
                                            </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                {{-- Critério de Julgamento --}}
                                <div class="col-md-4">
                                    <label for="criterio_julgamento" class="form-label">Julgamento</label>
                                    <select class="form-select" id="criterio_julgamento" name="criterio_julgamento">
                                        <option value="">Todos</option>
                                        @if(isset($criteriosJulgamento))
                                            @foreach($criteriosJulgamento as $criterio)
                                            <option value="{{ $criterio->id }}" 
                                                    {{ request('criterio_julgamento') == $criterio->id ? 'selected' : '' }}>
                                                {{ $criterio->nome }}
                                            </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                {{-- Situação --}}
                                <div class="col-md-4">
                                    <label for="situacao" class="form-label">Situação</label>
                                    <select class="form-select" id="situacao" name="situacao">
                                        <option value="">Todas</option>
                                        @if(isset($situacoes))
                                            @foreach($situacoes as $situacao)
                                            <option value="{{ $situacao->id }}" 
                                                    {{ request('situacao') == $situacao->id ? 'selected' : '' }}>
                                                {{ $situacao->nome }}
                                            </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            {{-- Filtros Avançados (Colapsável) --}}
                            {{-- <div class="row mt-3">
                                <div class="col-12">
                                    <button class="btn btn-link p-0 text-decoration-none" 
                                            type="button" 
                                            data-bs-toggle="collapse" 
                                            data-bs-target="#filtrosAvancados">
                                        <i class="fas fa-chevron-down me-1"></i>
                                        Filtros Avançados
                                    </button>
                                </div>
                            </div>

                            <div class="collapse mt-3" id="filtrosAvancados">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="data_inicio" class="form-label">Data Início</label>
                                        <input type="date" 
                                               class="form-control" 
                                               id="data_inicio" 
                                               name="data_inicio" 
                                               value="{{ request('data_inicio') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="data_fim" class="form-label">Data Fim</label>
                                        <input type="date" 
                                               class="form-control" 
                                               id="data_fim" 
                                               name="data_fim" 
                                               value="{{ request('data_fim') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="valor_min" class="form-label">Valor Mínimo</label>
                                        <div class="input-group">
                                            <span class="input-group-text">R$</span>
                                            <input type="number" 
                                                   class="form-control" 
                                                   id="valor_min" 
                                                   name="valor_min" 
                                                   value="{{ request('valor_min') }}"
                                                   step="0.01"
                                                   placeholder="0,00">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="valor_max" class="form-label">Valor Máximo</label>
                                        <div class="input-group">
                                            <span class="input-group-text">R$</span>
                                            <input type="number" 
                                                   class="form-control" 
                                                   id="valor_max" 
                                                   name="valor_max" 
                                                   value="{{ request('valor_max') }}"
                                                   step="0.01"
                                                   placeholder="0,00">
                                        </div>
                                    </div>
                                </div>
                            </div>
                             --}}
                            <div class="mt-3">
                                <a href="{{ route('site.compras.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-1"></i> Limpar Filtros
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Resultados --}}
            <div class="results-section">
                @if(isset($processos) && $processos->count() > 0)
                    {{-- Informações dos Resultados --}}
                    <div class="results-info mb-3">
                        <p class="text-muted mb-0">
                            Exibindo {{ $processos->firstItem() }} a {{ $processos->lastItem() }} 
                            de {{ $processos->total() }} processos
                        </p>
                    </div>

                    {{-- Lista de Processos --}}
                    <div class="processos-lista">
                        @foreach($processos as $processo)
                        <div class="processo-item mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title mb-0">
                                            <a href="{{ route('site.compras.show', $processo->id) }}" 
                                               class="text-decoration-none">
                                                {{ $processo->objeto }}
                                            </a>
                                        </h5>
                                        <div class="processo-numero">
                                            <span class="badge bg-light text-dark">
                                                Nº {{ $processo->numero }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <span class="badge bg-primary me-2">
                                            {{ $processo->modalidade->nome ?? 'N/A' }}
                                        </span>
                                        <span class="badge bg-{{ $processo->situacao_cor }}">
                                            {{ $processo->situacao->nome ?? 'N/A' }}
                                        </span>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <p class="mb-1">
                                                <i class="fas fa-calendar-alt text-muted me-2"></i>
                                                <span class="fw-semibold">Data de Publicação:</span>
                                                {{ $processo->data_publicacao ? $processo->data_publicacao->format('d/m/Y H:i') : 'N/A' }}
                                            </p>
                                            <p class="mb-1">
                                                <i class="fas fa-gavel text-muted me-2"></i>
                                                <span class="fw-semibold">Julgamento:</span>
                                                {{ $processo->criterio_julgamento->nome ?? 'N/A' }}
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-1">
                                                <i class="fas fa-calendar-alt text-muted me-2"></i>
                                                <span class="fw-semibold">Válido Até:</span>                                              
                                                    {{ $processo->data_validade ? $processo->data_validade->format('d/m/Y H:i') : 'N/A' }}
                                                </span>
                                            </p>
                                            <p class="mb-1">
                                                <i class="fas fa-users text-muted me-2"></i>
                                                <span class="fw-semibold">Credenciados:</span>
                                                {{ $processo->countCredenciadosValidos() }} empresa(s)
                                            </p>
                                        </div>
                                    </div>

                                    @if($processo->descricao)
                                    <p class="text-muted mb-3 border-top pt-2">
                                        {{ Str::limit($processo->descricao, 150) }}
                                    </p>
                                    @endif
                                    
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            @if($processo->anexos->count() > 0)
                                            <span class="text-muted">
                                                <i class="fas fa-paperclip me-1"></i>
                                                {{ $processo->anexos->count() }} anexo(s)
                                            </span>
                                            @endif
                                        </div>
                                        <div>
                                            <a href="{{ route('site.compras.show', $processo->id) }}" 
                                               class="btn btn-primary btn-sm">
                                                <i class="fas fa-eye me-1"></i>
                                                Ver Detalhes
                                            </a>
                                            @if($processo->anexos->count() > 0)
                                            <button class="btn btn-outline-secondary btn-sm" 
                                                    onclick="toggleAnexos({{ $processo->id }})">
                                                <i class="fas fa-download me-1"></i>
                                                Anexos
                                            </button>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    {{-- Anexos (Colapsável) --}}
                                    @if($processo->anexos->count() > 0)
                                    <div class="collapse mt-3" id="anexos-{{ $processo->id }}">
                                        <div class="anexos-list border-top pt-3">
                                            <h6 class="mb-2">Documentos Disponíveis:</h6>
                                            <div class="row g-2">
                                                @foreach($processo->anexos as $anexo)
                                                <div class="col-md-6">
                                                    <a href="{{config('app.aws_url')."{$anexo->anexo}" }}" 
                                                       target="_blank" 
                                                       class="anexo-item d-flex align-items-center p-2 border rounded text-decoration-none">
                                                        <i class="fas fa-file-pdf text-danger me-2"></i>
                                                        <div class="flex-grow-1 text-truncate">
                                                            <div class="anexo-nome">{{ $anexo->nome }}</div>
                                                            <small class="text-muted">
                                                                {{ $anexo->tamanho_formatado ?? '' }}
                                                            </small>
                                                        </div>
                                                        <i class="fas fa-external-link-alt text-muted ms-2"></i>
                                                    </a>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- Paginação --}}
                    <div class="pagination-wrapper mt-4 d-flex justify-content-center">
                        {{ $processos->appends(request()->query())->links() }}
                    </div>

                @else
                    {{-- Estado Vazio --}}
                    <div class="empty-state text-center py-5">
                        <div class="empty-icon mb-3">
                            <i class="fas fa-search fa-3x text-muted"></i>
                        </div>
                        <h4>Nenhum processo encontrado</h4>
                        <p class="text-muted">
                            Não foram encontrados processos com os filtros aplicados.<br>
                            Tente ajustar os critérios de busca.
                        </p>
                        <a href="{{ route('site.compras.index') }}" class="btn btn-primary">
                            <i class="fas fa-refresh me-1"></i>
                            Ver Todos os Processos
                        </a>
                    </div>
                @endif
            </div>
        </div>

        {{-- Sidebar (Col-lg-4) --}}
        <div class="col-lg-4">
            <aside class="sidebar">
            
               <!-- Acesso Rápido -->
                @include('public_templates.gov.includes.acesso-rapido')

                <!-- Contato -->
                @include('public_templates.gov.includes.contato-lateral')
                <!--  Links Úteis Lateral -->
                @include('public_templates.gov.includes.links-uteis-lateral')


                

        
                
                {{-- Widget - Compartilhar --}}
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">
                        <i class="fas fa-share-alt me-2"></i>
                        Compartilhar
                    </h3>
                    <div class="share-buttons">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="btn btn-outline-primary btn-sm mb-2">
                            <i class="fab fa-facebook-f me-1"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode('Licitações e Processos de Compras - '.$tenant->nome) }}" target="_blank" class="btn btn-outline-info btn-sm mb-2">
                            <i class="fab fa-twitter me-1"></i> Twitter
                        </a>
                        <a href="https://wa.me/?text={{ urlencode('Licitações e Processos de Compras - '.$tenant->nome.': '.request()->fullUrl()) }}" target="_blank" class="btn btn-outline-success btn-sm mb-2">
                            <i class="fab fa-whatsapp me-1"></i> WhatsApp
                        </a>
                        <button type="button" 
                                class="btn btn-outline-secondary btn-sm mb-2" 
                                onclick="copyToClipboard(event, '{{ request()->fullUrl() }}')">
                            <i class="fas fa-link me-1"></i> Copiar Link
                        </button>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>

{{-- CSS Específico --}}
@push('styles')
<style>
/* Estilos Sidebar */
.sidebar-widget {
    margin-bottom: 2rem;
    background: #fff;
    border-radius: var(--border-radius-lg, 0.5rem);
    padding: 1.5rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.sidebar-widget-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid var(--primary-color, #0d6efd);
    color: var(--text-primary, #333);
}

/* Estatísticas */
.stats-summary {
    margin-bottom: 1.5rem;
}

.stat-card {
    background: #fff;
    border-radius: var(--border-radius-md, 0.5rem);
    padding: 1rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    height: 100%;
}

.stat-card-inner {
    display: flex;
    align-items: center;
}

.stat-icon {
    background: var(--primary-color, #0d6efd);
    color: white;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    margin-right: 1rem;
}

.stat-data {
    flex-grow: 1;
}

.stat-number {
    display: block;
    font-size: 1.5rem;
    font-weight: 700;
    line-height: 1.2;
}

.stat-label {
    display: block;
    font-size: 0.9rem;
    color: var(--text-secondary, #6c757d);
}

/* Processos Lista */
.processo-item {
    transition: all 0.3s ease;
}

.processo-item:hover {
    transform: translateY(-3px);
}

.processo-item .card {
    border: none;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    border-radius: var(--border-radius-lg, 0.5rem);
}

.processo-item:hover .card {
    box-shadow: 0 8px 16px rgba(0,0,0,0.1);
}

.processo-numero .badge {
    font-size: 0.85rem;
    padding: 0.5em 0.8em;
}

/* Botões de Compartilhamento */
.btn-facebook {
    background-color: #1877f2;
    color: white;
}

.btn-twitter {
    background-color: #1da1f2;
    color: white;
}

.btn-whatsapp {
    background-color: #25d366;
    color: white;
}

.btn-facebook:hover, .btn-twitter:hover, .btn-whatsapp:hover {
    color: white;
    opacity: 0.9;
}

.share-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.share-buttons .btn {
    flex: 1 0 calc(50% - 0.5rem);
}

/* Anexos */
.anexo-item {
    transition: all 0.2s ease;
}

.anexo-item:hover {
    background-color: var(--gray-100, #f8f9fa);
    border-color: var(--primary-color, #0d6efd) !important;
}

/* Contato */
.contact-info p {
    margin-bottom: 0.75rem;
}

.contact-info a {
    color: var(--primary-color, #0d6efd);
    text-decoration: none;
}

.contact-info a:hover {
    text-decoration: underline;
}

/* Lista */
.list-group-item {
    border-radius: var(--border-radius-md, 0.25rem) !important;
    margin-bottom: 0.25rem;
    border: 1px solid var(--gray-200, #e9ecef);
    transition: all 0.2s ease;
}

.list-group-item:hover {
    background-color: var(--gray-100, #f8f9fa);
    border-color: var(--primary-color, #0d6efd);
}

/* Responsividade */
@media (max-width: 992px) {
    .sidebar {
        margin-top: 2rem;
    }
}
</style>
@endpush

{{-- JavaScript --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle de anexos
    window.toggleAnexos = function(processoId) {
        const anexosDiv = document.getElementById('anexos-' + processoId);
        const collapse = new bootstrap.Collapse(anexosDiv);
        collapse.toggle();
    };
    
    // Auto-submit do formulário de filtros
    const selectElements = document.querySelectorAll('#modalidade, #criterio_julgamento, #situacao');
    
    selectElements.forEach(select => {
        select.addEventListener('change', function() {
            document.getElementById('filtrosForm').submit();
        });
    });
    
    // Animação de entrada dos itens
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

    document.querySelectorAll('.processo-item').forEach(item => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(20px)';
        item.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        observer.observe(item);
    });
});
</script>
@endpush
@endsection

