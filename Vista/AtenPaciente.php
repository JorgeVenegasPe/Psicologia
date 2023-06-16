<?php
session_start();
if (isset($_SESSION['usuario'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../issets/css/formulario.css">
    <link rel="stylesheet" href="../issets/font-awesome/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Registro del Paciente</title>
</head>
<body>
<style>
        .b{
          display: none;
        }
    </style>
    <?php
    require "../issets/views/header.php";
    ?>
    <div class="container4">
        <form action="../Crud/Paciente/guardarAtencPaciente.php" method="post" class="form">
          <h2 class="title">Formulario de Atencion al Paciente</h2>
          <div class="checkout-information">
            <div class="input-group2">
              <div style="flex-direction:column">
                <label for="id_paciente" >Id del Paciente</label>
				      	<input id="id_paciente" type="text" name="id_paciente" class="input2" placeholder="ID de el Paciente" required/>
                <a class="button3"><i class="fa fa-search" aria-hidden="true"></i></a>
                </div>
                <div style="flex-direction:column">
					      <label for="nombrePaciente" >Nombre de Paciente</label>
				      	<input id="nombrePaciente" type="text" name="nombrePaciente" class="input3" readonly/>
				      </div>
            </div>
            <div class="input-group">
				      	<label for="diagnostico">Diagnostico</label>
				      	<textarea style="resize: none; padding: 1.2em 1em 2.8em 1em;font-family: 'Poppins', sans-serif;	font-size: 14px;" type="text" id="diagnostico" name="diagnostico" placeholder="Ingrese su diagnostico" required></textarea>
				    </div>
            <div class="input-group">
				      	<label for="tratamiento">Tratamiento</label>
				      	<textarea style="resize: none; padding: 1.2em 1em 2.8em 1em;font-family: 'Poppins', sans-serif;	font-size: 14px;" type="text" id="tratamiento" name="tratamiento" placeholder="Tratamiento" required></textarea>
				    </div>
            <div class="input-group">
				      	<label for="observacion">observacion</label>
				      	<textarea style="resize: none; padding: 1.2em 1em 2.8em 1em;font-family: 'Poppins', sans-serif;	font-size: 14px;" type="text" id="observacion" name="observacion" placeholder="Observacion" required></textarea>
				    </div>
            <div class="input-group2">
            <div style="flex-direction:column">
					      <label for="id_enfermedad">Codigo  Enfermedad</label>
					      <input class="input2" type="text" id="id_enfermedad" name="id_enfermedad" placeholder="Codigo de Enfermedead" required/>
				        <a class="button2"><i class="fa fa-search" aria-hidden="true"></i></a>
            </div>
            <div style="flex-direction:column">
					      <label for="enfermedad">Emfermedad</label>
					      <input type="text" class="input3" id="enfermedad" name="enfermedad" readonly />
				    </div>
            </div>
            <div class="xd">
              <button class="button">Registrar</button>
            </div>
          </div>
        </form>
    </div>

</body>
<script>
  $(document).ready(function() {
    $('.button2').click(function() {
      var codigo = $('#id_enfermedad').val();

      // Realizar la solicitud AJAX al servidor
      $.ajax({
        url: 'fetch_enfermedad.php', // Archivo PHP que procesa la solicitud
        method: 'POST',
        data: { codigo: codigo },
        success: function(response) {
          if (response.error) {
            $('#enfermedad').val('No existe esa enfermedad');
          } else {
            $('#enfermedad').val(response.nombre);
          }
        },
        error: function() {
          $('#enfermedad').val('Error al procesar la solicitud');
        }
      });
    });
  });



  $(document).ready(function() {
  $('.button3').click(function() {
    var codigoPaciente = $('#id_paciente').val();

    // Realizar la solicitud AJAX al servidor
    $.ajax({
      url: 'fetch_paciente.php', // Archivo PHP que procesa la solicitud
      method: 'POST',
      data: { codigoPaciente: codigoPaciente },
      success: function(response) {
        if (response.error) {
          $('#nombrePaciente').val(response.error);
        } else {
          $('#nombrePaciente').val(response.nombre);
        }
      },
      error: function() {
        $('#nombrePaciente').val('Error al procesar la solicitud');
      }
    });
  });
});
</script>
</html>
<?php
}else{
  header("Location: ../Index.php");
}
?>