<?php

require '../databasereg.php';

$id = null;
if (!empty($_GET['id'])) {
	$id = $_REQUEST['id'];
}

if ($id == null) {
	header("Location: index.php");
}
$idError   = null;
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
	//error

	//values
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
		$nomlError = 'Escribe nombre del lider de proyecto';
		$valid = false;
	}

	if (empty($niv)) {
		$nivError = 'Selecciona categoria del proyecto';
		$valid = false;
	}
	if (empty($uniform)) {
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
	if (empty($arpos)) {
		$arposError = 'Introduce un archivo';
		$valid = false;
	}

	if (empty($arvid)) {
		$arvidError = 'Introduce un archivo';
		$valid = false;
	}

	if ($valid) {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE proyecto set id_proy =?, titulo = ?,id_categoria = ?,id_AreaEstr = ?,
            id_profesor = ?,id_unidad_formacion = ?,descripcion =?,poster = ?,
            archivo_poster = ?,archivo_video = ? WHERE id_proy = ?";
		$q = $pdo->prepare($sql);
		($pos == "S") ? $posr = 1 : $posr = 0;
		$q->execute(array($id, $nomp, $niv, $ar, $prof, $uniform, $des, $posr, $arpos, $arvid, $id));

		Database::disconnect();
	}
} else {
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT proyecto.id_proy, proyecto.titulo, proyecto.id_profesor, 
        proyecto.descripcion, proyecto.poster, proyecto.id_unidad_formacion,
        proyecto.archivo_poster, proyecto.archivo_video,proyecto.titulo, proyecto.id_categoria,
         proyecto.id_AreaEstr 
        FROM proyecto 
        WHERE id_proy = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);


	$id 	= $data['id_proy'];
	$nomp = $data['titulo'];
	$prof = $data['id_profesor'];
	$niv = $data['id_categoria'];
	$ar = $data['id_AreaEstr'];
	$des = $data['descripcion'];
	$arpos = $data['archivo_poster'];
	$arvid = $data['archivo_video'];
	$uniform  = $data['id_unidad_formacion'];
	$pos   = ($data['poster']) ? "S" : "N";
	Database::disconnect();
}
?>
<!DOCTYPE html>
<html>

<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
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
								<a href="..\Perfil\perfil_estudiante.php">Mi Perfil</a>
								<a href="..\proyectos\proyectosAlumnos.php">Proyectos Actuales</a>
								<a href="..\login\logout2.php">Cerrar sesión</a>
							</div>



						</div>
					</td>
				</div>


			</tr>
		</table>
	</header>
	<div class="calificacion">
		<a href="proyectosAlumnos.php"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up-double" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="black" fill="none" stroke-linecap="round" stroke-linejoin="round">
				<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
				<path d="M13 14l-4 -4l4 -4"></path>
				<path d="M8 14l-4 -4l4 -4"></path>
				<path d="M9 10h7a4 4 0 1 1 0 8h-1"></path>
			</svg></a>
		<h2>Modificar Proyectos</h2>

	</div>
	<form class="form-horizontal" action="update.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
		<section>
			<table class="registro">
				<tr>
					<td class="<?php echo !empty($idError) ? 'error' : ''; ?>">
						<label>id: </label>
						<input class="form-control" name="id" type="text" readonly placeholder="id" value="<?php echo !empty($id) ? $id : ''; ?>" method="post">
						<?php if (($idError != null)) ?>
						<span class="help-inline"><?php echo $idError; ?></span>
					</td>
					<td class="<?php echo !empty($nompError) ? 'error' : ''; ?>">
						<label>Nombre del proyecto: </label>
						<input class="form-control" name="nomp" type="text" placeholder="Nombre del proyecto" value="<?php echo !empty($nomp) ? $nomp : ''; ?>">
						<?php if (($nompError != null)) ?>
						<span class="help-inline"><?php echo $nompError; ?></span>
					</td>
				</tr>

				<tr>
					<td class="<?php echo !empty($arError) ? 'error' : ''; ?>">
						<label>Área Estratégica</label>
						<select class="form-control" name="ar">
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
					</td>
					<td class="<?php echo !empty($nivError) ? 'error' : ''; ?>">
						<label>Niveles de desarrollo</label>
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

						<?php if (($nivError) != null) ?>
						<span class="help-inline"><?php echo $nivError; ?></span>
					</td>

				<tr>
					<td class="<?php echo !empty($profError) ? ' error' : ''; ?>">
						<label for="exampleInputEmail1">Selecciona un docente : </label>
						<select class="form-control" class="form-control" name="prof">
							<option value="">Selecciona un docente : </option>
							<?php
							$pdo = Database::connect();
							$query = 'SELECT * FROM profesores';
							foreach ($pdo->query($query) as $row) {
								if ($row['matricula'] == $prof)
									echo "<option selected value='" . $row['matricula'] . "'>" . $row['nombre'] . "</option>";
								else
									echo "<option value='" . $row['matricula'] . "'>" . $row['nombre'] . "</option>";
							}
							Database::disconnect();
							?>
						</select>
						<?php if (!empty($profError)) { ?>
							<span class="help-inline"><?php echo $profError; ?></span>
						<?php } ?>
					</td>



					<td class="<?php echo !empty($nivError) ? 'error' : ''; ?>">
						<label>Unidad de formación</label>
						<select class="form-control" name="uniform">
							<option value="">Selecciona una unidad formación: </option>
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

						<?php if (($nivError) != null) ?>
						<span class="help-inline"><?php echo $nivError; ?></span>
					</td>
				</tr>
				<tr>
					<td class="<?php echo !empty($arposError) ? 'error' : ''; ?>">
						<label>Poster: </label>
						<div id="src-file1">
							<input class="form-control" name="arpos" type="text" placeholder="Nombre del poster" value="<?php echo !empty($arpos) ? $arpos : ''; ?>">
							<?php if (($nompError != null)) ?>
							<span class="help-inline"><?php echo $nompError; ?></span>
						</div>
					</td>

					<td class="<?php echo !empty($arvidError) ? 'error' : ''; ?>">
						<label>Video: </label>
						<div id="src-file1">
							<input class="form-control" name="arvid" type="text" placeholder="Nombre del video" value="<?php echo !empty($arvid) ? $arvid : ''; ?>">
							<?php if (($nompError != null)) ?>
							<span class="help-inline"><?php echo $nompError; ?></span>
						</div>

					</td>
				</tr>
				<tr>
					<td class="<?php echo !empty($desError) ? 'error' : ''; ?>">
						<label>Descripción del Proyecto: (200 palabras max) </label>
						<input class="form-control" name="des" type="text" placeholder="Descripción del Proyecto: (200 palabras max)" value="<?php echo !empty($des) ? $des : ''; ?>">
						<?php if (($desError != null)) ?>
						<span class="help-inline"><?php echo $desError; ?></span>
					</td>
					<td class="<?php echo !empty($posError) ? 'error' : ''; ?>">
						<label>¿Necesitas estructura para tu póster?</label>

						<div class="form-control">
							<input name="pos" type="radio" value="S" <?php echo ($pos == "S") ? 'checked' : ''; ?>>Si</input> &nbsp;&nbsp;
							<input name="pos" type="radio" value="N" <?php echo ($pos == "N") ? 'checked' : ''; ?>>No</input>
							<?php if (($posError != null)) ?>
							<span class="help-inline"><?php echo $posError; ?></span>
						</div>
					</td>
				</tr>
			</table>


			<table id="alumnos">
				<label><strong>Intengrantes del proyecto: </strong></label>
				<?php
				$pdo = Database::connect();
				$sql = "SELECT alumnos_proyectos.matricula, alumnos.nombre as nombreAlumno 
				 FROM alumnos_proyectos 
				 INNER JOIN alumnos ON alumnos_proyectos.matricula = alumnos.matricula 
				 WHERE id_proyecto = $id";
				$i = 1;

				foreach ($pdo->query($sql) as $row) {
					echo '<tr class="form-control">';
					echo  '<td><strong>Alumno ' . $i . ': </strong></td>';
					echo  '<td>' . $row['nombreAlumno'] . '</td>';
					$i++;
					echo '</tr>';
				}

				Database::disconnect();
				?>
			</table>






		</section>
		<div class="row">
			<div class="col1">
				<button type="submit" class="calificar-btn">Actualizar Proyecto</button>
			</div>
			<div class="col2">
			</div>
		</div>

	</form>
	</div>




</body>


</html>
<?php
echo '<a href="registrareq.php?id=' . $id . '"><button class="calificar-btn">Registrar más integrantes</button></a>';
?>