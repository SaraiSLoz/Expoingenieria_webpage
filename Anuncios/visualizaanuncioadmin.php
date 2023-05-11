<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <table class="menu">
            <tr>
                <td class="espacio"><a href="..\paginaInicio\index-Admin.php"><img class="logo" src="https://raw.githubusercontent.com/mikeedel/expoinge/main/logo-expo.svg"></a></td>
                <td></td>
                <td></td>
                <td></td>
                <td><a href="..\paginaInicio\Conocenos2.php">Conócenos</a></td>
                <td><a href="..\paginaInicio\Ediciones2.php">Ediciones</a></td>
                <td><a href="..\Anuncios\visualizaanuncioadmin.php">Anuncios</a></td>
                <td><a href="..\paginaInicio\Contacto2.php">Contacto</a></td>
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

</body>

</html>

<tbody style="text-align: center;">

    <?php
    require('../databasereg.php');
    $pdo = Database::connect();
    $sql = "SELECT * FROM anuncios ORDER BY fecha DESC";

    foreach ($pdo->query($sql) as $row) {
        echo '<div>';
        echo '<td class= "nombre1"><b>' . $row['nombre'] . '</b></td>';
        echo '</div>';
        echo '<div class="contenedor">';
        echo '<div class="cuadrado">';
        echo '<div>';
        echo '<td>' . $row['contenido'] . '</td>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '<div class="fecha">';
        echo '<td>' . 'Publicado el ' . $row['fecha'] . '</td>';
        echo '</div>';
    }
    Database::disconnect();

    ?>