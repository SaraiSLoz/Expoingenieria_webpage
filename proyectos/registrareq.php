<?php


session_start();
$usuario = $_SESSION["usuario"];


if (isset($_SESSION["usuario"])) {

    require '../databasereg.php';
    $id_proy = null;
    $numAlumnos = null;
    if (!empty($_GET['id'])) {
        $id_proy = $_REQUEST['id'];
    }

    /*if ($id_proy == null) {
	header("Location: index.php");
}*/

    // Iniciar la sesión
    /* $id_proy = $_SESSION['id_proy']; */

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

        $numAlumnos = $_POST['numalumnos'];

        $valid = true;
        $id_proy = $_POST['id_proy'];
        $matri1 = $_POST["alumno1"];
        if (empty($matri1)) {
            $matri1Error = 'Escribe un nombre de proyecto';
            $valid = false;
        }

        if ($valid) {

            $pdo = Database::connect();
            /*$sql="SELECT proyecto.id_proy
            FROM proyecto 
            WHERE id_proy= ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($id_proy));
            $data = $q->fetch(PDO::FETCH_ASSOC);

            if (is_array($data) && !empty($data['id_proy'])) {
                $id_proy = $data['id_proy'];
            } else {
                die("No se ha especificado el ID del proyecto.");
            }*/
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $alumnos = array();

            // Recorrer los valores de los alumnos enviados desde el formulario y agregarlos al arreglo
            for ($i = 1; $i <= $numAlumnos; $i++) {
                $alumno = $_POST["alumno" . $i];
                array_push($alumnos, $alumno);
            }
            $sql = "SELECT COUNT(*) as count FROM alumnos WHERE matricula = ?";
            $q = $pdo->prepare($sql);

            // Recorrer el arreglo de alumnos y ejecutar la consulta SQL para cada uno de ellos
            foreach ($alumnos as $alumno) {
                // Ejecutar la consulta SQL y obtener el número de resultados
                $q->execute(array($alumno));
                $count = $q->fetch(PDO::FETCH_ASSOC)['count'];

                // Si la matrícula no existe en la tabla "alumnos", mostrar un mensaje de error
                if ($count == 0) {
                    //$valid = false;
                    echo 'La matrícula ' . $alumno . ' no se encuentra en la base de datos.';
                } else {
                    // Crear la consulta SQL para insertar los registros en la tabla "alumno_proyecto"
                    $sql = "INSERT INTO alumnos_proyectos (id_proyecto, matricula) VALUES (?,?)";

                    // Preparar la consulta SQL
                    $q = $pdo->prepare($sql);

                    $q->execute(array($id_proy, $alumno));

                    Database::disconnect();

                    header("location:../proyectos/proyectosAlumnos.php");
                }
            }
        }
    }

?>


    <!DOCTYPE html>
    <html>

    <head>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
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
                            // Generar las opciones del input text
                            let selectOptions = '<input type="text" name="alumno' + i + '" value="" required>';
                            campos += '<div><label>Alumno ' + i + ':</label>' + selectOptions + '</div>';
                        }
                        // Actualizar el contenido HTML del contenedor
                        $("#campos-registro").html(campos);
                    }
                });
            });
        </script>

    </head>

    <body>

        <header>
            <table class="menu">
                <tr>
                    <td class="espacio"><a href="..\paginaInicio\index.php"><img class="logo" src="https://raw.githubusercontent.com/mikeedel/expoinge/main/logo-expo.svg"></a></td>
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
                                    <a href="..\Perfil\perfil_estudiante.php">Mi Perfil</a>
                                    <a href="..\proyectos\proyectosAlumnos.php">Proyectos Actuales</a>
                                    <a href="..\login\logout2.php">Cerrar sesión</a>
                                </div>



                            </div>
                        </td>
                    </div>


                </tr>
            </table>


        </header>

        <div class="calificacion">
            <a href="index-Alumnos.php"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up-double" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="black" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M13 14l-4 -4l4 -4"></path>
                    <path d="M8 14l-4 -4l4 -4"></path>
                    <path d="M9 10h7a4 4 0 1 1 0 8h-1"></path>
                </svg></a>
            <h2>Registro de integrantes: </h2>

        </div>
        <form action="http://lab403azms01.itesm.mx/TC2005B_403_3/expoingenierias/proyectos/registrareq.php" method="post">
            <input name="id_proy" type="hidden" readonly placeholder="id proyecto" value="<?php echo !empty($id_proy) ? $id_proy : ''; ?>">
            <p style="font-size: 24px;">Ingresar el número de integrantes del equipo y después registra cada matricula: </p>
            <div class="form-group <?php echo !empty($matri1Error) ? ' error' : ''; ?>">
                <label>Cantidad de alumnos a registrar:</label>
                <input type="number" name="numalumnos" id="numalumnos" min="1" required>
                <button type="button" id="btn-agregar">Aceptar</button>
            </div>

            <div id="campos-registro"></div>
            <div class="bot">
                <button type="submit" class="calificar-btn">Registrar integrantes </button>
            </div>
        </form>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-opacity" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">¡Registro Exitoso!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Información de proyecto e integrantes ha sido guardada existosamente.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>



    </body>

    <script>
        $(document).ready(function() {
            $('#myModal').on('hidden.bs.modal', function() {
                window.location.href = 'location:../proyectos/proyectosAlumnos.php';
            });
        });
    </script>

    <html>

<?php
} else {
    header("location:/paginaInicio/index.php");
}
?>