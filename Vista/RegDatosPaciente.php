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
    <title>Datos del Paciento</title>
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
      <form action="../Crud/Paciente/guardarPaciente.php" method="post" class="form">
        <h2 class="title">Datos del Paciente</h2>
        <div class="checkout-information">
          <div class="input-group">
    		      <label for="nombre">Nombre</label>
    	      	<input id="nombre" type="text" name="nombre" class="input" placeholder="Ingrese su Nombre" required/>
          </div>
          <div class="input-group">
    		      <label for="ap_paterno">Apellido Paterno</label>
    	      	<input id="ap_paterno" type="text" name="ap_paterno" class="input" placeholder="Ingrese su Apellido Paterno" required/>
              <label for="ap_materno">Apellido Materno</label>
    	      	<input id="ap_materno" type="text" name="ap_materno" class="input" placeholder="Ingrese su Apellido Materno" required/>
          </div>
    	    <div class="input-group">
    		      <label for="dni">DNI</label>
    		      <input type="number" id="dni" class="input" name="dni" placeholder="Ingrese su DNI" />
    	    </div>
    	    <div class="input-group">
    		      <label for="fecha_nacimiento">Fecha de nacimiento</label>
    		      <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo date('Y-m-d'); ?>" placeholder="Ingrese su Fecha de Nacimiento" />
          </div>
    	    <div class="input-group">
    		      <label for="edad">Edad</label>
    		      <input type="number" id="edad" name="edad" placeholder="Ingrese su Codigo" />
    	    </div>

          <div class="input-group">
    		      <label for="Grado_ins">Grado de instruccion</label>
    	      	<input id="Grado_ins" type="text" name="Grado_ins" class="input" placeholder="Ingrese su Grado de instruccion" required/>
          </div>
    	    <div class="input-group">
    		      <label for="ocupacion">Ocupacion</label>
    		      <input type="text" id="ocupacion" class="input" name="ocupacion" placeholder="Ingrese su Ocupacion" />
    	    </div>
    	    <div class="input-group">
    		      <label for="estado_civil">Estado civil</label>
    		      <select class="input" id="estado_civil" name="estado_civil" required>
                <option value="">Seleccione un Estado Civil</option>
                <option value="soltero">Soltero/a</option>
                <option value="casado">Casado/a</option>
                <option value="divorciado">Divorciado/a</option>
                <option value="viudo">Viudo/a</option>
              </select>
    	    </div>
          <div class="input-group">
    		      <label for="genero">Género</label>
    		      <select class="input" id="genero" name="genero" required>
                <option value="">Seleccione un Genero</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
                <option value="Otro">Otro</option>
              </select>
    	    </div>
    	    <div class="input-group">
    		      <label for="telefono">Celular</label>
    		      <input type="tel" id="telefono" class="input" name="telefono" placeholder="Ingrese su celular" />
    	    </div>
          <div class="input-group">
    		      <label for="email">Correo Electronico</label>
    		      <input type="email" id="email" class="input" name="email" placeholder="Ingrese su Correo" />
    	    </div>
          <div class="input-group">
    		      <label for="direccion">Dirección</label>
    		      <input type="text" id="direccion" class="input" name="direccion" placeholder="Ingrese su Direccion" />
    	    </div>
          <div class="input-group">
    		      <label for="antecedentes">Antecedentes médicos</label>
    		      <input type="text" id="antecedentes" class="input" name="antecedentes" placeholder="Ingrese algun Antecedente Medico" />
    	    </div>
          <div class="input-group" style="display: none">
    		      <label for="id_usuario">id_usuario</label>
    		      <input type="text" id="id_usuario" class="input" name="id_usuario" value="<?=$_SESSION['id_usuario']?>" placeholder="Ingrese algun Antecedente Medico" />
    	    </div>
          <div class="xd">
            <a href="DatosPaciente.php" class="enlace">Ver pacientes</a>
            <button class="button">Enviar</button>
          </div>
        </div>
      </form>
    </div>
</body>
</html>
<?php
}else{
  header("Location: ../Index.php");
}
?>