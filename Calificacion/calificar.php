<?php
session_start();
$usuario = $_SESSION["usuario"];
require '../databasereg.php';

if (isset($_SESSION["usuario"])) {
    $id = null;
    if (!empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }


    $id_juez = $_SESSION['usuario'];



    if (!empty($_POST)) {
        $id = $_POST['id'];
        $id_juez = $_POST['juez'];
        $preg1 = $_POST['pregunta1'];
        $preg2 = $_POST['pregunta2'];
        $preg3 = $_POST['pregunta3'];
        $preg4 = $_POST['pregunta4'];
        $preg5 = $_POST['pregunta5'];
        $preg6 = $_POST['pregunta6'];
        $preg7 = $_POST['pregunta7'];
        $preg8 = $_POST['pregunta8'];
        $preg9 = $_POST['pregunta9'];
        $preg10 = $_POST['pregunta10'];



        $suma = $preg1 + $preg2 + $preg3 + $preg4 + $preg5 + $preg6 + $preg7 + $preg8 + $preg9 + $preg10;
        $valid = true;


        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO calificacion2(id, calificacion,id_juez,id_proyecto)values(null, ?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($suma, $id_juez, $id));
            Database::disconnect();




            header("Location: index_proyectosjuez.php");
            exit();
        }
    }



?>




    <!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" href="style.css">


    </head>

    <body>
        <header>
            <table class="menu">
                <tr>
                    <td><img class="logo" src="https://raw.githubusercontent.com/mikeedel/expoinge/main/logo-expo.svg"></td>
                    <td></td>
                    <td><a href="..\paginaInicio\Conocenos2.php">Conócenos</a></td>
                    <td><a href="..\paginaInicio\Ediciones2.php">Ediciones</a></td>
                    <td><a href="..\Anuncios\visualizaanuncioadmin.php">Anuncios</a></td>
                    <td><a href="..\paginaInicio\Contacto2.php">Contacto</a></td>
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
                                    <a href="..\Perfil\perfil_juez.php">Mi Perfil</a>
                                    <a href="..\Calificacion\index_proyectosjuez.php">Calificar Proyectos</a>
                                    <a href="https://www.youtube.com/user/hubspot">Certificado</a>
                                    <a href="..\login\logout2.php">Cerrar sesión</a>
                                </div>





                            </div>
                        </td>
                    </div>


                </tr>
            </table>
        </header>
        <div class="calificacion">
            <a href='index_proyectosjuez.php'><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up-double" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="black" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M13 14l-4 -4l4 -4"></path>
                    <path d="M8 14l-4 -4l4 -4"></path>
                    <path d="M9 10h7a4 4 0 1 1 0 8h-1"></path>
                </svg></a>
            <span>Calificación</span>
        </div>

        <div class="table-rubrica">
            <table class="rubrica">
                <tr>
                    <td>Rúbrica</td>
                    <td>Ponderación</td>
                </tr>
            </table>
        </div>

        <form method="post" action="calificar.php?id=<?php echo $id ?>" enctype="multipart/form-data">
            <div class="preguntas">
                <table class="todo">
                    <tr class="numeros">
                        <td></td>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                    </tr>
                    <tr>
                        <td><input type="hidden" name="id" value="<?php echo $id; ?>"></td>
                    </tr>
                    <tr>
                        <td><input type="hidden" name="id_juez" value="<?php echo $id_juez; ?>"></td>
                    </tr>
                    <tr>

                        <td class="pregunta">Pregunta 1</td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta1" value="1" id="opcion1"><span></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta1" value="2" id="opcion2"><span></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta1" value="3" id="opcion3"><span></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta1" value="4" id="opcion4"><span></span></label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="pregunta">Pregunta 2</td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta2" value="1" id="opcion1"><span></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta2" value="2" id="opcion2"><span></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta2" value="3" id="opcion3"><span></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta2" value="4" id="opcion4"><span></span></label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="pregunta">Pregunta 3</td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta3" value="1" id="opcion1"><span></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta3" value="2" id="opcion2"><span></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta3" value="3" id="opcion3"><span></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta3" value="4" id="opcion4"><span></span></label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="pregunta">Pregunta 4</td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta4" value="1" id="opcion1"><span></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta4" value="2" id="opcion2"><span></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta4" value="3" id="opcion3"><span></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta4" value="4" id="opcion4"><span></span></label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="pregunta">Pregunta 5</td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta5" value="1" id="opcion1"><span></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta5" value="2" id="opcion2"><span></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta5" value="3" id="opcion3"><span></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta5" value="4" id="opcion4"><span></span></label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="pregunta">Pregunta 6</td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta6" value="1" id="opcion1"><span></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta6" value="2" id="opcion2"><span></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta6" value="3" id="opcion3"><span></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta6" value="4" id="opcion4"><span></span></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="pregunta">Pregunta 7</td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta7" value="1" id="opcion1"><span></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta7" value="2" id="opcion2"><span></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta7" value="3" id="opcion3"><span></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta7" value="4" id="opcion4"><span></span></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="pregunta">Pregunta 8</td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta8" value="1" id="opcion1"><span></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta8" value="2" id="opcion2"><span></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta8" value="3" id="opcion3"><span></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta8" value="4" id="opcion4"><span></span></label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="pregunta">Pregunta 9</td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta9" value="1" id="opcion1"><span></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta9" value="2" id="opcion2"><span></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta9" value="3" id="opcion3"><span></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta9" value="4" id="opcion4"><span></span></label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="pregunta">Pregunta 10</td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta10" value="1" id="opcion1"><span></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta10" value="2" id="opcion2"><span></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta10" value="3" id="opcion3"><span></span></label>
                            </div>
                        </td>
                        <td>
                            <div class="opciones">
                                <label><input type="radio" name="pregunta10" value="4" id="opcion4"><span></span></label>
                            </div>
                        </td>
                    </tr>

                </table>
            </div>

            <div style="margin-top: 30px;">

                <td>
                    <button type="submit" class="calificar-btn" style="margin-left: 25px;">Terminar evaluación</button>
                    <span id="suma" class="suma" style="margin-left: 1090px;">Calificación: 0</span>
                </td>
            </div>





        </form>



        <script>
            //para que se vaya actualizando la suma 
            var suma = 0;
            var opciones = document.querySelectorAll('input[type="radio"]');
            opciones.forEach(function(opcion) {
                opcion.addEventListener('change', function() {
                    suma = 0;
                    opciones.forEach(function(opcion) {
                        if (opcion.checked) {
                            suma += parseInt(opcion.value);
                        }
                    });
                    actualizarSuma();
                });
            });

            function actualizarSuma() {
                document.getElementById("suma").innerHTML = "Calificación: " + suma;
            }
        </script>



    </body>

    </html>

<?php
} else {
    header("location:/paginaInicio/index.php");
}
?>