<?php
class usernameControlerPaciente{
    private $model;
    public function __construct()
    {
        require_once("C:/xampp/htdocs/Psicologia-Agenda-Clinica-Master/Modelo/Paciente/ModelPaciente.php");
        $this->model=new UserModelPaciente();
    }
    public function guardar($nombre, $ap_paterno, $ap_materno, $dni, $fecha_nacimiento, $edad,$grado_instruccion, $Ocupacion, $EstadoCivil,$genero,$telefono, $email, $direccion,$Antecedente,$id_usuario){
        $id=$this->model->insertarPaciente($nombre, $ap_paterno, $ap_materno, $dni, $fecha_nacimiento, $edad,$grado_instruccion, $Ocupacion, $EstadoCivil,$genero,$telefono, $email, $direccion,$Antecedente,$id_usuario);
        return ($id!=false) ? header("Location:../../Vista/DatosPaciente.php") : header("Location:../../Vista/DatosPaciente.php");
    }
    public function ver($idUsuario) {
        return ($this->model->ver($idUsuario)) ?: false;
    }
    public function eliminar($id){
        return ($this->model->eliminar($id)) ?  header("Location:../../Vista/DatosPaciente.php") : header("Location:../../Vista/DatosPaciente.php");
    }
    public function modificarPaciente($id,$nombre, $ap_paterno, $ap_materno, $dni, $fecha_nacimiento, $edad,$grado_instruccion, $Ocupacion, $EstadoCivil,$genero,$telefono, $email, $direccion,$Antecedente){
        return ($this->model->modificarPaciente($id,$nombre, $ap_paterno, $ap_materno, $dni, $fecha_nacimiento, $edad,$grado_instruccion, $Ocupacion, $EstadoCivil,$genero,$telefono, $email, $direccion,$Antecedente)) !=false ? 
        header("Location:../../Vista/DatosPaciente.php") : header("Location:../../Vista/DatosPaciente.php");
        }
    public function show($id){
            return ($this->model->show($id) != false) ? $this->model->show($id):header("Location:../../Vista/DatosPaciente.php");
        }
}
?>