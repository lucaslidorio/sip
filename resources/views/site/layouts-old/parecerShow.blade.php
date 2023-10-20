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
    
    <!-- Header Section End --> 
    
    <!-- Blog Section Start  -->
    <br>
    <br>
    <div id="blog-single">
      <div class="container">        
        <div class="section-header">
          <h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">
              PARECER DA COMISSÃO DE<span> {{$seemCommission->commission->nome}} </span>
          </h2>
          <hr class="lines wow zoomIn" data-wow-delay="0.3s">
          <p class="section-subtitle wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">
              Pareceres das comissões do poder legislativo
          </p>
        </div>
        <div class="shadow-lg p-5 mb-15 bg-white rounded">

          <div class="card " >
            <div class="card-header"style="background:white;">
            <h6>Parecer da comissão de     
              <strong> {{$seemCommission->commission->nome}} </strong>
              sobre <strong> 
              {{$seemCommission->proposition->type_proposition->nome}} 
              {{$seemCommission->proposition->numero}}/{{\Carbon\Carbon::parse($seemCommission->proposition->data)->format('Y')}}
              </strong>
            <h6>  
            </div>
           <div class="card-body p-0">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">Data</th>  
                  <th scope="col">{{\Carbon\Carbon::parse($seemCommission->data)->format('d/m/Y')}}</th>              
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">Autoria</th>
                  <td>{{$seemCommission->autoria}}</td>          
                </tr>
                <tr>
                  <th scope="row">Assunto</th>
                  <td>{{$seemCommission->assunto}}</td>
                </tr>
                <tr>
                  <th scope="row">Descrição</th>
                  <td colspan="2">{{$seemCommission->descricao}}</td>                
                </tr>
                <tr>
                  <th scope="row">Anexo(s)</th>
                  <td >
                    @foreach ($seemCommission->attachments as $anexo)
                    <a href="{{config('app.aws_url')."{$anexo->anexo}" }}" 
                      target="_blank" class="mb-2 text-reset"
                      data-toggle="tooltip" data-placement="top" 
                          title="Clique para abrir o documento" >
                          <i class="far fa-file-pdf fa-2x text-danger mr-2"></i>                          
                        <span class="mr-2"> {{$anexo->nome_original}}</span>                
                    </a>
                    @endforeach
                  </td>                
                </tr>
              </tbody>
            </table>
           </div>
           <div class="card-footer">
            <div class="row">
              <div class="col-sm-12">
                <a href="{{route('parecer.pesquisar')}}" data-id=""
                class="btn  btn-primary  " data-toggle="tooltip" data-placement="top"  
                title="Voltar">
                <i class="fas fa-backward">  Voltar</i>
              </a>
              </div>
            </div>

           </div>
          </div>  
        </div>         
        </div>        
      </div>     
    </div>
    <!-- Blog Section End  -->  
    <!-- Rodapé -->
  @include('site.layouts.includes.rodape')
  <!-- Fim Rodapé -->> 

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
   </script>

   
    
  </body>
</html>