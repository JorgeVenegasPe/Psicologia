<?php
require_once("C:/xampp/htdocs/Psicologia-Agenda-Clinica-master/Controlador/Paciente/ControllerAtencFamiliar.php");

$obj = new usernameControlerAreaFamiliar();

$obj->guardarAreaFamiliar($_POST['id_paciente'], $_POST['NomPadre'], $_POST['NomMadre'], $_POST['NumHermanos'], $_POST['NumHijos'], $_POST['InteFamiliar'], $_POST['HistMarital']);

?>
