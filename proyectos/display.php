<?php


require '../databasereg.php';

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
	$arposfilename = $_FILES['arvid']['name'];
	$arposfiletemp = $_FILES['arvid']['tmp_name'];
	$arvidfilename = $_FILES['arpos']['name'];
	$arposfiletemp = $_FILES['arpos']['tmp_name'];
	$filename_separate1 = explode('.', $arposfilename);
	$file_extension1 = strtolower(end($filename_separate1));
	$filename_separate2 = explode('.', $arvidfilename);
	$file_extension2 = strtolower(end($filename_separate2));
	$extension1 = array('pdf', 'png');
	$extension2 = array('pdf');

	$extensiones_validas = array('pdf', 'img');
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
	<h1>Display data</h1>
</body>

</html>