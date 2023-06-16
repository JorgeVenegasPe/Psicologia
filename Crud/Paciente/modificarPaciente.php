<?php
require_once("c:/xampp/htdocs/Psicologia-Agenda-Clinica-master/Controlador/Paciente/ControllerPaciente.php");
$obj = new usernameControlerPaciente();

$obj->modificarPaciente($_POST['id'],$_POST['nombre'], $_POST['ap_paterno'], $_POST['ap_materno'], $_POST['dni'], $_POST['fecha_nacimiento'], $_POST['edad'], $_POST['Grado_ins'], $_POST['ocupacion'], $_POST['estado_civil'], $_POST['genero'], $_POST['telefono'], $_POST['email'], $_POST['direccion'], $_POST['antecedentes']);

?>
