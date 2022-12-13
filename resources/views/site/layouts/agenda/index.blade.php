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

    <title>{{ $cliente->nome }}</title>


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

    <link rel="stylesheet" href="{{ asset('dashboard/css/fullcalendar/main.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css"
        integrity="sha512-8vq2g5nHE062j3xor4XxPeZiPjmRDh6wlufQlfC6pdQ/9urJkU07NM0tEREeymP++NczacJ/Q59ul+/K2eYvcg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Color CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="{{ url('../site/css/colors/preset.css') }}" media="screen" />

</head>
<style>
  a:not([href]):not([tabindex]) {
    color: #212529;
    }
    html, body{
      margin: 0; padding: 0;
      font-family: Arial, Helvetica, sans-serif;
      font-size: 14px;
    }
    #calendar{
      max-width: 900px; margin: 40px auto;
    }

  </style>
<script>
    protocolo = window.location.protocol,    
    url_host = window.location.host;
    url_atual = protocolo+'//'+url_host+'/agenda/show'; //monta a rota que retorna os dados em json
    console.log(url_atual);

    // console.log(window.location.protocol);
    // console.log(window.location.pathname);
   
   
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          //timeZone: 'UTC-4',
          //locale: 'pt-br',
         headerToolbar: {
            left:'prev,next today',
            center:'title',
            right:'dayGridMonth,timeGridWeek, timeGridDay'            
          },
           
         
          eventClick:function(info){          

            // console.log(info);
            // console.log(info.event.title);
            // console.log(info.event.start);
            // console.log(info.event.end);
            // console.log(info.event.textColor);
            // console.log(info.event.backgroundColor);
            // console.log(info.event.extendedProps.descricao);//informação externa

            // $('#txtID').val(info.event.id);
            // $('#txtTitulo').val(info.event.title);

            mes = (info.event.start.getMonth()+1);
            dia = (info.event.start.getDate());
            ano = (info.event.start.getFullYear());

            mes = (mes < 10) ? "0" + mes : mes; // se o mês for menor que 10 coloca o 0
            dia = (dia < 10) ? "0" + dia : dia;

            hora = info.event.start.getHours();
            minuto = info.event.start.getMinutes();
            hora = (hora < 10) ? "0" + hora : hora;
            minuto = (minuto < 10) ? "0" + minuto : minuto;           

            $('#titulo').html(info.event.title)
            $('#data').html(dia+"/"+mes+"/"+ano);
            
            $('#hora').html(hora+":"+minuto);
            
            $('#descricao').html(info.event.extendedProps.description);

            $('#modalDetalhes').modal();
          },
          
          //events: url_atual + '/admin/show',
          //events:url_atual,
          events:'https://www.seringueiras.ro.leg.br/agenda/show',
 
          views: {
            timeGridFourDay: {
              type: 'timeGrid',
              duration: { days: 7 },
              buttonText: 'semana'
            }           
          }
        });        
        
        calendar.setOption('locale', 'pt-br');//Traduz para português        
        calendar.render();
      });
</script>

<body class="container-fluid">
    @include('site.layouts.includes.menuExterno')

    <!-- Modal -->
<div class="modal fade" id="modalDetalhes" tabindex="-1" role="dialog" aria-labelledby="modalDetalhes" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="titulo" class="modal-title" id="modalDetalhes"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <div class="row"></div>
          
          <p>Data: <span id="data"></span></p>
          <p></p>Hora: <span id="hora"></span></p>
          <p>Descrição: <span id="descricao"></span></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          
        </div>
      </div>
    </div>
  </div>
        <!-- Header Section Start -->

    <section id="sessoes" class="section mw-100 ">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">
                    AGENDA DO PODER <span>LEGISLATIVO </span>
                </h2>
                <hr class="lines wow zoomIn" data-wow-delay="0.3s">
                <p class="section-subtitle wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">
                    AGENDA
                </p>
            </div>     
               <div class="col-12" id='calendar'>

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

    <script src="{{ asset('dashboard/js/fullcalendar/main.js') }}"></script>    
    <script src="{{ asset('dashboard/js/fullcalendar/pt-br.js') }}"></script>
  

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