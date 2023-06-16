<?php
class UserModelAtencPaciente{
    private $PDO;
    public function __construct()
    {
        require_once("C:/xampp/htdocs/Psicologia-Agenda-Clinica-master/Conexion/conexion.php");
        $con=new conexion();
        $this->PDO=$con->conexion();

    }
    public function insertarAtencPaciente($id_paciente, $id_enfermedad, $diagnostico, $tratamiento,$observacion) {
        $id_paciente = $_POST['id_paciente'];
        $id_enfermedad = $_POST['id_enfermedad'];
        $diagnostico = $_POST['diagnostico'];
        $tratamiento = $_POST['tratamiento'];
        $observacion = $_POST['observacion'];
        $statement=$this->PDO->prepare("INSERT INTO atencion_paciente(id_paciente, id_enfermedad, diagnostico, tratamiento, observacion) VALUES(:id_paciente, :id_enfermedad, :diagnostico, :tratamiento,:observacion)");
        $array = array($id_paciente, $id_enfermedad, $diagnostico, $tratamiento,$observacion);
        $statement->bindParam(":id_paciente",$id_paciente);
        $statement->bindParam(":id_enfermedad",$id_enfermedad);
        $statement->bindParam(":diagnostico",$diagnostico);
        $statement->bindParam(":tratamiento",$tratamiento);
        $statement->bindParam(":observacion",$observacion);

        return ($statement->execute())? $this->PDO->lastInsertId():false;
    }
    public function ver(){
        $statement=$this->PDO->prepare("SELECT * FROM atencion_paciente");
        return($statement->execute())? $statement->fetchaLL():false;
    }
    public function showAtencDiagnostico($id_paciente){
        $statement = $this->PDO->prepare("SELECT ap.id, ap.fecha_registro
                                          FROM atencion_paciente ap
                                          WHERE id_paciente = :id_paciente
                                          ORDER BY fecha_registro DESC");
        $statement->bindParam(":id_paciente", $id_paciente);
        return ($statement->execute()) ? $statement->fetchAll() : false;
    }
    public function getAtencDiagnosticoById($id) {
        $statement = $this->PDO->prepare("SELECT ap.diagnostico, ap.tratamiento, ap.observacion,ap.id_enfermedad,e.NombreEmfermedad,ap.id_paciente,p.nombre
        FROM atencion_paciente ap
        JOIN enfermedad e ON ap.id_enfermedad = e.id_enfermedad
        JOIN paciente p ON ap.id_paciente = p.id_paciente
        WHERE ap.id = :id");
        $statement->bindParam(":id", $id);
        return ($statement->execute()) ? $statement->fetch() : false;
    }
    public function showAtenc($id){
        $statement=$this->PDO->prepare("SELECT ap.id, ap.id_enfermedad, e.NombreEmfermedad, p.nombre, ap.diagnostico,ap.tratamiento,ap.id_paciente, ap.observacion
        FROM atencion_paciente ap
        JOIN enfermedad e ON ap.id_enfermedad = e.id_enfermedad
        JOIN paciente p ON ap.id_paciente = p.id_paciente
        WHERE p.id_paciente = :id
        ORDER BY fecha_registro DESC
        LIMIT 1 ");
        $statement->bindParam(":id",$id);
        return($statement->execute())? $statement->fetch():false;
    }
    public function eliminar($id){
        $statement=$this->PDO->prepare("DELETE FROM atencion_paciente WHERE id=:id;");
        $statement->bindParam(":id",$id);
        return($statement->execute())? true:false;

    }
    public function modificarAtencPaciente($id, $id_paciente, $id_enfermedad, $diagnostico, $tratamiento) {
      
        $statement = $this->PDO->prepare("UPDATE atencion_paciente SET id_paciente=:id_paciente, id_enfermedad=:id_enfermedad, diagnostico=:diagnostico, tratamiento=:tratamiento WHERE id=:id");
        $statement->bindParam(":id",$id);
        $statement->bindParam(":id_paciente",$id_paciente);
        $statement->bindParam(":id_enfermedad",$id_enfermedad);
        $statement->bindParam(":diagnostico",$diagnostico);
        $statement->bindParam(":tratamiento",$tratamiento);
    
        return ($statement->execute())? $this->PDO->lastInsertId():false;
    }
}
?>