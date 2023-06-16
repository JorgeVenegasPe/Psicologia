<?php
header('Content-Type: application/json');

require_once("C:/xampp/htdocs/Psicologia-Agenda-Clinica-Master/conexion/conexion.php");
        $con=new conexion();
        $PDO=$con->conexion();

switch ($_GET['accion']) {

    case 'listar':
      try {
        $query = "SELECT c.id_cita as id,
                  p.id_paciente AS title,
                  c.fecha_cita_Inicio AS start,
                  c.fecha_cita_Fin AS end,
                  d_nombre
        FROM cita c
        INNER JOIN paciente p ON c.id_paciente = p.id_paciente";
        $statement = $PDO->query($query);
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
      } catch(PDOException $e) {
        echo "Error al listar citas: " . $e->getMessage();
        die();
      }
      break;
  
  case 'agregar':
    try {
      $query = "INSERT INTO cita (id_paciente, fecha_cita_Inicio, fecha_cita_Fin, d_nombre) VALUES
                (:id_paciente, :fecha_cita_Inicio, :fecha_cita_Fin,:d_nombre)";
      $statement =$PDO->prepare($query);
      $statement->bindParam(':id_paciente', $_POST['titulo']);
      $statement->bindParam(':fecha_cita_Inicio', $_POST['inicio']);
      $statement->bindParam(':fecha_cita_Fin', $_POST['fin']);
      $statement->bindParam(':d_nombre', $_POST['docnombre']);
      $statement->execute();
      echo json_encode(true);
    } catch(PDOException $e) {
      echo "Error al agregar cita: " . $e->getMessage();
      die();
    }
    break;

  case 'modificar':
    try {
      $query = "UPDATE cita SET id_paciente = :id_paciente,
                fecha_cita_Inicio = :fecha_cita_Inicio,
                fecha_cita_Fin = :fecha_cita_Fin,
                d_nombre = :d_nombre
                WHERE id_cita = :id_cita";
      $statement =$PDO->prepare($query);
      $statement->bindParam(':id_paciente', $_POST['titulo']);
      $statement->bindParam(':fecha_cita_Inicio', $_POST['inicio']);
      $statement->bindParam(':fecha_cita_Fin', $_POST['fin']);
      $statement->bindParam(':d_nombre', $_POST['docnombre']);
      $statement->bindParam(':id_cita', $_POST['id']);
      $statement->execute();
      echo json_encode(true);
    } catch(PDOException $e) {
      echo "Error al modificar cita: " . $e->getMessage();
      die();
    }
    break;

  case 'borrar':
    try {
      $query = "DELETE FROM cita WHERE id_cita = :id_cita";
      $statement = $PDO->prepare($query);
      $statement->bindParam(':id_cita', $_POST['id']);
      $statement->execute();
      echo json_encode(true);
    } catch(PDOException $e) {
      echo "Error al borrar cita: " . $e->getMessage();
      die();
    }
    break;
}

?>
