<?php
require '../databasereg.php';

$pdo = Database::connect();



for ($id_area = 1; $id_area <= 4; $id_area++) {
    $stmt_proyectos = $pdo->prepare("SELECT * FROM proyecto WHERE id_AreaEstr = :id_area");
    $stmt_proyectos->bindParam(':id_area', $id_area);
    $stmt_proyectos->execute();
    $proyectos = $stmt_proyectos->fetchAll(PDO::FETCH_ASSOC);

    $stmt_jueces = $pdo->prepare("SELECT * FROM jueces_totales WHERE id_area = :id_area AND matricula NOT IN (SELECT id_profesor FROM proyecto WHERE id_proy = :id_proyecto) 
    AND id_area = (SELECT id_area FROM proyecto WHERE id_proy = :id_proyecto) ORDER BY RAND() LIMIT 3");

    $stmt_insertar = $pdo->prepare("
    INSERT INTO asigna_juez (id_proy, id_juez1, id_juez2, id_juez3) 
    VALUES (:id_proyecto, :juez_1, :juez_2, :juez_3)
    ON DUPLICATE KEY UPDATE 
    id_juez1 = VALUES(id_juez1), 
    id_juez2 = VALUES(id_juez2), 
    id_juez3 = VALUES(id_juez3)
");


    foreach ($proyectos as $proyecto) {
        $stmt_jueces->bindParam(':id_area', $proyecto['id_AreaEstr']);
        $stmt_jueces->bindParam(':id_proyecto', $proyecto['id_proy']);
        $stmt_jueces->execute();
        $jueces = $stmt_jueces->fetchAll(PDO::FETCH_ASSOC);

        // Obtener un conjunto aleatorio de jueces
        $jueces_asignados = array_rand($jueces, 3);

        // Insertar los datos en la tabla de proyectos
        $stmt_insertar->bindParam(':id_proyecto', $proyecto['id_proy']);
        $stmt_insertar->bindParam(':juez_1', $jueces[$jueces_asignados[0]]['matricula']);
        $stmt_insertar->bindParam(':juez_2', $jueces[$jueces_asignados[1]]['matricula']);
        $stmt_insertar->bindParam(':juez_3', $jueces[$jueces_asignados[2]]['matricula']);
        $stmt_insertar->execute();
    }
}



Database::disconnect();
