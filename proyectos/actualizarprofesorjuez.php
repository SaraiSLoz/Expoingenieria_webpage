<?php
include '../databasereg.php';
$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}
// Obtener los datos del formulario
$campo1 = 2;
$campo2 = 'Sin comentarios';
// Ejecutar la sentencia SQL para actualizar la tabla
$pdo = Database::connect();
$stmt = $pdo->prepare("UPDATE proyecto SET id_status = :campo1, comentario = :campo2 WHERE id_proy = :id");
$stmt->bindParam(':campo1', $campo1);
$stmt->bindParam(':campo2', $campo2);
$stmt->bindParam(':id', $id);
$stmt->execute();
Database::disconnect();
header("Location: http://lab403azms01.itesm.mx/TC2005B_403_3/expoingenierias/proyectos/indexProf-Juez.php");
exit();
