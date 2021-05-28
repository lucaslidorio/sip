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
    <title>{{$tenant->nome}}</title>
   

    <!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{url('../site/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{url('../site/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{url('../site/css/line-icons.css')}}">
<link rel="stylesheet" href="{{url('../site/css/owl.carousel.css')}}">
<link rel="stylesheet" href="{{url('../site/css/owl.theme.css')}}">
<link rel="stylesheet" href="{{url('../site/css/nivo-lightbox.css')}}">
<link rel="stylesheet" href="{{url('../site/css/magnific-popup.cs')}}s">
<link rel="stylesheet" href="{{url('../site/css/animate.css')}}">
<link rel="stylesheet" href="{{url('../site/css/menu_sideslide.css')}}">
<link rel="stylesheet" href="{{url('../site/css/main.css')}}">
<link rel="stylesheet" href="{{url('../site/css/responsive.css')}}">
<link rel="stylesheet" href="{{url('../site/css/lc_lightbox.min.css')}}">


<!-- Color CSS Styles  -->
<link rel="stylesheet" type="text/css" href="{{url('../site/css/colors/preset.css')}}" media="screen" />

  </head>
  <body>
    @include('site.layouts.includes.menuExterno')
    <!-- Header Section Start -->
    
    <section id="legislacao" class="section">
      <div class="container">
        <div class="section-header">
          <h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">
            Atas<span> Públicas</span></h2>
          <hr class="lines wow zoomIn" data-wow-delay="0.3s">
          <p class="section-subtitle wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">
            Atas das Sessões Ordinárias, Extraodinárias, Solene e Audiências Públicas
          </p>
        </div>
        <div class="row align-items-center ">
    
        </div>
       
      </div>
    </section>
    <!-- Services Section End -->
 
  
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
     lc_lightbox('.galeria_post', {
       wrap_class:'lcl_fade_oc',
       gallery:true,
       counter: true,
       fullscreen: true,
       download: true,
     })
   </script>

   
    
  </body>
</html>