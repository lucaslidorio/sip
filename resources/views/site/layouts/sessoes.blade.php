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
                    <span> Sessões</span>
                </h2>
                <hr class="lines wow zoomIn" data-wow-delay="0.3s">
                <p class="section-subtitle wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">
                    Sessões Ordinárias, Extraodinárias e Solene
                </p>
            </div>

            <div class="card">
                <div class="card-header bg-transparent">
                    <form action="{{ route('sessoes.index') }}" method="get">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="sessao">Tipo:</label>
                                <select class="custom-select" id="type_session_id" name="type_session_id">
                                    <option value="" selected>Selecione uma opção</option>
                                    @foreach ($tipos_sessao as $tipo)
                                        <option value="{{ $tipo->id }}"
                                            {{ request()->query('type_session_id') == $tipo->id ? 'selected' : '' }}>

                                            {{ $tipo->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="sessao">Legislatura:</label>
                                <select class="custom-select" id="legislature_id" name="legislature_id">
                                    <option value="" selected>Selecione uma opção</option>
                                    @foreach ($legislaturas as $legislatura)
                                        <option value="{{ $legislatura->id }}"
                                            {{ request()->query('legislature_id') == $legislatura->id ? 'selected' : '' }}>
                                            {{ $legislatura->descricao }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-4 text-right">
                                <br>
                                <button class="btn btn-primary text-right" type="submit">
                                    <i class="fas fa-filter"></i>
                                    Filtrar</button>
                            </div>
                        </div>
                    </form>

                </div>




                <div class="card-body  p-0">


                    <div class="accordion" id="sessao">

                        <div class="row pl-4 font-weight-bold">
                            <div class="col-md-3">
                                <h6>Ata</h6>
                            </div>
                            <div class="col-md-3">
                                <h6>Sessão</h6>
                            </div>
                            <div class="col-md-3">
                                <h6>Legislatura</h6>
                            </div>
                            <div class="col-md-3">
                                <h6>Sessão Legislativa</h6>
                            </div>
                        </div>
                        @foreach ($sessoes as $sessao)
                            <div class="accordion-item">
                                
                              <div class="card">
                                    <div class="card-header " style="background:white;" id="headingOne">
                                        <a class="btn  btn-link btn-block text-left text-dark" type="button"
                                            data-toggle="collapse" data-target="#{{ $sessao->id }}"
                                            aria-expanded="false" aria-controls="collapseOne">
                                            <div class="row">
                                                <div class="col-3">{{ $sessao->nome }}</div>
                                                <div class="col-3 block">{{ $sessao->typeSession->nome }}</div>
                                                <div class="col-3">{{ $sessao->legislature->descricao }}</div>
                                                <div class="col-3">{{ $sessao->section->descricao }} -
                                                    {{ $sessao->section->ano }}</div>
                                            </div>
                                        </a>

                                    </div>

                                    <div id="{{ $sessao->id }}" class="collapse" aria-labelledby="headingOne"
                                        data-parent="#sessao">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="card-text"><strong>Nome: </strong>
                                                        {{ $sessao->descricao }}</p>
                                                    <p class="card-text"><strong>Tipo: </strong>
                                                        {{ $sessao->typeSession->nome }}</p>
                                                    <p class="card-text"><strong>Legislatura: </strong>
                                                        {{ $sessao->legislature->descricao }}</p>
                                                    <p class="card-text"><strong>Sessão: </strong>
                                                        {{ $sessao->section->descricao }}</p>
                                                    <p class="card-text"><strong>Descrição: </strong>
                                                        {{ $sessao->descricao }}</p>

                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="card-text"><strong>Vereadores Presentes: </strong></p>

                                                    <p>
                                                        {{-- @foreach ($sessao->councilors as $sessaoCouncilor)                                           
                          {{$sessaoCouncilor->nome}}        
                          @endforeach --}}
                                                    </p>

                                                </div>
                                            </div>
                                            <div class="row ">
                                                <div class="col-sm-12 ">
                                                    <p><strong>Anexos:</strong></p> ​
                                                    @foreach ($sessao->attachments as $attachment)

                                                        <a href="{{ config('app.aws_url') . "{$attachment->anexo}" }}"
                                                            target="_blank" class="mb-2 text-reset">
                                                            <i class="far fa-file-pdf fa-2x text-danger mr-2"></i>
                                                            <span class="mr-2"> {{ $attachment->nome_original }}</span>
                                                        </a>

                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>






                </div>
            </div>

        </div>
    </section>
    <!-- Services Section End -->
    {{-- Inicion Modal --}}
    <div class="modal fade" id="sessaoShow" tabindex="-1" aria-labelledby="sessaoShow" aria-hidden="true">
        <div class=" modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Section Start -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="social-icons">
                        <ul>
                            <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li class="pinterest"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            <li class="dribbble"><a href="#"><i class="fa fa-dribbble"></i></a></li>
                        </ul>
                    </div>
                    <div class="site-info">
                        <p>All copyrights reserved &copy; 2023 - Designed & Developed by <a rel="nofollow"
                                href="https://uideck.com">UIdeck</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

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
