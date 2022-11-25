<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Bootstrap, Landing page, Template, Registration, Landing">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Grayrids">
    @foreach ($tenants as $tenant)
    @endforeach

    <title>{{ $tenant->nome }}</title>


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('../site/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('../site/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ url('../site/css/line-icons.css') }}">
    <link rel="stylesheet" href="{{ url('../site/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ url('../site/css/owl.theme.css') }}">
    <link rel="stylesheet" href="{{ url('../site/css/nivo-lightbox.css') }}">
    <link rel="stylesheet" href="{{ url('../site/css/magnific-popup.cs') }}s">
    <link rel="stylesheet" href="{{ url('../site/css/animate.css') }}">
    <link rel="stylesheet" href="{{ url('../site/css/menu_sideslide.css') }}">
    <link rel="stylesheet" href="{{ url('../site/css/main.css') }}">
    <link rel="stylesheet" href="{{ url('../site/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ url('../site/css/lc_lightbox.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css"
        integrity="sha512-8vq2g5nHE062j3xor4XxPeZiPjmRDh6wlufQlfC6pdQ/9urJkU07NM0tEREeymP++NczacJ/Q59ul+/K2eYvcg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Color CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="{{ url('../site/css/colors/preset.css') }}" media="screen" />

</head>

<body class="container-fluid">
    @include('site.layouts.includes.menuExterno')
        <!-- Header Section Start -->

    <section id="sessoes" class="section mw-100 ">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">
                    OUVIDORIA DO PODER <span>LEGISLATIVO </span>
                </h2>
                <hr class="lines wow zoomIn" data-wow-delay="0.3s">
                <p class="section-subtitle wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">
                    OUVIDORIA
                </p>
            </div>

            <div class="card">
            </div>
            <div class="row">             
                <div id="portfolio" class="row">
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 ">
                        <div class="portfolio-item">
                            <div class="shot-item rounded-circle">
                                <a class="overlay lightbox rounded" href="{{route('ouvidoria.create', 1)}}"> {{-- 1 = Reclamação --}}                                    
                                    <div class="card ">
                                        <img class="card-img-top img-fluid"
                                            src="{{ url('../site/img/portfolio/img2.jpg') }}" alt="imagem de sugestão">
                                        <div class="card-body">
                                            <p class="font-weight-bold" style="font-size: 150%">RECLAMAÇÃO</p>
                                            <p class="card-text">Envie sua insatisfação com o serviço público.
                                                <br>&nbsp;</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 ">
                        <div class="portfolio-item">
                            <div class="shot-item rounded-circle">
                                <a class="overlay lightbox rounded" href="{{route('ouvidoria.create',2)}}">{{-- 2 = ELOGIO --}} 
                                    <div class="card ">
                                        <img class="card-img-top img-fluid"
                                            src="{{ url('../site/img/portfolio/img3.jpg') }}" alt="imagem de sugestão">
                                        <div class="card-body">
                                            <p class="font-weight-bold" style="font-size: 150%">ELOGIO</p>
                                            <p class="card-text">Expresse se você está satisfeito com o atendimento
                                                público.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 ">
                        <div class="portfolio-item">
                            <div class="shot-item rounded-circle">
                                <a class="overlay lightbox rounded" href="{{route('ouvidoria.create', 3)}}">{{--3 = SOLICITAÇÃO --}}
                                    <div class="card ">
                                        <img class="card-img-top img-fluid"
                                            src="{{ url('../site/img/portfolio/img3.jpg') }}" alt="imagem de sugestão">
                                        <div class="card-body">
                                            <p class="font-weight-bold" style="font-size: 150%">SOLICITAÇÃO</p>
                                            <p class="card-text">Peça atendimento ou uma prestação de serviço. <br>&nbsp;</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 ">
                        <div class="portfolio-item">
                            <div class="shot-item rounded-circle">
                                <a class="overlay lightbox rounded" href="{{route('ouvidoria.create', 4)}}">{{--4 = SUGESTÃO --}}
                                    <div class="card ">
                                        <img class="card-img-top img-fluid"
                                            src="{{ url('../site/img/portfolio/img1.jpg') }}" alt="imagem de sugestão">
                                        <div class="card-body">
                                            <p class="font-weight-bold" style="font-size: 150%">SUGESTÃO</p>
                                            <p class="card-text">Envie uma ideia ou proposta de melhoria dos serviços
                                                públicos.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 ">
                        <div class="portfolio-item">
                            <div class="shot-item rounded-circle">
                                <a class="overlay lightbox rounded" href="{{route('ouvidoria.create', 5)}}">{{--5 = MANIFESTAÇÃO --}}
                                    <div class="card ">
                                        <img class="card-img-top img-fluid"
                                            src="{{ url('../site/img/portfolio/img1.jpg') }}" alt="imagem de sugestão">
                                        <div class="card-body">
                                            <p class="font-weight-bold" style="font-size: 150%">MANIFESTAÇÃO</p>
                                            <p class="card-text">Consulte suas Manifestações. <br>&nbsp;</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 ">
                        <div class="portfolio-item">
                            <div class="shot-item rounded-circle">
                                <a class="overlay lightbox rounded" href="{{route('ouvidoriaSite.index')}}">
                                    <div class="card ">
                                        <img class="card-img-top img-fluid"
                                            src="{{ url('../site/img/portfolio/img1.jpg') }}" alt="imagem de sugestão">
                                        <div class="card-body">
                                            <p class="font-weight-bold" style="font-size: 150%">DÚVIDAS</p>
                                            <p class="card-text">FAQ com perguntas frequentes.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 ">
                        <div class="portfolio-item">
                            <div class="shot-item rounded-circle">
                                <a class="overlay lightbox rounded" href="{{route('ouvidoria.create', 6)}}">{{--6 = DENÚNCIA --}}
                                    <div class="card ">
                                        <img class="card-img-top img-fluid"
                                            src="{{ url('../site/img/portfolio/img1.jpg') }}" alt="imagem de sugestão">
                                        <div class="card-body">
                                            <p class="font-weight-bold" style="font-size: 150%">DENÚNCIA</p>
                                            <p class="card-text">Comunique um ato ilícito pratica por agentes públicos.
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row p-2 text-justify">
                <p>
                    A Ouvidoria Pública se apresenta como mais um dos instrumentos da democracia participativa,
                    através da  Lei nº 13.460 <a  target="__blank" href="http://www.planalto.gov.br/ccivil_03/_ato2015-2018/2017/lei/L13460.htm">clique aqui</a>  , de 26 de julho de 2017, pois é um setor da Administração 
                    que permite o diálogo entre o cidadão, usuário dos serviços públicos, e as unidades de gestão. E
                    sta mediação legitima a Ouvidoria como importante instrumento de controle social, pois a análise 
                    das manifestações recebidas serve de base para informar os gestores públicos sobre problemas e 
                    dificuldades existentes, de modo a provocar a melhoria dos serviços públicos prestados.  
                </p>
                <p>Tipos de manifestação:</p>
                <p>
                    <strong>DENÚNCIA:</strong> Se você quer comunicar a ocorrência de um ato ilícito ou uma irregularidade praticada
                    contra a administração pública. Também pode ser usada para denunciar uma violação aos direitos
                    humanos. Em alguns casos, a sua manifestação não será classificada como uma denúncia e sim uma
                    solicitação. Por exemplo, se faltam remédios em um hospital público, você poderá fazer uma 
                    solicitação para que o órgão tome uma providência. Então, não se trata de uma denúncia.  
                </p>
                <p>
                   <strong>RECLAMAÇÃO:</strong> Se você quer demonstrar a sua insatisfação com um serviço público. Você pode fazer críticas, relatar 
                   ineficiência. Também se aplica aos casos de omissão. Por exemplo, você procurou um atendimento ou serviço,
                   e não teve resposta.
                </p>
                <p>
                    <strong>SOLICITAÇÃO:</strong> Se você espera um atendimento ou a prestação de um serviço. 
                    Pode ser algo material, como receber um medicamento, ou a ação do órgão em uma situação específica. 
                    Por exemplo, se alimentos fora da validade estiverem à venda, você pode solicitar que um órgão 
                    público faça uma fiscalização.
                </p>
                <p>
                    <strong>SUGESTÃO:</strong> 
                    Se você tiver uma ideia, ou proposta de melhoria dos serviços públicos.
                </p>
                <p>
                    <strong>ELOGIO:</strong> Se você foi bem atendimento e está satisfeito com o atendimento, e / ou 
                    com o serviço que foi prestado.
                </p>
                <p class="pt-3">Consulte sua manifestação <br>
                    Se você já fez uma manifestação e guardou o número de protocolo, pode acompanhar o andamento.
                     Para isso, clique em <strong>Manifestação</strong>. 
                </p>
            </div>
        </div>


        </div>
    </section>
    <!-- Services Section End -->
    <!-- Rodapé -->
    @include('site.layouts.includes.rodape')
    <!-- Fim Rodapé -->
    <!-- Go To Top Link -->
    <a href="#" class="back-to-top">
        <i class="lnr lnr-arrow-up"></i>
    </a>

    <div id="loader">
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="../site/js/jquery-min.js"></script>
    <script src="../site/js/popper.min.js"></script>
    <script src="../site/js/bootstrap.min.js"></script>
    <script src="../site/js/classie.js"></script>
    <script src="../site/js/jquery.mixitup.js"></script>
    <script src="../site/js/nivo-lightbox.js"></script>
    <script src="../site/js/owl.carousel.js"></script>
    <script src="../site/js/jquery.stellar.min.js"></script>
    <script src="../site/js/jquery.nav.js"></script>
    <script src="../site/js/scrolling-nav.js"></script>
    <script src="../site/js/jquery.easing.min.js"></script>
    <script src="../site/js/wow.js"></script>
    <script src="../site/js/menu.js"></script>
    <script src="../site/js/jquery.counterup.min.js"></script>
    <script src="../site/js/jquery.magnific-popup.min.js"></script>
    <script src="../site/js/waypoints.min.js"></script>
    <script src="../site/js/form-validator.min.js"></script>
    <script src="../site/js/contact-form-script.js"></script>
    <script src="../site/js/main.js"></script>
    <script src="../site/js/alloy_finger.min.js"></script>
    <script src="../site/js/lc_lightbox.lite.min.js"></script>

    {{-- Scrip da galeria --}}
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()

            $('.popover-dismiss').popover({
                trigger: 'focus'
            })
        })
        lc_lightbox('.galeria_post', {
            wrap_class: 'lcl_fade_oc',
            gallery: true,
            counter: true,
            fullscreen: true,
            download: true,
        })

    </script>


</body>

</html>