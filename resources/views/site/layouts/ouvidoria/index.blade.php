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
                {{-- <div class="col-md-12">
                    <!-- Portfolio Controller/Buttons -->
                    <div class="controls text-center">
                        <a class="filter active btn btn-common" data-filter="all">
                            All
                        </a>
                        <a class="filter btn btn-common" data-filter=".design">
                            Design
                        </a>
                        <a class="filter btn btn-common" data-filter=".development">
                            Development
                        </a>
                        <a class="filter btn btn-common" data-filter=".print">
                            Print
                        </a>
                    </div>
                    <!-- Portfolio Controller/Buttons Ends-->
                </div> --}}

                <!-- Portfolio Recent Projects -->
                <div id="portfolio" class="row">
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 ">
                        <div class="portfolio-item">
                            <div class="shot-item rounded-circle">
                                <a class="overlay lightbox rounded" href="{{route('ouvidoriaSite.index')}}">
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
                                <a class="overlay lightbox rounded" href="{{route('ouvidoriaSite.index')}}">
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
                                <a class="overlay lightbox rounded" href="{{route('ouvidoriaSite.index')}}">
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
                                <a class="overlay lightbox rounded" href="{{route('ouvidoriaSite.index')}}">
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
                                <a class="overlay lightbox rounded" href="{{route('ouvidoriaSite.index')}}">
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
                                <a class="overlay lightbox rounded" href="{{route('ouvidoriaSite.index')}}">
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