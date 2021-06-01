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
  <body>
    @include('site.layouts.includes.menuExterno')
    <!-- Header Section Start -->
    <header id="hero-area" data-stellar-background-ratio="0.5">       
  
    </header>
    <!-- Header Section End --> 
    
    <!-- Blog Section Start  -->
    <div id="blog-single">
      <div class="container">
        <div class="row justify-content-md-center">
        <div class="col-md-12">
           <div class="blog-post">
              <div class="post-thumb">
                
              </div>
              <div class="post-content">
                <div class="row">
                  <div class="col-md-4">
                    <img src="{{config('app.aws_url').$vereador->img }}" class="card-img rounded" alt="{{$vereador->titulo}}" 
                    style="max-width: 400px; margim:10px;" >
                  </div>
                  <div class="col-md-8">
                    <h5 class="card-title mt-1 font-weight-bold"><strong> Nome: </strong>{{$vereador->nome}}</h5>
                    <p class="card-text"><strong>Nome Parlamentar: </strong> {{$vereador->nome_parlamentar}}</p>
                    <div class="row">
                      <div class="col-md-6">
                          <p class="card-text"><strong>Data de Nascimento : </strong>
                           {{\Carbon\Carbon::parse($vereador->data_nascimento)->format('d/m/Y')}}
                          </p>   
                          <p class="card-text"><strong>Estado Civil : </strong> {{$vereador->estado_civil}}</p>
                          <p class="card-text"><strong>Naturalidade : </strong> {{$vereador->naturalidade}}</p>
                          <p class="card-text"><strong>Ocupação Profissional : </strong> {{$vereador->ocupacao_profissional}}</p>
                          <p class="card-text"><strong>Escolaridade : </strong> {{$vereador->escolaridade}}</p>
                          <p class="card-text"><strong>Endereço do Parlamentar : </strong> {{$vereador->endereco}}</p>
                          <p class="card-text"><strong>Atual : </strong> {{$vereador->atual == 1 ? 'Sim':'Não'}}</p>

                      </div>
                      <div class="col-md-6">
                        <p class="card-text"><strong>Endereço do Gabinete : </strong> {{$vereador->endereco_gabinete}}</p>
                        <p class="card-text"><strong>Telefone Pessoal : </strong> {{$vereador->telefone}}</p>
                        <p class="card-text"><strong>Telefone do Gabinete : </strong> {{$vereador->telefone_gabinete}}</p>
                        <p class="card-text"><strong>Facebook : </strong>
                          <a href="{{$vereador->facebook}}" class="link link-primary" target="_blank"
                            data-toggle="tooltip" data-placement="top" title="Visitar perfil no facebook">
                            <i class="fab fa-facebook-square" style="font-size: 30px"></i>
                          </a>             
                        <p class="card-text"><strong>Instagram : </strong>
                          <a href="{{$vereador->instagram}}" class="link link-primary" target="_blank"
                            data-toggle="tooltip" data-placement="top" title="Visitar perfil no instagram">
                            <i class="fab fa-instagram-square" style="font-size: 30px; color: #dd2a7b;"></i>
                          </a>         
                          
                          
                        <p class="card-text"><strong>Partido Político : </strong> </p>
                        <figure class="figure">
                          <img src="{{config('app.aws_url').$vereador->party->img }}" class="figure-img img-fluid rounded" 
                          alt="{{$vereador->party->nome}}" style="max-width: 150px">
                          <figcaption class="figure-caption">{{$vereador->party->sigla}} - {{$vereador->party->nome}}</figcaption>
                        </figure> 
                        
                      </div>
                    </div>
                  </div> 

                </div>
               
                <div class="row">
                  <div class="row border-top mt-3 pl-4 pr-4" style="padding-right:20px; " >
                    <p class="card-text text-justify  "><strong>Biografia:</strong> <br> {{$vereador->biografia}}</p>
                  </div>
                </div>
                
              </div>            
              
              
               
                    
            </div>
          </div>
          <div class="container">
            <div class="col-md-12">
              <h3 class="text-center">Nossos Vereadores</h3>
            </div>
            
            <div class="row justify-content-center">  
        
              @foreach ($councilors as $vereador)
              
              <div class="col-lg-3 col-sm-6 col-xs-12">
                <div class="card mb-2">
                  <div class="single-team m-2">
                    <a href="#"> <img src="{{config('app.aws_url').$vereador->img }}" alt="" style="max"></a>
                     <div class="team-details">
                       <div class="overlay"></div>
                       <div class="team-inner">
                         <a href="{{route('vereadores.show', $vereador->nome)}}" class=""><h4 class="team-title">  {{$vereador->nome}} - {{$vereador->party->sigla}}</h4></a>
                         
                       </div>
                     </div>
                   </div>
                   <p class="m-3 text-center">{{$vereador->nome}} - {{$vereador->party->sigla}}</p>
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