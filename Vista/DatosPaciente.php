<?php
session_start();
if (isset($_SESSION['usuario'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../issets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../issets/css/FormularioDatos.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Datos de Paciente</title>
</head>
<body>
    <style>
        .a{
            display:none;
        }
    </style>
<?php
require_once "../issets/views/header.php";
require_once("../Controlador/Paciente/ControllerPaciente.php");
require_once("../Controlador/Paciente/ControllerAtencPaciente.php");
require_once("../Controlador/Paciente/ControllerAtencFamiliar.php");
    $Fam=new usernameControlerAreaFamiliar();
    $Atenc=new usernameControlerAtencPaciente();
    $obj=new usernameControlerPaciente();
    $rows=$obj->ver($_SESSION['id_usuario']);
?>
    <div class="container3">
        <div class="input-group form">
	    	<label for="buscar">Buscar</label>
	    	<input id="buscar" type="text" name="buscar" class="input" placeholder="Buscar" required/>
        </div>
	</div>
    <div class="container4">
    <div class="cards">
        <?php if ($rows): ?>
            <?php foreach ($rows as $row): ?>
                <div class="card" data-id="<?=$row[0]?>">
                    <div class="card__body">
                        <h1 class="id" style="display:none;"><?=$row[0]?></h1>
                        <h2 class="title"><?=$row[1]?> <?=$row[2]?></h2>
                        <h1 style="display:none;"><?=$row[3]?></h1>
                        <label>DNI: </label><label class="dni"><?=$row[4]?></label>
                        <br>
                        <label>Correo: </label><label class="correo"><?=$row[12]?></label>
                        <br>
                        <br>
                        <a type="button" style="cursor:pointer;" class="nav-link" onclick="openModalVerPaciente('<?=$row[0]?>')">Ver Datos Personales</a>
                        <br>
                        <a type="button" style="cursor:pointer;" class="nav-link" onclick="openModalVerHistorialFamiliar('<?=$row[0]?>')">Ver Datos Familiares</a>
                        <br>
                        <a type="button" style="cursor:pointer;" class="nav-link" onclick="openModalVerDiagnostico('<?=$row[0]?>')">Ver Diagnostico</a>
                        <br>
                        <a type="button" style="cursor:pointer;" class="nav-link" onclick="openModalVerHistorial('<?=$row[0]?>')">Ver Historial</a>
                        
                    </div>
                </div>
                <?php
                    $user=$obj->show($row[0]);
                ?>
                <!-- Ver Pacientes --> 
                <div id="modalPaciente<?=$row[0]?>" class="modal">
                    <div class="containerModal">
                        <a href="#" class="close" onclick="closeModalVerPaciente('<?=$row[0]?>')">&times;</a>
                        <form action="../Crud/Cita/modificarCita.php" class="form" autocomplete="off"
                            method="post">
                            <h2 class="title">Paciente <?=$row[1]?></h2>
                            <p>Apellido Paterno: <label class="datos"><?=$user[2]?></label></p>
                            <p>Apellido Materno:  <label class="datos"><?=$user[3]?></label></p>
                            <p>DNI:  <label class="datos"><?=$user[4]?></label></p>
                            <p>Fecha de Nacimiento:  <label class="datos"><?=$user[5]?></label></p>
                            <p>Edad: <label class="datos"> <?=$user[6]?></label></p>
                            <p>Grado de Instruccion:  <label class="datos"><?=$user[7]?></label></p>
                            <p>Ocupaciòn:  <label class="datos"><?=$user[8]?></label></p>
                            <p>Estado Civil:  <label class="datos"><?=$user[9]?></label></p>
                            <p>Genero:  <label class="datos"><?=$user[10]?></label></p>
                            <p>Telefono:  <label class="datos"><?=$user[11]?></label></p>
                            <p>Email:  <label class="datos"><?=$user[12]?></label></p>
                            <p>Direccion:  <label class="datos"><?=$user[13]?></label></p>
                            <p>Antecedentes Medicos:  <label class="datos"><?=$user[14]?></label></p>
                            <div class="butonss">
                            <a type="button" href="../Crud/Paciente/eliminarPaciente.php?id=<?=$row[0]?>" id="deleteBtn" class="btne"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            <a type="button" id="editBtn" onclick="openModalEditar('<?=$row[0]?>')" class="btnm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            </div>
                        </form>
                    </div>
                </div>

                <?php
                    $AtencsUser=$Atenc->showAtenc($row[0]);
                ?>
                <!-- Ver Diagnostico --> 
                <div id="modalDiagnostico<?=$row[0]?>" class="modal">
                    <div class="containerModal">
                        <a href="#" class="close" onclick="closeModalVerDiagnostico('<?=$row[0]?>')">&times;</a>
                        <form action="../Crud/Cita/modificarCita.php" class="form" autocomplete="off"
                            method="post">
                            <?php 
                            if ($AtencsUser !== null) { ?>
                                <h2 class="title">Paciente <?=$AtencsUser[3]?></h2>
                                <p>Enfermedad: <label class="datos"><?=$AtencsUser[2]?></label></p>
                                <p>Diagnóstico: <label class="datos"><?=$AtencsUser[4]?></label></p>
                                <p>Tratamiento: <label class="datos"><?=$AtencsUser[5]?></label></p>
                                <p>Observacion: <label class="datos"><?=$AtencsUser[7]?></label></p>
                                <div class="butonss">
                                    <a type="button" href="../Crud/Paciente/eliminarAtencPaciente.php?id=<?=$AtencsUser[0]?>" id="deleteBtn" class="btne"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    <a type="button" onclick="openModalEditarDiag('<?=$row[0]?>')"id="editBtn" class="btnm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                </div>
                            <?php 
                            } else { 
                                ?>
                                <h2 class="error">No hay registros de atención para este paciente</h2>
                            <?php 
                            } 
                            ?>                   
                        </form>
                    </div>
                </div>

                <!-- Editar Paciente -->
                <div id="modalEditar<?=$row[0]?>" class="modal">
                    <div class="containerModal">
                        <a href="#" class="close" onclick="closeModalEditar('<?=$row[0]?>')">&times;</a>
                        <form action="../Crud/Paciente/modificarPaciente.php" class="form" autocomplete="off"
                            method="post">
                            <h2 class="title">Modificar datos de <?=$user[1]?><label class="labelModalTittle"></label></h2>
                            <div class="checkout-information">
                                <input style="display:none" type="text" value="<?=$user[0]?>">
                                <div class="input-group">
                                    <label style="display:none" class="labelModal" for="id">id</label>
                                    <input style="display:none" type="text" id="id" name="id" class="input"value="<?=$user[0]?>" />
                                </div>
                                <div class="input-group">
                                    <label class="labelModal" for="nombre">Nombre</label>
                                    <input type="text" id="nombre" name="nombre" class="input" value="<?=$user[1]?>" />
                                </div>
                                <div class="input-group">
                                    <label class="labelModal" for="ap_paterno">Apellido Materno</label>
                                    <input class="input" type="text" id="ap_paterno" name="ap_paterno" value="<?=$user[2]?>" required>
                                </div>
                                <div class="input-group">
                                    <label class="labelModal" for="ap_materno">Apellido Paterno</label>
                                    <input class="input" type="text" id="ap_materno" name="ap_materno" value="<?=$user[3]?>" required>
                                </div>
                                <div class="input-group">
                                    <label class="labelModal" for="dni">DNI</label>
                                    <input type="text"id="dni" name="dni" value="<?=$user[4]?>" required>
                                </div>
                                <div class="input-group">
                                    <label class="labelModal" for="fecha_nacimiento">Fecha de Naciemiento</label>
                                    <input type="text" id="fecha_nacimiento" placeholder="Buscar..." name="fecha_nacimiento" value="<?=$user[5]?>" required>
                                </div>
                                <div class="input-group">
                                    <label class="labelModal" for="edad">Edad</label>
                                    <input type="text" id="edad" name="edad" value="<?=$user[6]?>" required>
                                </div>
                                <div class="input-group">
                                    <label class="labelModal" for="Grado_ins">Grado de Instruccion</label>
                                    <input class="input" id="Grado_ins"type="text" name="Grado_ins" value="<?=$user[7]?>" required>
                                </div>
                                <div class="input-group">
                                    <label class="labelModal" for="ocupacion">Ocupacion</label>
                                    <input class="input" type="text" id="ocupacion" name="ocupacion" value="<?=$user[8]?>" required>
                                </div>
                                <div class="input-group">
                                    <label class="labelModal" for="estado_civil">Estado Civil</label>
                                    <input type="text" id="estado_civil" placeholder="Buscar..." name="estado_civil" value="<?=$user[9]?>" required>
                                </div>
                                <div class="input-group">
                                    <label class="labelModal" for="genero">Genero</label>
                                    <input type="text" id="genero" placeholder="Buscar..." name="genero" value="<?=$user[10]?>" required>
                                </div>
                                <div class="input-group">
                                    <label class="labelModal" for="telefono">Telefono</label>
                                    <input type="text" id="telefono" name="telefono" value="<?=$user[11]?>" required>
                                </div>
                                <div class="input-group">
                                    <label class="labelModal" for="email">Email</label>
                                    <input class="input" id="email" type="text" name="email" value="<?=$user[12]?>" required>
                                </div>
                                <div class="input-group">
                                    <label class="labelModal" for="direccion">Direccion</label>
                                    <input class="input" type="text" id="direccion" name="direccion" value="<?=$user[13]?>" required>
                                </div>
                                <div class="input-group">
                                    <label class="labelModal" for="antecedentes">Antecedentes</label>
                                    <input type="text" id="antecedentes" name="antecedentes" value="<?=$user[14]?>" required>
                                </div>
                                <br>
                                <div class="xd">
                                    <button type="submit" class="buttonM">Editar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Editar Diagnostico -->
                <div id="modalEditarDiag<?=$row[0]?>" class="modal">
                    <div class="containerModal" >
                        <a href="#" class="close" onclick="closeModalEditarDiag('<?=$row[0]?>')">&times;</a>
                        <form action="../Crud/Paciente/modificarAtencPaciente.php" class="form" autocomplete="off"
                            method="post">
                            <h2 class="title">Modificar datos de <?=$AtencsUser[3]?><label class="labelModalTittle"></label></h2>
                            <div class="checkout-information">
                                <input style="display:none" type="text" value="<?=$AtencsUser[0]?>">
                                <div class="input-group">
                                    <label style="display:none" class="labelModal" for="id">id</label>
                                    <input style="display:none" type="text" id="id" name="id" class="input"value="<?=$AtencsUser[0]?>" />
                                </div>
                                <div class="input-group">
                                    <label style="display:none" class="labelModal" for="id_paciente">id</label>
                                    <input style="display:none" type="text" id="id_paciente" name="id_paciente" class="input"value="<?=$AtencsUser[6]?>" />
                                </div>
                                <div class="input-group">
                                    <label style="display:none" class="labelModal" for="id_enfermedad">id</label>
                                    <input style="display:none" type="text" id="id_enfermedad" name="id_enfermedad" class="input"value="<?=$AtencsUser[1]?>" />
                                </div>
                                <div class="input-group">
                                    <label class="labelModal" for="diagnostico">Diagnostico</label>
                                    <input class="input" type="text" id="diagnostico" name="diagnostico" value="<?=$AtencsUser[4]?>" required>
                                </div>
                                <div class="input-group">
                                    <label class="labelModal" for="tratamiento">Tratamiento</label>
                                    <input class="input" type="text" id="tratamiento" name="tratamiento" value="<?=$AtencsUser[5]?>" required>
                                </div>
                                <br>
                                <div class="xd">
                                    <button type="submit" class="buttonM">Editar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
                    $AtencsUserDiag=$Atenc->showAtencDiagnostico($row[0]);
                ?>
                <!-- Ver Historial -->
                <div id="modalHistorial<?=$row[0]?>" class="modal">
                    <div class="containerModal">
                        <a href="#" class="close" onclick="closeModalVerHistorial('<?=$row[0]?>')">&times;</a>                        
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha de Diagnostico</th>
                                    <th>Registros</th>
                                </tr>
                            </thead>
                        <tbody id="myTable">
                        <?php if ($AtencsUserDiag) :?>
                        <?php foreach ($AtencsUserDiag as $rowsDiag): 
                        $AtencsUserDiagVerMas=$Atenc->getAtencDiagnosticoById($rowsDiag[0]);
                            ?>
                            <tr>
                                <td><?=$rowsDiag[0]?></td>
                                <td><?=$rowsDiag[1]?></td>
                                <td class="acct">
                                    <a type="button" style="cursor:pointer;" class="nav-link" onclick="openModalVerDiagnosticoDos('<?=$rowsDiag[0]?>')">Ver màs</a>
                                </td>
                            </tr>
                            <!-- Diagnostico dos -->
                            <div id="modalEditarDiagDos<?=$rowsDiag[0]?>" class="modal">
                                <div class="container5" >
                                    <form action="../Crud/Paciente/guardarAtencPaciente.php" method="post" class="form2">
                                    <a href="#" class="close" onclick="closeModalVerDiagnosticoDos('<?=$rowsDiag[0]?>')">&times;</a>
                                        <h2 class="title">Formulario de Atencion al Paciente</h2>
                                        <input style="display:none" type="text" value="<?=$AtencsUserDiagVerMas[0]?>">
                                            <div class="input-group">
                                                <label style="display:none" class="labelModal" for="id">id</label>
                                                <input style="display:none" type="text" id="id" name="id" class="input"value="<?=$AtencsUserDiagVerMas[0]?>" />
                                            </div>
                                        <div class="checkout-information">
                                            <div class="input-group2">
                                                <div style="flex-direction:column">
                                                    <label for="id_paciente" >Id del Paciente</label>
		                                		    <input id="id_paciente" type="text" name="id_paciente" class="input2" value="<?=$AtencsUserDiagVerMas[5]?>" readonly />
                                                    <a class="button3"><i class="fa fa-search" aria-hidden="true"></i></a>
                                                </div>
                                                <div style="flex-direction:column">
		                                		    <label for="nombrePaciente" >Nombre de Paciente</label>
		                                		    <input id="nombrePaciente" type="text" name="nombrePaciente" value="<?=$AtencsUserDiagVerMas[6]?>" class="input3" readonly/>
		                                	    </div>
                                            </div>
                                            <div class="input-group">
		                                		<label for="diagnostico">Diagnostico</label>
		                                		<textarea style="resize: none; padding: 1.2em 1em 2.8em 1em;font-family: 'Poppins', sans-serif;	font-size: 14px;" type="text" id="diagnostico" name="diagnostico" readonly><?=$AtencsUserDiagVerMas[0]?></textarea>
		                                	</div>
                                            <div class="input-group">
		                                	   	<label for="tratamiento">Tratamiento</label>
		                                	   	<textarea style="resize: none; padding: 1.2em 1em 2.8em 1em;font-family: 'Poppins', sans-serif;	font-size: 14px;" type="text" id="tratamiento" name="tratamiento" readonly><?=$AtencsUserDiagVerMas[1]?></textarea>
		                                	</div>
                                            <div class="input-group">
		                                	   	<label for="tratamiento">Observacion</label>
		                                	   	<textarea style="resize: none; padding: 1.2em 1em 2.8em 1em;font-family: 'Poppins', sans-serif;	font-size: 14px;" type="text" id="tratamiento" name="tratamiento"  readonly><?=$AtencsUserDiagVerMas[2]?></textarea>
		                                	</div>
                                            <div class="input-group2">
                                                <div style="flex-direction:column">
		                                		    <label for="id_enfermedad">Codigo  Enfermedad</label>
		                                		    <input class="input2" type="text" id="id_enfermedad" name="id_enfermedad" value="<?=$AtencsUserDiagVerMas[3]?>" readonly/>
		                                		    <a class="button2"><i class="fa fa-search" aria-hidden="true"></i></a>
                                                </div>
                                                <div style="flex-direction:column">
		                                		    <label for="enfermedad">Emfermedad</label>
		                                		    <input type="text" class="input3" id="enfermedad" value="<?=$AtencsUserDiagVerMas[4]?>" name="enfermedad" readonly />
		                                		</div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach;?>
                        <?php else:?>
                        <tr>
                            <td colspan="7" class="text-center">No hay registro</td>
                        </tr>
                        <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                    $AtencAreaFamiliar=$Fam->showAreaFamiliar($row[0]);
                ?>
                <!-- Ver Historial Familiar-->
                <div id="modalHistorialFamiliar<?=$row[0]?>" class="modal">
                    <div class="containerModal">
                        <a href="#" class="close" onclick="closeModalVerHistorialFamiliar('<?=$row[0]?>')">&times;</a>
                        <form action="../Crud/Cita/modificarCita.php" class="form" autocomplete="off"
                            method="post">
                            <?php 
                            if ($AtencAreaFamiliar !== null) { ?>
                                <h2 class="title">Paciente <?=$AtencAreaFamiliar[2]?></h2>
                                <p style="display:none">Id: <label class="datos"><?=$AtencAreaFamiliar[0]?></label></p>
                                <p>Nombre de Padre: <label class="datos"><?=$AtencAreaFamiliar[3]?></label></p>
                                <p>Nombre de Madre: <label class="datos"><?=$AtencAreaFamiliar[4]?></label></p>
                                <p>Numero de Hermanos: <label class="datos"><?=$AtencAreaFamiliar[5]?></label></p>
                                <p>Numero de Hijos: <label class="datos"><?=$AtencAreaFamiliar[6]?></label></p>
                                <p>Integracion Familiar: <label class="datos"><?=$AtencAreaFamiliar[7]?></label></p>
                                <p>Historial Marital: <label class="datos"><?=$AtencAreaFamiliar[8]?></label></p>
                                <div class="butonss">
                                    <a type="button" href="../Crud/Paciente/eliminarAreaFamiliar.php?id=<?=$AtencAreaFamiliar[0]?>" id="deleteBtn" class="btne"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    <a type="button" onclick="openModalModificarHistorialFamiliar('<?=$AtencAreaFamiliar[0]?>')"id="editBtn" class="btnm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                </div>
                            <?php 
                            } else { 
                                ?>
                                <h2 class="error">No hay registros de atención para este paciente</h2>
                            <?php 
                            } 
                            ?>                   
                        </form>
                    </div>
                </div>
                <!-- Editar Hitorial Familar-->
                <div id="modalModificarHistorialFamiliar<?=$AtencAreaFamiliar[0]?>" class="modal">
                    <div class="containerModal" >
                        <a href="#" class="close" onclick="closeModalModificarHistorialFamiliar('<?=$AtencAreaFamiliar[0]?>')">&times;</a>
                        <form action="../Crud/Paciente/modificarAreaFamiliar.php" class="form" autocomplete="off"
                            method="post">
                            <h2 class="title">Modificar datos de <?=$AtencAreaFamiliar[2]?><label class="labelModalTittle"></label></h2>
                            <div class="checkout-information">
                                <input style="display:none" type="text" value="<?=$AtencAreaFamiliar[0]?>">
                                <div class="input-group">
                                    <label style="display:none" class="labelModal" for="id">id</label>
                                    <input style="display:none" type="text" id="id" name="id" class="input"value="<?=$AtencAreaFamiliar[0]?>" />
                                </div><div class="input-group">
                                    <label style="display:none" class="labelModal" for="id_paciente">id</label>
                                    <input style="display:none" type="text" id="id_paciente" name="id_paciente" class="input"value="<?=$AtencAreaFamiliar[1]?>" />
                                </div>
                                <div class="input-group">
				                	<label for="NomMadre" >Nombre Completo de la Madre</label>
				                	<input id="NomMadre" type="text" name="NomMadre" class="input" value="<?=$AtencAreaFamiliar[4]?>" required/>
				                </div>
				                <div class="input-group">
				                	<label for="NomPadre" >Nombre Completo del Padre</label>
				                	<input type="text" id="NomPadre" name="NomPadre" value="<?=$AtencAreaFamiliar[3]?>" required/>
				                </div>
				                <div class="input-group2">
              	                	<div style="flex-direction:column">
                                		<label for="NumHermanos">Numero de Hermanos</label>
				                	    <input id="NumHermanos" type="number" name="NumHermanos" value="<?=$AtencAreaFamiliar[5]?>" class="input4" />
                                	</div>
                                	<div style="flex-direction:column">
				                		<label for="NumHijos">Numero de Hijos</label>
				                	    <input id="NumHijos" type="number" name="NumHijos" value="<?=$AtencAreaFamiliar[6]?>"class="input4"/>
				                	</div>
            	                </div>
				                <div class="input-group">
				                	<label for="InteFamiliar">Integracion Familiar</label>
				                	<textarea style="resize: none; padding: 1.8em 1em;font-family: 'Poppins', sans-serif;font-size: 14px;" type="text" id="InteFamiliar" name="InteFamiliar" required><?=$AtencAreaFamiliar[7]?></textarea>
				                </div>
                                <div class="input-group">
				                	<label for="HistMarital">Historial Marital:</label>
				                	<textarea style="resize: none; padding: 1.8em 1em;font-family: 'Poppins', sans-serif;font-size: 14px;" type="text" id="HistMarital" name="HistMarital" required><?=$AtencAreaFamiliar[8]?></textarea>
				                </div>
                                <br>
                                <div class="xd">
                                    <button type="submit" class="buttonM">Editar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            <?php endforeach; ?>
        <?php endif; ?>
    </div>
   
    
</body>
<script>
// Paciente    
function openModalVerPaciente(id) {
document.getElementById('modalPaciente' + id).style.display = 'block';
}
function closeModalVerPaciente(id) {
    document.getElementById('modalPaciente' + id).style.display = 'none';
}
// Diagnostico
function openModalVerDiagnostico(id) {
    document.getElementById('modalDiagnostico' + id).style.display = 'block';
}
function closeModalVerDiagnostico(id) {
    document.getElementById('modalDiagnostico' + id).style.display = 'none';
}
// Diagnostico Dos
function openModalVerDiagnosticoDos(id) {
    document.getElementById('modalEditarDiagDos' + id).style.display = 'block';
}
function closeModalVerDiagnosticoDos(id) {
    document.getElementById('modalEditarDiagDos' + id).style.display = 'none';
}
// Historial
function openModalVerHistorial(id) {
    document.getElementById('modalHistorial' + id).style.display = 'block';
}
function closeModalVerHistorial(id) {
    document.getElementById('modalHistorial' + id).style.display = 'none';
}// Historial Familiar
function openModalVerHistorialFamiliar(id) {
    document.getElementById('modalHistorialFamiliar' + id).style.display = 'block';
}
function closeModalVerHistorialFamiliar(id) {
    document.getElementById('modalHistorialFamiliar' + id).style.display = 'none';
}
function openModalModificarHistorialFamiliar(id) {
    document.getElementById('modalModificarHistorialFamiliar' + id).style.display = 'block';
}
function closeModalModificarHistorialFamiliar(id) {
    document.getElementById('modalModificarHistorialFamiliar' + id).style.display = 'none';
}
// Editar Paciente
function openModalEditar(id) {
    document.getElementById('modalEditar' + id).style.display = 'block';
}
function closeModalEditar(id) {
    document.getElementById('modalEditar' + id).style.display = 'none';
}
// Editar Giagnostico 
function openModalEditarDiag(id) {
    document.getElementById('modalEditarDiag' + id).style.display = 'block';
}
function closeModalEditarDiag(id) {
    document.getElementById('modalEditarDiag' + id).style.display = 'none';
}
</script>
</html>
<?php
}else{
  header("Location: ../Index.php");
}
?>

