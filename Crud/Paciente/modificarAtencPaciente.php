<?php
require_once("c:/xampp/htdocs/Psicologia-Agenda-Clinica-master/Controlador/Paciente/ControllerAtencPaciente.php");
$obj = new usernameControlerAtencPaciente();

$obj->modificarAtencPaciente($_POST['id'],$_POST['id_paciente'], $_POST['id_enfermedad'], $_POST['diagnostico'], $_POST['tratamiento']);

?>
