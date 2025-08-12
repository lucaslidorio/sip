@extends('public_templates.gov.layouts.app')

@section('title', 'Secretarias - ' . $tenant->nome)
@section('description', 'Conheça as secretarias municipais de ' . $tenant->nome . ' e seus serviços')

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
                Secretarias
            </li>
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
                    <div class="col-md-6">
                        <label for="searchSecretaria" class="form-label">Buscar secretaria</label>
                        <input type="text" 
                               class="form-control" 
                               id="searchSecretaria" 
                               placeholder="Digite o nome da secretaria..."
                               onkeyup="filterSecretarias()">
                    </div>
                    <div class="col-md-4">
                        <label for="areaFilter" class="form-label">Área de atuação</label>
                        <select class="form-select" id="areaFilter" onchange="filterSecretarias()">
                            <option value="">Todas as áreas</option>
                            <option value="administracao">Administração</option>
                            <option value="saude">Saúde</option>
                            <option value="educacao">Educação</option>
                            <option value="obras">Obras e Infraestrutura</option>
                            <option value="social">Assistência Social</option>
                            <option value="meio-ambiente">Meio Ambiente</option>
                            <option value="cultura">Cultura e Turismo</option>
                            <option value="esporte">Esporte e Lazer</option>
                            <option value="agricultura">Agricultura</option>
                            <option value="financas">Finanças</option>
                        </select>
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
        <!-- Secretaria de Administração -->
        <div class="secretaria-card" data-area="administracao">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex align-items-center">
                        <div class="secretaria-icon me-3">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <div>
                            <h3 class="h5 mb-0">Secretaria de Administração</h3>
                            <small>Gestão administrativa e recursos humanos</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        Responsável pela gestão administrativa, recursos humanos, patrimônio público e modernização da gestão municipal.
                    </p>
                    
                    <h6 class="text-primary-color">Principais Serviços:</h6>
                    <ul class="services-list">
                        <li>Concursos públicos</li>
                        <li>Gestão de pessoal</li>
                        <li>Controle patrimonial</li>
                        <li>Protocolo e arquivo</li>
                    </ul>
                </div>
                <div class="card-footer">
                    <div class="contact-info">
                        <p class="mb-1"><i class="fas fa-phone me-2"></i> (65) 3000-0001</p>
                        <p class="mb-1"><i class="fas fa-envelope me-2"></i> administracao@prefeitura.gov.br</p>
                        <p class="mb-0"><i class="fas fa-map-marker-alt me-2"></i> Rua Principal, 123 - Centro</p>
                    </div>
                    <div class="mt-3">
                        <a href="#" class="btn btn-outline-primary btn-sm me-2">
                            <i class="fas fa-info-circle me-1"></i> Mais Detalhes
                        </a>
                        <a href="#" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-phone me-1"></i> Contato
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Secretaria de Saúde -->
        <div class="secretaria-card" data-area="saude">
            <div class="card h-100">
                <div class="card-header bg-success text-white">
                    <div class="d-flex align-items-center">
                        <div class="secretaria-icon me-3">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <div>
                            <h3 class="h5 mb-0">Secretaria de Saúde</h3>
                            <small>Atenção básica e vigilância sanitária</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        Coordena as ações de saúde pública, atenção básica, vigilância sanitária e epidemiológica no município.
                    </p>
                    
                    <h6 class="text-primary-color">Principais Serviços:</h6>
                    <ul class="services-list">
                        <li>Unidades básicas de saúde</li>
                        <li>Vigilância sanitária</li>
                        <li>Programas de vacinação</li>
                        <li>Farmácia básica municipal</li>
                    </ul>
                </div>
                <div class="card-footer">
                    <div class="contact-info">
                        <p class="mb-1"><i class="fas fa-phone me-2"></i> (65) 3000-0002</p>
                        <p class="mb-1"><i class="fas fa-envelope me-2"></i> saude@prefeitura.gov.br</p>
                        <p class="mb-0"><i class="fas fa-map-marker-alt me-2"></i> Av. da Saúde, 456 - Centro</p>
                    </div>
                    <div class="mt-3">
                        <a href="#" class="btn btn-outline-primary btn-sm me-2">
                            <i class="fas fa-info-circle me-1"></i> Mais Detalhes
                        </a>
                        <a href="#" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-phone me-1"></i> Contato
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Secretaria de Educação -->
        <div class="secretaria-card" data-area="educacao">
            <div class="card h-100">
                <div class="card-header bg-info text-white">
                    <div class="d-flex align-items-center">
                        <div class="secretaria-icon me-3">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div>
                            <h3 class="h5 mb-0">Secretaria de Educação</h3>
                            <small>Ensino fundamental e educação infantil</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        Gerencia a rede municipal de ensino, educação infantil, ensino fundamental e programas educacionais.
                    </p>
                    
                    <h6 class="text-primary-color">Principais Serviços:</h6>
                    <ul class="services-list">
                        <li>Escolas municipais</li>
                        <li>Creches e pré-escolas</li>
                        <li>Transporte escolar</li>
                        <li>Merenda escolar</li>
                    </ul>
                </div>
                <div class="card-footer">
                    <div class="contact-info">
                        <p class="mb-1"><i class="fas fa-phone me-2"></i> (65) 3000-0003</p>
                        <p class="mb-1"><i class="fas fa-envelope me-2"></i> educacao@prefeitura.gov.br</p>
                        <p class="mb-0"><i class="fas fa-map-marker-alt me-2"></i> Rua da Educação, 789 - Centro</p>
                    </div>
                    <div class="mt-3">
                        <a href="#" class="btn btn-outline-primary btn-sm me-2">
                            <i class="fas fa-info-circle me-1"></i> Mais Detalhes
                        </a>
                        <a href="#" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-phone me-1"></i> Contato
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Secretaria de Obras -->
        <div class="secretaria-card" data-area="obras">
            <div class="card h-100">
                <div class="card-header bg-warning text-dark">
                    <div class="d-flex align-items-center">
                        <div class="secretaria-icon me-3">
                            <i class="fas fa-hard-hat"></i>
                        </div>
                        <div>
                            <h3 class="h5 mb-0">Secretaria de Obras</h3>
                            <small>Infraestrutura e obras públicas</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        Executa obras de infraestrutura urbana, manutenção de vias públicas e projetos de engenharia.
                    </p>
                    
                    <h6 class="text-primary-color">Principais Serviços:</h6>
                    <ul class="services-list">
                        <li>Pavimentação e recapeamento</li>
                        <li>Obras de drenagem</li>
                        <li>Manutenção de prédios públicos</li>
                        <li>Iluminação pública</li>
                    </ul>
                </div>
                <div class="card-footer">
                    <div class="contact-info">
                        <p class="mb-1"><i class="fas fa-phone me-2"></i> (65) 3000-0004</p>
                        <p class="mb-1"><i class="fas fa-envelope me-2"></i> obras@prefeitura.gov.br</p>
                        <p class="mb-0"><i class="fas fa-map-marker-alt me-2"></i> Av. das Obras, 321 - Industrial</p>
                    </div>
                    <div class="mt-3">
                        <a href="#" class="btn btn-outline-primary btn-sm me-2">
                            <i class="fas fa-info-circle me-1"></i> Mais Detalhes
                        </a>
                        <a href="#" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-phone me-1"></i> Contato
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Secretaria de Assistência Social -->
        <div class="secretaria-card" data-area="social">
            <div class="card h-100">
                <div class="card-header bg-danger text-white">
                    <div class="d-flex align-items-center">
                        <div class="secretaria-icon me-3">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <div>
                            <h3 class="h5 mb-0">Secretaria de Assistência Social</h3>
                            <small>Programas sociais e assistência</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        Desenvolve programas de assistência social, proteção às famílias em vulnerabilidade social.
                    </p>
                    
                    <h6 class="text-primary-color">Principais Serviços:</h6>
                    <ul class="services-list">
                        <li>CRAS - Centro de Referência</li>
                        <li>Bolsa Família</li>
                        <li>Auxílio emergencial</li>
                        <li>Programas habitacionais</li>
                    </ul>
                </div>
                <div class="card-footer">
                    <div class="contact-info">
                        <p class="mb-1"><i class="fas fa-phone me-2"></i> (65) 3000-0005</p>
                        <p class="mb-1"><i class="fas fa-envelope me-2"></i> social@prefeitura.gov.br</p>
                        <p class="mb-0"><i class="fas fa-map-marker-alt me-2"></i> Rua da Solidariedade, 654 - Centro</p>
                    </div>
                    <div class="mt-3">
                        <a href="#" class="btn btn-outline-primary btn-sm me-2">
                            <i class="fas fa-info-circle me-1"></i> Mais Detalhes
                        </a>
                        <a href="#" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-phone me-1"></i> Contato
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Secretaria de Meio Ambiente -->
        <div class="secretaria-card" data-area="meio-ambiente">
            <div class="card h-100">
                <div class="card-header bg-success text-white">
                    <div class="d-flex align-items-center">
                        <div class="secretaria-icon me-3">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <div>
                            <h3 class="h5 mb-0">Secretaria de Meio Ambiente</h3>
                            <small>Preservação e sustentabilidade</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        Promove a preservação ambiental, licenciamento e educação ambiental no município.
                    </p>
                    
                    <h6 class="text-primary-color">Principais Serviços:</h6>
                    <ul class="services-list">
                        <li>Licenciamento ambiental</li>
                        <li>Coleta seletiva</li>
                        <li>Educação ambiental</li>
                        <li>Fiscalização ambiental</li>
                    </ul>
                </div>
                <div class="card-footer">
                    <div class="contact-info">
                        <p class="mb-1"><i class="fas fa-phone me-2"></i> (65) 3000-0006</p>
                        <p class="mb-1"><i class="fas fa-envelope me-2"></i> meioambiente@prefeitura.gov.br</p>
                        <p class="mb-0"><i class="fas fa-map-marker-alt me-2"></i> Av. Verde, 987 - Parque</p>
                    </div>
                    <div class="mt-3">
                        <a href="#" class="btn btn-outline-primary btn-sm me-2">
                            <i class="fas fa-info-circle me-1"></i> Mais Detalhes
                        </a>
                        <a href="#" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-phone me-1"></i> Contato
                        </a>
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
                            Segunda a Sexta: 7h às 17h<br>
                            <i class="fas fa-clock me-2"></i>
                            Sábado: 7h às 11h
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="h6 text-primary-color">Atendimento ao Público</h5>
                        <p class="mb-3">
                            <i class="fas fa-users me-2"></i>
                            Protocolo Geral: 7h às 16h<br>
                            <i class="fas fa-phone me-2"></i>
                            Central de Atendimento: (65) 3000-0000
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
    const searchTerm = document.getElementById('searchSecretaria').value.toLowerCase();
    const areaFilter = document.getElementById('areaFilter').value;
    const cards = document.querySelectorAll('.secretaria-card');
    let visibleCount = 0;
    
    cards.forEach(card => {
        const title = card.querySelector('h3').textContent.toLowerCase();
        const area = card.getAttribute('data-area');
        const content = card.querySelector('.card-text').textContent.toLowerCase();
        
        const matchesSearch = title.includes(searchTerm) || content.includes(searchTerm);
        const matchesArea = !areaFilter || area === areaFilter;
        
        if (matchesSearch && matchesArea) {
            card.style.display = 'block';
            visibleCount++;
        } else {
            card.style.display = 'none';
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
    document.getElementById('searchSecretaria').value = '';
    document.getElementById('areaFilter').value = '';
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

