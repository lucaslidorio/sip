@extends('public_templates.leg.default')

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
  .fc .fc-event-title {
  white-space: normal !important;
  overflow-wrap: break-word !important;
  word-break: break-word !important;
  font-size: 13px; /* ajuste opcional */
}

.fc-event {
  max-width: 100% !important;
  display: block !important;
}
</style>

@section('content')
<div class="row" style="height: 60px; background-color: #f5f5f5">
    <div class="container ">
        <div class="row mt-4">
            <div class="col-8">
                <p class="fs-1">Agenda</p>
            </div>
            <div class="col-4 fs-4">Agenda</div>
        </div>
    </div>
</div>
<div class="container">
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
    


</div> 


@endsection

<script>
  const protocolo = window.location.protocol;
  const url_host = window.location.host;
  const url_atual = `${protocolo}//${url_host}/agenda/show`; // monta a rota que retorna os dados em json

  document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');

    const calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },

      locale: 'pt-br',
      events: url_atual,

      eventClick: function (info) {
        // Previne qualquer ação extra ao clicar
        info.jsEvent.preventDefault();
      },

      eventDidMount: function (info) {
        const evento = info.event;

        const mes = String(evento.start.getMonth() + 1).padStart(2, '0');
        const dia = String(evento.start.getDate()).padStart(2, '0');
        const ano = evento.start.getFullYear();
        const hora = String(evento.start.getHours()).padStart(2, '0');
        const minuto = String(evento.start.getMinutes()).padStart(2, '0');

        const tooltip = new bootstrap.Tooltip(info.el, {
          title: `
            <strong>${evento.title}</strong><br>
            Data: ${dia}/${mes}/${ano}<br>
            Hora: ${hora}:${minuto}<br>
            ${evento.extendedProps.description || ''}
          `,
          html: true,
          placement: 'top',
          trigger: 'hover',
          container: 'body'
        });
      },

      views: {
        timeGridFourDay: {
          type: 'timeGrid',
          duration: { days: 7 },
          buttonText: 'semana'
        }
      }
    });

    calendar.render();
  });
</script>
