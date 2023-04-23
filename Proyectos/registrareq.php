<?php



require 'databasereg.php';

$matri1Error = null;
$matri2Error = null;
$matri3Error = null;
$matri4Error = null;
$matri5Error = null;


if (!empty($_POST)) {
    $matri1 = $_POST['matri1'];
    $matri2 = $_POST['matri2'];
    $matri3 = $_POST['matri3'];
    $matri4 = $_POST['matri4'];
    $matri5 = $_POST['matri5'];

    $valid = true;

    if (empty($matri1)) {
		$nompError = 'Escribe un nombre de proyecto';
		$valid = false;
	}

    if ($valid) {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
        $params = array(':matri1' => $matri1, ':matri2' => $matri2, ':matri3' => $matri3,':matri4' => $matri4,':matri5' => $matri5);
       
        if (empty($matri1)){
            unset($params[':matri1']);
             $sql = "INSERT INTO alumno_proyecto (id_proyecto,matricula) VALUES ($matri2, $matri3, $matri4, $matri5)";
        }

        if (empty($matri2)){
            unset($params[':matri2']);
             $sql = "INSERT INTO alumno_proyecto (id_proyecto,matricula) VALUES ($matri1, $matri3, $matri4, $matri5)";
            
        }
        
        if (empty($matri3)){
            unset($params[':matri3']);
             $sql = "INSERT INTO alumno_proyecto (id_proyecto,matricula) VALUES ($matri1, $matri2, $matri4, $matri5)";
            
        }

        
        if (empty($matri4)){
            unset($params[':matri4']);
             $sql = "INSERT INTO alumno_proyecto (id_proyecto,matricula) VALUES ($matri1, $matri2, $matri3, $matri5)";
             if (empty($matri3)){
                unset($params[':matri3']);
                 $sql = "INSERT INTO alumno_proyecto (id_proyecto,matricula) VALUES ($matri1, $matri2, $matri3, $matri5)"; 
            }
        }


             if (empty($matri5)){
                unset($params[':matri5']);
                $sql = "INSERT INTO alumno_proyecto (id_proyecto,matricula) VALUES ($matri1, $matri2, $matri3, $matri4)";
                if (empty($matri4)){
                    unset($params[':matri4']);
                    $sql = "INSERT INTO alumno_proyecto (id_proyecto,matricula) VALUES ($matri1, $matri2, $matri3)";
                    if (empty($matri3)){
                        unset($params[':matri3']);
                        $sql = "INSERT INTO alumno_proyecto (id_proyecto,matricula) VALUES ($matri1, $matri2)"; 
                    } 
                }
                else{
                    $sql = "INSERT INTO alumno_proyecto (id_proyecto,matricula) VALUES ($matri1, $matri2, $matri3)";
                }
            }  
            else{
                $sql = "INSERT INTO alumno_proyecto (id_proyecto,matricula) VALUES ($matri1, $matri2, $matri3,$matri4, $matri5)";
            }
            
        else{
            $sql = "INSERT INTO alumno_proyecto (id_proyecto,matricula) VALUES (:matri1, id_proy), (:matri2, id_proy), (:matri3, id_proy), 
            (:matri4, id_proy), (:matri5, id_proy)"
        
        }


        
		$q = $pdo->prepare($sql);
		
		$q->execute(array($params));
		Database::disconnect();
	}



}



?>


<!DOCTYPE html>
<html>

<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" 
	rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" 
	crossorigin="anonymous">
	<link rel="stylesheet" href="stylereg.css">
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