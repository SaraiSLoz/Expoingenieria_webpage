<?php
require '../databasereg.php';
session_start();
if (isset($_SESSION["usuario"])) {
    $id = null;
    if (!empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
    if ($id == null) {
        header("Location: index.php");
    } else {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql1 = 'SELECT calificacion 
         FROM proyecto
         WHERE id_proyecto = ?
         ';
        $q = $pdo->prepare($sql1);
        $q->execute(array($id));
        $promedio_calif = $q->fetchColumn();

        $sql3 = "SELECT status.nombre as status1 
                    FROM proyecto 
                    INNER JOIN status ON proyecto.id_status = status.id
                    WHERE id_proy = ?";
        $q = $pdo->prepare($sql3);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
    }
?>

    <!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" href="styleMod.css">
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
        <section class="main">
            <div class="calificacion">
                <a href="..\paginaInicio\index-Alumno.php"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up-double" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="black" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M13 14l-4 -4l4 -4"></path>
                        <path d="M8 14l-4 -4l4 -4"></path>
                        <path d="M9 10h7a4 4 0 1 1 0 8h-1"></path>
                    </svg></a>
                <h2>Proyecto: </h2>
            </div>
            <table class="center-table">
                <tr class="first-row">
                    <td><strong>ID de proyecto:</strong></td>
                    <td><?php echo $id; ?></td>
                    <td></td>
                    <td><strong>Calificación:</strong></td>
                    <td><?php echo $promedio_calif; ?></td>
                    <td></td>
                </tr>
                <tr class="white-row">
                    <td><strong>Status:</strong></td>
                    <td><?php echo $data['status1'] ?></td>
                    <td></td>
                    <td><strong>Motivo: </strong></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
            <div class="modify-btn-container">
                <button class="calificar-btn">Modificar</button>
            </div>
        </section>
    </body>

    </html>

<?php
} else {
    header("location:/expoingenierias/paginaInicio/index.php");
}
?>