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
    <title>Registro Familiar</title>
</head>
<body><style>
        .b{
            display: none;
        }
    </style>
     <?php
	require "../issets/views/header.php";
	?>
    <div class="container4">
         <form action="../Crud/Paciente/guardarAreaFamiliar.php" method="post" class="form">
            <h2 class="title">Formulario Registro</h2>
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
					<label for="NomMadre" >Nombre Completo de la Madre</label>
					<input id="NomMadre" type="text" name="NomMadre" class="input" placeholder="Aqui tu Nombre de la Madre" required/>
				</div>
				<div class="input-group">
					<label for="NomPadre" >Nombre Completo del Padre</label>
					<input type="text" id="NomPadre" name="NomPadre" placeholder="Aqui tu Nombre del Padre" required/>
				</div>
				<div class="input-group2">
              		<div style="flex-direction:column">
                		<label for="NumHermanos">Numero de Hermanos</label>
					    <input id="NumHermanos" type="number" name="NumHermanos" placeholder="Cantidad" class="input4" />
                	</div>
                	<div style="flex-direction:column">
						<label for="NumHijos">Numero de Hijos</label>
					    <input id="NumHijos" type="number" name="NumHijos"placeholder="Cantidad" class="input4"/>
					</div>
            	</div>
				<div class="input-group">
					<label for="InteFamiliar">Integracion Familiar</label>
					<textarea style="resize: none; padding: 1.8em 1em;font-family: 'Poppins', sans-serif;font-size: 14px;" type="text" id="InteFamiliar" name="InteFamiliar" placeholder="Integracion Familiar" required></textarea>
				</div>
                <div class="input-group">
					<label for="HistMarital">Historial Marital:</label>
					<textarea style="resize: none; padding: 1.8em 1em;font-family: 'Poppins', sans-serif;font-size: 14px;" type="text" id="HistMarital" name="HistMarital" placeholder="Historial Marital" required></textarea>
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
  $('.button3').click(function() {
    var codigoPaciente = $('#id_paciente').val();

    // Realizar la solicitud AJAX al servidor
    $.ajax({
      url: 'fetch_pacienteFamiliar.php', // Archivo PHP que procesa la solicitud
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


