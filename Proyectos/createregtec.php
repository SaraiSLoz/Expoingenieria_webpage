<?php


require 'databasereg.php';

$nompError = null;
$arError = null;
$profError   = null;
$nivError   = null;
$equError = null;
$desError = null;
$posError = null;
$arposError = null;
$arvidError = null;



if (!empty($_POST)) {

	$nomp = $_POST['nomp'];
	$ar = $_POST['ar'];
	$prof   = $_POST['prof'];
	$niv   = $_POST['niv'];
	$uniform = $_POST['uniform'];

	$des = $_POST['des'];
	$pos = isset($_POST['pos']) ? $_POST['pos'] : '';
	$arpos = $_POST['arpos'];
	$arvid = $_POST['arvid'];



	// validate input
	$valid = true;

	if (empty($nomp)) {
		$nompError = 'Escribe un nombre de proyecto';
		$valid = false;
	}
	if (empty($ar)) {
		$arError = 'Selecciona area estrategica';
		$valid = false;
	}
	if (empty($prof)) {
		$profError = 'Escribe nombre del lider de proyecto';
		$valid = false;
	}

	if (empty($niv)) {
		$nivError = 'Selecciona categoria del proyecto';
		$valid = false;
	}
	if (empty($uniform)) {
		$uniformError = 'Selecciona unidad de formacion del proyecto';
		$valid = false;
	}


	if (empty($des)) {
		$desError = 'Escribe una descripcion';
		$valid = false;
	}

	if (empty($pos)) {
		$posError = 'Selecciona si deseas estructura';
		$valid = false;
	}

	if (empty($arpos)) {
		$arposError = 'Introduce un enlace para el  poster';
		$valid = false;
	}
	if (empty($arvid)) {
		$arvidError = 'Introduce un enlace para el  video';
		$valid = false;
	}

	// insert data
	if ($valid) {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO proyecto(id_proy,titulo, id_categoria,id_AreaEstr,id_profesor,id_unidad_formacion,id_expoinge,
		descripcion,poster,archivo_poster,archivo_video,id_status,calificacion) 
		values(null, ?, ?, ?, ?, ?, 1,?,?,?,?,1,NULL)";
		$q = $pdo->prepare($sql);
		($pos == "S") ? $posr = 1 : $posr = 0;
		$q->execute(array($nomp, $niv, $ar, $prof, $uniform, $des, $posr, $arpos, $arvid));
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" 
crossorigin="anonymous"></script>
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
	<div class="calificacion">
		<a href="index.php"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up-double" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="black" fill="none" stroke-linecap="round" stroke-linejoin="round">
				<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
				<path d="M13 14l-4 -4l4 -4"></path>
				<path d="M8 14l-4 -4l4 -4"></path>
				<path d="M9 10h7a4 4 0 1 1 0 8h-1"></path>
			</svg></a>
		<h2>Registro de Proyectos</h2>

	</div>
	<form  action="registrareq.php" method="post" enctype="multipart/form-data">
		
	<div class="form-group <?php echo !empty($nompError) ? 'error' : ''; ?>">
					<label for="exampleInputEmail1">Nombre del proyecto: </label>
					<input class="form-control" name="nomp" type="text" placeholder="Nombre del proyecto" value="<?php echo !empty($nomp) ? $nomp : ''; ?>">
					<?php if (($nompError != null)) ?>
					<span class="help-inline"><?php echo $nompError; ?></span>
					<small id="emailHelp" class="form-text text-muted"> Agregar nombre de proyecto</small>
	</div>


			<div class="form-row">
    		<div class="form-group col-5<?php echo !empty($arError) ? ' error' : ''; ?>">
       			 <label for="exampleInputEmail1">Área estratégica:</label>
        		<select class="form-control" name="ar">
            		<option value="">Selecciona un área estratégica</option>
            		<?php
           			 $pdo = Database::connect();
           			 $query = 'SELECT * FROM area_estrategica';
            		foreach ($pdo->query($query) as $row) {
               		if ($row['id_a'] == $ar)
                    		echo "<option selected value='" . $row['id_a'] . "'>" . $row['nombre_a'] . "</option>";
                	else
                    		echo "<option value='" . $row['id_a'] . "'>" . $row['nombre_a'] . "</option>";
            		}
            		Database::disconnect();
            ?>
        		</select>
        <?php if (!empty($arError)) { ?>
            <span class="help-inline"><?php echo $arError; ?></span>
        <?php } ?>
    	</div>
    <div class="form-group col-5<?php echo !empty($nivError) ? ' error' : ''; ?>">
        <label for="exampleInputEmail1">Nivel de Desarrollo:</label>
        <select class="form-control" name="niv">
            <option value="">Selecciona un nivel de desarrollo</option>
            <?php
            $pdo = Database::connect();
            $query = 'SELECT * FROM categoria';
            foreach ($pdo->query($query) as $row) {
                if ($row['id_c'] == $niv)
                    echo "<option selected value='" . $row['id_c'] . "'>" . $row['nombre_c'] . "</option>";
                else
                    echo "<option value='" . $row['id_c'] . "'>" . $row['nombre_c'] . "</option>";
            }
            Database::disconnect();
            ?>
        </select>
        <?php if (!empty($nivError)) { ?>
            <span class="help-inline"><?php echo $nivError; ?></span>
        <?php } ?>
    </div>
</div>

<div class="form-group <?php echo !empty($uniformError) ? ' error' : ''; ?>">
        <label for="exampleInputEmail1">Unidad de formación: </label>
        <select class="form-control" name="uniform">
            <option value="">Selecciona una unidad de formación: </option>
            <?php
            $pdo = Database::connect();
            $query = 'SELECT * FROM unidad_de_formacion';
            foreach ($pdo->query($query) as $row) {
                if ($row['id'] == $uniform)
                    echo "<option selected value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                else
                    echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
            }
            Database::disconnect();
            ?>
        </select>
        <?php if (!empty($uniformError)) { ?>
            <span class="help-inline"><?php echo $uniformError; ?></span>
        <?php } ?>
    </div>

	<div class="form-group <?php echo !empty($profError) ? ' error' : ''; ?>">
        <label for="exampleInputEmail1">Unidad de formación: </label>
        <select class="form-control" name="prof">
            <option value="">Selecciona el/la profesor/profesora : </option>
            <?php
            $pdo = Database::connect();
            $query = 'SELECT * FROM profesores';
            foreach ($pdo->query($query) as $row) {
                if ($row['id'] == $prof)
                    echo "<option selected value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                else
                    echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
            }
            Database::disconnect();
            ?>
        </select>
        <?php if (!empty($profError)) { ?>
            <span class="help-inline"><?php echo $profError; ?></span>
        <?php } ?>
    </div>	





			<div class="row <?php echo !empty($desError) ? 'error' : ''; ?>">
				<div class="col1">
					<p>Descripción del Proyecto: (200 palabras max) </p>
				</div>
				<div class="col10">
					<input name="des" type="text" placeholder="Descripción del Proyecto: (200 palabras max)" value="<?php echo !empty($des) ? $des : ''; ?>">
					<?php if (($desError != null)) ?>
					<span class="help-inline"><?php echo $desError; ?></span>
				</div>
				<div class="col3">
				</div>
			</div>

			<div class="form-group <?php echo !empty($arpospError) ? 'error' : ''; ?>">
					<label for="exampleInputEmail1">Poster: </label>
					<input class="form-control" name="arpos" type="text" placeholder="Enlace póster" value="<?php echo !empty($arpos) ? $arpos : ''; ?>">
					<?php if (($arposError != null)) ?>
					<span class="help-inline"><?php echo $arposError; ?></span>
					<small id="emailHelp" class="form-text text-muted"> Incluir enlace con máximo 100 carácteres.</small>
			</div>
			<div class="form-group <?php echo !empty($arvidError) ? 'error' : ''; ?>">
					<label for="exampleInputEmail1">Video: </label>
					<input class="form-control" name="arvid" type="text" placeholder="Enlace video" value="<?php echo !empty($arvid) ? $arvid : ''; ?>">
					<?php if (($arvidError != null)) ?>
					<span class="help-inline"><?php echo $arvidError; ?></span>
					<small id="emailHelp" class="form-text text-muted"> Incluir enlace con máximo 100 carácteres.</small>
			</div>


			<div class="row <?php echo !empty($posError) ? 'error' : ''; ?>">
				<div class="col1">
					<p>¿Necesitas estructura para tu póster?</p>
				</div>

				<div class="col2">
					<input name="pos" type="radio" value="S" <?php $pos = null;
																echo ($pos == "S") ? 'checked' : ''; ?>>Si</input> &nbsp;&nbsp;
					<input name="pos" type="radio" value="N" <?php $pos = null;
																echo ($pos == "N") ? 'checked' : ''; ?>>No</input>
					<?php if (($posError != null)) ?>
					<span class="help-inline"><?php echo $posError; ?></span>
				</div>
			</div>



		<div class="bot">
			<button type="submit" class="calificar-btn">REgistrar proyecto </button>
		</div>
	</form>
	</div>

</body>


</html>