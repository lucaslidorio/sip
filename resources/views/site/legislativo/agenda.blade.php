@extends('site.legislativo.layouts.default')

<style>
  a:not([href]):not([tabindex]) {
    color: #212529;
  }

  html,
  body {
    margin: 0;
    padding: 0;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 14px;
  }

  #calendar {
    max-width: 900px;
    margin: 40px auto;
  }
</style>
<script>
  protocolo = window.location.protocol,    
    url_host = window.location.host;
    url_atual = protocolo+'//'+url_host+'/agenda/show'; //monta a rota que retorna os dados em json
    

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
            
            $('#modalDetalhes').modal( 'show');
            
           },
          
          events: url_atual ,
          //events:url_atual,
          
          // events:'https://www.seringueiras.ro.leg.br/agenda/show',
 
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

@section('content')
  <div>
    <h3 class="font-blue text-center">Agenda</h3>
    <p  class="text-center fs-5">Agenda Legislativa</p>
  </div>
  <div class="row">
    <div class="col-12" id='calendar'>

    </div>
  </div>
  <div class="modal fade" id="modalDetalhes" tabindex="-1" role="dialog" aria-labelledby="modalDetalhes" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 id="titulo" class="modal-title" id="modalDetalhes"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="row"></div>
          
          <p>Data: <span id="data"></span></p>
          <p></p>Hora: <span id="hora"></span></p>
          <p>Descrição: <span id="descricao"></span></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          
        </div>
      </div>
    </div>
  </div>

@endsection