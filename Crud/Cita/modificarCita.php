<?php
require_once("C:/xampp/htdocs/Psicologia-Agenda-Clinica-Master/Controlador/Cita/citaControlador.php");
$obj = new usernameControlerCita();

$fecha_cita_inicio = $_POST['fecha_cita_inicio'];
$Hora_inicio = $_POST['Hora_inicio'];
$fechaInicio = $fecha_cita_inicio . ' ' . $Hora_inicio;

$fecha_cita_fin = $_POST['fecha_cita_fin'];
$Hora_Fin = $_POST['Hora_Fin'];
$fechaFin = $fecha_cita_fin . ' ' . $Hora_Fin;
$obj->modificarCita($_POST['id'],$fechaInicio, $fechaFin, $_POST['d_nombre']);

?>
