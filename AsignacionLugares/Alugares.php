<?php
session_start();
$usuario = $_SESSION["usuario"];


if (isset($_SESSION["usuario"])) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <header>
            <table class="menu">
                <tr>
                    <td class="espacio"><a href="..\paginaInicio\indexAlumnos.html"><img class="logo" src="https://raw.githubusercontent.com/mikeedel/expoinge/main/logo-expo.svg"></a></td>
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
                                    <a href="..\Perfil\perfil_administrador.php">Mi Perfil</a>
                                    <a href="..\Calificacion\asignados.php">Asignar jueces</a>
                                    <a href="..\AsignacionLugares\AsigLugares.php">Asignar lugares</a>
                                    <a href="https://www.youtube.com/user/hubspot">Visualizar proyectos</a>
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
                <a href="indexAlumnos.php"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up-double" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="black" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M13 14l-4 -4l4 -4"></path>
                        <path d="M8 14l-4 -4l4 -4"></path>
                        <path d="M9 10h7a4 4 0 1 1 0 8h-1"></path>
                    </svg>
                    <h2>Asignacion de Lugares:</h2>
            </div>
            <table class="blue-table">
                <tr class="blue-row">
                    <td>Nombre</td>
                    <td>Asignacion de lugares</td>
                </tr>
            </table>
            <table class="center-table">
                <tr class="first-row">

                </tr>

            </table>
            <!-- Tablas y contenido existente -->
            <div class="modify-img-container">
                <img src="tortuga.jpg" alt="Modificar" class="tortuga-img">
            </div>
        </section>
    </body>

    </html>

<?php
} else {
    header("location:/expoingenierias/paginaInicio/index.php");
}
?>