@extends('public_templates.gov.layouts.app')

@section('title', 'Mapa do Site - ' . $tenant->nome)
@section('description', 'Navegue facilmente pelo site de ' . $tenant->nome . ' através do mapa do site')

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
                Mapa do Site
            </li>
        </ol>
    </nav>

    <!-- Cabeçalho da Página -->
    <div class="page-header text-center mb-5">
        <h1 class="page-title text-primary-color">
            <i class="fas fa-sitemap me-3"></i>
            Mapa do Site
        </h1>
        <p class="page-subtitle text-muted">
            Encontre rapidamente todas as páginas e seções do nosso site
        </p>
    </div>

    <!-- Busca no Mapa -->
    <div class="sitemap-search mb-5">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" 
                                   class="form-control" 
                                   id="sitemapSearch" 
                                   placeholder="Buscar página ou seção..."
                                   onkeyup="searchSitemap()">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-outline-secondary w-100" onclick="clearSearch()">
                            <i class="fas fa-times me-1"></i> Limpar Busca
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mapa do Site -->
    <div class="sitemap-content">
        <div class="row">
            <!-- Páginas Principais -->
            <div class="col-lg-6 mb-4">
                <div class="sitemap-section">
                    <h2 class="section-title">
                        <i class="fas fa-home me-2"></i>
                        Páginas Principais
                    </h2>
                    <ul class="sitemap-list">
                        <li>
                            <a href="{{ route('site.index') }}">
                                <i class="fas fa-home me-2"></i>
                                Página Inicial
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('site.noticias.todas') }}">
                                <i class="fas fa-newspaper me-2"></i>
                                Notícias
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('site.agenda') }}">
                                <i class="fas fa-calendar me-2"></i>
                                Agenda Pública
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-building me-2"></i>
                                Secretarias
                            </a>
                            <ul class="sitemap-sublist">
                                <li><a href="#">Secretaria de Administração</a></li>
                                <li><a href="#">Secretaria de Saúde</a></li>
                                <li><a href="#">Secretaria de Educação</a></li>
                                <li><a href="#">Secretaria de Obras</a></li>
                                <li><a href="#">Secretaria de Assistência Social</a></li>
                                <li><a href="#">Secretaria de Meio Ambiente</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-file-alt me-2"></i>
                                Decretos e Portarias
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Transparência -->
            <div class="col-lg-6 mb-4">
                <div class="sitemap-section">
                    <h2 class="section-title">
                        <i class="fas fa-balance-scale me-2"></i>
                        Transparência
                    </h2>
                    <ul class="sitemap-list">
                        <li>
                            <a href="#">
                                <i class="fas fa-chart-bar me-2"></i>
                                Portal da Transparência
                            </a>
                            <ul class="sitemap-sublist">
                                <li><a href="#">Receitas</a></li>
                                <li><a href="#">Despesas</a></li>
                                <li><a href="#">Contratos</a></li>
                                <li><a href="#">Convênios</a></li>
                                <li><a href="#">Folha de Pagamento</a></li>
                                <li><a href="#">Diárias</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-users me-2"></i>
                                Servidores Públicos
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-file-invoice-dollar me-2"></i>
                                Prestação de Contas
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-gavel me-2"></i>
                                Licitações e Contratos
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Serviços Online -->
            <div class="col-lg-6 mb-4">
                <div class="sitemap-section">
                    <h2 class="section-title">
                        <i class="fas fa-laptop me-2"></i>
                        Serviços Online
                    </h2>
                    <ul class="sitemap-list">
                        <li>
                            <a href="#">
                                <i class="fas fa-file-invoice me-2"></i>
                                Nota Fiscal Eletrônica
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-map-marked-alt me-2"></i>
                                IPTU Online
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-certificate me-2"></i>
                                Certidões
                            </a>
                            <ul class="sitemap-sublist">
                                <li><a href="#">Certidão Negativa de Débitos</a></li>
                                <li><a href="#">Certidão de Localização</a></li>
                                <li><a href="#">Certidão de Uso do Solo</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-file-alt me-2"></i>
                                Protocolo Online
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-download me-2"></i>
                                Downloads
                            </a>
                            <ul class="sitemap-sublist">
                                <li><a href="#">Formulários</a></li>
                                <li><a href="#">Manuais</a></li>
                                <li><a href="#">Documentos</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Informações Municipais -->
            <div class="col-lg-6 mb-4">
                <div class="sitemap-section">
                    <h2 class="section-title">
                        <i class="fas fa-info-circle me-2"></i>
                        Informações Municipais
                    </h2>
                    <ul class="sitemap-list">
                        <li>
                            <a href="#">
                                <i class="fas fa-landmark me-2"></i>
                                História do Município
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-user-tie me-2"></i>
                                Prefeito e Vice-Prefeito
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-users-cog me-2"></i>
                                Estrutura Organizacional
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-map me-2"></i>
                                Dados Geográficos
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-chart-line me-2"></i>
                                Indicadores Sociais
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-camera me-2"></i>
                                Galeria de Fotos
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Participação Cidadã -->
            <div class="col-lg-6 mb-4">
                <div class="sitemap-section">
                    <h2 class="section-title">
                        <i class="fas fa-users me-2"></i>
                        Participação Cidadã
                    </h2>
                    <ul class="sitemap-list">
                        <li>
                            <a href="#">
                                <i class="fas fa-headset me-2"></i>
                                Ouvidoria
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-vote-yea me-2"></i>
                                Audiências Públicas
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-comments me-2"></i>
                                Consultas Públicas
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-handshake me-2"></i>
                                Conselhos Municipais
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-bullhorn me-2"></i>
                                Fale Conosco
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Turismo e Cultura -->
            <div class="col-lg-6 mb-4">
                <div class="sitemap-section">
                    <h2 class="section-title">
                        <i class="fas fa-camera-retro me-2"></i>
                        Turismo e Cultura
                    </h2>
                    <ul class="sitemap-list">
                        <li>
                            <a href="#">
                                <i class="fas fa-map-marked-alt me-2"></i>
                                Pontos Turísticos
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-calendar-alt me-2"></i>
                                Eventos e Festivais
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-utensils me-2"></i>
                                Gastronomia Local
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-bed me-2"></i>
                                Hospedagem
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-palette me-2"></i>
                                Arte e Cultura
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Utilidades -->
            <div class="col-lg-12 mb-4">
                <div class="sitemap-section">
                    <h2 class="section-title">
                        <i class="fas fa-tools me-2"></i>
                        Utilidades e Acessibilidade
                    </h2>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="sitemap-list">
                                <li>
                                    <a href="{{ route('site.pesquisar') }}">
                                        <i class="fas fa-search me-2"></i>
                                        Busca no Site
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('site.acessibilidade') }}">
                                        <i class="fas fa-universal-access me-2"></i>
                                        Acessibilidade
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('site.sitemap') }}">
                                        <i class="fas fa-sitemap me-2"></i>
                                        Mapa do Site
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="sitemap-list">
                                <li>
                                    <a href="#">
                                        <i class="fas fa-shield-alt me-2"></i>
                                        Política de Privacidade
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fas fa-file-contract me-2"></i>
                                        Termos de Uso
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fas fa-rss me-2"></i>
                                        RSS Feed
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Estatísticas do Site -->
    <div class="site-stats mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="h5 mb-0">
                    <i class="fas fa-chart-bar me-2"></i>
                    Estatísticas do Site
                </h3>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-3 mb-3">
                        <div class="stat-item">
                            <div class="stat-number">150+</div>
                            <div class="stat-label">Páginas</div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="stat-item">
                            <div class="stat-number">25+</div>
                            <div class="stat-label">Serviços Online</div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="stat-item">
                            <div class="stat-number">500+</div>
                            <div class="stat-label">Documentos</div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="stat-item">
                            <div class="stat-number">100%</div>
                            <div class="stat-label">Acessível</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ajuda -->
    <div class="help-section mt-5">
        <div class="card">
            <div class="card-body text-center">
                <h3 class="h4 text-primary-color mb-3">
                    <i class="fas fa-question-circle me-2"></i>
                    Não encontrou o que procurava?
                </h3>
                <p class="text-muted mb-4">
                    Use nossa busca ou entre em contato conosco para obter ajuda.
                </p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="{{ route('site.pesquisar') }}" class="btn btn-primary">
                        <i class="fas fa-search me-2"></i>
                        Fazer uma Busca
                    </a>
                    <a href="#" class="btn btn-outline-primary">
                        <i class="fas fa-headset me-2"></i>
                        Falar Conosco
                    </a>
                    <a href="#" class="btn btn-outline-secondary">
                        <i class="fas fa-phone me-2"></i>
                        Central de Atendimento
                    </a>
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
    max-width: 600px;
    margin: 0 auto;
}

.sitemap-section {
    background: var(--bg-primary);
    border-radius: var(--border-radius-lg);
    padding: 2rem;
    height: 100%;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--gray-200);
}

.section-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--primary-color);
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid var(--primary-lighter);
}

.sitemap-list {
    list-style: none;
    padding-left: 0;
    margin-bottom: 0;
}

.sitemap-list li {
    margin-bottom: 0.75rem;
}

.sitemap-list a {
    color: var(--text-primary);
    text-decoration: none;
    display: block;
    padding: 0.5rem 0;
    border-radius: var(--border-radius-sm);
    transition: var(--transition-normal);
}

.sitemap-list a:hover {
    color: var(--primary-color);
    background-color: var(--primary-lighter);
    padding-left: 0.5rem;
}

.sitemap-sublist {
    list-style: none;
    padding-left: 2rem;
    margin-top: 0.5rem;
    margin-bottom: 0;
}

.sitemap-sublist li {
    margin-bottom: 0.5rem;
}

.sitemap-sublist a {
    font-size: 0.9rem;
    color: var(--text-secondary);
    padding: 0.25rem 0;
}

.sitemap-sublist a:hover {
    color: var(--primary-color);
}

.sitemap-search .card {
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-sm);
}

.site-stats .stat-item {
    padding: 1rem;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--primary-color);
    line-height: 1;
}

.stat-label {
    font-size: 1rem;
    color: var(--text-secondary);
    margin-top: 0.5rem;
}

.help-section .card {
    background: var(--primary-lighter);
    border: 1px solid var(--primary-color);
}

/* Destacar resultados da busca */
.sitemap-list .highlight {
    background-color: yellow;
    padding: 0.2rem 0.4rem;
    border-radius: var(--border-radius-sm);
}

.sitemap-section.hidden {
    display: none;
}

@media (max-width: 768px) {
    .page-title {
        font-size: 2rem;
    }
    
    .page-subtitle {
        font-size: 1.1rem;
    }
    
    .sitemap-section {
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .section-title {
        font-size: 1.25rem;
    }
    
    .stat-number {
        font-size: 2rem;
    }
    
    .help-section .d-flex {
        flex-direction: column;
        align-items: center;
    }
    
    .help-section .btn {
        width: 100%;
        max-width: 300px;
        margin-bottom: 0.5rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
function searchSitemap() {
    const searchTerm = document.getElementById('sitemapSearch').value.toLowerCase();
    const sections = document.querySelectorAll('.sitemap-section');
    let hasResults = false;
    
    sections.forEach(section => {
        const links = section.querySelectorAll('.sitemap-list a');
        let sectionHasMatch = false;
        
        // Limpar highlights anteriores
        links.forEach(link => {
            link.innerHTML = link.innerHTML.replace(/<span class="highlight">/g, '').replace(/<\/span>/g, '');
        });
        
        if (searchTerm.length >= 2) {
            links.forEach(link => {
                const text = link.textContent.toLowerCase();
                const listItem = link.closest('li');
                
                if (text.includes(searchTerm)) {
                    // Destacar termo encontrado
                    const regex = new RegExp(`(${searchTerm})`, 'gi');
                    link.innerHTML = link.innerHTML.replace(regex, '<span class="highlight">$1</span>');
                    
                    listItem.style.display = 'block';
                    sectionHasMatch = true;
                    hasResults = true;
                } else {
                    listItem.style.display = 'none';
                }
            });
            
            // Mostrar/ocultar seção baseado nos resultados
            if (sectionHasMatch) {
                section.classList.remove('hidden');
            } else {
                section.classList.add('hidden');
            }
        } else {
            // Mostrar todos os itens se a busca for muito curta
            links.forEach(link => {
                link.closest('li').style.display = 'block';
            });
            section.classList.remove('hidden');
            hasResults = true;
        }
    });
    
    // Mostrar mensagem se não houver resultados
    showNoResultsMessage(!hasResults && searchTerm.length >= 2);
}

function clearSearch() {
    document.getElementById('sitemapSearch').value = '';
    
    // Mostrar todos os itens e seções
    const sections = document.querySelectorAll('.sitemap-section');
    sections.forEach(section => {
        section.classList.remove('hidden');
        
        const links = section.querySelectorAll('.sitemap-list a');
        links.forEach(link => {
            link.closest('li').style.display = 'block';
            // Remover highlights
            link.innerHTML = link.innerHTML.replace(/<span class="highlight">/g, '').replace(/<\/span>/g, '');
        });
    });
    
    showNoResultsMessage(false);
}

function showNoResultsMessage(show) {
    let noResultsDiv = document.getElementById('noResultsMessage');
    
    if (show) {
        if (!noResultsDiv) {
            noResultsDiv = document.createElement('div');
            noResultsDiv.id = 'noResultsMessage';
            noResultsDiv.className = 'alert alert-info text-center mt-4';
            noResultsDiv.innerHTML = `
                <i class="fas fa-search fa-2x mb-3"></i>
                <h4>Nenhum resultado encontrado</h4>
                <p class="mb-0">Tente usar termos diferentes ou mais específicos.</p>
            `;
            document.querySelector('.sitemap-content').appendChild(noResultsDiv);
        }
        noResultsDiv.style.display = 'block';
    } else {
        if (noResultsDiv) {
            noResultsDiv.style.display = 'none';
        }
    }
}

// Animação de entrada das seções
document.addEventListener('DOMContentLoaded', function() {
    const sections = document.querySelectorAll('.sitemap-section');
    
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
    
    sections.forEach(section => {
        section.style.opacity = '0';
        section.style.transform = 'translateY(20px)';
        section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(section);
    });
});

// Busca em tempo real
document.getElementById('sitemapSearch').addEventListener('input', function() {
    clearTimeout(this.searchTimeout);
    this.searchTimeout = setTimeout(searchSitemap, 300);
});
</script>
@endpush

