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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- FullCalendar CSS -->
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
        .dropdown-menu .dropdown-item {
            white-space: nowrap;
        }
        
         /* Altera a direção do icone e adiciona estilo para setas */
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
     /* Estilos para o menu geral */
        .dropdown-menu {
             border: 1px solid #e0e0e0; /* Borda geral do menu */
            box-shadow: 0 2px 5px rgba(0,0,0,0.1); /* Sombra sutil */
        }
        .dropdown-menu li {
            display: block;
            position: relative;
        }
         .dropdown-menu li > a.dropdown-item {
             color: #333; /* Cor do texto dos itens do menu */
             padding: 8px 15px; /* Espaçamento dos itens do menu */
             display: inline-block; /* Faz o link ter o tamanho do texto*/
             position: relative;
              margin: 0;
              width: auto;
             white-space: nowrap;
           z-index: 1;
        }
        .dropdown-menu li::before {
            content: "";
            position: absolute;
            top:0;
            left:0;
            width: 100%;
            height: 100%;
             background-color: transparent;
           z-index: 0;
          }
       .dropdown-menu li > a.dropdown-item:hover,
        .dropdown-menu li > a.dropdown-item:focus,
        .dropdown-menu li > a.dropdown-item.show{
            background-color: #ebe6e6; /* Cor de fundo ao passar o mouse */
        }
         .dropdown-menu .dropdown-divider { /* Divisor entre seções do menu */
           border-top: 1px solid #ddd;
           margin: 5px 0;
        }
        .dropdown-menu .dropdown-item i {
          margin-right: 5px; /* Espaço entre o ícone e o texto*/
       }
 </style>

</head>

<body>
    <header class="header-tudo">
        <div class="header-top" style="text-align: center;">
            <nav class="container nav_menu hidden-xs ">
                <ul class="lista1 list-inline pull-right tamanho_fontes">
                    <li>
                        <form class="d-flex" action="{{ route('site.pesquisar') }}" method="get">
                            <input class="form-control input-limited"  name="pesquisar" type="search" placeholder="Pesquisar"
                                aria-label="Search">
                            <button type="submit" class="btn " style="color: white;">
                                <span class="glyphicon glyphicon-search"><i class="fa fa-search fa-lg"></i></span>
                            </button>
                        </form>
                    </li>

                    <li>
                        <a target="_blank" href="sitemap" accesskey="6">
                            <i class="fa fa-sitemap" aria-hidden="true"></i>
                            Mapa do site
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="https://www.gov.br/governodigital/pt-br/vlibras/">
                            <i class="fa fa-external-link" aria-hidden="true"></i>
                            VLibras
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="https://www.teixeiropolis.ro.gov.br/feed" accesskey="6">
                            <i class="fa fa-rss" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>

                <ul class="list-inline pull-left">
                    <li>
                        <a href="#conteudo-pagina" accesskey="c"><strong>1</strong> Conteúdo</a>
                    </li>

                    <li>
                        <a href="#menu-topo-site" accesskey="m"><strong>2</strong> Menu</a>
                    </li>

                    <li>
                        <a href="{{route('site.acessibilidade')}}" accesskey="a"><strong>3</strong>
                            Acessibilidade</a>
                    </li>

                    <li class="tamanho_fontes">
                        <a onclick="aumentarFonte()" href="#" accesskey="x">
                            <i class="fa fa-plus-square-o"></i>
                            +
                        </a>

                        <a onclick="diminuirFonte()" href="#" accesskey="y">
                            <i class="fa fa-minus-square-o"></i>
                            -
                        </a>

                        <a onclick="toggleDarkMode()" href="#" accesskey="b">
                            <i class="fas fa-adjust"></i>
                        </a>
                    </li>
                </ul>
            </nav>             
            @include('public_templates.leg.includes.menu')
        </div>
        <!-- container topo - image prefeitura -->
        <div class="container ">
            <a href="{{route('site.index')}}" class="text-decoration-none text-reset">
            <div class="row">
                <div class="col-12 text-center" style="padding-top: 5px;">
                
                    <img src="{{config('app.aws_url')."{$tenant->brasao}" }} "alt="" width="70%" height="70%">
              
                </div>
            </div>
        </a>
        </div>
    </header>
    <div class="row">
        <div class="col-12">
            <div class="cor-padrao-bg" style="height: 5px;"></div>
        </div>
    </div>   

    @yield('content')
  
    @include('public_templates.leg.includes.footer')   

    <!-- Plugin libras -->
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>
    <script src="{{asset('leg/js/commons.min.js')}}"></script>
    <script src="{{asset('leg/js/slick.min.js')}}"></script>
    <script src="{{asset('leg/js/vlibras-plugin.js')}}"></script>
    <script src="{{asset('leg/js/main.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   <!-- FullCalendar JS -->
   <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
  
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
    
     <!-- glightbox JS -->
            
   </body>

</html>