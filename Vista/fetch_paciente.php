<?php
require("C:/xampp/htdocs/Psicologia-Agenda-Clinica-master/Conexion/conexion.php");
$con = new conexion();
$conn = $con->conexion();

// Obtener el código enviado por AJAX
$codigoPaciente = $_POST['codigoPaciente'];

// Consultar la base de datos para obtener la atención del paciente
$sql = "SELECT pa.nombre, ap.diagnostico, ap.tratamiento
        FROM paciente pa
        LEFT JOIN atencion_paciente ap ON ap.id_paciente = pa.id_paciente
        WHERE pa.id_paciente = :codigoPaciente";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':codigoPaciente', $codigoPaciente);
$stmt->execute();

// Obtener el resultado de la consulta
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
  $nombrePaciente = $row['nombre'];
  $response = array('nombre' => $nombrePaciente);
} else {
  $response = array('error' => 'No existe esw paciente');
}

// Devolver la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>

