<!DOCTYPE html>
<html lang="pt-br">
  <head>
    @foreach ($tenants as $tenant)      
    @endforeach
 
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="{{$tenant->nome}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Grayrids">


    <meta property="og:site_name" content="{{$tenant->nome}}">
    <meta property="og:url" content="seringueiras.ro.leg.br">
    <meta property="og:title" content="{{$post->titulo}} -  {{$tenant->nome}}">
    <meta property="og:description" content="{{$post->conteudo}}">
    <meta property="og:type" content="article">
    <meta property="og:image" content="{{config('app.aws_url').$post->img_destaque }}" />
    <meta property="og:image:url" content="{{config('app.aws_url').$post->img_destaque }}" />
    <meta property="og:image:secure_url" content="{{config('app.aws_url').$post->img_destaque }}" />
    <meta property="og:image:type" content="image/jpg" />
    <meta property="og:image:width" content="300" />
    <meta property="og:image:height" content="300" />
    <meta property="og:image:alt" content="{{$post->titulo}}" />
      
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
              <h1 class="wow fadeIn" id="titulo" data-wow-duration="1000ms" data-wow-delay="0.3s">
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
                <figure class="figure">
                  <img src="{{config('app.aws_url').$post->img_destaque }}" class="img-fluid" alt="Responsive image" style="max-height: 500px" alt="{{$post->titulo}}">
                    
                      <meta content="{{config('app.aws_url').$post->img_destaque }}" itemprop="url" />
                      <meta content="960" itemprop="width" />
                      <meta content="480" itemprop="height" />
                </figure>
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
              <div class="row ml-3">
                
              </div>
              <div class="row m-3">
                <div class="col-md-12">
                  <span>Compartilhar</span> <br>
                  <a href="" id="whatsapp-share-btt" rel="nofollow" target="_blank"><i class="fab fa-whatsapp fa-2x text-success"></i></a>
                </div>
                
                
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
        //Constrói a URL depois que o DOM estiver pronto
    document.addEventListener("DOMContentLoaded", function() {
        //conteúdo que será compartilhado: Título da página + URL
        var titulo = document.getElementById("titulo").innerHTML;
        var conteudo = encodeURIComponent(titulo + " - "+ document.title + " " + window.location.href);
        //altera a URL do botão
        document.getElementById("whatsapp-share-btt").href = "https://api.whatsapp.com/send?text=" + conteudo;
    }, false);

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