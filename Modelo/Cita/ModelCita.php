<?php
class UserModelCita{
    private $PDO;
    public function __construct()
    {
        require_once("C:/xampp/htdocs/Psicologia-Agenda-Clinica-Master/conexion/conexion.php");
        $con=new conexion();
        $this->PDO=$con->conexion();
    }
    public function insertarCita($id, $fecha_registro, $fecha_cita_Inicio, $fecha_cita_Fin, $id_paciente, $d_nombre, $id_usuario) {
        $statement = $this->PDO->prepare("INSERT INTO cita (id_cita, fecha_registro, fecha_cita_Inicio, fecha_cita_Fin, id_paciente, d_nombre, id_usuario) VALUES (:id_cita, :fecha_registro, :fecha_cita_Inicio, :fecha_cita_Fin, :id_paciente, :d_nombre, :id_usuario)");
        $statement->bindParam(":id_cita", $id);
        $statement->bindParam(":fecha_registro", $fecha_registro);
        $statement->bindParam(":fecha_cita_Inicio", $fecha_cita_Inicio);
        $statement->bindParam(":fecha_cita_Fin", $fecha_cita_Fin);
        $statement->bindParam(":id_paciente", $id_paciente);
        $statement->bindParam(":d_nombre", $d_nombre);
        $statement->bindParam(":id_usuario", $id_usuario);
    
        return ($statement->execute()) ? $this->PDO->lastInsertId() : false;
    }
    
    public function ver($idUsuario){
        $statement=$this->PDO->prepare("SELECT c.id_cita,c.fecha_registro,c.fecha_cita_Inicio,c.fecha_cita_Fin,p.nombre,c.d_nombre FROM cita c
                                        INNER JOIN paciente p on c.id_paciente=p.id_paciente
                                        WHERE c.id_usuario = :idUsuario");
        $statement->bindValue(':idUsuario', $idUsuario);
        return($statement->execute())? $statement->fetchaLL():false;

    }
    public function show($id){
        $statement=$this->PDO->prepare("SELECT c.id_cita,c.fecha_registro,c.fecha_cita_Inicio,c.fecha_cita_Fin,p.nombre,c.d_nombre FROM cita c
                                       INNER JOIN paciente p on c.id_paciente=p.id_paciente
                                       where id_cita=:id limit 1");
        $statement->bindParam(":id",$id);
        return($statement->execute())? $statement->fetch():false;

    }
    public function eliminar($id){
        $statement=$this->PDO->prepare("DELETE FROM cita WHERE id_cita=:id;");
        $statement->bindParam(":id",$id);
        return($statement->execute())? true:false;
        
    }
    public function modificarCita($id,$fecha_cita_Inicio, $fecha_cita_Fin,$d_nombre) {
      
        $statement = $this->PDO->prepare("UPDATE cita SET fecha_cita_Inicio=:fecha_cita_Inicio,
         fecha_cita_Fin=:fecha_cita_Fin,d_nombre=:d_nombre WHERE id_cita=:id");
        $statement->bindParam(":id",$id);
        $statement->bindParam(":fecha_cita_Inicio",$fecha_cita_Inicio);
        $statement->bindParam(":fecha_cita_Fin",$fecha_cita_Fin);
        $statement->bindParam(":d_nombre",$d_nombre);
    
        return ($statement->execute())? $this->PDO->lastInsertId():false;
    }
    
}

?>