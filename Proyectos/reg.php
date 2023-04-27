<?php
require_once "databasereg.php"; // Asegúrate de incluir el archivo de configuración de la base de datos

$pdo = Database::connect();
$query = 'SELECT * FROM alumno_tabla';
$options = array();

foreach ($pdo->query($query) as $row) {
    $options[] = array(
        'username' => $row['username'],
        'nombre' => $row['nombre']
    );
}

Database::disconnect();

echo json_encode($options);
?>
