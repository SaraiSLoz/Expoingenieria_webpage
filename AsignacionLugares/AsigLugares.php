<?php
session_start();
$usuario = $_SESSION["usuario"];

$imgError = null;
if (isset($_SESSION["usuario"])) {

    if (!empty($_FILES['img']['name'])) {

        $imgfilename = $_FILES['img']['name'];
        $imgfiletemp = $_FILES['img']['tmp_name'];
        $filename_separate = explode('.', $imgfilename);
        $file_extension = strtolower(end($filename_separate));
        $extension = array('jpg', 'png');
        $extensiones_validas = array('jpg', 'png');
        if (in_array($file_extension, $extensiones_validas)) {
            // El archivo es válido
        } else {
            // El archivo tiene una extensión no permitida
            echo "Error: el archivo $imgfilename tiene una extensión no permitida 
  $imgfilename,$file_extension";
        }

        if (in_array($file_extension, $extension)) {
            $upload_img = '/var/www/html/TC2005B_403_3/expoingenierias/uploads' . $imgfilename;
            move_uploaded_file($imgfiletemp, $upload_img);
        }
        $valid = true;
        if (empty($upload_img)) {
            $imgError = 'Introduce una imagen';
            $valid = false;
        }
    }

?>

    <!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" href="styleAdmin.css">
        <link rel="stylesheet" href="style2.css">
        <link rel="stylesheet" href="style_asig.css">

    </head>

    <body>
        <table class="menu">
            <tr>
                <td><img class="logo" src="https://raw.githubusercontent.com/mikeedel/expoinge/main/logo-expo.svg"></td>
                <td></td>
                <td><a href="https://www.instagram.com/">Conócenos</a></td>
                <td class="espacio2"><a href="https://www.instagram.com/">Ediciones</a></td>
                <td><a href="https://www.instagram.com/">Avisos</a></td>
                <td class="espacio"><a href="https://www.instagram.com/">Contacto</a></td>
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
                <a href="..\paginaInicio\index-Admin.php"> <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up-double" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="black" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M13 14l-4 -4l4 -4"></path>
                        <path d="M8 14l-4 -4l4 -4"></path>
                        <path d="M9 10h7a4 4 0 1 1 0 8h-1"></path>
                    </svg></a>
                <h2>Asignación de lugares:<span class="admin"> </span></h2>
                <a href="visualizalugar.php"><button id="asignar-btn" class="modify-btn">
                        Visualizar imagen
                    </button></a>

                <form method="post" action="AsigLugares.php" enctype="multipart/form-data">
                    <input type="file" name="img" aria-label="Archivo" class="modify-btn22">
                    <?php if ($imgError != null) { ?>
                        <span class="help-inline"><?php echo $imgError; ?></span>
                    <?php } ?>
                    <input type="submit" value="Cargar imagen" class="modify-btn3">
                </form>


            </div>
            <table>
                <thead class="blue-table">
                    <tr class="blue-row">
                        <td>Nombre</td>
                        <td>Area</td>
                        <td>Categoria</td>
                        <td>Status</td>
                        <td>Lugar</td>
                        <td>Asignar lugar</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../databasereg.php';
                    $pdo = Database::connect();
                    $sql = "SELECT proyecto.id_proy, proyecto.titulo,proyecto.lugar, status.nombre as status1, categoria.nombre_c as categoria, area_estrategica.nombre_a as area_estrategica 
                        FROM proyecto 
                        INNER JOIN status ON  proyecto. id_status = status.id
                        INNER JOIN categoria ON proyecto.id_categoria=categoria.id_c 
                        INNER JOIN area_estrategica ON proyecto.id_AreaEstr=area_estrategica.id_a";

                    foreach ($pdo->query($sql) as $row) {
                        echo '<tr>';
                        echo '<td>' . $row['titulo'] . '</td>';
                        echo '<td>' . $row['categoria'] . '</td>';
                        echo '<td>' . $row['area_estrategica'] . '</td>';
                        echo '<td>' . $row['status1'] . '</td>';
                        echo '<td>' . $row['lugar'] . '</td>';
                        echo '<td><a href="AsigInd.php?id=' . $row['id_proy'] . '"><button class="calificar-btn">Asignar Lugar </button></td></a>';
                        echo '</tr>';
                        echo '<tr><td colspan="6"><hr></td></tr>';
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