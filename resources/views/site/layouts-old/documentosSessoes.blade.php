<!DOCTYPE html>
<html lang="pt-br">
<br>
<br>
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
                    DOCUMENTOS DAS <span> SESSÕES</span>
                </h2>
                <hr class="lines wow zoomIn" data-wow-delay="0.3s">
                <p class="section-subtitle wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">
                    Atas, ordem do dia, editais de convocação
                </p>
            </div>

            <div class="card">
                <div class="card-header bg-transparent">
                    <form action="{{ route('documentosSessoes.pesquisar') }}" method="get">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="sessao">Tipo:</label>
                                <select class="custom-select" id="type_document_id" name="type_document_id">
                                    <option value="" selected>Selecione uma opção</option>
                                    @foreach ($tipos_documento as $tipo)
                                        <option value="{{ $tipo->id }}"
                                            {{ request()->query('type_document_id') == $tipo->id ? 'selected' : '' }}>

                                            {{ $tipo->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                           
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="data_inicio" >Data Início:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                      </div>
                                      <input type="date" class="form-control" 
                                          id="data_inicio" name="data_inicio"
                                          value="">
                                     </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="data_fim" >Data Fim:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                      </div>
                                      <input type="date" class="form-control " 
                                          id="data_fim" name="data_fim"
                                          value="">
                                    
                                  </div>
                                </div>
                            </div>                         
                                                  
                           <div class="col-sm-3 text-right">
                                <br>
                                <button class="btn btn-primary text-right" type="submit">
                                    <i class="fas fa-filter"></i>
                                    Filtrar</button>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="card-body  p-0">
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">Data Públicação</th>
                            <th scope="col">Arquivo</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Sessão</th>
                          
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($anexos_ordem_dia as $anexo)
                        <tr>
                            <th scope="row">{{\Carbon\Carbon::parse($anexo->created_at)->format('d/m/Y')}}</th>
                            <td> <a href="{{config('app.aws_url')."{$anexo->anexo}" }}" 
                                target="_blank" class="mb-2 text-reset"
                                data-toggle="tooltip" data-placement="top" 
                                    title="Clique para abrir o documento" >
                                  <i class="far fa-file-pdf fa-2x text-danger mr-2"></i>
                                  <span class="mr-2"> {{$anexo->nome_original}}</span>                
                              </a></td>
                            <td>{{$anexo->type_document->nome}}</td>
                            <td>{{$anexo->descricao}}</td>
                            <td>{{$anexo->session->nome}} - {{$anexo->session->legislature->descricao}}</td>
                            
                          </tr>
                        @endforeach
                        
                        </tbody>
                      </table>

                   



                </div>
                <div class="card-footer" style="background:white;">
                    @if (!empty($filters))
                    {!!$anexos_ordem_dia->appends($filters)->links()!!}
                    @else
                    {!!$anexos_ordem_dia->links()!!}
                    @endif
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
