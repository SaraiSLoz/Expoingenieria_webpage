<?php
require '../databasereg.php';
$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}
if ($id == null) {
    header("Location: index.php");
} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'SELECT proyecto.lugar, proyecto.titulo FROM proyecto  WHERE id_proy = ?';
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
}
/*
// Obtener una lista de todos los archivos en la carpeta de subida
$dir = 'C:/xampp/htdocs/expoingenierias/uploads/';
$files = scandir($dir, SCANDIR_SORT_DESCENDING);

// Ordenar la lista de archivos por fecha de modificación
usort($files, function ($a, $b) use ($dir) {
    return filemtime($dir . $a) < filemtime($dir . $b);
});

// Recuperar el nombre del archivo más reciente
$latest_file = $files[0];

// Mostrar la imagen en la página*/

$dir = '../uploads/';
$allowedExtensions = ['jpg', 'png'];
$lastModifiedTime = 0;
$lastFile = '';

if ($handle = opendir($dir)) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != ".." && in_array(strtolower(pathinfo($dir . $entry, PATHINFO_EXTENSION)), $allowedExtensions)) {
            $fileModificationTime = filemtime($dir . $entry);
            if ($fileModificationTime > $lastModifiedTime) {
                $lastModifiedTime = $fileModificationTime;
                $lastFile = $entry;
            }
        }
    }
    closedir($handle);
}




?>



<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style_lugar.css">
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
            <a href="proyectosAlumnos.php"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up-double" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="black" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M13 14l-4 -4l4 -4"></path>
                    <path d="M8 14l-4 -4l4 -4"></path>
                    <path d="M9 10h7a4 4 0 1 1 0 8h-1"></path>
                </svg></a>
            <h2>Asignación de Lugares:</h2>
        </div>
        <table class="blue-table">
            <tr class="blue-row">
                <td>Nombre</td>
                <td>Lugar Asignado</td>
                <td>Imagen</td>

            </tr>
        </table>
        <table class="center-table">
            <tr class="first-row">
                <td><?php echo $data['titulo']; ?></td>
                <td><?php echo $data['lugar']; ?></td>
                <td>
                    <?php
                    if (!empty($lastFile)) {
                        echo "<img src='$dir/$lastFile' alt='Imagen subida' class='my-class'>";
                    } else {
                        echo "No hay imagen disponible";
                    }
                    ?></td>
            </tr>

        </table>
        <!-- Tablas y contenido existente -->

    </section>
</body>

</html>