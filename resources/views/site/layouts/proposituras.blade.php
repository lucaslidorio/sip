<!DOCTYPE html>
<html lang="pt-br">
<br><br>
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
                    PROPOSITURAS DOS PODER <span>LEGISLATIVO </span>
                </h2>
                <hr class="lines wow zoomIn" data-wow-delay="0.3s">
                <p class="section-subtitle wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">
                    Indicações, moções, pareceres, projetos de leis, etc...
                </p>
            </div>

            <div class="card">
                <div class="card-header bg-transparent">
                    <form action="{{ route('proposituraPesquisar.pesquisar') }}" method="get">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="sessao">Tipo de Documento:</label>
                                <select class="custom-select " id="type_proposition_id" name="type_proposition_id">
                                    <option value="" selected>Selecione uma opção</option>
                                    @foreach ($tipos_propositura as $tipo)
                                        <option value="{{ $tipo->id }}"
                                            {{ request()->query('type_proposition_id') == $tipo->id ? 'selected' : '' }}>

                                            {{ $tipo->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                           
                            <div class="col-md-3">
                                <label for="sessao">Situação:</label>
                                <select class="custom-select" id="proceeding_situation_id" name="proceeding_situation_id">
                                    <option value="" selected>Selecione uma opção</option>
                                    @foreach ($situacoes as $situacao)
                                        <option value="{{ $situacao->id }}"
                                            {{ request()->query('proceeding_situation_id') == $situacao->id ? 'selected' : '' }}>

                                            {{ $situacao->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="ano">Ano:</label>
                                <select class="custom-select" id="ano" name="ano">
                                    <option value="" selected >Ano</option> 
                                    <option value="2018" {{ request()->query('ano') == '2018' ? 'selected': ''}}>2018 </option> 
                                    <option value="2019" {{ request()->query('ano') == '2019' ? 'selected': ''}}>2019 </option>                       
                                    <option value="2020" {{ request()->query('ano') == '2020' ? 'selected': ''}}>2020 </option> 
                                    <option value="2021" {{ request()->query('ano') == '2021' ? 'selected': ''}}>2021 </option>  
                                    <option value="2022" {{ request()->query('ano') == '2022' ? 'selected': ''}}>2022 </option>  
                                    <option value="2023" {{ request()->query('ano') == '2023' ? 'selected': ''}}>2023 </option>  
                                    <option value="2024" {{ request()->query('ano') == '2024' ? 'selected': ''}}>2024 </option>                              
                                </select>
                               
                            </div> 
                            <div class="col-sm-6 col-md-3 ">
                                <label for="ordenacao">Ordenar por:</label>
                                <select class="custom-select" id="ordenacao" name="ordenacao">
                                    <option value="" selected >Nenhum</option> 
                                    <option value="ASC" {{ request()->query('ordenacao') == 'ASC' ? 'selected': ''}} >Número crescente </option> 
                                    <option value="DESC" {{ request()->query('ordenacao') == 'DESC' ? 'selected': ''}}>Número decrescente </option>                       
                                                           
                                </select>
                               
                            </div> 
                        </div>
                        <div class="row ">
                            <div class="col-sm-12 text-right pt-2 pr-3">                                
                                <button class="btn btn-primary text-right" type="submit">
                                    <i class="fas fa-filter"></i>
                                    Filtrar</button>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="card-body  p-0 table-bordered">
                    <div class="table-responsive">
                    <table class="table table-hover ">
                        <thead>
                          <tr>
                            <th scope="col">Número</th>
                            <th scope="col">Data</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Situação</th>
                            <th scope="col" class="text-center">Ações</th>                                          
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($proposituras as $propositura)
                        <tr>
                            <th scope="row">{{$propositura->numero}}</th>
                            <td>{{\Carbon\Carbon::parse($propositura->data)->format('d/m/Y')}}</td>
                            <td>{{$propositura->type_proposition->nome}}</td>
                            <td>{{$propositura->descricao}}</td>
                            <td>
                                <span class="badge badge-pill badge-primary">{{$propositura->situation->nome}}</span>
                                
                            </td>
                            <td class="text-center">
                                <a href="{{route('propositura.show', $propositura->id)}}" data-id=""
                                class="btn  btn-info  " data-toggle="tooltip" data-placement="top"  
                                title="Ver Detalhes">
                                <i class="far fa-eye "> Abrir</i>
                              </a>
                            </td>
                          
                          </tr>
                        @endforeach
                        
                        </tbody>
                      </table>
                    </div>

                </div>
                <div class="card-footer" style="background:white;">
                    @if (!empty($filters))
                    {!!$proposituras->appends($filters)->links()!!}
                    @else
                    {!!$proposituras->links()!!}
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
