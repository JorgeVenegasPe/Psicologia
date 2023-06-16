<?php
  require("C:/xampp/htdocs/Psicologia-Agenda-Clinica-master/Conexion/conexion.php");
  $con=new conexion();
  $conn=$con->conexion();

  // Obtener el código enviado por AJAX
  $codigo = $_POST['codigo'];

  // Consultar la base de datos para obtener la enfermedad correspondiente
  $sql = "SELECT NombreEmfermedad FROM enfermedad WHERE id_enfermedad = :codigo";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':codigo', $codigo);
  $stmt->execute();

  // Obtener el resultado de la consulta
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($row) {
    $nombreEnfermedad = $row['NombreEmfermedad'];
    $response = array('nombre' => $nombreEnfermedad);
  } else {
    $response = array('error' => 'No existe esa enfermedad');
  }

  // Devolver la respuesta en formato JSON
  header('Content-Type: application/json');
  echo json_encode($response);
  ?>

