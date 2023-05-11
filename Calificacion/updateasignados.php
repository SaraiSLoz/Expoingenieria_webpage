<?php
session_start();
$usuario = $_SESSION["usuario"];
if (isset($_SESSION["usuario"])) {

	require '../databasereg.php';

	$id_proy = null;
	if (!empty($_GET['id_proy'])) {
		$id_proy = $_REQUEST['id_proy'];
	}

	if ($id_proy == null) {
		header("Location: index.php");
	}


	$idError = null;
	$id_proyError = null;
	$id_juez1Error = null;
	$id_juez2Error = null;
	$id_juez3Error = null;

	$id_juez1Error2 = NULL;
	$id_juez2Error2 = NULL;
	$id_juez3Error2 = NULL;

	$id_juez1Error3 = NULL;
	$id_juez2Error3 = NULL;
	$id_juez3Error3 = NULL;

	if (!empty($_POST)) {
		//error

		//values


		$id_proy = $_POST['id_proy'];
		$id_juez1 = $_POST['id_juez1'];
		$id_juez2 = $_POST['id_juez2'];
		$id_juez3 = $_POST['id_juez3'];


		// validate input
		$valid = true;

		if (!empty($id_juez1)) {
			$pdo = Database::connect();
			$stmt_juez1 = $pdo->prepare("
			SELECT * FROM jueces_totales
			WHERE matricula = :id_juez1
		");

			$stmt_juez1->bindParam(':id_juez1', $id_juez1);
			$stmt_juez1->execute();
			$juez1 = $stmt_juez1->fetch(PDO::FETCH_ASSOC);

			if (!$juez1) {
				$id_juez1Error2 = 'Juez no encontrado';
				$valid = false;
			} else {
				$stmt_proyecto = $pdo->prepare("
				SELECT * FROM proyecto
				WHERE id_proy = :id_proyecto
				AND id_profesor = :id_juez1
			");

				$stmt_proyecto->bindParam(':id_proyecto', $id_proy);
				$stmt_proyecto->bindParam(':id_juez1', $id_juez1);
				$stmt_proyecto->execute();
				$proyecto_juez1 = $stmt_proyecto->fetch(PDO::FETCH_ASSOC);

				if ($proyecto_juez1) {
					$id_juez1Error3 = 'Juez asociado al proyecto';
					$valid = false;
				}
			}
			Database::disconnect();
		}


		if (!empty($id_juez2)) {
			$pdo = Database::connect();
			$stmt_juez2 = $pdo->prepare("
			SELECT * FROM jueces_totales
			WHERE matricula = :id_juez2
		");

			$stmt_juez2->bindParam(':id_juez2', $id_juez2);
			$stmt_juez2->execute();
			$juez2 = $stmt_juez2->fetch(PDO::FETCH_ASSOC);

			if (!$juez2) {
				$id_juez2Error2 = 'Juez no encontrado';
				$valid = false;
			} else {
				$stmt_proyecto = $pdo->prepare("
				SELECT * FROM proyecto
				WHERE id_proy = :id_proyecto
				AND id_profesor = :id_juez2
			");

				$stmt_proyecto->bindParam(':id_proyecto', $id_proy);
				$stmt_proyecto->bindParam(':id_juez2', $id_juez2);
				$stmt_proyecto->execute();
				$proyecto_juez2 = $stmt_proyecto->fetch(PDO::FETCH_ASSOC);

				if ($proyecto_juez2) {
					$id_juez2Error3 = 'Juez asociado al proyecto';
					$valid = false;
				}
			}
			Database::disconnect();
		}

		if (!empty($id_juez3)) {
			$pdo = Database::connect();
			$stmt_juez3 = $pdo->prepare("
			SELECT * FROM jueces_totales
			WHERE matricula = :id_juez3
		");

			$stmt_juez3->bindParam(':id_juez3', $id_juez3);
			$stmt_juez3->execute();
			$juez3 = $stmt_juez3->fetch(PDO::FETCH_ASSOC);

			if (!$juez3) {
				$id_juez3Error3 = 'Juez no encontrado';
				$valid = false;
			} else {
				$stmt_proyecto = $pdo->prepare("
				SELECT * FROM proyecto
				WHERE id_proy = :id_proyecto
				AND id_profesor = :id_juez3
			");

				$stmt_proyecto->bindParam(':id_proyecto', $id_proy);
				$stmt_proyecto->bindParam(':id_juez3', $id_juez3);
				$stmt_proyecto->execute();
				$proyecto_juez3 = $stmt_proyecto->fetch(PDO::FETCH_ASSOC);

				if ($proyecto_juez3) {
					$id_juez3Error3 = 'Juez asociado al proyecto';
					$valid = false;
				}
			}
			Database::disconnect();
		}




		if (empty($id_juez1)) {
			$id_juez1Error = 'Escribe una nómina';
			$valid = false;
		}

		if (empty($id_juez2)) {
			$id_juez2Error = 'Escribe una nómina';
			$valid = false;
		}
		if (empty($id_juez3)) {
			$id_juez3Error = 'Escribe una nómina';
			$valid = false;
		}


		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE asigna_juez set id_proy = ?,id_juez1 = ?,
            id_juez2 = ?,id_juez3 = ? WHERE id_proy = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($id_proy, $id_juez1, $id_juez2, $id_juez3, $id_proy));

			Database::disconnect();
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT asigna_juez.id_proy, asigna_juez.id_juez1, 
        asigna_juez.id_juez2, asigna_juez.id_juez3
        FROM asigna_juez 
        WHERE id_proy = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id_proy));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$id_proy = $data['id_proy'];
		$id_juez1 = $data['id_juez1'];
		$id_juez2 = $data['id_juez2'];
		$id_juez3 = $data['id_juez3'];


		Database::disconnect();
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
									<a href="..\Perfil\perfil_administrador.php">Mi Perfil</a>
									<a href="..\Calificacion\asignados.php">Asignar jueces</a>
									<a href="..\AsignacionLugares\AsigLugares.php">Asignar lugares</a>
									<a href="..\proyectos\index.php">Visualizar proyectos</a>
									<a href="..\Anuncios\anuncios.php">Crear Anuncio</a>
									<a href="..\login\logout2.php">Cerrar sesión</a>
								</div>





							</div>
						</td>
					</div>


				</tr>
			</table>
		</header>
		<div class="calificacion">
			<a href="http://lab403azms01.itesm.mx/TC2005B_403_3/expoingenierias/Calificacion/asignados.php"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up-double" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="black" fill="none" stroke-linecap="round" stroke-linejoin="round">
					<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
					<path d="M13 14l-4 -4l4 -4"></path>
					<path d="M8 14l-4 -4l4 -4"></path>
					<path d="M9 10h7a4 4 0 1 1 0 8h-1"></path>
				</svg></a>
			<h2>Modificar Proyectos</h2>

		</div>
		<form class="form-horizontal" action="http://lab403azms01.itesm.mx/TC2005B_403_3/expoingenierias/Calificacion/updateasignados.php?id_proy=<?php echo $id_proy ?>" method="post" enctype="multipart/form-data">
			<section>
				<div class="row <?php echo !empty($idError) ? 'error' : ''; ?>">
					<div class="col1">
						<p>Nombre del proyecto: </p>
					</div>
					<div class="col2">
						<input name="id_proy" type="text" readonly placeholder="id_proy" value="<?php echo !empty($id_proy) ? $id_proy : ''; ?>" method="post">
						<?php if (($idError != null)) ?>
						<span class="help-inline"><?php echo $idError; ?></span>

					</div>
					<div class="col3">
					</div>
				</div>
				<div class="row <?php echo !empty($id_juez1Error) ? 'error' : ''; ?>">
					<div class="col1">
						<p>Juez 1: </p>
					</div>
					<div class="col3">
						<input name="id_juez1" type="text" placeholder="Juez 1" value="<?php echo !empty($id_juez1) ? $id_juez1 : ''; ?>">
						<?php if (($id_juez1Error != null)) ?>
						<span class="help-inline"><?php echo $id_juez1Error; ?></span>
						<?php if (($id_juez1Error2 != null)) ?>
						<span class="help-inline"><?php echo $id_juez1Error2; ?></span>
						<?php if (($id_juez1Error3 != null)) ?>
						<span class="help-inline"><?php echo $id_juez1Error3; ?></span>

					</div>
				</div>
				<div class="row <?php echo !empty($id_juez2Error) ? 'error' : ''; ?>">
					<div class="col1">
						<p>Juez 2: </p>
					</div>
					<div class="col3">
						<input name="id_juez2" type="text" placeholder="Juez 2" value="<?php echo !empty($id_juez2) ? $id_juez2 : ''; ?>">
						<?php if (($id_juez2Error != null)) ?>
						<span class="help-inline"><?php echo $id_juez2Error; ?></span>
						<?php if (($id_juez2Error2 != null)) ?>
						<span class="help-inline"><?php echo $id_juez2Error2; ?></span>
						<?php if (($id_juez2Error3 != null)) ?>
						<span class="help-inline"><?php echo $id_juez2Error3; ?></span>

					</div>
				</div>

				<div class="row <?php echo !empty($id_juez3Error) ? 'error' : ''; ?>">
					<div class="col1">
						<p>Juez 3: </p>
					</div>
					<div class="col3">
						<input name="id_juez3" type="text" placeholder="Juez 3" value="<?php echo !empty($id_juez3) ? $id_juez3 : ''; ?>">
						<?php if (($id_juez3Error != null)) ?>
						<span class="help-inline"><?php echo $id_juez3Error; ?></span>
						<?php if (($id_juez3Error2 != null)) ?>
						<span class="help-inline"><?php echo $id_juez3Error2; ?></span>
						<?php if (($id_juez3Error3 != null)) ?>
						<span class="help-inline"><?php echo $id_juez3Error3; ?></span>

					</div>
				</div>

			</section>
			<div class="bot">

				<button type="submit" class="botonf">Actualizar cambios</button>
			</div>
		</form>
		</div>

	</body>


	</html>

<?php
} else {
	header("location:http://lab403azms01.itesm.mx/TC2005B_403_3/expoingenierias/paginaInicio/index.php");
}
?>