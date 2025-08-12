@extends('public_templates.gov.layouts.app')

@section('title', 'Decretos e Portarias - ' . $tenant->nome)
@section('description', 'Consulte decretos, portarias e atos normativos de ' . $tenant->nome)

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
                Decretos e Portarias
            </li>
        </ol>
    </nav>

    <!-- Cabeçalho da Página -->
    <div class="page-header text-center mb-5">
        <h1 class="page-title text-primary-color">
            <i class="fas fa-file-alt me-3"></i>
            Decretos e Portarias
        </h1>
        <p class="page-subtitle text-muted">
            Consulte a legislação municipal, decretos, portarias e atos normativos publicados
        </p>
    </div>

    <div class="row">
        <!-- Conteúdo Principal -->
        <div class="col-lg-8">
            <!-- Filtros -->
            <div class="filters-section mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-filter me-2"></i>
                            Filtros de Pesquisa
                        </h5>
                    </div>
                    <div class="card-body">
                        <form id="filterForm">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="searchTerm" class="form-label">Buscar por palavra-chave</label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="searchTerm" 
                                           placeholder="Digite uma palavra-chave..."
                                           onkeyup="filterDocuments()">
                                </div>
                                
                                <div class="col-md-3">
                                    <label for="documentType" class="form-label">Tipo de Documento</label>
                                    <select class="form-select" id="documentType" onchange="filterDocuments()">
                                        <option value="">Todos os tipos</option>
                                        <option value="decreto">Decretos</option>
                                        <option value="portaria">Portarias</option>
                                        <option value="lei">Leis</option>
                                        <option value="resolucao">Resoluções</option>
                                        <option value="instrucao">Instruções Normativas</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <label for="yearFilter" class="form-label">Ano</label>
                                    <select class="form-select" id="yearFilter" onchange="filterDocuments()">
                                        <option value="">Todos os anos</option>
                                        <option value="2024">2024</option>
                                        <option value="2023">2023</option>
                                        <option value="2022">2022</option>
                                        <option value="2021">2021</option>
                                        <option value="2020">2020</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="dateFrom" class="form-label">Data inicial</label>
                                    <input type="date" 
                                           class="form-control" 
                                           id="dateFrom"
                                           onchange="filterDocuments()">
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="dateTo" class="form-label">Data final</label>
                                    <input type="date" 
                                           class="form-control" 
                                           id="dateTo"
                                           onchange="filterDocuments()">
                                </div>
                                
                                <div class="col-md-4 d-flex align-items-end">
                                    <button type="button" class="btn btn-outline-secondary w-100" onclick="clearFilters()">
                                        <i class="fas fa-times me-1"></i> Limpar Filtros
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Lista de Documentos -->
            <div class="documents-list" id="documentsList">
                <!-- Decreto Exemplo 1 -->
                <div class="document-item" data-type="decreto" data-year="2024" data-date="2024-01-15">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="document-header mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <span class="badge bg-primary me-2">Decreto</span>
                                        <span class="badge bg-secondary">Nº 001/2024</span>
                                    </div>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>
                                        15/01/2024
                                    </small>
                                </div>
                            </div>
                            
                            <h3 class="document-title h5 mb-3">
                                Decreto nº 001/2024 - Dispõe sobre o funcionamento dos serviços públicos municipais
                            </h3>
                            
                            <p class="document-summary text-muted mb-3">
                                Estabelece normas para o funcionamento dos serviços públicos municipais, 
                                horários de atendimento e procedimentos administrativos.
                            </p>
                            
                            <div class="document-meta mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <small class="text-muted">
                                            <i class="fas fa-user me-1"></i>
                                            <strong>Assinado por:</strong> Prefeito Municipal
                                        </small>
                                    </div>
                                    <div class="col-md-6">
                                        <small class="text-muted">
                                            <i class="fas fa-tag me-1"></i>
                                            <strong>Categoria:</strong> Administração Pública
                                        </small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="document-actions">
                                <a href="#" class="btn btn-outline-primary btn-sm me-2">
                                    <i class="fas fa-eye me-1"></i> Visualizar
                                </a>
                                <a href="#" class="btn btn-outline-secondary btn-sm me-2">
                                    <i class="fas fa-download me-1"></i> Download PDF
                                </a>
                                <button type="button" class="btn btn-outline-info btn-sm" onclick="shareDocument('Decreto nº 001/2024')">
                                    <i class="fas fa-share me-1"></i> Compartilhar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Portaria Exemplo 1 -->
                <div class="document-item" data-type="portaria" data-year="2024" data-date="2024-01-10">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="document-header mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <span class="badge bg-success me-2">Portaria</span>
                                        <span class="badge bg-secondary">Nº 005/2024</span>
                                    </div>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>
                                        10/01/2024
                                    </small>
                                </div>
                            </div>
                            
                            <h3 class="document-title h5 mb-3">
                                Portaria nº 005/2024 - Nomeia comissão para elaboração do plano municipal de educação
                            </h3>
                            
                            <p class="document-summary text-muted mb-3">
                                Constitui comissão responsável pela elaboração e revisão do Plano Municipal de Educação, 
                                definindo membros e atribuições.
                            </p>
                            
                            <div class="document-meta mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <small class="text-muted">
                                            <i class="fas fa-user me-1"></i>
                                            <strong>Assinado por:</strong> Secretário de Educação
                                        </small>
                                    </div>
                                    <div class="col-md-6">
                                        <small class="text-muted">
                                            <i class="fas fa-tag me-1"></i>
                                            <strong>Categoria:</strong> Educação
                                        </small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="document-actions">
                                <a href="#" class="btn btn-outline-primary btn-sm me-2">
                                    <i class="fas fa-eye me-1"></i> Visualizar
                                </a>
                                <a href="#" class="btn btn-outline-secondary btn-sm me-2">
                                    <i class="fas fa-download me-1"></i> Download PDF
                                </a>
                                <button type="button" class="btn btn-outline-info btn-sm" onclick="shareDocument('Portaria nº 005/2024')">
                                    <i class="fas fa-share me-1"></i> Compartilhar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lei Exemplo 1 -->
                <div class="document-item" data-type="lei" data-year="2023" data-date="2023-12-20">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="document-header mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <span class="badge bg-warning text-dark me-2">Lei</span>
                                        <span class="badge bg-secondary">Nº 1.234/2023</span>
                                    </div>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>
                                        20/12/2023
                                    </small>
                                </div>
                            </div>
                            
                            <h3 class="document-title h5 mb-3">
                                Lei nº 1.234/2023 - Institui o Programa Municipal de Coleta Seletiva
                            </h3>
                            
                            <p class="document-summary text-muted mb-3">
                                Cria o Programa Municipal de Coleta Seletiva de resíduos sólidos, estabelecendo 
                                diretrizes para a gestão sustentável dos resíduos no município.
                            </p>
                            
                            <div class="document-meta mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <small class="text-muted">
                                            <i class="fas fa-user me-1"></i>
                                            <strong>Assinado por:</strong> Prefeito Municipal
                                        </small>
                                    </div>
                                    <div class="col-md-6">
                                        <small class="text-muted">
                                            <i class="fas fa-tag me-1"></i>
                                            <strong>Categoria:</strong> Meio Ambiente
                                        </small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="document-actions">
                                <a href="#" class="btn btn-outline-primary btn-sm me-2">
                                    <i class="fas fa-eye me-1"></i> Visualizar
                                </a>
                                <a href="#" class="btn btn-outline-secondary btn-sm me-2">
                                    <i class="fas fa-download me-1"></i> Download PDF
                                </a>
                                <button type="button" class="btn btn-outline-info btn-sm" onclick="shareDocument('Lei nº 1.234/2023')">
                                    <i class="fas fa-share me-1"></i> Compartilhar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nenhum resultado -->
            <div id="noResults" class="no-results text-center py-5" style="display: none;">
                <div class="mb-4">
                    <i class="fas fa-search fa-3x text-muted"></i>
                </div>
                <h3 class="h4 text-muted">Nenhum documento encontrado</h3>
                <p class="text-muted">
                    Tente ajustar os filtros ou fazer uma nova busca.
                </p>
                <button type="button" class="btn btn-primary" onclick="clearFilters()">
                    Ver todos os documentos
                </button>
            </div>

            <!-- Paginação -->
            <div class="pagination-wrapper text-center mt-4">
                <nav aria-label="Navegação de páginas">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Anterior</a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">Próximo</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <aside class="documents-sidebar">
                <!-- Estatísticas -->
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Estatísticas</h3>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-number">45</div>
                            <div class="stat-label">Decretos</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">32</div>
                            <div class="stat-label">Portarias</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">18</div>
                            <div class="stat-label">Leis</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">12</div>
                            <div class="stat-label">Resoluções</div>
                        </div>
                    </div>
                </div>

                <!-- Categorias -->
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Categorias</h3>
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            Administração Pública
                            <span class="badge bg-primary rounded-pill">15</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            Educação
                            <span class="badge bg-primary rounded-pill">12</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            Saúde
                            <span class="badge bg-primary rounded-pill">10</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            Meio Ambiente
                            <span class="badge bg-primary rounded-pill">8</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            Obras e Infraestrutura
                            <span class="badge bg-primary rounded-pill">6</span>
                        </a>
                    </div>
                </div>

                <!-- Documentos Recentes -->
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Documentos Recentes</h3>
                    <div class="recent-documents">
                        <div class="recent-doc-item mb-3">
                            <div class="d-flex">
                                <div class="doc-icon me-3">
                                    <i class="fas fa-file-alt text-primary"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Decreto nº 001/2024</h6>
                                    <small class="text-muted">15/01/2024</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="recent-doc-item mb-3">
                            <div class="d-flex">
                                <div class="doc-icon me-3">
                                    <i class="fas fa-file-alt text-success"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Portaria nº 005/2024</h6>
                                    <small class="text-muted">10/01/2024</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="recent-doc-item">
                            <div class="d-flex">
                                <div class="doc-icon me-3">
                                    <i class="fas fa-file-alt text-warning"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Lei nº 1.234/2023</h6>
                                    <small class="text-muted">20/12/2023</small>
                                </div>
                            </div>
                        </div>
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
                        <a href="#" class="btn btn-outline-primary">
                            <i class="fas fa-gavel me-2"></i> Licitações
                        </a>
                        <a href="#" class="btn btn-outline-primary">
                            <i class="fas fa-balance-scale me-2"></i> Transparência
                        </a>
                    </div>
                </div>

                <!-- Informações -->
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Informações</h3>
                    <div class="info-content">
                        <p class="small text-muted mb-3">
                            Todos os documentos estão disponíveis em formato PDF para download.
                        </p>
                        
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <small>
                                Para dúvidas sobre a legislação, entre em contato com a 
                                Secretaria de Administração.
                            </small>
                        </div>
                    </div>
                </div>
            </aside>
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

.document-item .card {
    transition: var(--transition-normal);
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-sm);
}

.document-item .card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.document-title {
    color: var(--text-primary);
    line-height: 1.4;
}

.document-summary {
    line-height: 1.6;
}

.filters-section .card {
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-sm);
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

.stats-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.stat-item {
    text-align: center;
    padding: 1rem;
    background: var(--bg-secondary);
    border-radius: var(--border-radius-md);
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: var(--primary-color);
    line-height: 1;
}

.stat-label {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin-top: 0.5rem;
}

.recent-doc-item {
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--gray-200);
}

.recent-doc-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.doc-icon {
    width: 40px;
    height: 40px;
    background: var(--bg-secondary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
}

.no-results {
    background: var(--bg-secondary);
    border-radius: var(--border-radius-xl);
    padding: 3rem 2rem;
}

@media (max-width: 768px) {
    .page-title {
        font-size: 2rem;
    }
    
    .page-subtitle {
        font-size: 1.1rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
        gap: 0.5rem;
    }
    
    .document-actions .btn {
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
function filterDocuments() {
    const searchTerm = document.getElementById('searchTerm').value.toLowerCase();
    const documentType = document.getElementById('documentType').value;
    const yearFilter = document.getElementById('yearFilter').value;
    const dateFrom = document.getElementById('dateFrom').value;
    const dateTo = document.getElementById('dateTo').value;
    
    const documents = document.querySelectorAll('.document-item');
    let visibleCount = 0;
    
    documents.forEach(doc => {
        const title = doc.querySelector('.document-title').textContent.toLowerCase();
        const summary = doc.querySelector('.document-summary').textContent.toLowerCase();
        const type = doc.getAttribute('data-type');
        const year = doc.getAttribute('data-year');
        const date = doc.getAttribute('data-date');
        
        const matchesSearch = title.includes(searchTerm) || summary.includes(searchTerm);
        const matchesType = !documentType || type === documentType;
        const matchesYear = !yearFilter || year === yearFilter;
        
        let matchesDateRange = true;
        if (dateFrom && date < dateFrom) matchesDateRange = false;
        if (dateTo && date > dateTo) matchesDateRange = false;
        
        if (matchesSearch && matchesType && matchesYear && matchesDateRange) {
            doc.style.display = 'block';
            visibleCount++;
        } else {
            doc.style.display = 'none';
        }
    });
    
    // Mostrar/ocultar mensagem de "nenhum resultado"
    const noResults = document.getElementById('noResults');
    if (visibleCount === 0) {
        noResults.style.display = 'block';
    } else {
        noResults.style.display = 'none';
    }
}

function clearFilters() {
    document.getElementById('searchTerm').value = '';
    document.getElementById('documentType').value = '';
    document.getElementById('yearFilter').value = '';
    document.getElementById('dateFrom').value = '';
    document.getElementById('dateTo').value = '';
    filterDocuments();
}

function shareDocument(title) {
    if (navigator.share) {
        navigator.share({
            title: title,
            text: 'Confira este documento: ' + title,
            url: window.location.href
        });
    } else {
        // Fallback para navegadores que não suportam Web Share API
        const url = window.location.href;
        navigator.clipboard.writeText(url).then(() => {
            alert('Link copiado para a área de transferência!');
        });
    }
}

// Destacar termos de pesquisa
function highlightSearchTerms() {
    const searchTerm = document.getElementById('searchTerm').value.toLowerCase();
    if (searchTerm.length < 3) return;
    
    const documents = document.querySelectorAll('.document-item:not([style*="display: none"])');
    
    documents.forEach(doc => {
        const title = doc.querySelector('.document-title');
        const summary = doc.querySelector('.document-summary');
        
        [title, summary].forEach(element => {
            let html = element.innerHTML;
            // Remove highlights anteriores
            html = html.replace(/<mark>/g, '').replace(/<\/mark>/g, '');
            
            // Adiciona novos highlights
            const regex = new RegExp(`(${searchTerm})`, 'gi');
            html = html.replace(regex, '<mark>$1</mark>');
            
            element.innerHTML = html;
        });
    });
}

// Event listener para destacar termos durante a digitação
document.getElementById('searchTerm').addEventListener('input', function() {
    setTimeout(highlightSearchTerms, 100);
});

// Animação de entrada dos documentos
document.addEventListener('DOMContentLoaded', function() {
    const documents = document.querySelectorAll('.document-item');
    
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
    
    documents.forEach(doc => {
        doc.style.opacity = '0';
        doc.style.transform = 'translateY(20px)';
        doc.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(doc);
    });
});
</script>
@endpush

