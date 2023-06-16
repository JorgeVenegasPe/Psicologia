<?php
require_once("C:/xampp/htdocs/Psicologia-Agenda-Clinica-Master/Controlador/Cita/citaControlador.php");

$obj = new usernameControlerCita();
$fecha_cita_inicio = $_POST['fecha_cita_inicio'];
$Hora_inicio = $_POST['Hora_inicio'];
$fechaInicio = $fecha_cita_inicio . ' ' . $Hora_inicio;

$fecha_cita_fin = $_POST['fecha_cita_fin'];
$Hora_Fin = $_POST['Hora_Fin'];
$fechaFin = $fecha_cita_fin . ' ' . $Hora_Fin;
$obj->guardar($_POST['id'], $_POST['fecha_registro'], $fechaInicio, $fechaFin, $_POST['id_paciente'], $_POST['d_nombre'], $_POST['id_usuario']);

?>
