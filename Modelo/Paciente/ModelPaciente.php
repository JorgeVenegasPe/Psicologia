<?php
class userModelPaciente{
    private $PDO;
    public function __construct()
    {
        require_once("C:/xampp/htdocs/Psicologia-Agenda-Clinica-master/Conexion/conexion.php");
        $con=new conexion();
        $this->PDO=$con->conexion();

    }
    public function insertarPaciente($nombre, $ap_paterno, $ap_materno, $dni, $fecha_nacimiento, $edad,$grado_instruccion, $Ocupacion, $EstadoCivil,$genero,$telefono, $email, $direccion,$Antecedente,$id_usuario) {
        $nombre = $_POST['nombre'];
        $ap_paterno = $_POST['ap_paterno'];
        $ap_materno = $_POST['ap_materno'];
        $dni = $_POST['dni'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $edad = $_POST['edad'];
        $grado_instruccion = $_POST['Grado_ins'];
        $Ocupacion = $_POST['ocupacion'];
        $EstadoCivil = $_POST['estado_civil'];
        $genero = $_POST['genero'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $direccion = $_POST['direccion'];
        $Antecedente = $_POST['antecedentes'];
        $id_usuario = $_POST['id_usuario'];
        $statement=$this->PDO->prepare("INSERT INTO paciente(nombre, ap_paterno, ap_materno, dni, fecha_nacimiento, edad,
         grado_instruccion, ocuapacion, EstadoCivil, genero,telefono, Email, direccion, Antecedentes,id_usuario) 
         VALUES(:nombre, :ap_paterno, :ap_materno, :dni, :fecha_nacimiento, :edad, :grado_instruccion, 
         :ocupacion, :EstadoCivil, :genero, :telefono, :Email, :direccion, :Antecedentes, :id_usuario)");
        $array = array($nombre, $ap_paterno, $ap_materno, $dni, $fecha_nacimiento, $edad, $grado_instruccion, $Ocupacion, $EstadoCivil, $genero, $telefono, $email, $direccion, $Antecedente, $id_usuario);
        $statement->bindParam(":nombre",$nombre);
        $statement->bindParam(":ap_paterno",$ap_paterno);
        $statement->bindParam(":ap_materno",$ap_materno);
        $statement->bindParam(":dni",$dni);
        $statement->bindParam(":fecha_nacimiento",$fecha_nacimiento);
        $statement->bindParam(":edad",$edad);
        $statement->bindParam(":grado_instruccion",$grado_instruccion);
        $statement->bindParam(":ocupacion",$Ocupacion);
        $statement->bindParam(":EstadoCivil",$EstadoCivil);
        $statement->bindParam(":genero",$genero);
        $statement->bindParam(":telefono",$telefono);
        $statement->bindParam(":Email",$email);
        $statement->bindParam(":direccion",$direccion);
        $statement->bindParam(":Antecedentes",$Antecedente);
        $statement->bindParam(":id_usuario",$id_usuario);
    
        return ($statement->execute())? $this->PDO->lastInsertId():false;
    }
    public function ver($idUsuario) {
        $statement = $this->PDO->prepare("SELECT * FROM paciente WHERE id_usuario = :idUsuario");
        $statement->bindValue(':idUsuario', $idUsuario);
        return ($statement->execute()) ? $statement->fetchAll() : false;
    }
    public function show($id){
        $statement=$this->PDO->prepare("SELECT * FROM paciente where id_paciente=:id limit 1");
        $statement->bindParam(":id",$id);
        return($statement->execute())? $statement->fetch():false;

    }
    public function eliminar($id){
        $statement=$this->PDO->prepare("DELETE FROM paciente WHERE id_paciente=:id;");
        $statement->bindParam(":id",$id);
        return($statement->execute())? true:false;

    }
    public function modificarPaciente($id,$nombre, $ap_paterno, $ap_materno, $dni, $fecha_nacimiento, $edad,$grado_instruccion, $Ocupacion, $EstadoCivil,$genero,$telefono, $email, $direccion,$Antecedente) {
        $statement = $this->PDO->prepare("UPDATE paciente SET nombre=:nombre, ap_paterno=:ap_paterno, ap_materno=:ap_materno,
        dni=:dni,fecha_nacimiento=:fecha_nacimiento,edad=:edad, grado_instruccion=:grado_instruccion, ocuapacion=:ocupacion, EstadoCivil=:EstadoCivil, genero=:genero,
        telefono=:telefono, Email=:Email, direccion=:direccion, Antecedentes=:Antecedentes WHERE id_paciente=:id");
        $statement->bindParam(":id",$id);
        $statement->bindParam(":nombre",$nombre);
        $statement->bindParam(":ap_paterno",$ap_paterno);
        $statement->bindParam(":ap_materno",$ap_materno);
        $statement->bindParam(":dni",$dni);
        $statement->bindParam(":fecha_nacimiento",$fecha_nacimiento);
        $statement->bindParam(":edad",$edad);
        $statement->bindParam(":grado_instruccion",$grado_instruccion);
        $statement->bindParam(":ocupacion",$Ocupacion);
        $statement->bindParam(":EstadoCivil",$EstadoCivil);
        $statement->bindParam(":genero",$genero);
        $statement->bindParam(":telefono",$telefono);
        $statement->bindParam(":Email",$email);
        $statement->bindParam(":direccion",$direccion);
        $statement->bindParam(":Antecedentes",$Antecedente);
        return ($statement->execute())? $this->PDO->lastInsertId():false;
    }
}
?>