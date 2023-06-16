<?php
class usernameControlerAreaFamiliar{
    private $model;
    public function __construct()
    {
        require_once("C:/xampp/htdocs/Psicologia-Agenda-Clinica-Master/Modelo/Paciente/ModelAtencFamiliar.php");
        $this->model=new UserModelAreaFamiliar();
    }
    public function guardarAreaFamiliar($id_paciente, $NomPadre, $NomMadre,$CantHermanos,$CantHijos,$integracion_familiar,$historial_martial){
        $id=$this->model->insertarAreaFamiliar($id_paciente, $NomPadre, $NomMadre,$CantHermanos,$CantHijos,$integracion_familiar,$historial_martial);
        return ($id!=false) ? header("Location:../../Vista/DatosPaciente.php") : header("Location:../../Vista/DatosPaciente.php");
    }
    public function ver(){
        return ($this->model->ver()) ? $this->model->ver():false;
    }
    public function eliminarAreaFamiliar($id){
        return ($this->model->eliminarAreaFamiliar($id)) ?  header("Location:../../Vista/DatosPaciente.php") : header("Location:../../Vista/DatosPaciente.php");
    }
    public function ModificarAreaFamiliar($id,$id_paciente, $NomPadre, $NomMadre,$CantHermanos,$CantHijos,$integracion_familiar,$historial_martial){
        return ($this->model->ModificarAreaFamiliar($id, $id_paciente, $NomPadre, $NomMadre,$CantHermanos,$CantHijos,$integracion_familiar,$historial_martial)) !=false ? 
        header("Location:../../Vista/DatosPaciente.php") : header("Location:../../Vista/DatosPaciente.php");
        }
    public function showAreaFamiliar($id) {
        $atencion = $this->model->showAreaFamiliar($id);
        if ($atencion !== false) {
            return $atencion;
        } else {
            return null;
        }
    }
}
?>