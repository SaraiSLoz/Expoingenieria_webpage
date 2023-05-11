<?php
require_once "../databasereg.php";



if (!empty($_POST)) {
  $carrera = $_POST('carrera');
  $usuario = $_POST['usuario'];
  $securepassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $correo = $_POST['email'];
  $username = $_POST['username'];
  $name = $_POST['name']; // validate input
  $valid = true;

  if (empty($usuario)) {
    //$nompError = 'Escribe un nombre de proyecto';
    $valid = false;
  }
  if (empty($securepassword)) {
    //$arError = 'Selecciona area estrategica';
    $valid = false;
  }
  if (empty($correo)) {
    //$nomlError = 'Escribe nombre del lider de proyecto';
    $valid = false;
  }

  if (empty($username)) {
    //$nivError = 'Selecciona categoria del proyecto';
    $valid = false;
  }

  // donde dice $variableUsuario tienes que poner la variable en la cual tienes el nombre del user para validarlo, supongo que ha de ser una POST, pero tu lo modificas
  $pdo = Database::connect();
  $query = "SELECT * FROM registro WHERE username = :username";
  $q = $pdo->prepare($query);
  $q->bindParam(":username", $username, PDO::PARAM_STR);
  $q->execute();
  $count = $q->rowCount();
  $data = $q->fetch(PDO::FETCH_OBJ);

  if ($count == 0) {
    // mysql_num_rows <- esta funcion me imprime el numero de registro que encontro 
    // si el numero es igual a 0 es porque el registro no exite, en otras palabras ese user no esta en la tabla miembro por lo tanto se puede registrar
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {


      if ($valid) {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO registro (id,nombre, username, contraseña, email, id_usuario) VALUES (null, ?, ?, ?, ?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($name, $username, $securepassword, $correo,  $usuario));
        echo '<script> alert("el usuario se registro correctamente");</script>';
      }
    } else {
      echo '<script> alert("el correo no es válido");</script>';
    }
  } else {
    //caso contario (else) es porque ese user ya esta registrado
    echo '<script> alert("el usuario ya esta registrado, ingresa otro");</script>';
  }
  Database::disconnect();



  // insert data
  /*if ($valid) {
  $pdo = Database::connect();
  /*
 // We need to check if the account with that username exists.
 if ($stmt = $pdo->prepare('SELECT id, password FROM register WHERE username = ?')) {
   // Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
   $stmt->bind_param('s', $_POST['username']);
   $stmt->execute();

   $stmt->store_result();
   // Store the result so we can check if the account exists in the database.
   if ($stmt->num_rows > 0) {
     // Username already exists
     echo '<div><p>El nombre del usuario existe , por favor escoge otro</p></div>';
   } 
   else {
     
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $sql = "INSERT INTO register (id, username, password, email, usuario) VALUES (null, ?, ?, ?, ?)";
     $q = $pdo->prepare($sql);
     $securepassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
     $q->execute(array($correo, $securepassword, $username, $usuario));
     echo '<div><p>YA SIRVEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE</p></div>';
     
   } $stmt->close();
 }
 Database::disconnect();
} */
}









?>

</body>

</html>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="registro1.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    function mostrarRegistro() {
      var select = document.getElementById('usuario');
      var valorSeleccionado = select.options[select.selectedIndex].value;
      console.log(valorSeleccionado);
      if (valorSeleccionado == "Estudiante") {
        $.ajax({
          url: "carreras.php",
          type: "GET",
          success: function(data) {
            var carreras = JSON.parse(data);
            var selectOptions = '<option value="">Selecciona una carrera</option>';
            for (var j = 0; j < carreras.length; j++) {
              selectOptions += '<option value="' + carreras[j].id + '">' + carreras[j].nombre + '</option>';
            }
            document.getElementById('carrera').innerHTML = selectOptions;
          }
        });

      } else if (valorSeleccionado == 'Docente') {
        // Mostrar otro registro
        console.log('El registro de otro color');
      } else if (valorSeleccionado == 'Externo') {
        console.log('registro externo');
      }
    }
  </script>


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

    <a href="../paginaInicio/index.php"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up-double" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
        <path d="M13 14l-4 -4l4 -4"></path>
        <path d="M8 14l-4 -4l4 -4"></path>
        <path d="M9 10h7a4 4 0 1 1 0 8h-1"></path>
      </svg></a>
    <span></span>
  </div>
  <form action="registro.php" method="post" autocomplete="off">
    <section class="main">
      <h1>Registro de usuario</h1>
      <table class="registro">
        <tr>
          <td><input type="text" name="name" placeholder="Nombre Completo..." id="name" class="input1" /> </td>
        </tr>
        <tr>
          <td><input type="text" name="username" placeholder="Usuario..." id="username" class="input1" /> </td>
        </tr>
        <tr>
          <td><input type="email" name="email" placeholder="Correo..." id="email" class="input2" /> </td>
        </tr>
        <td><input type="password" name="password" placeholder="Contraseña..." id="password" class="input3" /> </td>
        </tr>
        </tr>
        <td><select name="usuario" id="usuario" class="input3" onchange="mostrarRegistro()">
            <option value="">Selecciona usuario</option>
            <option values="Estudiante">Estudiante</option>
            <option values="Docente">Docente</option>
            <option values="Externo">Externo</option>

          </select></td>
        </tr>
        <tr>
          <td><button class="boton1">Registarme</button></td>
        </tr>
      </table>
  </form>
  </section>

  <?php





  ?>