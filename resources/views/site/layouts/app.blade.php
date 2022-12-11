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
  <link rel="shortcut icon" href="./faveiconcms.ico" type="image/x-icon">
  <title>{{$tenant->nome}}</title>
  @include('site.layouts.css')
  
</head>

<body>
  {{-- Loop para para mostra a legislatura atual --}}
  @foreach ($legislatures as $legislature)

  @endforeach
  @include('sweetalert::alert')
  <!-- Header Section Start -->
  <header id="slider-area">
    <!-- Menu-->
    <div class="container">
      @include('site.layouts.includes.menu')
    </div>
   
    <!-- Fim Menu -->
    <div class="row">
      <hr>
     
    </div>
    <div class="container    mt-5 pt-2 " >
      <div class="row pt-3">
        <div class="col-sm-12 col-md-6 col-lg-6  shadow-sm p-3 mb-2 bg-white rounded">
          @include('site.layouts.includes.slide')
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
          <div class="row">
            <div class="col-md-4 col-sm-6">
              <a target="__blank" href="https://transparencia.seringueiras.ro.leg.br/portaltransparencia/esic" class="text-decoration-none">
                <div class="item-boxes wow fadeInDown" data-wow-delay="0.2s">
                  <div class="icon border-warning">
                    <img class="card-img-top img-fluid"
                    src="{{ url('../site/img/portfolio/informacao-ico.png') }}" alt="imagem de sugestão">
                  </div>
                  <h4 class="font-weight-bold text-dark" >E-Sic</h4>
                  <p class="text-dark">Acesso a informação </p>
                  
                </div>
              </a>
              </div>
              <div class="col-md-4 col-sm-6">
                <a  href="{{route('ouvidoriaSite.index')}}" class="text-decoration-none">
                  <div class="item-boxes wow fadeInDown" data-wow-delay="0.2s">
                    <span class="icon border-info">
                      <i class="fas fa-phone text-info"></i>
                    </span>
                    <h4 class="font-weight-bold text-dark" >Ouvidoria</h4></h4>
                    <p class="text-dark">Reclamação, Sugestão, Solicitação etc... </p>
                    
                  </div>
                </a>
                </div>
                <div class="col-md-4 col-sm-6">
                  <a target="_blank" href="https://www.planalto.gov.br/ccivil_03/_ato2011-2014/2011/lei/l12527.htm" class="text-decoration-none">
                    <div class="item-boxes wow fadeInDown" data-wow-delay="0.2s">
                      <span class="icon">
                        <i class="fas fa-balance-scale"></i>
                      </span>
                      <h4 class="font-weight-bold text-dark" >LAI</h4></h4>
                      <p class="text-dark">Reclamação, Sugestão, Solicitação etc... </p>
                      
                    </div>
                  </a>
                  </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-12">
              <h6 class="text-center"><u>SIGA - NOS NAS REDES SOCIAIS</u></h6>              
            </div>
          </div>
          <div class="row">
            <div class="col-4"></div>
            <div class="social-icons border">
              <ul>
                <li class="facebook"><a  target="_blank" href="https://www.facebook.com/camara.seringueiras"><i class="fab fa-facebook"></i></a></li>
              </ul>
            </div>
          </div>
          
        </div>
      </div>  
    </div>
    
  </header>
  <!--Section Legislacao -->
  
  @include('site.layouts.includes.legislacao')
  
 
  @include('site.layouts.includes.institucional')
  <!-- Features Section Start -->
  
  <!-- Features Section End -->

  <!-- Start Video promo Section -->

  <!-- End Video Promo Section -->

  @include('site.layouts.includes.sobre')

  <!-- Start Pricing Table Section -->
  
  <!-- End Pricing Table Section -->

  <!-- Counter Section Start -->
  @include('site.layouts.includes.contagem')
  <!-- Counter Section End -->

  <!-- testimonial Section Start -->
  
  <!-- testimonial Section Start -->

  <!-- Download Section Start -->
  
  <!-- Download Section End -->

  <!-- Team section Start -->
  @include('site.layouts.includes.vereadores')
  <!-- Team section End -->

  <!-- Clients Section -->
  
  <!-- Client Section End -->

  <!-- Blog Section -->
  @include('site.layouts.includes.noticias')
  <!-- blog Section End -->

  <!-- Contact Section Start -->
  @include('site.layouts.includes.contato')
  <!-- Contact Section End -->

  <!-- Subcribe Section Start -->

  <!-- Subcribe Section End -->
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
  <script src="site/js/jquery-min.js"></script>
  <script src="site/js/popper.min.js"></script>
  <script src="site/js/bootstrap.min.js"></script>
  <script src="site/js/classie.js"></script>
  <script src="site/js/jquery.mixitup.js"></script>
  <script src="site/js/nivo-lightbox.js"></script>
  <script src="site/js/owl.carousel.js"></script>
  <script src="site/js/jquery.stellar.min.js"></script>
  <script src="site/js/jquery.nav.js"></script>
  <script src="site/js/scrolling-nav.js"></script>
  <script src="site/js/jquery.easing.min.js"></script>
  <script src="site/js/wow.js"></script>
  <script src="site/js/menu.js"></script>
  <script src="site/js/jquery.counterup.min.js"></script>
  <script src="site/js/jquery.magnific-popup.min.js"></script>
  <script src="site/js/waypoints.min.js"></script>
  <script src="site/js/form-validator.min.js"></script>
  <script src="site/js/contact-form-script.js"></script>
  <script src="site/js/main.js"></script>
  

</body>

</html>