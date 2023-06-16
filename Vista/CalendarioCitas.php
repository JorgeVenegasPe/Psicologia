<!DOCTYPE html>
<html lang="en" dir="ltr"> 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../issets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../issets/css/datatables.min.css">
    <link rel="stylesheet" href="../issets/css/bootstrap-clockpicker.css">
    <link rel="stylesheet" href="../issets/fullcalendar/main.css">
    <link rel="stylesheet" href="../issets/css/calendariocita.css">
    <script src="../issets/js/jquery-3.6.0.min.js"></script>
    <script src="../issets/js/popper.min.js"></script>
    <script src="../issets/js/bootstrap.min.js"></script>
    <script src="../issets/js/datatables.min.js"></script>
    <script src="../issets/js/bootstrap-clockpicker.js"></script> 
    <script src="../issets/js/moment-with-locales.js"></script>
    <script src="../issets/fullcalendar/main.js"></script>
    <title>Calendario</title>
</head>
<body>
    
    <?php           
    require "../issets/views/header.php";
    ?>
    <!-- Calendario -->
    <div class="container-fluid2">
        <div>
          <div id="Calendario1" style="border-radius: 4em; border-style: double; border-color:#b4d77b; padding:30px"></div>
      </div>
    </div>

    <!-- Formulario de Eventos -->
    <div class="modal fade" id="FormularioEventos" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a  class="close" data-bs-dismiss="modal" aria-label="Close">&times;</a>
          <div class="modal-body">
              <input type="hidden" id="Id">
              <div class="form-row">
                <div class="form-group">
                  <label for="">Id de Paciente:</label>
                  <input type="text" id="Titulo" class="form-control" placeholder="">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Fecha de inicio:</label>
                  <div class="input-group" data-autoclose="true">
                    <input type="date" id="FechaInicio" value="" class="form-control">
                  </div>
                </div>
                <div class="form-group col-md-6" id="TituloHoraInicio">
                  <label>Hora de inicio:</label>
                  <div class="input-group clockpicker" data-autoclose="true">
                    <input type="text" id="HoraInicio" value="" class="form-control" autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="">Fecha de fin:</label>
                  <div class="input-group" data-autoclose="true">
                    <input type="date" id="FechaFin" class="form-control" value="">
                  </div>
                </div>
                <div class="form-group col-md-6" id="TituloHoraFin">
                 <label for="">Hora de fin:</label>
                  <div class="input-group clockpicker" data-autoclose="true">
                    <input type="text" id="HoraFin" class="form-control" autocomplete="off">
                 </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label for="">Nombre del Doctor:</label>
                  <input type="text" id="DocNombre" class="form-control" placeholder="">
                </div>
              </div>
          </div>

          <div class="modal-footer">
            <button type="button" id="BotonAgregar" class="btn btn-success">Agregar</button>
            <button type="button" id="BotonModificar" class="btn btn-success">Modificar</button>
            <button type="button" id="BotonBorrar" class="btn btn-success">Borrar</button>
            <button type="button" id="cancelarr" class="btn btn-success" data-bs-dismiss="modal">Cancelar</button>
          </div>

        </div>
      </div>
    </div>


    <script>

document.addEventListener("DOMContentLoaded", function(){
    $('.clockpicker').clockpicker();

    let calendario1 = new FullCalendar.Calendar(document.getElementById('Calendario1'),{
      droppable: true,
      height: 850,
      locale: 'es',
      headerToolbar:{
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      editable: true,
      events: '../Modelo/Cita/datoseventos.php?accion=listar',
      dateClick: function(info){
        limpiarFormulario();
        $('#BotonAgregar').show();
        $('#BotonModificar').hide();
        $('#BotonBorrar').hide();

        if (info.allDay) {
          $('#FechaInicio').val(info.dateStr);
          $('#FechaFin').val(info.dateStr);
        }else{
          let fechaHora = info.dateStr.split("T");
          $('#FechaInicio').val(fechaHora[0]);
          $('#FechaFin').val(fechaHora[0]);
          $('#HoraInicio').val(fechaHora[1].substring(0,5));
        }
        $("#FormularioEventos").modal('show');
      },
      eventClick: function(info) {
        $('#BotonAgregar').hide();
        $('#BotonModificar').show();
        $('#BotonBorrar').show();
        $('#Id').val(info.event.id);
        $('#Titulo').val(info.event.title);
        $('#FechaInicio').val(moment(info.event.start).format("YYYY-MM-DD"));
        $('#FechaFin').val(moment(info.event.end).format("YYYY-MM-DD"));
        $('#HoraInicio').val(moment(info.event.start).format("HH:mm"));
        $('#HoraFin').val(moment(info.event.end).format("HH:mm"));
        $('#DocNombre').val(info.event.extendedProps.d_nombre);
        $("#FormularioEventos").modal('show');
      },
      eventResize: function(info){
        $('#Id').val(info.event.id);
        $('#Titulo').val(info.event.title);
        $('#FechaInicio').val(moment(info.event.start).format("YYYY-MM-DD"));
        $('#FechaFin').val(moment(info.event.end).format("YYYY-MM-DD"));
        $('#HoraInicio').val(moment(info.event.start).format("HH:mm"));
        $('#HoraFin').val(moment(info.event.end).format("HH:mm"));
        $('#DocNombre').val(info.event.extendedProps.d_nombre);
        let registro = recuperarDatosFormulario();
        modificarRegistro(registro);
      },
      eventDrop: function(info){
        $('#Id').val(info.event.id);
        $('#Titulo').val(info.event.title);
        $('#FechaInicio').val(moment(info.event.start).format("YYYY-MM-DD"));
        $('#FechaFin').val(moment(info.event.end).format("YYYY-MM-DD"));
        $('#HoraInicio').val(moment(info.event.start).format("HH:mm"));
        $('#HoraFin').val(moment(info.event.end).format("HH:mm"));
        $('#DocNombre').val(info.event.extendedProps.d_nombre);
        let registro = recuperarDatosFormulario();
        modificarRegistro(registro);
      },
    });

    calendario1.render();

    //Eventos de botones de la aplicacion
    $('#BotonAgregar').click(function(){
      let registro = recuperarDatosFormulario();
      agregarRegistro(registro);
      $('#FormularioEventos').modal('hide');
    });

    $('#BotonModificar').click(function(){
      let registro = recuperarDatosFormulario();
      modificarRegistro(registro);
      $('#FormularioEventos').modal('hide');
    });

    $('#BotonBorrar').click(function(){
      let registro = recuperarDatosFormulario();
      borrarRegistro(registro);
      $('#FormularioEventos').modal('hide');
    });


    //funciones para comunicarse con el servidor AJAX!
    function agregarRegistro(registro) {
      $.ajax({
        type: 'POST',
        url: '../Modelo/Cita/datoseventos.php?accion=agregar',
        data: registro,
        success: function(msg){
          calendario1.refetchEvents();
        },
        error: function(error) {
          alert("Hubo un error al agregar el evento: " + error);
        }
      });
    }

    function modificarRegistro(registro){
      $.ajax({
        type: 'POST',
        url: '../Modelo/Cita/datoseventos.php?accion=modificar',
        data: registro,
        success: function(msg){
          calendario1.refetchEvents();
        },
        error: function(error) {
          alert("Hubo un error al modificar el evento: " + error);
        }
      });
    }

    function borrarRegistro(registro){
      $.ajax({
        type: 'POST',
        url: '../Modelo/Cita/datoseventos.php?accion=borrar',
        data: registro,
        success: function(msg){
          calendario1.refetchEvents();
        },
        error: function(error) {
          alert("Hubo un error al borrar el evento: " + error);
        }
      });
    }

    //funciones que interactuan con el FormularioEventos

    function limpiarFormulario(){
      $('#Id').val('');
      $('#Titulo').val('');
      $('#FechaFin').val('');
      $('#FechaInicio').val('');
      $('#HoraInicio').val('');
      $('#HoraFin').val('');
      $('#DocNombre').val('');
    }

    function recuperarDatosFormulario(){
      let registro = {
        id: $('#Id').val(),
        titulo: $('#Titulo').val(),
        inicio: $('#FechaInicio').val() + ' ' + $('#HoraInicio').val(),
        fin: $('#FechaFin').val() + ' ' + $('#HoraFin').val(),
        docnombre: $('#DocNombre').val(),
      }
      return registro;
    }

});
    </script>
  </body>
</html>