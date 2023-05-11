$sql1 = 'SELECT AVG(calificacion)*2.5 as promedio_calif
FROM calificacion
WHERE id_proyecto = ?
HAVING COUNT(DISTINCT id_juez) = 3';
$q = $pdo->prepare($sql1);
$q->execute(array($id));
$promedio_calif = $q->fetchColumn();

if ($promedio_calif != 0) {
$cambio_status = 5;
$sql2 = 'UPDATE proyecto SET id_status = ? WHERE id_proy = ?';
$q2 = $pdo->prepare($sql2);
$q2->execute(array($cambio_status, $id));
}

$sql0 = 'UPDATE proyecto SET calificacion = ? WHERE id_proy = ?';
$q0 = $pdo->prepare($sql0);
$q0->execute(array($promedio_calif, $id));
$sql3 = "SELECT status.nombre as status1
FROM proyecto
INNER JOIN status ON proyecto.id_status = status.id
WHERE id_proy = ?";
$q = $pdo->prepare($sql3);
$q->execute(array($id));
$data = $q->fetch(PDO::FETCH_ASSOC);
}
?>