<?php
session_start(); // llama a session_start() al principio del archivo
?>

<?php




if ($_POST) {
    //session_start();
    require('../databasereg.php');
    $u = $_POST['t1'];

    $p = password_hash($_POST['t2'], PASSWORD_DEFAULT);
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query_alumno = $pdo->prepare("SELECT * FROM alumnos WHERE matricula = :u");
    $query_alumno->bindParam(":u", $u);
    $query_alumno->execute();
    $alumno = $query_alumno->fetch(PDO::FETCH_ASSOC);


    $query_profesor = $pdo->prepare("SELECT * FROM profesores WHERE matricula = :u");
    $query_profesor->bindParam(":u", $u);
    $query_profesor->execute();
    $profesor = $query_profesor->fetch(PDO::FETCH_ASSOC);

    $query_juez = $pdo->prepare("SELECT * FROM jueces WHERE matricula = :u");
    $query_juez->bindParam(":u", $u);
    $query_juez->execute();
    $juez = $query_juez->fetch(PDO::FETCH_ASSOC);

    $query_admin = $pdo->prepare("SELECT * FROM admin WHERE matricula = :u");
    $query_admin->bindParam(":u", $u);
    $query_admin->execute();
    $admin = $query_admin->fetch(PDO::FETCH_ASSOC);

    $pdo = Database::connect();
    if ($alumno && password_verify($_POST['t2'], $alumno['contraseña'])) {
        if ($alumno['estado_ver'] == 1) {
            $_SESSION["usuario"] = $alumno["matricula"];
            header("location:../paginaInicio/index-Alumno.php");
        } else {
            echo "<script>$('#myModal').modal('show');</script>";
        }
    } else {
        if ($profesor && password_verify($_POST['t2'], $profesor['contraseña'])) {
            if ($profesor['estado_ver'] == 1) {
                if ($profesor['rol'] == 1) {
                    $_SESSION["usuario"] = $profesor["matricula"];
                    header("location:http:../paginaInicio/index-Profesor.php");
                } else if ($profesor['rol'] == 2) {
                    $_SESSION["usuario"] = $profesor["matricula"];
                    header("location:../paginaInicio/index-JuezInterno.php");
                } else if ($profesor['rol'] == 3) {
                    $_SESSION["usuario"] = $profesor["matricula"];
                    header("location:../paginaInicio/index-ProfesorJuez.php");
                }
            } else {
                echo "<script>$('#myModal').modal('show');</script>";
            }
        } else {
            if ($juez && password_verify($_POST['t2'], $juez['contraseña'])) {
                if ($juez['estado_ver'] == 1) {
                    $_SESSION["usuario"] = $juez["matricula"];
                    header("location:../paginaInicio/index-Juez.php");
                } else {
                    echo "<script>$('#myModal').modal('show');</script>";
                }
            } else {

                if ($admin && password_verify($_POST['t2'], $admin['contraseña'])) {
                    $_SESSION["usuario"] = $admin["matricula"];
                    header("location:../paginaInicio/index-Admin.php");
                } else {
                    echo "Usuario o password invalidos";
                }
            }
        }
    }
    Database::disconnect();
}

?>

<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="login1.css">

    <script>
        $(document).ready(function() {
            $("#myModal").modal({
                backdrop: "static",
                keyboard: false
            }); // Mostrar el modal al cargar la página y deshabilitar el cierre con el teclado y clic fuera del modal
            $("#myModal").on("hidden.bs.modal", function(e) { // Limpiar el contenido del modal al cerrarlo
                $(this).find(".modal-title").text("");
                $(this).find(".modal-body").html("");
            });
            $("#myModal").on("click", ".btn-secondary", function() { // Cerrar el modal al hacer clic en el botón "Cerrar"
                $("#myModal").modal("hide");
            });
        });
    </script>

    <meta charset="UTF-8">


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <style>
        .modal-backdrop.show {
            opacity: 0.5;
        }
    </style>


</head>
<meta charset="UTF-8">

<body>
    <header>
        <table class="encabezado">
            <tr>
                <td><img class="logo" src="logo-expo.svg"></td>
            </tr>
        </table>
    </header>
    <div class="contra">
        <a href="..\paginaInicio\index.php"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up-double" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="black" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M13 14l-4 -4l4 -4"></path>
                <path d="M8 14l-4 -4l4 -4"></path>
                <path d="M9 10h7a4 4 0 1 1 0 8h-1"></path>
            </svg></a>
        <span></span>
    </div>
    <section class="main">
        <h1>Inicio de Sesión</h1>
        <form action="login2.php" method="post">
            <table class="login">
                <tr>
                    <td><input type="text" name="t1" placeholder="Usuario..." class="input1" /> </td>
                </tr>
                <td><input type="password" name="t2" placeholder="Contraseña..." class="input2" /> </td>
                </tr>
                <tr>
                    <td><input type="submit" name="" value="Ingresar"></td>
                </tr>
                <tr>
                    <td><a href="..\registro\registroprincipal.php" class="a">Registrarme</a></td>
                </tr>

            </table>
        </form>
    </section>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-opacity" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">¡Correo no verificado!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Se le ha enviado un correo electrónico de verificación. Por favor revise su bandeja de entrada y siga las instrucciones para activar su cuenta.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>








</body>