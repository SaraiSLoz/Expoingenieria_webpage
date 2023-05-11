<?php

require '../databasereg.php';
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="black" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
            <a href='index.php'><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up-double" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="black" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M13 14l-4 -4l4 -4"></path>
                    <path d="M8 14l-4 -4l4 -4"></path>
                    <path d="M9 10h7a4 4 0 1 1 0 8h-1"></path>
                </svg></a>
            <h2>Proyectos Actuales</h2>


        </div>
        <p style="text-align: center;"><strong>Categoria: Concepto</strong></p>

        <table style="text-align: center;">
            <thead class="blue-table">
                <tr class="blue-row">
                    <td>Lugar</td>
                    <td>Nombre</td>
                    <td>Área estratégica</td>
                    <td>Calificación</td>
                </tr>
            </thead>

            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>

            <tbody>
                <?php

                $pdo = Database::connect();
                $sql = "SELECT proyecto.id_proy,proyecto.calificacion, proyecto.titulo, proyecto.id_categoria, proyecto.id_AreaEstr,
                        categoria.nombre_c as categoria, area_estrategica.nombre_a as area_estrategica 
                        FROM proyecto 
                        INNER JOIN categoria ON proyecto.id_categoria=categoria.id_c 
                        INNER JOIN area_estrategica ON proyecto.id_AreaEstr=area_estrategica.id_a
                        WHERE id_categoria = 1
                        ORDER BY calificacion DESC
                        LIMIT 3";
                $i = 1;
                foreach ($pdo->query($sql) as $row) {
                    echo '<tr>';
                    echo '<td>' . $i . '</td>';
                    echo '<td>' . $row['titulo'] . '</td>';
                    echo '<td>' . $row['area_estrategica'] . '</td>';
                    echo '<td>' . $row['calificacion'] . '</td>';
                    echo '</tr>';
                    echo '<tr><td colspan="4"><hr></td></tr>';
                    $id = $row['id_proy'];
                    $area = $row['id_AreaEstr'];
                    $calificacion = $row['calificacion'];
                    $categoria = $row['id_categoria'];
                    $sql1 = "INSERT INTO premiados (lugar, id_proy, area, categoria) 
                    VALUES (?, ?, ?, ?) 
                    ON DUPLICATE KEY UPDATE 
                    lugar = VALUES(lugar), 
                    area = VALUES(area), 
                    categoria = VALUES(categoria)";
                    $q = $pdo->prepare($sql1);
                    $q->execute(array($i, $id, $area, $categoria));
                    $i++;
                } ?>


                <td colspan="4" style="text-align: center;">
                    <p><strong>Categoria: Prototipo</strong></p>
                </td>
                <tr class="blue-row">
                    <td>Lugar</td>
                    <td>Nombre</td>
                    <td>Área estratégica</td>
                    <td>Calificación</td>
                </tr>

                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>

                <?php
                $sql = "SELECT proyecto.id_proy,proyecto.calificacion, proyecto.titulo, proyecto.id_categoria, proyecto.id_AreaEstr,
                        categoria.nombre_c as categoria, area_estrategica.nombre_a as area_estrategica 
                        FROM proyecto 
                        INNER JOIN categoria ON proyecto.id_categoria=categoria.id_c 
                        INNER JOIN area_estrategica ON proyecto.id_AreaEstr=area_estrategica.id_a
                        WHERE id_categoria = 2
                        ORDER BY calificacion DESC
                        LIMIT 3";
                $i = 1;
                foreach ($pdo->query($sql) as $row) {
                    echo '<tr>';
                    echo '<td>' . $i . '</td>';
                    echo '<td>' . $row['titulo'] . '</td>';
                    echo '<td>' . $row['area_estrategica'] . '</td>';
                    echo '<td>' . $row['calificacion'] . '</td>';
                    echo '</tr>';
                    echo '<tr><td colspan="4"><hr></td></tr>';
                    $id = $row['id_proy'];
                    $area = $row['id_AreaEstr'];
                    $calificacion = $row['calificacion'];
                    $categoria = $row['id_categoria'];
                    $sql1 = "INSERT INTO premiados (lugar,id_proy, area, categoria) 
                    VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE
                    lugar = VALUES(lugar), 
                    area = VALUES(area), 
                    categoria = VALUES(categoria)";
                    $q = $pdo->prepare($sql1);
                    $q->execute(array($i, $id, $area, $categoria));
                    $i++;
                } ?>
                <td colspan="4" style="text-align: center;">
                    <p><strong>Categoria: Producto</strong></p>
                </td>
                <tr class="blue-row">
                    <td>Lugar</td>
                    <td>Nombre</td>
                    <td>Área estratégica</td>
                    <td>Calificación</td>
                </tr>

                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>

                <?php
                $sql = "SELECT proyecto.id_proy,proyecto.calificacion, proyecto.titulo, proyecto.id_categoria, proyecto.id_AreaEstr,
                        categoria.nombre_c as categoria, area_estrategica.nombre_a as area_estrategica 
                        FROM proyecto 
                        INNER JOIN categoria ON proyecto.id_categoria=categoria.id_c 
                        INNER JOIN area_estrategica ON proyecto.id_AreaEstr=area_estrategica.id_a
                        WHERE id_categoria = 3
                        ORDER BY calificacion DESC
                        LIMIT 3";
                $i = 1;
                foreach ($pdo->query($sql) as $row) {
                    echo '<tr>';
                    echo '<td>' . $i . '</td>';
                    echo '<td>' . $row['titulo'] . '</td>';
                    echo '<td>' . $row['area_estrategica'] . '</td>';
                    echo '<td>' . $row['calificacion'] . '</td>';
                    echo '</tr>';
                    echo '<tr><td colspan="4"><hr></td></tr>';
                    $id = $row['id_proy'];
                    $area = $row['id_AreaEstr'];
                    $calificacion = $row['calificacion'];
                    $categoria = $row['id_categoria'];
                    $sql1 = "INSERT INTO premiados (lugar,id_proy, area, categoria) 
                    VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE
                    lugar = VALUES(lugar), 
                    area = VALUES(area), 
                    categoria = VALUES(categoria)";
                    $q = $pdo->prepare($sql1);
                    $q->execute(array($i, $id, $area, $categoria));
                    $i++;
                }
                Database::disconnect();

                ?>
            </tbody>
        </table>

        <p style="text-align: center;"><strong>Primeros Lugares Globales</strong></p>

        <table style="text-align: center;">
            <thead class="blue-table">
                <tr class="blue-row">
                    <td>Lugar</td>
                    <td>Nombre</td>
                    <td>Categoría</td>
                    <td>Área estratégica</td>
                    <td>Calificación</td>
                </tr>
            </thead>
            <tbody>


                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>

                <?php

                $pdo = Database::connect();
                $sql = "SELECT proyecto.id_proy,proyecto.calificacion, proyecto.titulo, 
                        categoria.nombre_c as categoria, area_estrategica.nombre_a as area_estrategica 
                        FROM proyecto 
                        INNER JOIN categoria ON proyecto.id_categoria=categoria.id_c 
                        INNER JOIN area_estrategica ON proyecto.id_AreaEstr=area_estrategica.id_a
                        ORDER BY calificacion DESC
                        LIMIT 5";
                $i = 1;
                foreach ($pdo->query($sql) as $row) {
                    echo '<tr>';
                    echo '<td>' . $i . '</td>';
                    echo '<td>' . $row['titulo'] . '</td>';
                    echo '<td>' . $row['categoria'] . '</td>';
                    echo '<td>' . $row['area_estrategica'] . '</td>';
                    echo '<td>' . $row['calificacion'] . '</td>';
                    echo '</tr>';
                    echo '<tr><td colspan="5"><hr></td></tr>';
                    $i++;
                }
                Database::disconnect();

                ?>
            </tbody>
        </table>


    </section>
</body>

</html>