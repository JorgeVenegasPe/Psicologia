<?php
class usernameControlerCita{
    private $model;
    public function __construct()
    {
        require_once("C:/xampp/htdocs/Psicologia-Agenda-Clinica-Master/Modelo/Cita/ModelCita.php");
        $this->model=new UserModelCita();
    }
    public function guardar($id, $fecha_registro, $fechaInicio, $fechaFin, $id_paciente, $d_nombre, $id_usuario) {
        $id = $this->model->insertarCita($id, $fecha_registro, $fechaInicio, $fechaFin, $id_paciente, $d_nombre, $id_usuario);
        return ($id != false) ? header("Location:../../Vista/citas.php") : header("Location:../../Vista/citas.php");
    }
    public function ver($idUsuario) {
        return ($this->model->ver($idUsuario)) ?: false;
    }
    public function eliminar($id){
        return ($this->model->eliminar($id)) ?  header("Location:../../Vista/citas.php") : header("Location:../../Vista/citas.php");
    }
    public function modificarCita($id,$fecha_cita_Inicio, $fecha_cita_Fin ,$d_nombre){
        return ($this->model->modificarCita($id,$fecha_cita_Inicio, $fecha_cita_Fin ,$d_nombre)) !=false ? 
        header("Location:../../Vista/citas.php") : header("Location:../../Vista/citas.php");
        }
    public function show($id) {
        $cita = $this->model->show($id);
    
        if ($cita != false) {
            // Separar la fecha y la hora
            $fecha_cita_inicio = explode(" ", $cita['fecha_cita_Inicio']);
            $fecha_inicio = $fecha_cita_inicio[0];
            $hora_inicio = $fecha_cita_inicio[1];

            $fecha_cita_fin = explode(" ", $cita['fecha_cita_Fin']);
            $fecha_fin = $fecha_cita_fin[0];
            $hora_fin = $fecha_cita_fin[1];
    
            // Asignar los valores a las variables para usar en el formulario
            $datos = [
                'id' => $cita['id_cita'],
                'fecha_inicio' => $fecha_inicio,
                'hora_inicio' => $hora_inicio,
                'fecha_fin' => $fecha_fin,
                'hora_fin' => $hora_fin,
                'nombre' => $cita['nombre'],
                'd_nombre' => $cita['d_nombre']
            ];
    
            return $datos;
        } else {
            header("Location: ../../Vista/citas.php");
        }
    }
} 
?>