<?php


require 'databasereg.php';

$nompError = null;
$arError = null;
$nomlError   = null;
$nivError   = null;
$equError = null;
$desError = null;
$posError = null;
$arposError = null;
$arvidError = null;


if (!empty($_POST)) {

	$nomp = $_POST['nomp'];
	$ar = $_POST['ar'];
	$noml   = $_POST['noml'];
	$niv   = $_POST['niv'];
	$equ = $_POST['equ'];
	$des = $_POST['des'];
	$pos = isset($_POST['pos']) ? $_POST['pos'] : '';

	$arposfilename = $_FILES['arpos']['name'];
	$arposfiletemp = $_FILES['arpos']['tmp_name'];
	$arvidfilename = $_FILES['arvid']['name'];
	$arvidfiletemp = $_FILES['arvid']['tmp_name'];
	$filename_separate1 = explode('.', $arposfilename);
	$file_extension1 = strtolower(end($filename_separate1));
	$filename_separate2 = explode('.', $arvidfilename);
	$file_extension2 = strtolower(end($filename_separate2));
	$extension1 = array('pdf', 'png');
	$extension2 = array('mp4');

	$extensiones_validas = array('pdf', 'png', 'mp4');
	if (in_array($file_extension1, $extensiones_validas)) {
		// El archivo es válido
	} else {
		// El archivo tiene una extensión no permitida
		echo "Error: el archivo $arposfilename tiene una extensión no permitida 
  $arposfilename, $arvidfilename,$file_extension1";
	}

	if (in_array($file_extension1, $extension1)) {
		$upload_poster = 'poster/' . $arposfilename;
		move_uploaded_file($arposfiletemp, $upload_poster);
	}

	if (in_array($file_extension2, $extension2)) {
		$upload_video = 'video/' . $arvidfilename;
		move_uploaded_file($arvidfiletemp, $upload_video);
	}


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
	if (empty($noml)) {
		$nomlError = 'Escribe nombre del lider de proyecto';
		$valid = false;
	}

	if (empty($niv)) {
		$nivError = 'Selecciona categoria del proyecto';
		$valid = false;
	}
	if (empty($equ)) {
		$equError = 'Escribe id de equipo';
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
	if (empty($upload_poster)) {
		$arposError = 'Introduce un archivo';
		$valid = false;
	}

	if (empty($upload_video)) {
		$arvidError = 'Introduce un archivo';
		$valid = false;
	}

	// insert data
	if ($valid) {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO proyecto(id_proy,id_categoria,id_AreaEstr,titulo,profesor,equipo,descripcion,poster,archivo_poster,archivo_video) values(null, ?, ?, ?, ?, ?, ?,?,?,?)";
		$q = $pdo->prepare($sql);
		($pos == "S") ? $posr = 1 : $posr = 0;
		$q->execute(array($niv, $ar, $nomp, $noml, $equ, $des, $posr, $upload_poster, $upload_video));
		Database::disconnect();
	}
}


?>


<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="stylereg.css">
</head>

<body>
	<header>
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
	<form class="form-horizontal" action="createregtec.php" method="post" enctype="multipart/form-data">
		<section>
			<div class="row <?php echo !empty($nompError) ? 'error' : ''; ?>">
				<div class="col1">
					<p>Nombre del proyecto: </p>
				</div>
				<div class="col2">
					<input name="nomp" type="text" placeholder="Nombre del proyecto" value="<?php echo !empty($nomp) ? $nomp : ''; ?>">
					<?php if (($nompError != null)) ?>
					<span class="help-inline"><?php echo $nompError; ?></span>
				</div>
				<div class="col3">
				</div>
			</div>


			<div class="row <?php echo !empty($arError) ? 'error' : ''; ?>">
				<div class="col1">
					<p>Área Estratégica</p>
				</div>
				<div class="col2">
					<select name="ar">
						<option value="">Selecciona un area estrategica</option>
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
					<?php if (($arError) != null) ?>
					<span class="help-inline"><?php echo $arError; ?></span>
				</div>
				<div class="col3">
				</div>
			</div>


			<div class="row <?php echo !empty($nomlError) ? 'error' : ''; ?>">
				<div class="col1">
					<p>Nombre del profesor: </p>
				</div>
				<div class="col2">
					<input name="noml" type="text" placeholder="Nombre del profesor" value="<?php echo !empty($noml) ? $noml : ''; ?>">
					<?php if (($nomlError != null)) ?>
					<span class="help-inline"><?php echo $nomlError; ?></span>
				</div>
				<div class="col3">
				</div>
			</div>



			<div class="row <?php echo !empty($nivError) ? 'error' : ''; ?>">
				<div class="col1">
					<p>Niveles de desarrollo</p>
				</div>
				<div class="col2">
					<select name="niv">
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

					<?php if (($nivError) != null) ?>
					<span class="help-inline"><?php echo $nivError; ?></span>
				</div>
				<div class="col3">
				</div>
			</div>

			<div class="row <?php echo !empty($equError) ? 'error' : ''; ?>">
				<div class="col1">
					<p>ID del Equipo: </p>
				</div>
				<div class="col2">
					<input name="equ" type="number" placeholder="ID del Equipo" value="<?php echo !empty($equ) ? $equ : ''; ?>">
					<?php if (($equError != null)) ?>
					<span class="help-inline"><?php echo $equError; ?></span>
				</div>
				<div class="col3">
				</div>
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

			<div class="row <?php echo !empty($arposError) ? 'error' : ''; ?>">
				<div class="col5">
					<p>Poster: </p>
					<div id="src-file1">
						<input type="file" name="arpos" aria-label="Archivo" value="<?php echo !empty($upload_poster) ? $upload_poster : ''; ?>">
						<?php if (($arposError != null)) ?>
						<span class="help-inline"><?php echo $arposError; ?></span>
					</div>
					<div class="col3">
					</div>
				</div>

			</div>

			<div class="row <?php echo !empty($arvidError) ? 'error' : ''; ?>">
				<div class="col5">
					<p>Video: </p>
					<div id="src-file1">
						<input type="file" name="arvid" aria-label="Archivo" value="<?php echo !empty($upload_video) ? $upload_video : ''; ?>">
						<?php if (($arvidError != null)) ?>
						<span class="help-inline"><?php echo $arvidError; ?></span>
					</div>
					<div class="col3">
					</div>
				</div>

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



		</section>
		<div class="bot">
			<button type="submit" class="botonf">Registrar Proyecto</button>
		</div>
	</form>
	</div>

</body>


</html>