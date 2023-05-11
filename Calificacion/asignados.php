<?php


session_start();
$usuario = $_SESSION["usuario"];


if (isset($_SESSION["usuario"])) {



?>


    <!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" href="style2.css">
        <script>
            function asignarAleatoriamente() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // Actualiza la tabla con los datos recibidos del servidor
                        document.querySelector(".center-table").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "asigaleatorio.php", true);
                xhttp.send();
            }
        </script>

        <script>
            function notificar() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // Actualiza la tabla con los datos recibidos del servidor
                        document.querySelector(".center-table").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "notijueces_asignaciones.php", true);
                xhttp.send();
            }
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
                <a href="../paginaInicio/index-Admin.php"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up-double" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="black" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M13 14l-4 -4l4 -4"></path>
                        <path d="M8 14l-4 -4l4 -4"></path>
                        <path d="M9 10h7a4 4 0 1 1 0 8h-1"></path>
                    </svg></a>
                <h2 style="white-space: nowrap; margin-left: 20px;">Asignación de Jueces</h2>

                <div class="modify-btn-container">

                    <a href="asignados.php"><button id="asignar-btn" class="modify-btn">
                            Asignar Aleatoriamente
                        </button></a>

                    <script>
                        const asignarBtn = document.getElementById("asignar-btn");
                        asignarBtn.addEventListener("click", asignarAleatoriamente);
                    </script>



                </div>

                <div class="modify-btn-container">



                    <a href="asignados.php"><button id="notificar-btn" class="modify-btn2">
                            Notificar a Jueces
                        </button></a>

                    <script>
                        const notificarBtn = document.getElementById("notificar-btn");
                        notificarBtn.addEventListener("click", notificar);
                    </script>


                </div>






            </div>

            <table>
                <thead class="blue-table">
                    <tr class="blue-row">
                        <td>Proyecto</p>
                        </td>
                        <td>Área</td>
                        <td>Juez #1</td>
                        <td>Juez #2</td>
                        <td>Juez #3</td>
                        <td>Modificar</td>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../databasereg.php';
                    $pdo = Database::connect();
                    $sql = "SELECT proyecto.titulo, asigna_juez.id_proy, area_estrategica.nombre_a as area_estrategica, 
                j1.nombre as nombre_juez1, j2.nombre as nombre_juez2, 
                j3.nombre as nombre_juez3 
                FROM asigna_juez
                INNER JOIN proyecto ON proyecto.id_proy = asigna_juez.id_proy
                INNER JOIN area_estrategica ON proyecto.id_AreaEstr = area_estrategica.id_a  
                INNER JOIN jueces_totales j1 ON j1.matricula = asigna_juez.id_juez1
                INNER JOIN jueces_totales j2 ON j2.matricula = asigna_juez.id_juez2
                INNER JOIN jueces_totales j3 ON j3.matricula = asigna_juez.id_juez3";


                    foreach ($pdo->query($sql) as $row) {
                        echo '<tr>';
                        echo '<td>' . $row['titulo'] . '</td>';
                        echo '<td>' . $row['area_estrategica'] . '</td>';
                        echo '<td>' . $row['nombre_juez1'] . '</td>';
                        echo '<td>' . $row['nombre_juez2'] . '</td>';
                        echo '<td>' . $row['nombre_juez3'] . '</td>';
                        echo '<td><a href="http://lab403azms01.itesm.mx/TC2005B_403_3/expoingenierias/Calificacion/updateasignados.php?id_proy=' . $row['id_proy'] . '"><button class="modificar-btn">Modificar</button></td></a>';


                        echo '</tr>';
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
    header("location:/paginaInicio/index.php");
}
?>