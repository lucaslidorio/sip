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
    @if($tenant->brasao)
    <link rel="icon" type="image/x-icon" href="{{config('app.aws_url')."{$tenant->favicon}" }}">
    @endif
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Sistema de Cores Dinâmico -->
    @if($tenant->arquivo_cor_css === 'colors-blue.css')
        <link href="{{ asset('gov/css/colors-blue.css') }}" rel="stylesheet">
    @else
        <link href="{{ asset('gov/css/colors-green.css') }}" rel="stylesheet">
    @endif
    
    <!-- CSS Principal -->
    <link href="{{ asset('gov/css/main.css') }}" rel="stylesheet">
    
    <!-- CSS de Acessibilidade Corrigido -->
    <link href="{{ asset('gov/css/accessibility-fix.css') }}" rel="stylesheet">
    
    <!-- CSS do Menu Moderno -->
    <link href="{{ asset('gov/css/modern-menu.css') }}" rel="stylesheet">
    <link href="{{ asset('gov/css/mobile-menu-fix.css') }}" rel="stylesheet">
    <!-- CSS do Carrocel de noticias -->
    <link href="{{ asset('gov/css/hero-carousel.css') }}" rel="stylesheet">
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
                <span><i class="fas fa-clock me-1"></i> {{ now()->setTimezone('America/Porto_Velho')->format('d/m/Y H:i') }}</span>
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
                        <a href="{{route('site.index')}}" class="text-decoration-none">
                            <img src="{{config('app.aws_url')."{$tenant->brasao}" }}" class="img-fluid" alt="Logo {{ $tenant->nome }}">  
                        </a>                              
                        @else
                        <div class="header-brand-text">
                            <h1>{{ $tenant->nome }}</h1>
                            <p>{{ $tenant->slogan ?? 'Portal Oficial' }}</p>
                        </div>
                        @endif                     
                        
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
                        <a href="{{ route('site.contato') }}" class="btn btn-primary">
                            <i class="fas fa-phone me-1"></i> Contato
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

   <!-- Navegação Principal Moderna -->
    <nav class="navbar navbar-expand-lg navbar-main" id="mainNavbar">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain"
                aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav me-auto">
                    @foreach($menus as $menu)
                    @if($menu->isMegaMenu())
                    {{-- Mega Menu --}}
                    <li class="nav-item dropdown mega-menu">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            {!! $menu->getIconeHtml() !!} {{ $menu->nome }}
                        </a>
                        <div class="dropdown-menu mega-menu-content">
                            <div class="row">
                                @foreach($menu->categorias as $categoria)
                                <div class="col-md-4">
                                    <h6 style="color: {{ $categoria->cor_destaque }}" class="border-bottom border-light-subtle ">
                                        {!! $categoria->getIconeHtml() !!} {{ $categoria->nome }}
                                    </h6>
                                    @foreach($categoria->itensCategoria as $item)
                                    <a href="{{ $item->getUrlCompleta() }}" class="dropdown-item">
                                        {!! $item->getIconeHtml() !!} {{ $item->nome }}
                                    </a>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </li>
    
                    @elseif($menu->isDropdown())
                    {{-- Dropdown Tradicional --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            {!! $menu->getIconeHtml() !!} {{ $menu->nome }}
                        </a>
                        <ul class="dropdown-menu">
                            @foreach($menu->children as $submenu)
                            <li><a class="dropdown-item" href="{{ $submenu->getUrlCompleta() }}">
                                    {!! $submenu->getIconeHtml() !!} {{ $submenu->nome }}
                                </a></li>
                            @endforeach
                        </ul>
                    </li>
    
                    @else
                    {{-- Menu Simples --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ $menu->getUrlCompleta() }}">
                            {!! $menu->getIconeHtml() !!} {{ $menu->nome }}
                        </a>
                    </li>
                    @endif
                    @endforeach                          
                    
{{--                                       
                    <li class="nav-item dropdown mega-menu">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-balance-scale"></i>
                            <span>Transparência</span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="mega-menu-content">
                                <div class="mega-menu-section">
                                    <h6>Receitas e Despesas</h6>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-money-bill-wave"></i>
                                        Receitas Municipais
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-shopping-cart"></i>
                                        Despesas Públicas
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-chart-pie"></i>
                                        Execução Orçamentária
                                    </a>
                                </div>
                                <div class="mega-menu-section">
                                    <h6>Contratos e Licitações</h6>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-file-contract"></i>
                                        Contratos Vigentes
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-gavel"></i>
                                        Licitações Abertas
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-handshake"></i>
                                        Convênios
                                    </a>
                                </div>
                                <div class="mega-menu-section">
                                    <h6>Recursos Humanos</h6>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-users"></i>
                                        Servidores Públicos
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-money-check"></i>
                                        Folha de Pagamento
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-plane"></i>
                                        Diárias e Viagens
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li> --}}
                    
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-laptop"></i>
                            <span>Serviços Online</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-file-invoice"></i> Nota Fiscal Eletrônica</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-home"></i> IPTU Online</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-certificate"></i> Certidões</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-file-alt"></i> Protocolo Online</a></li>
                        </ul>
                    </li> --}}
                    
                    {{-- <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('site.agenda*') ? 'active' : '' }}" 
                           href="{{ route('site.agenda') }}">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Agenda</span>
                        </a>
                    </li> --}}
                </ul>
                
                <!-- Botões de ação no menu -->
                {{-- <div class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#contatoModal">
                            <i class="fas fa-envelope"></i>
                            <span>Contato</span>
                        </a>
                    </li>
                </div> --}}
            </div>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <main class="main-wrapper">
        <div class="content-wrapper">
            @yield('content')
        </div>
    </main>

   @include('public_templates.gov.includes.rodape')

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
    
    <!-- JavaScript de Acessibilidade Corrigido -->
    <script src="{{asset('gov/js/accessibility.js') }}"></script>
    
    <!-- JavaScript do Menu Moderno -->
    <script src="{{asset('gov/js/modern-menu.js') }}"></script>
    <!-- JavaScript do Carroce de noticias -->
    <script src="{{ asset('gov/js/hero-carousel.js') }}"></script>
    <!-- Scripts Adicionais -->
    @stack('scripts')
</body>
</html>

