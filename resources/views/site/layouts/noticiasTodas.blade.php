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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<!-- Color CSS Styles  -->
<link rel="stylesheet" type="text/css" href="{{url('../site/css/colors/preset.css')}}" media="screen" />

  </head>
  <style>   
    #link:hover{
      transition:  0.4s;
      background:rgba(71, 119 , 250, 0.77);
      opacity: 0.9;
    }   
    #btnPesquisar:hover{
    color: white !important;   
   }
  </style>
  <body>
    @include('site.layouts.includes.menuExterno')
    <!-- Header Section Start -->
    <header id="hero-area" data-stellar-background-ratio="0.5">     
      @include('site.layouts.includes.slide')  
    
      {{-- <div class="container">      
        <div class="row justify-content-md-center">
          <div class="col-md-10">
            <div class="contents text-center">
              <h1 class="wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">
                titulo
              </h1>
              <div class="post-meta">
                <ul>
                 
                </ul>
              </div>
            </div>
          </div>
        </div> 
      </div>            --}}
    </header>
    <!-- Header Section End --> 
    
    <!-- Blog Section Start  -->
    <div id="blog-single">
      <div class="container">
        <div class="col-md-12">
          <h3 class="text-center">Todas as Notícias</h3>
        </div>
        <div class="row justify-content-md-center">
          <div class="col-md-12">
          
            <div class="blog-post">
        
              <div class="post-thumb">
                {{-- <img src="{{config('app.aws_url').$post->img_destaque }}" class="img-fluid" alt="Responsive image" style="max-height: 500px" alt="{{$post->titulo}}"> --}}
              </div>
              <div class="post-content">
               <form action="{{route('noticiasTodas.pesquisar')}}" method="get">
                <div class="input-group mb-3">
                  <input type="text" name="pesquisa" class="form-control p-4" placeholder="Digite aqui..." aria-label="Digite aqui" aria-describedby="botão de pesquisar noticias">
                  <div class="input-group-append">
                    <button class="btn  btn-outline-primary text-primary" type="submit" id="btnPesquisar"> 
                      <i class="fas fa-search "></i>
                      Pesquisar</button>
                  </div>
                </div>
               
               </form>
               <div class="row">
                 <div class="col-12">
                  <ul class="list-unstyled">
                    @foreach ($posts as $noticia)                     
                    
                    <a href="{{route('noticias.show', $noticia->url)}}" >
                    <li class="media mb-3 p-2" id="link">
                      <div class="col-2">
                        <img src="{{config('app.aws_url').$noticia->img_destaque }}" class="mr-3 mt-1" alt="{{$noticia->titulo}}" 
                      style="width: 100%; height:90px; ">
                      </div>
                      <div class="col-10">
                        <div class="media-body " >
                          <h6 class="mt-0 mb-1 text-dark">{{$noticia->titulo}}</h6>
                          <span class="text-muted">
                            Publicado por:
                            <i class="lnr lnr-user "></i> {{$noticia->user->name}}
                          </span>
                          &nbsp;
                          <span class="text-muted">
                            <i class="lnr lnr-calendar-full"></i>
                            {{Carbon\Carbon::parse($noticia->data_publicacao)->format('d/m/Y')}}
                          </span>
                            
                        </div>

                      </div>
                     
                     
                    </li>
                  </a>
                    @endforeach
                  </ul>                
                   
                 </div>
           
               </div>
               @if (!empty($pesquisar))
               {!!$posts->appends($pesquisar)->links()!!}
               @else
               {!!$posts->links()!!}
               @endif
              </div>            
              <div class="container mt-5 mb-5">
                
                {{-- @foreach ($post->imagens as $imagem)         
                  <a class="galeria_post" href="{{config('app.aws_url')."{$imagem->img}" }}" title="">
                    
                    <img src="{{config('app.aws_url')."{$imagem->img}" }}" class="" style= "width:200px" >
                  </a>  
                 @endforeach --}}
              </div>          
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