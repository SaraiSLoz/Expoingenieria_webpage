<?php
session_start();
if (isset($_SESSION["usuario"])) {
    require '../databasereg.php';
    $id = null;
    if (!empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }

    if ($id == null) {
        header("Location: indexProf.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'SELECT proyecto.id_proy, proyecto.titulo, proyecto.descripcion, proyecto.poster, 
        proyecto.archivo_poster, proyecto.archivo_video,categoria.nombre_c as categoria, area_estrategica.nombre_a as area_estrategica, 
        profesores.nombre as profesor, unidad_de_formacion.nombre as unidad_formacion
        FROM proyecto 
        INNER JOIN categoria ON proyecto.id_categoria=categoria.id_c 
        INNER JOIN area_estrategica ON proyecto.id_AreaEstr=area_estrategica.id_a 
        INNER JOIN profesores ON proyecto.id_profesor = profesores.matricula
        INNER JOIN unidad_de_formacion ON proyecto.id_unidad_formacion = unidad_de_formacion.id
        WHERE id_proy = ?';
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }
    $comentarioError = null;
    if (!empty($_POST)) {
        $comentario = $_POST['comentario'];


        $valid = true;

        if (empty($comentario)) {
            $comentarioError = 'Escribe un comentario al proyecto';
            $valid = false;
        }
        if ($valid) {
            $id = $data['id_proy'];
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql0 = 'UPDATE proyecto SET comentario = ? WHERE id_proy = ?';
            $q0 = $pdo->prepare($sql0);
            $q0->execute(array($comentario, $id));
            Database::disconnect();
        }
    }



?>

    <!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" href="styleMod.css">
        <script>
            function mostrarFormulario() {
                document.getElementById("formulario").style.display = "block";
            }
            $(document).ready(function() {
                $('#actualizar').click(function() {
                    // Obtener datos a actualizar
                    var id_proyecto = 1;
                    var comentario = 'Nuevo comentario';

                    // Enviar solicitud AJAX al servidor
                    $.ajax({
                        type: 'POST',
                        url: 'actualizar.php',
                        data: {
                            id_proyecto: id_proyecto,
                            comentario: comentario
                        },
                        success: function(data) {
                            // Manejar la respuesta del servidor aquí
                            alert('Actualización exitosa!');
                        }
                    });
                });
            });

            ;
        </script>
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
                                    <a href="..\Perfil\perfil_profesor.php">Mi Perfil</a>
                                    <a href="..\proyectos\indexProf.php">Autorizar Proyectos</a>
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
                <a href="indexProf.php"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up-double" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="black" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M13 14l-4 -4l4 -4"></path>
                        <path d="M8 14l-4 -4l4 -4"></path>
                        <path d="M9 10h7a4 4 0 1 1 0 8h-1"></path>
                    </svg></a>
                <h2>Proyecto: </h2>
            </div>
            <table class="center-table">
                <tr class="first-row">
                    <td><strong>Nombre:</strong></td>
                    <td><?php echo $data['titulo']; ?></td>
                    <td></td>
                    <td><strong>Area Estrategica:</strong></td>
                    <td><?php echo $data['area_estrategica']; ?></td>
                    <td></td>
                </tr>
                <tr class="white-row">
                    <td><strong>Profesor:</strong></td>
                    <td><?php echo $data['profesor']; ?></td>
                    <td></td>
                    <td><strong>Unidad Formación:</strong></td>
                    <td><?php echo $data['unidad_formacion']; ?></td>
                    <td></td>
                </tr>
                <tr class="white-row">
                    <td><strong>Nivel de Desarrollo:</strong></td>
                    <td><?php echo $data['categoria']; ?></td>
                    <td></td>
                    <td><strong>ID:</strong></td>
                    <td><?php echo $data['id_proy']; ?></td>
                    <td></td>
                </tr>
                <tr class="white-row">
                    <td><strong>Poster:</strong></td>
                    <td><?php echo $data['archivo_poster']; ?></td>
                    <td></td>
                    <td><strong>Video:</strong></td>
                    <td><?php echo $data['archivo_video']; ?></td>
                    <td></td>
                </tr>
                <tr class="white-row">
                    <td><strong>Descripcion:</strong></td>
                    <td><?php echo $data['descripcion']; ?></td>
                    <td></td>
                    <td><strong>Estructura Poster:</strong></td>
                    <td><?php echo ($data['poster']) ? "SI" : "NO"; ?></td>
                    <td></td>
                </tr>
            </table>
            <div class="white-row">
                <table id="alumnos" class="center-table">
                    <tr>
                        <th colspan="2" style="text-align: center;">Intengrantes del proyecto: </th>
                    </tr>
                    <?php
                    $pdo = Database::connect();
                    $sql = "SELECT alumnos_proyectos.matricula, alumnos.nombre as nombreAlumno 
				 FROM alumnos_proyectos 
				 INNER JOIN alumnos ON alumnos_proyectos.matricula = alumnos.matricula 
				 WHERE id_proyecto = $id";
                    $i = 1;

                    foreach ($pdo->query($sql) as $row) {
                        echo '<tr >';
                        echo  '<td>Alumno: ' . $i . '</td>';
                        echo  '<td>' . $row['nombreAlumno'] . '</td>';
                        $i++;
                        echo '</tr>';
                    }

                    Database::disconnect();
                    ?>
                </table>
            </div>
            <table>
                <tr>
                    <td>
                        <form action="actualizar.php?id=<?php echo $data['id_proy']; ?>" method="post">
                            <div class="modify-btn-container">
                                <button class="calificar-btn" id="autorizar">Autorizar</button>
                            </div>
                        </form>
                    </td>
                    <td>
                        <div class="modify-btn-container">
                            <button class="calificar-btn" onclick="mostrarFormulario()">Solicitar modificaciones</button>
                        </div>
                    <td>
                </tr>
            </table>
        </section>
        <form action="autorizar.php?id=<?php echo $data['id_proy']; ?>" method="post" id="formulario" style="display: none;">
            <div>
                <label>Agregar comentario sobre las mejoras del proyecto para poder ser autorizado</label>
                <textarea type="text" name="comentario" placeholder="Agregar comentario" value="<?php echo !empty($comentario) ? $comentario : ''; ?>">
            </div>
            <div class="modify-btn-container">
                <button class="calificar-btn" type=submit id="mostrar-formulario">Enviar comentarios</button>
            </div>

        </form>


    </body>

    </html>
<?php

} else {
    header("location:/paginaInicio/index.php");
}
?>