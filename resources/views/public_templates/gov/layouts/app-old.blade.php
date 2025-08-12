<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('description', $tenant->nome . ' - Portal Oficial')">
    <meta name="keywords" content="@yield('keywords', 'prefeitura, governo, municipal, transparência')">
    <meta name="author" content="{{ $tenant->nome }}">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Title -->
    <title>@yield('title', $tenant->nome . ' - Portal Oficial')</title>
    
    <!-- Favicon -->
    @if($tenant->favicon)
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $tenant->favicon) }}">
    @endif
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Sistema de Cores Dinâmico -->
    @if($tenant->arquivo_cor_css === 'blue')    
        <link href="{{asset('gov/css/colors-blue.css') }}" rel="stylesheet">
    @else
        <link href="{{asset('gov/css/colors-green.css') }}" rel="stylesheet">
    @endif
    
    <!-- CSS Principal -->
    <link href="{{ asset('gov/css/main.css') }}" rel="stylesheet">
    
    <!-- CSS Adicional -->
    @stack('styles')
    
    <!-- VLibras -->
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    
    <!-- Google Analytics -->
    @if(config('app.google_analytics_id'))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('app.google_analytics_id') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ config('app.google_analytics_id') }}');
    </script>
    @endif
</head>
<body>
    <!-- Barra de Acessibilidade -->
    <div class="header-accessibility">
        <div class="container">
            <div class="accessibility-controls">
                <button id="increase-font" class="btn-accessibility" title="Aumentar fonte">
                    <i class="fas fa-plus"></i> A+
                </button>
                <button id="decrease-font" class="btn-accessibility" title="Diminuir fonte">
                    <i class="fas fa-minus"></i> A-
                </button>
                <button id="toggle-contrast" class="btn-accessibility" title="Alto contraste">
                    <i class="fas fa-adjust"></i> Contraste
                </button>
                <a href="{{ route('site.acessibilidade') }}" title="Página de acessibilidade">
                    <i class="fas fa-universal-access"></i> Acessibilidade
                </a>
            </div>
            
            <div class="header-info">
                <span><i class="fas fa-clock me-1"></i> {{ now()->format('d/m/Y H:i') }}</span>
            </div>
        </div>
    </div>

    <!-- Header Principal -->
    <header class="header-main">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="header-brand">
                        @if($tenant->brasao)
                        <img src="{{config('app.aws_url')."{$tenant->brasao}" }}" alt="Logo {{$tenant->brasao}}">
                        @endif
                        <div class="header-brand-text">
                            {{-- <h1>{{ $tenant->nome }}</h1> --}}
                            {{-- <p>{{ $tenant->slogan ?? 'Portal Oficial' }}</p> --}}
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="header-search">
                        <form action="{{ route('site.pesquisar') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="pesquisar" class="form-control" 
                                       placeholder="Buscar no site..." 
                                       value="{{ request('pesquisar') }}"
                                       required>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="header-actions">
                        <a href="{{ route('site.agenda') }}" class="btn btn-outline-primary">
                            <i class="fas fa-calendar me-1"></i> Agenda
                        </a>
                        <a href="#" class="btn btn-primary">
                            <i class="fas fa-phone me-1"></i> Contato
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Navegação Principal -->
    <nav class="navbar navbar-expand-lg navbar-main">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('site.index') ? 'active' : '' }}" 
                           href="{{ route('site.index') }}">
                            <i class="fas fa-home me-1"></i> Início
                        </a>
                    </li>
                    
                    @if($menus && $menus->count() > 0)
                        @foreach($menus as $menu)
                            @if($menu->submenus && $menu->submenus->count() > 0)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    @if($menu->icone)
                                    <i class="{{ $menu->icone }} me-1"></i>
                                    @endif
                                    {{ $menu->nome }}
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach($menu->submenus as $submenu)
                                    <li>
                                        <a class="dropdown-item" href="{{ $submenu->url }}">
                                            @if($submenu->icone)
                                            <i class="{{ $submenu->icone }} me-2"></i>
                                            @endif
                                            {{ $submenu->nome }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $menu->url }}">
                                    @if($menu->icone)
                                    <i class="{{ $menu->icone }} me-1"></i>
                                    @endif
                                    {{ $menu->nome }}
                                </a>
                            </li>
                            @endif
                        @endforeach
                    @endif
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('noticias.todas') }}">
                            <i class="fas fa-newspaper me-1"></i> Notícias
                        </a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-balance-scale me-1"></i> Transparência
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-money-bill me-2"></i> Receitas</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-shopping-cart me-2"></i> Despesas</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-file-contract me-2"></i> Contratos</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-users me-2"></i> Servidores</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <main class="main-wrapper">
        <div class="content-wrapper">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer-main">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h5>{{ $tenant->nome }}</h5>
                    <p>{{ $tenant->endereco ?? 'Endereço não informado' }}</p>
                    @if($tenant->telefone)
                    <p><i class="fas fa-phone me-2"></i> {{ $tenant->telefone }}</p>
                    @endif
                    @if($tenant->email)
                    <p><i class="fas fa-envelope me-2"></i> {{ $tenant->email }}</p>
                    @endif
                </div>
                
                <div class="footer-section">
                    <h5>Acesso Rápido</h5>
                    <ul>
                        <li><a href="{{ route('noticias.todas') }}">Notícias</a></li>
                        <li><a href="{{ route('site.agenda') }}">Agenda</a></li>
                        <li><a href="#">Licitações</a></li>
                        <li><a href="#">Portal da Transparência</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h5>Serviços</h5>
                    <ul>
                        <li><a href="#">Nota Fiscal Eletrônica</a></li>
                        <li><a href="#">Secretarias</a></li>
                        <li><a href="#">Decretos e Portarias</a></li>
                        <li><a href="#">Ouvidoria</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h5>Informações</h5>
                    <ul>
                        <li><a href="{{ route('site.acessibilidade') }}">Acessibilidade</a></li>
                        <li><a href="{{ route('site.sitemap') }}">Mapa do Site</a></li>
                        <li><a href="#">Política de Privacidade</a></li>
                        <li><a href="#">Termos de Uso</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} {{ $tenant->nome }}. Todos os direitos reservados.</p>
                <p>Desenvolvido com <i class="fas fa-heart text-danger"></i> pelo Sistema SIP</p>
            </div>
        </div>
    </footer>

    <!-- VLibras Widget -->
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>

    <!-- Scripts -->
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- VLibras -->
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>
    
    <!-- Acessibilidade -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let fontSize = 16;
            let isHighContrast = false;
            
            // Aumentar fonte
            document.getElementById('increase-font').addEventListener('click', function() {
                fontSize += 2;
                if (fontSize <= 24) {
                    document.documentElement.style.fontSize = fontSize + 'px';
                    localStorage.setItem('fontSize', fontSize);
                }
            });
            
            // Diminuir fonte
            document.getElementById('decrease-font').addEventListener('click', function() {
                fontSize -= 2;
                if (fontSize >= 12) {
                    document.documentElement.style.fontSize = fontSize + 'px';
                    localStorage.setItem('fontSize', fontSize);
                }
            });
            
            // Alto contraste
            document.getElementById('toggle-contrast').addEventListener('click', function() {
                isHighContrast = !isHighContrast;
                document.body.classList.toggle('high-contrast', isHighContrast);
                localStorage.setItem('highContrast', isHighContrast);
            });
            
            // Carregar preferências salvas
            const savedFontSize = localStorage.getItem('fontSize');
            if (savedFontSize) {
                fontSize = parseInt(savedFontSize);
                document.documentElement.style.fontSize = fontSize + 'px';
            }
            
            const savedContrast = localStorage.getItem('highContrast');
            if (savedContrast === 'true') {
                isHighContrast = true;
                document.body.classList.add('high-contrast');
            }
        });
    </script>
    
    <!-- Scripts Adicionais -->
    @stack('scripts')
</body>
</html>

