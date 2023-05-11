<?php

require '../databasereg.php';

$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if ($id == null) {
    header("Location: index.php");
}

$lugarError = null;
$idError = null;

if (!empty($_POST)) {
    $lugar = $_POST['lugar'];

    $valid = true;

    if (empty($lugar)) {
        $nompError = 'Escribe un nombre de proyecto';
        $valid = false;
    }

    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE proyecto set id_proy =?, lugar = ? WHERE id_proy = ?";
        $q = $pdo->prepare($sql);

        $q->execute(array($id, $lugar, $id));

        Database::disconnect();
        header("Location: AsigLugares.php");
    }
}
?>

<!DOCTYPE html>
<html>

<head>
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
        <div class="cols">
            <div class="col1">
                <br>
            </div>
        </div>

        <div class="calificacion">
            <a href='AsigLugares.php'><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up-double" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="black" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M13 14l-4 -4l4 -4"></path>
                    <path d="M8 14l-4 -4l4 -4"></path>
                    <path d="M9 10h7a4 4 0 1 1 0 8h-1"></path>
                </svg></a>
            <div class="col1">
                <h2>Asignar de lugar:<span class="admin"> </span></h2>
                <br>
            </div>
        </div>
        <form class="form-horizontal" action="AsigInd.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
            <div class="row <?php echo !empty($idError) ? 'error' : ''; ?>">
                <div class="col1">
                    <p>id: </p>
                </div>
                <div class="col2">
                    <input name="id" type="text" readonly placeholder="id" value="<?php echo !empty($id) ? $id : ''; ?>" method="post">
                    <?php if (($idError != null)) ?>
                    <span class="help-inline"><?php echo $idError; ?></span>
                </div>
                <div class="col3">
                </div>
            </div>

            <div class="row <?php echo !empty($lugarError) ? 'error' : ''; ?>">
                <div class="col1">
                    <p>Lugar del proyecto: </p>
                </div>
                <div class="col2">
                    <input name="lugar" type="text" placeholder="Asignar lugar" value="<?php echo !empty($lugar) ? $lugar : ''; ?>" method="post">
                    <?php if (($lugarError != null)) ?>
                    <span class="help-inline"><?php echo $lugarError; ?></span>
                </div>
                <div class="col3">
                </div>
            </div>
            <div class="bot">
                <button type="submit" class="calificar-btn" name="siguiente">Guardar </button>
            </div>
        </form>


</body>

</html>