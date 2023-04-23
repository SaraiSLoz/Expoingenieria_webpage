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
    <section class="main">

        <div class="calificacion">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up-double" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M13 14l-4 -4l4 -4"></path>
                <path d="M8 14l-4 -4l4 -4"></path>
                <path d="M9 10h7a4 4 0 1 1 0 8h-1"></path>
            </svg>
            <h2>Proyectos Actuales</h2>
            <div class="modify-btn-container">
                <button class="calificar-btn" onclick="window.location.href='createregtec.php'">Registrar Proyecto</button>
            </div>

        </div>
        <table>
            <thead class="blue-table">
                <tr class="blue-row">
                    <td>Nombre</td>
                    <td>Area</td>
                    <td>Categoria</td>
                    <td>Modificar</td>
                    <td>Registrar integrantes</td>
                    <td>Borrar</td>
                    <td>Calificar</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'databasereg.php';
                $pdo = Database::connect();
                $sql = "SELECT proyecto.id_proy, proyecto.titulo, categoria.nombre_c as categoria, area_estrategica.nombre_a as area_estrategica 
                        FROM proyecto 
                        INNER JOIN categoria ON proyecto.id_categoria=categoria.id_c 
                        INNER JOIN area_estrategica ON proyecto.id_AreaEstr=area_estrategica.id_a";

                foreach ($pdo->query($sql) as $row) {
                    echo '<tr>';
                    echo '<td>' . $row['titulo'] . '</td>';
                    echo '<td>' . $row['categoria'] . '</td>';
                    echo '<td>' . $row['area_estrategica'] . '</td>';
                    echo '<td><a href="update.php?id=' . $row['id_proy'] . '"><button class="calificar-btn">Modificar</button></td></a>';
                    echo '<td><a href="registrareq.php?id=' . $row['id_proy'] . '"><button class="calificar-btn">Registrar Integrantes </button></td></a>';
                    echo '<td><a href="deletetec.php?id=' . $row['id_proy'] . '"><button><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler 
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
                    echo '<td class="botoness"><button class="bot-cal1">Calificar</button> <button class="bot-cal2">Descalificar</button></td>';
                    echo '<td class = "link"><a href="read.php?id=' . $row['id_proy'] . '">ver más</a></td>';
                    echo '</tr>';
                }
                Database::disconnect();

                ?>
            </tbody>
        </table>

    </section>
</body>

</html>