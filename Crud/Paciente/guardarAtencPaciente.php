<?php
require_once("C:/xampp/htdocs/Psicologia-Agenda-Clinica-master/Controlador/Paciente/ControllerAtencPaciente.php");

$obj = new usernameControlerAtencPaciente();
$obj->guardarAtencPac($_POST['id_paciente'], $_POST['id_enfermedad'], $_POST['diagnostico'], $_POST['tratamiento'],$_POST['observacion']);

?>
