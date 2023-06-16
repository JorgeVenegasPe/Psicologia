<?php
class UserModelAreaFamiliar{
    private $PDO;
    public function __construct()
    {
        require_once("C:/xampp/htdocs/Psicologia-Agenda-Clinica-master/Conexion/conexion.php");
        $con=new conexion();
        $this->PDO=$con->conexion();

    }
    public function insertarAreaFamiliar($id_paciente, $NomPadre, $NomMadre,$CantHermanos,$CantHijos,$integracion_familiar,$historial_martial) {
        $id_paciente = $_POST['id_paciente'];
        $NomPadre = $_POST['NomPadre'];
        $NomMadre = $_POST['NomMadre'];
        $CantHermanos = $_POST['NumHermanos'];
        $CantHijos = $_POST['NumHijos'];
        $integracion_familiar = $_POST['InteFamiliar'];
        $historial_martial = $_POST['HistMarital'];
        $statement=$this->PDO->prepare("INSERT INTO area_familiar(id_paciente, NomPadre, NomMadre, CantHermanos,CantHijos,integracion_familiar,historial_martial) VALUES(:id_paciente, :NomPadre, :NomMadre,:CantHermanos,:CantHijos,:integracion_familiar,:historial_martial)");
        $array = array($id_paciente, $NomPadre, $NomMadre,$CantHermanos,$CantHijos,$integracion_familiar,$historial_martial);
        $statement->bindParam(":id_paciente",$id_paciente);
        $statement->bindParam(":NomPadre",$NomPadre);
        $statement->bindParam(":NomMadre",$NomMadre);
        $statement->bindParam(":CantHermanos",$CantHermanos);
        $statement->bindParam(":CantHijos",$CantHijos);
        $statement->bindParam(":integracion_familiar",$integracion_familiar);
        $statement->bindParam(":historial_martial",$historial_martial);

        return ($statement->execute())? $this->PDO->lastInsertId():false;
    }
    public function ver(){
        $statement=$this->PDO->prepare("SELECT * FROM atencion_paciente");
        return($statement->execute())? $statement->fetchaLL():false;
    }
    public function showAreaFamiliar($id){
        $statement=$this->PDO->prepare("SELECT af.IdFamiliar,af.id_paciente, p.nombre,af.NomPadre,af.NomMadre,af.CantHermanos,af.CantHijos,af.integracion_familiar,af.historial_martial
        FROM area_familiar af
        JOIN paciente p ON af.id_paciente = p.id_paciente
        WHERE p.id_paciente = :id
        LIMIT 1 ");
        $statement->bindParam(":id",$id);
        return($statement->execute())? $statement->fetch():false;
    }
    public function eliminarAreaFamiliar($id){
        $statement=$this->PDO->prepare("DELETE FROM area_familiar WHERE IdFamiliar=:id;");
        $statement->bindParam(":id",$id);
        return($statement->execute())? true:false;

    }
    public function ModificarAreaFamiliar($id, $id_paciente, $NomPadre, $NomMadre,$CantHermanos,$CantHijos,$integracion_familiar,$historial_martial) {
      
        $statement = $this->PDO->prepare("UPDATE area_familiar SET id_paciente=:id_paciente, NomPadre=:NomPadre, NomMadre=:NomMadre, CantHermanos=:CantHermanos,CantHijos=:CantHijos,integracion_familiar=:integracion_familiar,historial_martial=:historial_martial WHERE IdFamiliar=:id");
        $statement->bindParam(":id",$id);
        $statement->bindParam(":id_paciente",$id_paciente);
        $statement->bindParam(":NomPadre",$NomPadre);
        $statement->bindParam(":NomMadre",$NomMadre);
        $statement->bindParam(":CantHermanos",$CantHermanos);
        $statement->bindParam(":CantHijos",$CantHijos);
        $statement->bindParam(":integracion_familiar",$integracion_familiar);
        $statement->bindParam(":historial_martial",$historial_martial);
    
        return ($statement->execute())? $this->PDO->lastInsertId():false;
    }
}
?>