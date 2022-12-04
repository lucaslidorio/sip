@extends('adminlte::page')
@section('title', 'Agenda')
@section('content_header')
@section('plugins.Sweetalert2', false)
@include('sweetalert::alert')

  @section('css')
    <style>
      html, body{
        margin: 0; padding: 0;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 14px;
      }
      #calendar{
        max-width: 900px; margin: 40px auto;
      }

    </style>
  @stop
  @section('js')
  <script>
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
         // defaultDate:new Date(2022,8,1), //Inicializa em uma data especifica
          //initialView: ['dayGridMonth' ]
          
         headerToolbar: {
            left:'prev,next today myCustomButton',
            center:'title',
            right:'dayGridMonth,timeGridWeek, timeGridDay'
            //center: 'dayGridMonth,timeGridFourDay' // buttons for switching between views
          },
          //botão customizado
          customButtons: {
            myCustomButton: {
              text: 'botao',
              hint:  'botao teste',
              click: function() {
                alert('clicked the custom button!');
              }
            }
          }, 
          dateClick: function(info) {
            $('#modalStore').modal();
            console.log(info);
            calendar.addEvent({
              title:"Evento x", date:info.dateStr
            });

          },
          eventClick:function(info){
            console.log(info);
            console.log(info.event.title);
            console.log(info.event.start);

            console.log(info.event.end);
            console.log(info.event.textColor);
            console.log(info.event.backgroundColor);

            console.log(info.event.extendedProps.descricao);//informação externa
          },


          events:[
            {
              title:"Meu evento 1",
              start:"2022-12-03 08:30:00",
              descricao :"Descrição do evento 1",
              // end:"2022-12-03 10:30:00",
              // color:"#00FF7F",
              // textColor:"#000000",
            },{
              title:"Meu evento 2",
              start:"2022-12-03 07:30:00",
              end:"2022-12-09 12:30:00",
              color:"#FFCCAA",
              textColor:"#000000",
              descricao :"Descrição do evento 2",
            }
          ],
       

          

          
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
  @endsection


<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Agenda</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
        <li class="breadcrumb-item ">Agenda</li>
      </ol>
    </div>
  </div>
</div>

@stop
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-8">
            
          </div>
          <div class="col-md-4">
            <div class="card-tools">
             
            </div>
          </div>
        </div> 
      </div>     
   
      <!-- /.card-header -->
      <div class="card-body">
        
        <div class="row ">          
          <div class="col-12" id='calendar'>

          </div>
        </div>
        {{-- <div id='calendar'></div> --}}
       
      </div>



<!-- Modal -->
<div class="modal fade" id="modalStore" tabindex="-1" role="dialog" aria-labelledby="modalStoreModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalStoreModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          ID:
          <input type="text" class="form-control" name="txtID" id="txtID"> <br>
          Fecha:
          <input type="text" class="form-control" name="txtFecha" id="txtFecha">
       
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label for="txtTitulo">Titulo</label>
              <input type="text" class="form-control" name="txtTitulo" id="txtTitulo">
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label for="txtHora">Hora</label>
              <input type="text" class="form-control" name="txtHora" id="txtHora">
            </div>
          </div>          
          <div class="col-12">
            <div class="col-12">
              <label for="sobre">Descricao:</label>
              <div class="form-group">
              <textarea class="form-control" name="txtDescricao" id="txtDescricao" cols="1" rows="3" 
                  placeholder="Sobre a secretaia"></textarea>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="txtCor">Cor</label>
              <input type="color" class="form-control" name="txtCor" id="txtCor">
            </div>
          </div>
        </div>
        
      </div>
      <div class="modal-footer">
        <button id="btnSalvar" class="btn btn-primary">Salvar</button>
        <button id="btnAlterar" class="btn btn-warning">Alterar</button>
        <button id="btnExcluir" class="btn btn-danger">Excluir</button>
        <button id="btnCancelar" class="btn btn-secondary">Cancelar</button>
        
      </div>
    </div>
  </div>
</div>




      <!-- /.card-body -->
      <div class="card-footer">
        {{-- @if (isset($pesquisar))
        {!!$parties->appends($pesquisar)->links()!!}
        @else
        {!!$parties->links()!!}
        @endif --}}
      </div>
    </div>
    <!-- /.card -->
  </div>
</div>
@stop

@section('js')
<script>






//Swal.fire('Any fool can use a computer');  
  //Inicia os tooltip
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })  
    //Alert de confirmação de exclusão
    $('.delete-confirm').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');    
          Swal.fire({
          title: 'Deseja continuar?',
          text: "Este registro e seus detalhes serão excluídos permanentemente!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText:'Cancelar',
          confirmButtonText: 'Sim, Exclua!'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = url;
          }
        })  
});
</script>
@stop