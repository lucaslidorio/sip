<!DOCTYPE html>
<html lang="en">
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
    <header id="hero-area" data-stellar-background-ratio="0.5">       
    
      <div class="container">      
        <div class="row justify-content-md-center">
          <div class="col-md-10">
            <div class="contents text-center">
              <h1 class="wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">
                {{$post->titulo}}
              </h1>
              <div class="post-meta">
                <ul>
                  <li><i class="lnr lnr-calendar-full"></i> <a href="#">{{\Carbon\Carbon::parse($post->data_publicacao)->format('d/m/Y')}}</a></li>
                  <li><i class="lnr lnr-user"></i> <a href="">{{$post->user->name}}</a></li>
                 
                  <li>
                    <i class="lnr lnr-bookmark"></i>
                    @foreach ($post->categories as $categoria)
                     <a href="#">{{$categoria->nome}}</a></li>
                    @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div> 
      </div>           
    </header>
    <!-- Header Section End --> 
    
    <!-- Blog Section Start  -->
    <div id="blog-single">
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col-md-12">
            <div class="blog-post">
              <div class="post-thumb">
                <img src="{{config('app.aws_url').$post->img_destaque }}" class="img-fluid" alt="Responsive image" style="max-height: 500px" alt="{{$post->titulo}}">
              </div>
              <div class="post-content">
                @isset($post)
                <p>{!!$post->conteudo!!}</p>  
                @endisset
                
              </div>            
              <div class="container mt-5 mb-5">
                @foreach ($post->imagens as $imagem)         
                  <a class="galeria_post" href="{{config('app.aws_url')."{$imagem->img}" }}" title="">
                    {{-- data-lcl-txt = "Descrição" data-lcl-author="Lucas" --}}
                    <img src="{{config('app.aws_url')."{$imagem->img}" }}" class="" style= "width:200px" >
                  </a>  
                 @endforeach
              </div>          
            </div>
          </div>
          <div class="container">
            <div class="col-md-12">
              <h3 class="text-center">Notícias Relacionadas</h3>
            </div>
          
          <div class="row">
            @foreach ($posts as $post)
            <div class="col-md-3  mr-3">
              <div class="card" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <h6 class="card-subtitle mb-2 text-muted">{{$post->titulo}}</h6>
                  <a href="single-post.html">
                    <img src="{{config('app.aws_url').$post->img_destaque }}" alt="" style="max-height: 120px;">
                  </a><br>
                  
                  <div class="meta-tags">
                    <span class="date"><i class="lnr lnr-calendar-full"></i>
                      {{\Carbon\Carbon::parse($post->data_publicacao)->format('d/m/Y')}}</span>
                    {{-- <span class="comments"><a href="#"><i class="lnr lnr-bubble"></i> 24 Comments</a></span> --}}
                </div>
                <a href="{{route('noticias.show', $post->url)}}" class="btn btn-common btn-rm">Leia Mais</a>
            
                </div>
              </div>
            </div>
                
            @endforeach
          </div>
        </div> 
             
          
        </div>
        
      </div>
     
    </div>
    <!-- Blog Section End  -->

  
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