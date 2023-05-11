<?php

require('verify-resetpass.php');


if ($_POST) {

  require('../databasereg.php');
  $u = $_POST['t1'];
  $u2 = $_POST['t2'];

  if ($u = $u2) {

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "
          SELECT email FROM (
              SELECT email FROM alumnos
              UNION
              SELECT email FROM jueces
              UNION
              SELECT email FROM profesores
          ) AS usuarios WHERE email = :u
      ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':u', $u);
    $stmt->execute();
    $todoscorreos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($todoscorreos) {
      enviarCorreoReset($u);
      echo "<script>$('#myModal').modal('show');</script>";
    } else {
      echo "Correo Inválido";
    }
  } else {
    echo "Correos diferentes";
  }
}

Database::disconnect();


?>



<!DOCTYPE html>
<html>

<head>


  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

  <link rel="stylesheet" href="olvide_contraseña1.css">

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
  <table class="menu">
    <tr>
      <td><img class="logo" src="https://raw.githubusercontent.com/mikeedel/expoinge/main/logo-expo.svg"></td>
      <td></td>
      <td class="espacio3"><a href="https://www.instagram.com/">Inicio</a></td>
      <td><a href="https://www.instagram.com/">Conócenos</a></td>
      <td class="espacio2"><a href="https://www.instagram.com/">Ediciones</a></td>
      <td><a href="https://www.instagram.com/">Avisos</a></td>
      <td class="espacio"><a href="https://www.instagram.com/">Contacto</a></td>
      <div class="iconos">
        <td> <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bell-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M14.235 19c.865 0 1.322 1.024 .745 1.668a3.992 3.992 0 0 1 -2.98 1.332a3.992 3.992 0 0 1 -2.98 -1.332c-.552 -.616 -.158 -1.579 .634 -1.661l.11 -.006h4.471z" stroke-width="0" fill="currentColor"></path>
            <path d="M12 2c1.358 0 2.506 .903 2.875 2.141l.046 .171l.008 .043a8.013 8.013 0 0 1 4.024 6.069l.028 .287l.019 .289v2.931l.021 .136a3 3 0 0 0 1.143 1.847l.167 .117l.162 .099c.86 .487 .56 1.766 -.377 1.864l-.116 .006h-16c-1.028 0 -1.387 -1.364 -.493 -1.87a3 3 0 0 0 1.472 -2.063l.021 -.143l.001 -2.97a8 8 0 0 1 3.821 -6.454l.248 -.146l.01 -.043a3.003 3.003 0 0 1 2.562 -2.29l.182 -.017l.176 -.004z" stroke-width="0" fill="currentColor"> </path>
          </svg>
        </td>

        <td>
          <div class="dropdown">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
              <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
              <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path>
            </svg>


            <div class="dropdown-content_admin">
              <a href="https://blog.hubspot.com/">Perfil</a>
              <a href="https://academy.hubspot.com/">Jueces</a>
              <a href="https://www.youtube.com/user/hubspot">Proyectos</a>
              <a href="https://www.youtube.com/user/hubspot">Históricos</a>
              <a href="https://www.youtube.com/user/hubspot">Asignación de lugares</a>
              <a href="https://www.youtube.com/user/hubspot">Logout</a>

            </div>



          </div>
        </td>
      </div>


    </tr>
  </table>

  <div class="contra">
    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up-double" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
      <path d="M13 14l-4 -4l4 -4"></path>
      <path d="M8 14l-4 -4l4 -4"></path>
      <path d="M9 10h7a4 4 0 1 1 0 8h-1"></path>
    </svg>
    <span>Reestablecer Contraseña</span>
  </div>
  <section class="main">
    <form>
      <h1>Ingresa correo electrónico vinculado a tu cuenta para recuperar tu contraseña:</h1>
      <table class="olvide_contraseña">
        <tr>
          <td>Correo: </td>
          <td><input type="email" name=t1 placeholder="correo..." class="input1" /> </td>
        </tr>
        <tr>
          <td>Confirmar correo: </td>
          <td><input type="email" name=t2 placeholder="correo..." class="input2" /> </td>
        </tr>
        <tr>
          <td><a href="" class="a">Enviar correo</a></td>
        </tr>
      </table>
    </form>
  </section>

  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-opacity" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Revisa tu bandeja de entrada!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Se le ha enviado un correo electrónico para reestablecer la contraseña.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>







</body>

</html>