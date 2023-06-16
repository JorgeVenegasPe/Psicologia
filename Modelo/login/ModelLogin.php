<?php 
    class Login {
        private $PDO;
        public function __construct()
        {
        require("../../Conexion/conexion.php");
        $con=new conexion();
        $this->PDO=$con->conexion();
        }
        public function validarDatos($usuario, $contrasena) {
            if($_POST){
                session_start();
                $usuario = $_POST['usu'];
                $contrasena = $_POST['pass'];
                $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $statement = $this->PDO->prepare("SELECT * FROM usuarios WHERE usuario = :u AND password = :p");
                $statement->bindParam(":u", $usuario);
                $statement->bindParam(":p", $contrasena);
                $statement->execute();
                $usuario = $statement->fetch(PDO::FETCH_ASSOC);
                if($usuario){
                    $_SESSION['usuario'] = $usuario["nombre"];
                    $_SESSION['id_usuario'] = $usuario["id_usuario"];
                    header("location: ../../Vista/CalendarioCitas.php");
                }else{
                    header("location: ../../Index.php?error=1");
                } 
            }
        }

    }
?>