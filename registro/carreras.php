<?php
require_once "../databasereg.php"; 

$pdo = Database::connect();
$query = 'SELECT * FROM carrera';

$options = array();
foreach ($pdo->query($query) as $row) {
    $options[] = array(
        'id' => $row['id'],
        'nombre' => $row['nombre']
    );
}

Database::disconnect();

echo json_encode($options);
