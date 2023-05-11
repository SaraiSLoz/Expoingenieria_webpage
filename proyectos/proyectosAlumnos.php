<?php
session_start();
$usuario = $_SESSION["usuario"];

if (isset($_SESSION["usuario"])) {


?>
    <!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" href="styleAdmin.css">
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
                <a href="..\paginaInicio\index-Alumno.php"><svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler-arrow-back-up-double" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="black" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M13 14l-4 -4l4 -4"></path>
                        <path d="M8 14l-4 -4l4 -4"></path>
                        <path d="M9 10h7a4 4 0 1 1 0 8h-1"></path>
                    </svg></a>
                <h2>Proyectos Actuales</h2>
                <div class="modify-btn-container" style="text-align: left; margin-left: 930px;">
                    <button class="calificar-btn" onclick="window.location.href='createregtec.php'">Registrar Proyecto</button>
                </div>


            </div>
            <table>
                <thead class="blue-table">
                    <tr class="blue-row">
                        <td>Nombre</td>
                        <td>Categoria</td>
                        <td>Status</td>
                        <td>Comentarios</td>
                        <td>Modificar</td>
                        <td>Lugar</td>
                        <td>Calificación</td>
                        <td>Detalles</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../databasereg.php';
                    $pdo = Database::connect();
                    $sql = "SELECT proyecto.id_proy, proyecto.titulo, proyecto.lugar, status.nombre as status1, categoria.nombre_c as categoria, area_estrategica.nombre_a as area_estrategica 
                    FROM proyecto 
                    INNER JOIN status ON proyecto.id_status = status.id
                    INNER JOIN categoria ON proyecto.id_categoria = categoria.id_c 
                    INNER JOIN area_estrategica ON proyecto.id_AreaEstr = area_estrategica.id_a
                    INNER JOIN alumnos_proyectos ON proyecto.id_proy = alumnos_proyectos.id_proyecto
                    WHERE alumnos_proyectos.matricula = '$usuario'";


                    foreach ($pdo->query($sql) as $row) {
                        echo '<tr>';
                        echo '<td>' . $row['titulo'] . '</td>';
                        echo '<td>' . $row['categoria'] . '</td>';
                        echo '<td>' . $row['status1'] . '</td>';
                        echo '<td class = "link"><a href="comentarioAlumno.php?id=' . $row['id_proy'] . '">Ver comentarios</a></td>';
                        echo '<td><a href="update.php?id=' . $row['id_proy'] . '"><button class="calificar-btn">Modificar</button></td></a>';
                        echo '<td class = "link"><a href="Alugares.php?id=' . $row['id_proy'] . '">ver lugar</a></td>';
                        echo '<td class = "link"><a href="CalificacionAlumno.php?id=' . $row['id_proy'] . '">ver calificación</a></td>';
                        echo '<td class = "link"><a href="read.php?id=' . $row['id_proy'] . '">ver más</a></td>';
                        echo '</tr>';
                        echo '<tr><td colspan="8"><hr></td></tr>';
                    }
                    Database::disconnect();

                    ?>
                </tbody>
            </table>

        </section>
    </body>

    </html>
<?php
} else {
    header("location:/expoingenierias/paginaInicio/index.php");
}
?>