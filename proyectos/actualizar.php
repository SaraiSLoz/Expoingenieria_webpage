<?php
include '../databasereg.php';
include 'enviarcoment.php';
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

$query = $pdo->prepare("
    SELECT alumnos.nombre, alumnos.email
    FROM alumnos
    INNER JOIN alumnos_proyectos
    ON alumnos.matricula = alumnos_proyectos.matricula
    WHERE alumnos_proyectos.id_proyecto = :proyectoID
");
$query->bindParam(":proyectoID", $id);
$query->execute();
$alumnos = $query->fetchAll(PDO::FETCH_ASSOC);

echo '<pre>';
print_r($alumnos);
echo '</pre>';


foreach ($alumnos as $alumno) {
    $nombre = $alumno['nombre'];
    $email = $alumno['email'];
    enviarcomentarios_profe_alumno($email, $nombre, $comentario);
}


Database::disconnect();
header("Location: indexProf.php");
exit();

?>

<!DOCTYPE html>