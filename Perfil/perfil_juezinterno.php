<?php
session_start();
$usuario = $_SESSION["usuario"];
require '../databasereg.php';
if (isset($_SESSION["usuario"])) {

    if ($usuario == null) {
        header("Location: index.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'SELECT juez_interno.matricula, juez_interno.nombre,juez_interno.email,area_estrategica.nombre_a as area,
        departamento.nombre as depto
        FROM juez_interno
        INNER JOIN departamento ON juez_interno.id_departamento=departamento.id 
        INNER JOIN area_estrategica ON juez_interno.id_area=area_estrategica.id_a 
        WHERE matricula = ?';
        $q = $pdo->prepare($sql);
        $q->execute(array($usuario));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }

?>

    <!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" href="perfil_juezinterno1.css">
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
                                    <a href="..\Perfil\perfil_juezinterno.php">Mi Perfil</a>
                                    <a href="..\Calificacion\index_proyectosjuezinterno.php">Calificar Proyectos</a>
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
                <a href="..\paginaInicio\index-JuezInterno.php"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up-double" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="black" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M13 14l-4 -4l4 -4"></path>
                        <path d="M8 14l-4 -4l4 -4"></path>
                        <path d="M9 10h7a4 4 0 1 1 0 8h-1"></path>
                    </svg></a>
                <h2>Mi Perfil</h2>
            </div>
            <form>
                <table class="imagen_logo">
                    <tr>
                        <td><img class="logo2" src="logo_perfil.svg"></td>
                    </tr>
                </table>

                <table class="perfil">
                    <tr>
                        <td><strong>Nómina:</strong></td>
                        <td><input type="text" value=<?php echo $data['matricula']; ?> readonly></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><strong>Nombre:</strong></td>
                        <td><input type="text" value=<?php echo $data['nombre']; ?> readonly></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td><input type="text" value=<?php echo $data['email']; ?> readonly></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><strong>Área Estratégica:</strong></td>
                        <td><input type="text" value=<?php echo $data['area']; ?> readonly></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><strong>Departamento:</strong></td>
                        <td><input type="text" value=<?php echo $data['depto']; ?> readonly></td>
                        <td></td>
                    </tr>

                </table>
            </form>
        </section>
    </body>

    </html>


<?php
} else {
    header("location:/expoingenierias/paginaInicio/index.php");
}
?>