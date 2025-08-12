@extends('public_templates.gov.layouts.app')

@section('title', 'Acessibilidade - ' . $tenant->nome)
@section('description', 'Informações sobre acessibilidade e recursos disponíveis no site de ' . $tenant->nome)

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
                Acessibilidade
            </li>
        </ol>
    </nav>

    <!-- Cabeçalho da Página -->
    <div class="page-header text-center mb-5">
        <h1 class="page-title text-primary-color">
            <i class="fas fa-universal-access me-3"></i>
            Acessibilidade
        </h1>
        <p class="page-subtitle text-muted">
            Nosso compromisso é garantir que todos os cidadãos tenham acesso às informações públicas
        </p>
    </div>

    <div class="row">
        <!-- Conteúdo Principal -->
        <div class="col-lg-8">
            <!-- Introdução -->
            <section class="accessibility-intro mb-5">
                <div class="card">
                    <div class="card-body">
                        <h2 class="h4 text-primary-color mb-3">
                            <i class="fas fa-info-circle me-2"></i>
                            Sobre a Acessibilidade
                        </h2>
                        <p class="lead">
                            Este site foi desenvolvido seguindo as diretrizes de acessibilidade digital, 
                            garantindo que pessoas com deficiência possam navegar, compreender e interagir 
                            com o conteúdo de forma eficiente.
                        </p>
                        <p>
                            Estamos comprometidos em tornar nosso site acessível a todos os usuários, 
                            independentemente de suas habilidades ou tecnologias assistivas utilizadas.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Recursos de Acessibilidade -->
            <section class="accessibility-features mb-5">
                <h2 class="h4 text-primary-color mb-4">
                    <i class="fas fa-tools me-2"></i>
                    Recursos de Acessibilidade Disponíveis
                </h2>
                
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="feature-card h-100">
                            <div class="feature-icon">
                                <i class="fas fa-text-height"></i>
                            </div>
                            <h3 class="h5">Controle de Fonte</h3>
                            <p>Aumente ou diminua o tamanho da fonte usando os botões A+ e A- no topo da página.</p>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <div class="feature-card h-100">
                            <div class="feature-icon">
                                <i class="fas fa-adjust"></i>
                            </div>
                            <h3 class="h5">Alto Contraste</h3>
                            <p>Ative o modo de alto contraste para melhor visualização do conteúdo.</p>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <div class="feature-card h-100">
                            <div class="feature-icon">
                                <i class="fas fa-sign-language"></i>
                            </div>
                            <h3 class="h5">VLibras</h3>
                            <p>Tradutor automático para Língua Brasileira de Sinais (LIBRAS) disponível em todas as páginas.</p>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <div class="feature-card h-100">
                            <div class="feature-icon">
                                <i class="fas fa-keyboard"></i>
                            </div>
                            <h3 class="h5">Navegação por Teclado</h3>
                            <p>Todo o site pode ser navegado usando apenas o teclado, com foco visível nos elementos.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Atalhos de Teclado -->
            <section class="keyboard-shortcuts mb-5">
                <h2 class="h4 text-primary-color mb-4">
                    <i class="fas fa-keyboard me-2"></i>
                    Atalhos de Teclado
                </h2>
                
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Atalho</th>
                                        <th>Função</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><kbd>Alt + 1</kbd></td>
                                        <td>Ir para o conteúdo principal</td>
                                    </tr>
                                    <tr>
                                        <td><kbd>Alt + 2</kbd></td>
                                        <td>Ir para o menu principal</td>
                                    </tr>
                                    <tr>
                                        <td><kbd>Alt + 3</kbd></td>
                                        <td>Ir para o campo de busca</td>
                                    </tr>
                                    <tr>
                                        <td><kbd>Alt + 4</kbd></td>
                                        <td>Ir para o rodapé</td>
                                    </tr>
                                    <tr>
                                        <td><kbd>Tab</kbd></td>
                                        <td>Navegar para o próximo elemento</td>
                                    </tr>
                                    <tr>
                                        <td><kbd>Shift + Tab</kbd></td>
                                        <td>Navegar para o elemento anterior</td>
                                    </tr>
                                    <tr>
                                        <td><kbd>Enter</kbd></td>
                                        <td>Ativar link ou botão</td>
                                    </tr>
                                    <tr>
                                        <td><kbd>Esc</kbd></td>
                                        <td>Fechar modal ou menu aberto</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Tecnologias Assistivas -->
            <section class="assistive-tech mb-5">
                <h2 class="h4 text-primary-color mb-4">
                    <i class="fas fa-assistive-listening-systems me-2"></i>
                    Tecnologias Assistivas Compatíveis
                </h2>
                
                <div class="card">
                    <div class="card-body">
                        <p class="mb-3">Este site foi testado e é compatível com as seguintes tecnologias assistivas:</p>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="h6 text-primary-color">Leitores de Tela</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-check text-success me-2"></i>NVDA</li>
                                    <li><i class="fas fa-check text-success me-2"></i>JAWS</li>
                                    <li><i class="fas fa-check text-success me-2"></i>VoiceOver (macOS/iOS)</li>
                                    <li><i class="fas fa-check text-success me-2"></i>TalkBack (Android)</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h5 class="h6 text-primary-color">Navegadores</h5>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-check text-success me-2"></i>Google Chrome</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Mozilla Firefox</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Microsoft Edge</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Safari</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Conformidade -->
            <section class="compliance mb-5">
                <h2 class="h4 text-primary-color mb-4">
                    <i class="fas fa-certificate me-2"></i>
                    Conformidade e Padrões
                </h2>
                
                <div class="card">
                    <div class="card-body">
                        <p>Este site segue as seguintes diretrizes e padrões de acessibilidade:</p>
                        
                        <ul class="compliance-list">
                            <li>
                                <strong>WCAG 2.1 Nível AA</strong> - Web Content Accessibility Guidelines
                            </li>
                            <li>
                                <strong>eMAG</strong> - Modelo de Acessibilidade em Governo Eletrônico
                            </li>
                            <li>
                                <strong>Lei Brasileira de Inclusão (LBI)</strong> - Lei nº 13.146/2015
                            </li>
                            <li>
                                <strong>Decreto nº 5.296/2004</strong> - Acessibilidade digital
                            </li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Feedback -->
            <section class="feedback">
                <h2 class="h4 text-primary-color mb-4">
                    <i class="fas fa-comments me-2"></i>
                    Feedback e Sugestões
                </h2>
                
                <div class="card">
                    <div class="card-body">
                        <p class="mb-3">
                            Sua opinião é importante para nós! Se você encontrou alguma barreira de 
                            acessibilidade ou tem sugestões de melhoria, entre em contato conosco.
                        </p>
                        
                        <div class="contact-methods">
                            @if($tenant->email)
                            <div class="contact-method mb-3">
                                <h6 class="text-primary-color">E-mail</h6>
                                <p>
                                    <i class="fas fa-envelope me-2"></i>
                                    <a href="mailto:{{ $tenant->email }}?subject=Feedback sobre Acessibilidade">
                                        {{ $tenant->email }}
                                    </a>
                                </p>
                            </div>
                            @endif
                            
                            @if($tenant->telefone)
                            <div class="contact-method mb-3">
                                <h6 class="text-primary-color">Telefone</h6>
                                <p>
                                    <i class="fas fa-phone me-2"></i>
                                    <a href="tel:{{ $tenant->telefone }}">{{ $tenant->telefone }}</a>
                                </p>
                            </div>
                            @endif
                            
                            <div class="contact-method">
                                <h6 class="text-primary-color">Ouvidoria</h6>
                                <p>
                                    <i class="fas fa-headset me-2"></i>
                                    <a href="#" class="btn btn-outline-primary btn-sm">
                                        Acessar Ouvidoria
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <aside class="accessibility-sidebar">
                <!-- Controles de Acessibilidade -->
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Controles de Acessibilidade</h3>
                    <div class="accessibility-controls">
                        <button type="button" class="btn btn-outline-primary w-100 mb-2" onclick="increaseFontSize()">
                            <i class="fas fa-plus me-2"></i>
                            Aumentar Fonte (A+)
                        </button>
                        <button type="button" class="btn btn-outline-primary w-100 mb-2" onclick="decreaseFontSize()">
                            <i class="fas fa-minus me-2"></i>
                            Diminuir Fonte (A-)
                        </button>
                        <button type="button" class="btn btn-outline-primary w-100 mb-2" onclick="toggleContrast()">
                            <i class="fas fa-adjust me-2"></i>
                            Alto Contraste
                        </button>
                        <button type="button" class="btn btn-outline-primary w-100" onclick="resetAccessibility()">
                            <i class="fas fa-undo me-2"></i>
                            Restaurar Padrão
                        </button>
                    </div>
                </div>

                <!-- Links Úteis -->
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Links Úteis</h3>
                    <div class="useful-links">
                        <a href="https://www.gov.br/governodigital/pt-br/acessibilidade-digital" 
                           target="_blank" 
                           class="btn btn-outline-secondary w-100 mb-2">
                            <i class="fas fa-external-link-alt me-2"></i>
                            Acessibilidade Digital - Gov.br
                        </a>
                        <a href="https://www.w3.org/WAI/WCAG21/quickref/" 
                           target="_blank" 
                           class="btn btn-outline-secondary w-100 mb-2">
                            <i class="fas fa-external-link-alt me-2"></i>
                            WCAG 2.1 Guidelines
                        </a>
                        <a href="https://vlibras.gov.br/" 
                           target="_blank" 
                           class="btn btn-outline-secondary w-100">
                            <i class="fas fa-external-link-alt me-2"></i>
                            VLibras
                        </a>
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
                        <a href="{{ route('site.sitemap') }}" class="btn btn-outline-primary">
                            <i class="fas fa-sitemap me-2"></i> Mapa do Site
                        </a>
                    </div>
                </div>

                <!-- Informações de Contato -->
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Contato</h3>
                    <div class="contact-info">
                        @if($tenant->endereco)
                        <p class="mb-2">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                            {{ $tenant->endereco }}
                        </p>
                        @endif
                        
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

.feature-card {
    background: var(--bg-primary);
    border: 1px solid var(--gray-200);
    border-radius: var(--border-radius-lg);
    padding: 1.5rem;
    text-align: center;
    transition: var(--transition-normal);
    box-shadow: var(--shadow-sm);
}

.feature-card:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-md);
}

.feature-icon {
    width: 60px;
    height: 60px;
    background: var(--primary-lighter);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    font-size: 1.5rem;
    color: var(--primary-color);
}

.compliance-list {
    list-style: none;
    padding-left: 0;
}

.compliance-list li {
    padding: 0.5rem 0;
    border-bottom: 1px solid var(--gray-200);
}

.compliance-list li:last-child {
    border-bottom: none;
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

.contact-info a {
    color: var(--text-primary);
    text-decoration: none;
}

.contact-info a:hover {
    color: var(--primary-color);
}

.contact-method h6 {
    margin-bottom: 0.5rem;
}

.contact-method p {
    margin-bottom: 0;
}

kbd {
    background-color: var(--gray-800);
    color: var(--text-white);
    padding: 0.25rem 0.5rem;
    border-radius: var(--border-radius-sm);
    font-size: 0.875rem;
}

@media (max-width: 768px) {
    .page-title {
        font-size: 2rem;
    }
    
    .page-subtitle {
        font-size: 1.1rem;
    }
    
    .feature-card {
        margin-bottom: 1rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Funções de acessibilidade
function increaseFontSize() {
    let currentSize = parseInt(document.documentElement.style.fontSize) || 16;
    if (currentSize < 24) {
        currentSize += 2;
        document.documentElement.style.fontSize = currentSize + 'px';
        localStorage.setItem('fontSize', currentSize);
    }
}

function decreaseFontSize() {
    let currentSize = parseInt(document.documentElement.style.fontSize) || 16;
    if (currentSize > 12) {
        currentSize -= 2;
        document.documentElement.style.fontSize = currentSize + 'px';
        localStorage.setItem('fontSize', currentSize);
    }
}

function toggleContrast() {
    document.body.classList.toggle('high-contrast');
    const isHighContrast = document.body.classList.contains('high-contrast');
    localStorage.setItem('highContrast', isHighContrast);
}

function resetAccessibility() {
    document.documentElement.style.fontSize = '16px';
    document.body.classList.remove('high-contrast');
    localStorage.removeItem('fontSize');
    localStorage.removeItem('highContrast');
}

// Carregar preferências salvas
document.addEventListener('DOMContentLoaded', function() {
    const savedFontSize = localStorage.getItem('fontSize');
    if (savedFontSize) {
        document.documentElement.style.fontSize = savedFontSize + 'px';
    }
    
    const savedContrast = localStorage.getItem('highContrast');
    if (savedContrast === 'true') {
        document.body.classList.add('high-contrast');
    }
});

// Atalhos de teclado
document.addEventListener('keydown', function(e) {
    if (e.altKey) {
        switch(e.key) {
            case '1':
                e.preventDefault();
                document.querySelector('main').focus();
                break;
            case '2':
                e.preventDefault();
                document.querySelector('nav').focus();
                break;
            case '3':
                e.preventDefault();
                document.querySelector('input[name="pesquisar"]').focus();
                break;
            case '4':
                e.preventDefault();
                document.querySelector('footer').focus();
                break;
        }
    }
});
</script>
@endpush

