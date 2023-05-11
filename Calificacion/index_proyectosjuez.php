<?php
session_start();
$usuario = $_SESSION["usuario"];
if (isset($_SESSION["usuario"])) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" href="style_juez.css">
    </head>

    <body>
        <table class="menu">
            <tr>
                <td><img class="logo" src="https://raw.githubusercontent.com/mikeedel/expoinge/main/logo-expo.svg"></td>
                <td></td>
                <td><a href="..\paginaInicio\Conocenos2.php">Conócenos</a></td>
                <td><a href="..\paginaInicio\Ediciones2.php">Ediciones</a></td>
                <td><a href="..\Anuncios\visualizaanuncioadmin.php">Anuncios</a></td>
                <td><a href="..\paginaInicio\Contacto2.php">Contacto</a></td>
                <div class="iconos">


                    <td>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bell-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M14.235 19c.865 0 1.322 1.024 .745 1.668a3.992 3.992 0 0 1 -2.98 1.332a3.992 3.992 0 0 1 -2.98 -1.332c-.552 -.616 -.158 -1.579 .634 -1.661l.11 -.006h4.471z" stroke-width="0" fill="currentColor"></path>
                            <path d="M12 2c1.358 0 2.506 .903 2.875 2.141l.046 .171l.008 .043a8.013 8.013 0 0 1 4.024 6.069l.028 .287l.019 .289v2.931l.021 .136a3 3 0 0 0 1.143 1.847l.167 .117l.162 .099c.86 .487 .56 1.766 -.377 1.864l-.116 .006h-16c-1.028 0 -1.387 -1.364 -.493 -1.87a3 3 0 0 0 1.472 -2.063l.021 -.143l.001 -2.97a8 8 0 0 1 3.821 -6.454l.248 -.146l.01 -.043a3.003 3.003 0 0 1 2.562 -2.29l.182 -.017l.176 -.004z" stroke-width="0" fill="currentColor"> </path>
                        </svg>
                        <div class="dropdown">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path>
                            </svg>


                            <div class="dropdown-content">
                                <a href="..\Perfil\perfil_juez.php">Mi Perfil</a>
                                <a href="..\Calificacion\index_proyectosjuez.php">Calificar Proyectos</a>
                                <a href="https://www.youtube.com/user/hubspot">Certificado</a>
                                <a href="..\login\logout2.php">Cerrar sesión</a>
                            </div>





                        </div>

                    </td>
                </div>


            </tr>
            <table>
                <div class="calificacion">
                    <a href="..\paginaInicio\index-Juez.php"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up-double" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="black" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M13 14l-4 -4l4 -4"></path>
                            <path d="M8 14l-4 -4l4 -4"></path>
                            <path d="M9 10h7a4 4 0 1 1 0 8h-1"></path>
                        </svg></a>
                    <h2>Calificar Proyectos</h2>

                </div>

                <thead class="blue-table">
                    <tr class="blue-row">
                        <td>Nombre</td>
                        <td>Area</td>
                        <td>Categoria</td>
                        <td>Calificación</td>
                        <td>Ver más</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../databasereg.php';
                    $pdo = Database::connect();
                    $sql = "SELECT proyecto.titulo, asigna_juez.id_proy, asigna_juez.id_juez1, asigna_juez.id_juez2, asigna_juez.id_juez3,
                area_estrategica.nombre_a as area_estrategica,categoria.nombre_c as categoria
                 FROM asigna_juez
                 INNER JOIN proyecto ON proyecto.id_proy = asigna_juez.id_proy
                 INNER JOIN categoria ON proyecto.id_categoria=categoria.id_c 
                 INNER JOIN area_estrategica ON proyecto.id_AreaEstr = area_estrategica.id_a  
                 WHERE id_juez1 = '$usuario' OR id_juez2 = '$usuario'  OR id_juez3 = '$usuario'";

                    foreach ($pdo->query($sql) as $row) {
                        echo '<tr>';
                        echo '<td>' . $row['titulo'] . '</td>';
                        echo '<td>' . $row['area_estrategica'] . '</td>';
                        echo '<td>' . $row['categoria'] . '</td>';

                        $sql = "SELECT calificacion FROM calificacion WHERE id_proyecto = '{$row['id_proy']}' AND id_juez = '$usuario'";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        $calificacion = $stmt->fetchColumn();

                        if ($calificacion !== false) {
                            // Si existe una calificación para este proyecto y juez, mostrar la calificación
                            echo '<td>' . $calificacion . '</td>';
                        } else {
                            // Si el proyecto aún no tiene una calificación, mostrar el botón de calificación
                            echo '<td class="botoness"><a href="../Calificacion/calificar.php?id=' . $row['id_proy'] . '"><button class="bot-cal1">Calificar</button></a></td>';
                        }
                        echo '<td class = "link2"><a href="readjueces.php?id=' . $row['id_proy'] . '">Ver más</a></td>';
                        echo '</tr>';
                    }
                    Database::disconnect();

                    ?>
                </tbody>
            </table>
            </div>
            </section>
    </body>

    </html>


<?php
} else {
    header("location:/paginaInicio/index.php");
}
?>