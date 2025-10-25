<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{$tenant->nome}}">
    <title>{{$tenant->nome}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon.ico">
    
    <link rel="stylesheet" href="{{asset('leg/css/css.css')}}">
    <link rel="stylesheet" href="{{asset('leg/css/settings.css')}}">
    <link rel="stylesheet" href="{{asset('leg/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('leg/css/slick-theme.css')}}"> 
    <link rel="stylesheet" href="{{asset('dashboard/css/fullcalendar/main.css') }}">   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
    
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{$tenant->nome}}">
    <meta property="og:description" content="{{$tenant->nome}}">
    <meta property="og:url" content="{{ config('app.secure_url') }}">
    <meta property="og:site_name" content="{{$tenant->nome}}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:description" content="{{$tenant->nome}}">
    <meta name="twitter:title" content="{{$tenant->nome}}">
    <meta name="twitter:site" content="{{ config('app.secure_url') }}">

    <style>
        /* Ajustes de fonte para todo o site */
        body {
            font-size: 14px;
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }
        
        /* Dropdown menu estilizado */
        .dropdown-menu .dropdown-item {
            white-space: nowrap;
            font-size: 16px !important; /* Forçar tamanho maior */
            padding: 12px 20px !important; /* Padding maior */
        }
        
        .dropdown-item.dropdown-toggle::after {
            display: inline-block;
            margin-left: 0.255em;
            vertical-align: 0.255em;
            content: "";
            border-top: .3em solid transparent;
            border-right: 0 solid transparent;
            border-bottom: .3em solid transparent;
            border-left: .3em solid;
        }
        
        .dropdown-menu {
            border: 1px solid #e0e0e0;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            background-color: white !important;
            margin-top: 0 !important;
            border-radius: 0;
            min-width: 240px; /* Menu mais largo */
            opacity: 0;
            visibility: hidden;
            display: block !important;
            transform: translateY(10px);
            transition: all 0.25s ease-out;
        }
        
        .dropdown:hover > .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .dropdown-menu li {
            position: relative;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        
        .dropdown-menu li:last-child {
            border-bottom: none;
        }
        
        .dropdown-menu li > a.dropdown-item {
            color: #333 !important;
            display: block;
            width: 100%;
            font-size: 16px !important;
            transition: all 0.2s ease;
            position: relative;
            font-weight: 400;
        }
        
        .dropdown-menu li > a.dropdown-item:hover,
        .dropdown-menu li > a.dropdown-item:focus {
            background-color: #f5f5f5 !important;
            color: #004a9f !important;
            transform: translateX(5px);
        }
        
        .dropdown-menu .dropdown-item i {
            margin-right: 10px;
            font-size: 18px;
            width: 20px;
            text-align: center;
            color: #004a9f;
        }
        
        /* Navbar principal */
        .navbar {
            padding: 0;
        }
        
        .navbar-nav .nav-link {
            padding: 1.2rem 1.5rem !important;
            font-size: 18px !important; /* Fonte maior */
            font-weight: 500;
            position: relative;
            transition: all 0.3s ease;
        }
        
        #menu-principal {
            background-color: #004a9f;
            color: white;
        }
        
        #menu-principal .nav-link {
            color: white !important;
        }
        
        /* Efeito hover elegante para links do menu principal */
        #menu-principal .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            bottom: 0;
            left: 50%;
            background-color: #ffffff;
            transition: all 0.3s ease;
        }
        
        #menu-principal .nav-link:hover::after,
        #menu-principal .nav-item:hover > .nav-link::after {
            width: 100%;
            left: 0;
        }
        
        #menu-principal .nav-link:hover,
        #menu-principal .nav-item:hover > .nav-link {
            background-color: rgba(255,255,255,0.1);
        }
        
        .header-top {
            background-color: #003366;
            color: white;
            padding: 8px 0;
            font-size: 14px;
        }
        
        .header-top a {
            color: white;
            text-decoration: none;
        }
        
        .header-middle {
            padding: 1.5rem 0;
        }
        
        .selos-transparencia img {
            transition: transform 0.3s ease;
            max-height: 90px !important; /* Aumentando de 70px para 90px */
            margin-right: 15px;
            margin-bottom: 10px;
        }
        
        /* Remove efeitos indesejados no link do brasão */
        .brasao-link {
            display: inline-block;
            background-color: transparent !important;
            box-shadow: none !important;
            transition: none !important;
        }

        .brasao-link:hover {
            transform: none !important;
            box-shadow: none !important;
            background-color: transparent !important;
        }
        
        /* Remover o efeito de barra inferior no hover do brasão */
        .brasao-link::after {
            display: none !important; /* Remover completamente o pseudo-elemento */
        }
        
        /* Aumentar o tamanho da imagem do brasão */
        .brasao-link img {
            max-width: 85% !important; /* Aumentando de 70% para 85% */
        }
        
        /* Campo de pesquisa maior */
        .header-top .form-control {
            min-width: 200px; /* Largura mínima */
            height: 38px;     /* Altura aumentada */
            font-size: 14px;  /* Tamanho da fonte */
        }

        .header-top .btn {
            height: 38px;     /* Altura igual ao input */
            padding-left: 12px;
            padding-right: 12px;
        }
        
        /* Responsividade */
        @media (max-width: 991.98px) {
            .navbar-nav .dropdown-menu {
                display: none !important;
                opacity: 1;
                visibility: visible;
                transform: none;
                transition: none;
                background-color: rgba(255,255,255,0.95) !important; /* Fundo branco mais sólido */
                border: none;
                border-radius: 0;
                margin: 0;
                padding: 0;
            }
            
            .navbar-nav .dropdown-menu.show {
                display: block !important;
            }
            
            /* Corrigindo as cores dos itens de dropdown no mobile */
            .navbar-nav .dropdown-menu .dropdown-item {
                color: #333 !important; /* Texto escuro para melhor legibilidade */
                padding: 10px 15px 10px 25px !important; /* Padding à esquerda maior para indicar hierarquia */
                border-left: 3px solid #004a9f; /* Borda à esquerda para indicar que é um subitem */
            }
            
            .navbar-nav .dropdown-menu .dropdown-item:hover,
            .navbar-nav .dropdown-menu .dropdown-item:focus {
                background-color: rgba(0,74,159,0.1) !important; /* Azul claro no hover */
                color: #004a9f !important;
            }
            
            /* Ajustes para ícones no menu mobile */
            .navbar-nav .dropdown-menu .dropdown-item i {
                color: #004a9f !important;
                font-size: 16px;
            }
            
            /* Tamanhos de fonte no menu mobile */
            .navbar-nav .nav-link {
                padding: 12px 15px !important;
                font-size: 16px !important;
                border-bottom: 1px solid rgba(255,255,255,0.1);
            }
            
            /* Estilo para o botão do menu mobile */
            .navbar-toggler {
                padding: 10px 15px;
                color: white !important;
                border-color: rgba(255,255,255,0.5) !important;
                margin: 5px 0;
            }
            
            /* Removendo os efeitos que não funcionam bem em mobile */
            #menu-principal .nav-link::after {
                display: none;
            }
            
            /* Ajuste para os botões no menu mobile */
            #menu-principal .d-flex {
                flex-direction: column;
                width: 100%;
                padding-top: 10px;
                border-top: 1px solid rgba(255,255,255,0.1);
                margin-top: 10px;
            }
            
            #menu-principal .btn {
                margin-bottom: 10px;
                width: 100%;
                text-align: left;
            }
        }
        
        /* Botões no menu */
        #menu-principal .btn {
            font-size: 18px !important;
            padding: 0.75rem 1.25rem !important;
            font-weight: 500;
            transition: all 0.3s ease;
            color: white !important;
            border-color: rgba(255,255,255,0.5) !important;
        }
        
        #menu-principal .btn:hover {
            transform: translateY(-2px);
            background-color: rgba(255,255,255,0.1) !important;
            color: white !important;
            border-color: white !important;
        }
        
        #menu-principal .btn:focus,
        #menu-principal .btn:active {
            color: white !important;
            background-color: rgba(255,255,255,0.15) !important;
            border-color: white !important;
        }
        
        /* Animação para menu de acesso rápido */
        .acesso-rapido .btn {
            transform: translateY(0);
            transition: all 0.3s ease;
        }
        
        .acesso-rapido .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        /* Alterações para o Logo e Selos de Transparência */
        .brasao-link {
            display: inline-block;
            position: relative;
        }
        
        .brasao-link::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 3px;
            bottom: -5px;
            left: 0;
            background-color: #004a9f;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }
        
        .brasao-link:hover::after {
            transform: scaleX(1);
        }
    </style>
</head>

<body>
    <!-- Header completo -->
    <header>
        <!-- Barra de acessibilidade -->
        <div class="header-top">
            <div class="container">
                <div class="row align-items-center"> <!-- Adicionado align-items-center aqui -->
                    <div class="col-md-4">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <a href="#conteudo-pagina" accesskey="c"><strong>1</strong> Conteúdo</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#menu-principal" accesskey="m"><strong>2</strong> Menu</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="{{route('site.acessibilidade')}}" accesskey="a"><strong>3</strong>
                                    Acessibilidade</a>
                            </li>
                            <li class="list-inline-item">
                                <a onclick="aumentarFonte()" href="#" accesskey="x">
                                    <i class="fa fa-plus-square-o"></i> +
                                </a>
                                <a onclick="diminuirFonte()" href="#" accesskey="y">
                                    <i class="fa fa-minus-square-o"></i> -
                                </a>
                                <a onclick="toggleDarkMode()" href="#" accesskey="b">
                                    <i class="fas fa-adjust"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-md-end align-items-center"> <!-- Adicionado align-items-center aqui -->
                            <form class="d-flex me-2" action="{{ route('site.pesquisar') }}" method="get">
                                <input class="form-control" name="pesquisar" type="search" 
                                    placeholder="Pesquisar" aria-label="Search">
                                <button type="submit" class="btn" style="color: white; background-color: rgba(255,255,255,0.1);">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <a href="{{route('site.mapa')}}" accesskey="6">
                                        <i class="fa fa-sitemap" aria-hidden="true"></i>
                                        <span class="d-none d-md-inline">Mapa do site</span>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a target="_blank" href="https://www.gov.br/governodigital/pt-br/vlibras/">
                                        <i class="fa fa-sign-language" aria-hidden="true"></i>
                                        <span class="d-none d-md-inline">VLibras</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="header-info">
                            <span><i class="fas fa-clock me-1"></i> {{ now()->setTimezone('America/Porto_Velho')->format('d/m/Y H:i') }}</span>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Logo e Selos de Transparência -->
        <div class="header-middle">
            <div class="container  ">
                <div class="row align-items-center ">
                    <div class="col-md-6 text-center text-md-start">                
                        <a href="{{route('site.index')}}" class="text-decoration-none brasao-link">
                            <img src="{{config('app.aws_url')."{$tenant->brasao}" }}" 
                                alt="Brasão {{ $tenant->nome }}" class="img-fluid" style="max-width: 70%;">
                        </a>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="selos-transparencia d-flex flex-wrap justify-content-center justify-content-md-end">
                            @foreach($selosTransparencia as $selo)                                
                                    <img src="{{ config('app.aws_url').$selo->anexo }}" alt="{{ $selo->nome_original }}"
                                        class="img-fluid" style="max-height: 70px;">                                
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                    @include('components.visitor-number-simple')
                </div>
            </div>
        </div>
        
        <!-- Menu Principal -->
        <nav class="navbar navbar-expand-lg" id="menu-principal">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMainMenu" 
                    aria-controls="navbarMainMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i> Menu
                </button>
                
                <div class="collapse navbar-collapse" id="navbarMainMenu">
                    <!-- Menu implementado diretamente -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @foreach($menus as $menu)
                            @if($menu->posicao == 1)
                                <li class="nav-item {{ $menu->children->count() > 0 ? 'dropdown' : '' }}">
                                    @if($menu->children->count() > 0)
                                        <a class="nav-link dropdown-toggle" href="#" id="dropdown-{{ $menu->id }}" role="button" 
                                           data-bs-toggle="dropdown" aria-expanded="false">
                                            @if($menu->icone)
                                                <i class="{{ $menu->icone }}"></i>
                                            @endif
                                            {{ $menu->nome }}
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdown-{{ $menu->id }}">
                                            @foreach($menu->children as $submenu)
                                                <li>
                                                    @if($submenu->pagina_interna == 1 && $submenu->url == null)
                                                        <a class="dropdown-item" href="{{ route('pagina', $submenu->slug) }}">
                                                            @if($submenu->icone)
                                                                <i class="{{ $submenu->icone }}"></i>
                                                            @endif
                                                            {{ $submenu->nome }}
                                                        </a>
                                                    @elseif($submenu->pagina_interna == 1 && $submenu->url != null)
                                                        <a class="dropdown-item" href="{{ route($submenu->url) }}">
                                                            @if($submenu->icone)
                                                                <i class="{{ $submenu->icone }}"></i>
                                                            @endif
                                                            {{ $submenu->nome }}
                                                        </a>
                                                    @else
                                                        <a class="dropdown-item" href="{{ $submenu->url }}"
                                                           target="{{ $submenu->target ? '_blank' : '_self' }}">
                                                            @if($submenu->icone)
                                                                <i class="{{ $submenu->icone }}"></i>
                                                            @endif
                                                            {{ $submenu->nome }}
                                                        </a>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        @if($menu->pagina_interna == 1 && $menu->url == null)
                                            <a class="nav-link" href="{{ route('pagina', $menu->slug) }}">
                                                @if($menu->icone)
                                                    <i class="{{ $menu->icone }}"></i>
                                                @endif
                                                {{ $menu->nome }}
                                            </a>
                                        @elseif($menu->pagina_interna == 1 && $menu->url != null)
                                            <a class="nav-link" href="{{ route($menu->url) }}">
                                                @if($menu->icone)
                                                    <i class="{{ $menu->icone }}"></i>
                                                @endif
                                                {{ $menu->nome }}
                                            </a>
                                        @else
                                            <a class="nav-link" href="{{ $menu->url }}" 
                                               target="{{ $menu->target ? '_blank' : '_self' }}">
                                                @if($menu->icone)
                                                    <i class="{{ $menu->icone }}"></i>
                                                @endif
                                                {{ $menu->nome }}
                                            </a>
                                        @endif
                                    @endif
                                </li>
                            @endif
                        @endforeach
                    </ul>

                    <!-- Botões de acesso rápido do lado direito do menu (opcional) -->
                    <div class="d-flex align-items-center">
                        <a href="{{ route('site.contato') }}" class="btn btn-outline-light me-2" 
                           style="font-size: 18px; font-weight: 500; color: white !important; padding: 0.75rem 1.25rem; border-color: rgba(255,255,255,0.5);">
                            <i class="fas fa-envelope me-1"></i> Contato
                        </a>                       
                    </div>
                </div>
            </div>
        </nav>
        
        <!-- Linha decorativa -->
        <div class="cor-padrao-bg" style="height: 5px;"></div>
    </header>

    <!-- Conteúdo principal -->
    <main id="conteudo-pagina">
        @yield('content')
    </main>
  
    <!-- Rodapé -->
    @include('public_templates.leg.includes.footer')   

    <!-- Plugin libras -->
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{asset('leg/js/commons.min.js')}}"></script>
    <script src="{{asset('leg/js/slick.min.js')}}"></script>
    <script src="{{asset('leg/js/vlibras-plugin.js')}}"></script>
    <script src="{{asset('leg/js/main.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Script para inicializar os dropdowns multinível -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializa todos os dropdowns
            var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
            var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
                return new bootstrap.Dropdown(dropdownToggleEl)
            });
            
            // Expande submenus ao passar o mouse (apenas em desktop)
            if (window.innerWidth > 992) {
                document.querySelectorAll('.navbar .dropdown').forEach(function(dropdown) {
                    dropdown.addEventListener('mouseover', function() {
                        if (!this.classList.contains('show')) {
                            var dropdownToggle = this.querySelector('.dropdown-toggle');
                            var dropdownInstance = bootstrap.Dropdown.getInstance(dropdownToggle);
                            if (dropdownInstance) dropdownInstance.show();
                        }
                    });
                    
                    dropdown.addEventListener('mouseout', function() {
                        if (this.classList.contains('show')) {
                            var dropdownToggle = this.querySelector('.dropdown-toggle');
                            var dropdownInstance = bootstrap.Dropdown.getInstance(dropdownToggle);
                            if (dropdownInstance) dropdownInstance.hide();
                        }
                    });
                });
            }
        });
    </script>
</body>
</html>