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
                <div class=" col-xs-12 col-md-6 col-lg-3">
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
                <div class="col-md-6 col-lg-4">
                    <div class="header-search">
                        <form method="GET" action="{{ route('pesquisar') }}" class="search-container">
                            <div class="input-group">
                                <input type="text" 
                                    name="pesquisar" 
                                    class="form-control" 
                                    placeholder="Pesquisar no site..." 
                                    autocomplete="off">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="col-xs-12 col-md-6 col-lg-3 pt-2 pt-sm-0">
                    <div class="header-actions">
                        <a href="{{ route('site.agenda') }}" class="btn btn-outline-primary">
                            <i class="fas fa-calendar me-1"></i> Agenda
                        </a>
                        <a href="{{ route('site.contato') }}" class="btn btn-primary">
                            <i class="fas fa-phone me-1"></i> Contato
                        </a>
                    </div>
                </div>
                <div class="d-none d-md-block col-md-3 col-lg-2 text-end">
                    <div class="header-actions">
                       @foreach($selosTransparencia as $selo)                    
                        <img src="{{ config('app.aws_url').$selo->anexo }}" alt="{{ $selo->nome_original }}"
                            class="img-fluid mb-2" style="max-height: 80px; margin-right: 10px;">
                    
                       @endforeach
                    </div>
                </div>
            </div>
            <div >               
                    @include('components.visitor-number-simple')                
            </div>
        </div>
    </header>

   <!-- Navegação Principal Moderna -->
    @include('public_templates.gov.includes.menu')

    <!-- Conteúdo Principal -->
    <main class="main-wrapper">
        <div class="content-wrapper">
            @yield('content')
        </div>

    </main>
   @include('public_templates.gov.includes.redes-sociais-flutuante')
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
    <script src="{{ asset('gov/js/copy-to-clipboard.js') }}"></script>
    <!-- Scripts Adicionais -->
    @stack('scripts')
</body>
</html>

