<?php
require("C:/xampp/htdocs/Psicologia-Agenda-Clinica-master/Conexion/conexion.php");
$con = new conexion();
$conn = $con->conexion();

// Obtener el código enviado por AJAX
$codigoPaciente = $_POST['codigoPaciente'];


// Consultar la base de datos para obtener la atención del paciente
$sql = "SELECT pa.nombre, af.NomPadre , af.NomMadre, af.integracion_familiar
        FROM paciente pa
        LEFT JOIN area_familiar af ON af.id_paciente = pa.id_paciente
        WHERE pa.id_paciente = :codigoPaciente";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':codigoPaciente', $codigoPaciente);
$stmt->execute();

// Obtener el resultado de la consulta
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
  $nombrePaciente = $row['nombre'];
  $NomPadre = $row['NomPadre'];
  $NomMadre = $row['NomMadre'];
  $integracion_familiar = $row['integracion_familiar'];

  if ($NomPadre && $NomMadre && $integracion_familiar) {
    $response = array('error' => 'Este paciente ya esta Registrado');
  } else {
    $response = array('nombre' => $nombrePaciente);
  }
} else {
  $response = array('error' => 'No existe ese paciente');
}

// Devolver la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
