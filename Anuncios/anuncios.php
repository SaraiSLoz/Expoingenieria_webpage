<?php

session_start();
$usuario = $_SESSION["usuario"];


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
                <td><img class="logo" src="https://raw.githubusercontent.com/mikeedel/expoinge/main/logo-expo.svg"></td>
                <td></td>
                <td><a href="https://www.instagram.com/">Conócenos</a></td>
                <td class="espacio2"><a href="https://www.instagram.com/">Ediciones</a></td>
                <td><a href="visualizaanuncio.php">Avisos</a></td>
                <td class="espacio"><a href="https://www.instagram.com/">Contacto</a></td>
                <td>
                    <div class="dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                            <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                            <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path>
                        </svg>





                        <div class="dropdown-content">
                            <a href="..\Perfil\perfil_administrador.php">Mi Perfil</a>
                            <a href="..\Calificacion\asignados.php">Asignar jueces</a>
                            <a href="..\AsignacionLugares\AsigLugares.php">Asignar lugares</a>
                            <a href="..\proyectos\index.php">Visualizar proyectos</a>
                            <a href="..\Anuncios\anuncios.php">Crear Anuncio</a>
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
            <a href="..\paginaInicio\index-Admin.php"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up-double" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="black" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M13 14l-4 -4l4 -4"></path>
                    <path d="M8 14l-4 -4l4 -4"></path>
                    <path d="M9 10h7a4 4 0 1 1 0 8h-1"></path>
                </svg></a>
            <h2>Anuncios</h2>
            <div class="modify-btn-container">

                <button class="calificar-btn" onclick="window.location.href='createanuncio.php'">Crear Nuevo Anuncio</button>
            </div>



        </div>
        <table>
            <thead class="blue-table">
                <tr class="blue-row">
                    <td>Nombre</td>
                    <td>Fecha</td>
                    <td>Acciones</td>
                    <td>Borrar</td>

                </tr>
            </thead>
            <tbody style="text-align: center;">

                <?php
                require('../databasereg.php');
                $pdo = Database::connect();
                $sql = "SELECT * FROM anuncios ORDER BY fecha DESC";

                foreach ($pdo->query($sql) as $row) {
                    echo '<tr>';
                    echo '<td>' . $row['nombre'] . '</td>';
                    echo '<td>' . $row['fecha'] . '</td>';
                    echo '<td><a href="updateanuncio.php?id=' . $row['id'] . '"><button class="calificar-btn">Modificar</button></td></a>';
                    echo '<td><a href="deleteanuncio.php?id=' . $row['id'] . '"><button><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler 
                    icon-tabler-trash-off" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" 
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M3 3l18 18"></path>
                                <path d="M4 7h3m4 0h9"></path>
                                <path d="M10 11l0 6"></path>
                                <path d="M14 14l0 3"></path>
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l.077 -.923"></path>
                                <path d="M18.384 14.373l.616 -7.373"></path>
                                <path d="M9 5v-1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                             </svg></button></td>';
                    echo '</tr>';
                }
                Database::disconnect();

                ?>
            </tbody>
        </table>

    </section>
</body>

</html>