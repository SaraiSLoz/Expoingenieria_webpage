<?php

require 'databasereg.php';
$id_proy = null;
$numAlumnos = null;
if (!empty($_GET['id'])) {
	$id_proy = $_REQUEST['id'];
}

if ($id_proy == null) {
	/*header("Location: index.php");*/
}


    $matri1Error = null;
    $matri2Error = null;
    $matri3Error = null;
    $matri4Error = null;
    $matri5Error = null;

    if (!empty($_POST)) {
       /* $matri2 = $_POST['matri2'];
        $matri3 = $_POST['matri3'];
        $matri4 = $_POST['matri4'];
        $matri5 = $_POST['matri5'];
        */
        $id_proy = $_POST['id_proy'];

        $numAlumnos =$_POST['numalumnos'];

        $valid = true;

        if (empty($matri1)) {
            $matri1Error = 'Escribe un nombre de proyecto';
            $valid = false;
        }
       
        if ($valid) {
           
            $pdo = Database::connect();
            $sql="SELECT proyecto.id_proy
            FROM proyecto 
            WHERE id_proy= ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($id_proy));
            $data = $q->fetch(PDO::FETCH_ASSOC);
            if (is_array($data) && !empty($data['id_proy'])) {
                $id_proy = $data['id_proy'];
            } else {
                die("No se ha especificado el ID del proyecto.");
            }

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $alumnos = array();

            // Recorrer los valores de los alumnos enviados desde el formulario y agregarlos al arreglo
            for ($i = 1; $i <= $numAlumnos; $i++) {
                $alumno = $_POST["alumno".$i];
                array_push($alumnos, $alumno);
            }
            
            // Crear la consulta SQL para insertar los registros en la tabla "alumno_proyecto"
            $sql = "INSERT INTO alumno_proyecto (id_proyecto, matricula) VALUES (?,?)";
            
            // Preparar la consulta SQL
            $q = $pdo->prepare($sql);
            
            // Recorrer el arreglo de alumnos y ejecutar la consulta SQL para cada uno de ellos
            foreach ($alumnos as $alumno) {
                $q->execute(array($id_proy, $alumno));
            }
            
            Database::disconnect();


        }



    }
?>


<!DOCTYPE html>
<html>
<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" 
	rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" 
	crossorigin="anonymous">
	<link rel="stylesheet" href="stylereg.css">
    <title>Registro de alumnos</title>
    
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#btn-agregar").click(function() {
            let numAlumnos = $("#numalumnos").val();
            if (numAlumnos > 0) {
                let campos = "";
                for (var i = 1; i <= numAlumnos; i++) {
                    // Hacer una petición AJAX a una URL que devuelve los valores de la base de datos
                    $.ajax({
                        url: "reg.php",
                        type: "GET",
                        success: (function(i) {
                            return function(data) {
                                // Procesar la respuesta y agregar las opciones al select
                                let alumnos = JSON.parse(data);
                                let selectOptions = '<option value="">Selecciona un alumno</option>';
                                for (let j = 0; j < alumnos.length; j++) {
                                    selectOptions += '<option value="'+alumnos[j].username+'">'+alumnos[j].nombre+'</option>';
                                }
                                campos += '<div><label>Alumno '+i+':</label><select name="alumno'+i+'" required>'+selectOptions+'</select></div>';
                                $("#campos-registro").html(campos);
                            }
                        })(i)
                    });
                }
            }
        });
    });
</script>
</head>

<body>

<header>
        <table class="menu">
            <tr>
                <td class="espacio"><a href="..\paginaInicio\index.html"><img class="logo" src="https://raw.githubusercontent.com/mikeedel/expoinge/main/logo-expo.svg"></a></td>
                <td></td>
                <td></td>
                <td></td>
                <td><a href="..\Conócenos\index.html">Conócenos</a></td>
                <td><a href="..\Ediciones\index.html">Ediciones</a></td>
                <td><a href="..\anucios-todos\index.html">Anuncios</a></td>
                <td><a href="..\Contacto\index.html">Contacto</a></td>
                <div class="iconos">
                    <td>
                        <div class="dropdown">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path>
                            </svg>


                            <div class="dropdown-content">
                                <a href="https://blog.hubspot.com/">Perfil</a>
                                <a href="https://academy.hubspot.com/">Proyectos Asignados</a>
                                <a href="https://www.youtube.com/user/hubspot">Certicado</a>
                                <a href="https://www.youtube.com/user/hubspot">Log Out</a>
                            </div>



                        </div>
                    </td>
                </div>


            </tr>
        </table>

        
    </header>


    <form action="registrareq.php" method="post">
    <div class="row <?php echo !empty($id_proyError) ? 'error' : ''; ?>">
				<div class="col1">
					<p>id proyecto: </p>
				</div>
				<div class="col2">
					<input name="id_proy" type="text" readonly placeholder="id proyecto" value="<?php echo !empty($id_proy) ? $id_proy : ''; ?>">
				</div>
                </div>
				<div class="col3">
				</div>
	</div>
    <div class="form-group <?php echo !empty($matri1Error) ? ' error' : ''; ?>">
        <label>Cantidad de alumnos a registrar:</label>
        <input type="number" name="numalumnos" id="numalumnos" min="1" required>
		<button type="button" id="btn-agregar">Agregar campos</button>
    </div>
    
		<div id="campos-registro"></div>
        <div class="bot">
			<button type="submit" class="calificar-btn">Registrar integrantes </button>
		</div>
    </form>
   


    

</body>

