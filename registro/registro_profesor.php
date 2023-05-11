<?php
require_once "../databasereg.php";



if (!empty($_POST)) {
  $nomina = $_POST['nomina'];
  $nombre = $_POST['nombre'];
  $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);
  $email = $_POST['email'];
  $id_departamento = $_POST['id_departamento'];
  $id_rol = $_POST['rol'];
  $id_area = $_POST['area'];

  // validate input
  $valid = true;

  if (empty($nomina)) {
    //$nompError = 'Escribe un nombre de proyecto';
    $valid = false;
  }
  if (empty($contraseña)) {
    //$arError = 'Selecciona area estrategica';
    $valid = false;
  }
  if (empty($nombre)) {
    //$nomlError = 'Escribe nombre del lider de proyecto';
    $valid = false;
  }

  if (empty($email)) {
    //$nivError = 'Selecciona categoria del proyecto';
    $valid = false;
  }
  if (empty($id_departamento)) {
    //$nivError = 'Selecciona categoria del proyecto';
    $valid = false;
  }



  if ($valid) {

    $verification_code = md5(uniqid());

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO profesores (matricula,nombre,contraseña,email,id_departamento,rol,id_area) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($nomina, $nombre, $contraseña, $email, $id_departamento, $id_rol, $id_area));

    echo "<script>$('#myModal').modal('show');</script>";

    require_once "verify-email.php";
    enviarCorreoVerificacion($email, $verification_code);

    Database::disconnect();
  }
}



?>


<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="registro1.css">


  <script>
    document.addEventListener('DOMContentLoaded', function() {
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

      <?php
      if ($valid) {
        echo "$('#myModal').modal('show');";
      }
      ?>
    });
  </script>


  <meta charset="UTF-8">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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
    <a href='registroprincipal.php'><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up-double" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="black" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
        <path d="M13 14l-4 -4l4 -4"></path>
        <path d="M8 14l-4 -4l4 -4"></path>
        <path d="M9 10h7a4 4 0 1 1 0 8h-1"></path>
      </svg></a>
    <span></span>
  </div>
  <form action="registro_profesor.php" method="post" autocomplete="off">
    <section class="main">
      <h1>Registro de usuario</h1>
      <table class="registro">
        <tr>
          <td><input type="text" name="nomina" placeholder="Nomina..." id="nomina" class="input1" /> </td>
        </tr>
        <tr>
          <td><input type="text" name="nombre" placeholder="Nombre..." id="nombre" class="input2" /> </td>
        </tr>
        <tr>
          <td><input type="email" name="email" placeholder="Correo..." id="email" class="input3" /> </td>
        </tr>
        <tr>
          <td><input type="password" name="contraseña" placeholder="Contraseña..." id="contraseña" class="input3" /> </td>
        </tr>
        <tr>
          <td><select name="id_departamento" class="input3">
              <option value="">Selecciona departamento</option>
              <?php
              $pdo = Database::connect();
              $query = 'SELECT * FROM departamento';
              foreach ($pdo->query($query) as $row) {
                if ($row['id'] == $id_departamento)
                  echo "<option selected value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                else
                  echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
              }
              Database::disconnect();
              ?>
            </select></td>
        </tr>
        <tr>
          <td><select name="area" class="input3">
              <option value="">Selecciona área estrategica</option>
              <?php
              $pdo = Database::connect();
              $query = 'SELECT * FROM area_estrategica';
              foreach ($pdo->query($query) as $row) {
                if ($row['id_a'] == $id_departamento)
                  echo "<option selected value='" . $row['id_a'] . "'>" . $row['nombre_a'] . "</option>";
                else
                  echo "<option value='" . $row['id_a'] . "'>" . $row['nombre_a'] . "</option>";
              }
              Database::disconnect();
              ?>
            </select></td>
        </tr>
        <tr>
          <td><select name="rol" class="input3">
              <option value="">Selecciona rol</option>
              <option value=1>Autorizar proyectos</option>
              <option value=2>Calificar proyectos</option>
              <option value=3>Autorizar/Calificar proyectos</option>
            </select></td>
        </tr>
        <tr>
          <td><button class="boton1">Registrarme</button></td>
        </tr>
      </table>
  </form>
  </section>

  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-opacity" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">¡Usuario Registrado!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Su cuenta se ha registrado exitosamente. Un correo de verificación se ha enviado a su bandeja para activar la cuenta.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>


  <body>


    <html>