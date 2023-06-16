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
    <link rel="stylesheet" href="../issets/css/FormularioCita.css">
    <link href="../issets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Citas</title>
</head>
<body>
    <style>
        .b{
            display: none;
        }
    </style>
    
    <?php
    require "../issets/views/header.php";
    ?>
    <div class="cita">
            <!-- El de Jorge -->
            <div class="container4">
                <form action="../Crud/Cita/guardarCita.php" method="post" class="form">
                    <h2 class="title">Formulario Cita</h2>
                    <div class="checkout-information">
                        <div class="input-group">
                            <label for="fecha_registro">Fecha Registro</label>
                            <input class="input" type="date" name="fecha_registro" id="fecha_registro" value="<?php echo date('Y-m-d'); ?>"readonly>
                        </div>
                        <div class="input-group">
                            <label for="fecha_cita_inicio">Fecha de Inicio</label>
                            <input class="input" type="date" id="fecha_cita_inicio" name="fecha_cita_inicio" required>
                        </div>
                        <div class="input-group">
                            <label for="Hora_inicio">Inicio de la Cita</label>
                            <input type="time" id="Hora_inicio" name="Hora_inicio" class="input"/>
                        </div>
                        <div class="input-group">
                            <label for="fecha_cita_fin">Fecha de Fin</label>
                            <input class="input" type="date" id="fecha_cita_fin" name="fecha_cita_fin" required>
                        </div>
                        <div class="input-group">
                            <label for="Hora_Fin">Fin de la Cita</label>
                            <input type="time" id="Hora_Fin" name="Hora_Fin" class="input"/>
                        </div>
                        <div class="input-group2">
                        <div style="flex-direction:column">
                            <label for="id_paciente" >Id del Paciente</label>
				      	    <input id="id_paciente" type="text" name="id_paciente" class="input2" placeholder="ID de el Paciente" required/>
                             <a class="button3"><i class="fa fa-search" aria-hidden="true"></i></a>
                        </div>
                        <div style="flex-direction:column">
					        <label for="nombrePaciente" >Nombre de Paciente</label>
				      	    <input id="nombrePaciente" type="text" name="nombrePaciente" class="input3" readonly/>
				        </div>
                        </div>
                        <div class="input-group">
                            <label for="d_nombre">Nombre de Doctor</label>
                            <input type="text" placeholder="Nombre Doctor" name="d_nombre" required>
                        </div>
                        <div class="input-group" style="display: none">
    		                  <label for="id_usuario">id_usuario</label>
    		                  <input type="text" id="id_usuario" class="input" name="id_usuario" value="<?=$_SESSION['id_usuario']?>" placeholder="Ingrese algun Antecedente Medico" />
    	                </div>
                        <div class="xd">
                            <button class="button">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
            <?php
        require("../Controlador/Cita/citaControlador.php");
        $obj=new usernameControlerCita();
        $rows=$obj->ver($_SESSION['id_usuario']);
        ?>
        <div style="flex-direction:column">
            <div class="container">
                <table class="table">
                    <?php
                    $rowsPerPage = 7;
                    $totalRows = count($rows);
                    $totalPages = ceil($totalRows / $rowsPerPage);
                    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                    $startIndex = ($currentPage - 1) * $rowsPerPage;

                    
                    $endIndex = $startIndex + $rowsPerPage;
                    ?>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha Registro</th>
                            <th>Fecha de Inicio</th>
                            <th>Fecha de Fin</th>
                            <th>Nombre de P.</th>
                            <th>Nombre de D.</th>
                            <th>Eliminar</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php if ($rows) :?>
                        <?php foreach ($rows as $row): ?>
                        <tr>
                            <td><?=$row[0]?></td>
                            <td><?=$row[1]?></td>
                            <td><?=$row[2]?></td>
                            <td><?=$row[3]?></td>
                            <td><?=$row[4]?></td>
                            <td><?=$row[5]?></td>
                            <td class="acct">
                                <a type="button" class="btne" lass="btnm" onclick="openModalEliminar('<?=$row[0]?>')"><i
                                        class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            <td class="acct">
                                <a type="button" class="btnm" onclick="openModal('<?=$row[0]?>')">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                        $user=$obj->show($row[0]);
                        ?>
                        <!-- Modal para eliminacion -->
                        <div id="modalEliminar<?=$row[0]?>" class="modal">
                            <div class="containerModalEliminar">
                                <a href="#" class="close" style="margin-right:20px" onclick="closeModalEliminar('<?=$row[0]?>')">&times;</a>
                                <form class="form" style="margin-top: -25px;" autocomplete="off" method="post">
                                    <h2 class="title2" value="<?=$user[0]?>">Eliminar Cita</h2>
                                    <br>    
                                    <label class="Alertas" for="" value="<?=$user[0]?>">¿Estas seguro de eliminar esta cita?</label>
                                    
                                    <div class="input-group">
                                        <div>
                                        <br>
                                        <a class="buttonM" style="margin-left: 20em;" href="../Crud/Cita/eliminarCita.php?id=<?=$row[0]?>">Eliminar</a>
                                        </div>
                                    </div>
                                    <br>
                                </form>
                            </div>
                        </div>


                        <!-- Modal para modificacion -->
                        <div id="modal<?=$row[0]?>" class="modal">
                            <div class="containerModal">
                                <a href="#" class="close" onclick="closeModal('<?=$row[0]?>')">&times;</a>
                                <form action="../Crud/Cita/modificarCita.php" class="form" autocomplete="off"
                                    method="post">
                                    <h2 class="title">Modificar Cita de <?=$row[4]?><label class="labelModalTittle"></label></h2>
                                    <div class="checkout-information">
                                        <input style="display:none" type="text" value="<?=$user['id']?>">
                                        <div class="input-group">
                                            <label style="display:none" class="labelModal" for="id">id</label>
                                            <input style="display:none" type="text" id="id" name="id" class="input"
                                                value="<?=$user['id']?>" />
                                        </div>
                                        <div class="input-group">
                                            <label class="labelModal" for="fecha_cita_inicio">Fecha Inicio</label>
                                            <input class="input" type="date" id="fecha_cita_inicio" name="fecha_cita_inicio"
                                                value="<?=$user['fecha_inicio']?>" required>
                                        </div>
                                        <div class="input-group">
                                            <label class="labelModal" for="Hora_inicio">Inicio de la  Cita</label>
                                            <input type="time" id="Hora_inicio" name="Hora_inicio" class="input"
                                                value="<?=$user['hora_inicio']?>" />
                                        </div>
                                        <div class="input-group">
                                            <label class="labelModal" for="fecha_cita_fin">Fecha Fin</label>
                                            <input class="input" type="date" id="fecha_cita_fin" name="fecha_cita_fin"
                                                value="<?=$user['fecha_fin']?>" required>
                                        </div>
                                        <div class="input-group">
                                            <label class="labelModal" for="Hora_Fin">Fin de la Cita</label>
                                            <input type="time" id="Hora_Fin" name="Hora_Fin" class="input"
                                                value="<?=$user['hora_fin']?>" />
                                        </div>
                                        <div class="input-group">
                                            <label class="labelModal" for="d_nombre">Nombre de Doctor</label>
                                            <input type="text" placeholder="Buscar..." name="d_nombre"
                                                value="<?=$user['d_nombre']?>" required>
                                        </div>
                                        <br>
                                        <div class="xd">
                                            <button type="submit" class="buttonM">Editar</button>
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
            <div class="pagination">
            <?php for ($page = 1; $page <= $totalPages; $page++) { ?>
            <a href="?page=<?=$page?>"> <?=$page?></a>
            <?php } ?>
            </div>
        </div>
    </div>
    </section>
</body>

<script>
function openModal(id) {
    document.getElementById('modal' + id).style.display = 'block';
}

function closeModal(id) {
    document.getElementById('modal' + id).style.display = 'none';
}

function openModalEliminar(id) {
    document.getElementById('modalEliminar' + id).style.display = 'block';
}

function closeModalEliminar(id) {
    document.getElementById('modalEliminar' + id).style.display = 'none';
}

$(document).ready(function() {
  $('.button3').click(function() {
    var codigoPaciente = $('#id_paciente').val();

    // Realizar la solicitud AJAX al servidor
    $.ajax({
      url: 'fetch_paciente.php', // Archivo PHP que procesa la solicitud
      method: 'POST',
      data: { codigoPaciente: codigoPaciente },
      success: function(response) {
        if (response.error) {
          $('#nombrePaciente').val(response.error);
        } else {
          $('#nombrePaciente').val(response.nombre);
        }
      },
      error: function() {
        $('#nombrePaciente').val('Error al procesar la solicitud');
      }
    });
  });
});
</script>
<script>
var paginationLinks = document.getElementsByClassName('pagination')[0].getElementsByTagName('a');

for (var i = 0; i < paginationLinks.length; i++) {
    paginationLinks[i].addEventListener('click', function(event) {
        event.preventDefault();
        var page = parseInt(this.getAttribute('href').split('=')[1]);
        mostrarPagina(page);
    });
}

function mostrarPagina(page) {
    var rows = document.getElementById('myTable').getElementsByTagName('tr');

    for (var i = 0; i < rows.length; i++) {
        rows[i].style.display = 'none';
    }

    var startIndex = (page - 1) * <?=$rowsPerPage?>;
    var endIndex = startIndex + <?=$rowsPerPage?>;

    for (var i = startIndex; i < endIndex && i < rows.length; i++) {
        rows[i].style.display = 'table-row';
    }
}

mostrarPagina(1);
</script>
</html>
<?php
}else{
  header("Location: ../Index.php");
}
?>
