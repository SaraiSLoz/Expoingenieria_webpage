<?php
require_once "../databasereg.php";

if (isset($_POST['verification_code'])) {
    $verification_code = $_POST['verification_code'];
    $pdo = Database::connect();
    $pdo->beginTransaction();
    try {
        // Actualizar la tabla alumnos
        $sql_alumnos = "UPDATE alumnos SET codigo_verificacion = :codigo_verificacion WHERE codigo_verificacion = :verification_code";
        $stmt_alumnos = $pdo->prepare($sql_alumnos);
        $stmt_alumnos->bindParam(':codigo_verificacion', $verification_code);
        $stmt_alumnos->bindParam(':verification_code', $verification_code);
        $stmt_alumnos->execute();

        // Actualizar la tabla jueces
        $sql_jueces = "UPDATE jueces SET codigo_verificacion = :codigo_verificacion WHERE codigo_verificacion = :verification_code";
        $stmt_jueces = $pdo->prepare($sql_jueces);
        $stmt_jueces->bindParam(':codigo_verificacion', $verification_code);
        $stmt_jueces->bindParam(':verification_code', $verification_code);
        $stmt_jueces->execute();

        // Actualizar la tabla profesores
        $sql_profesores = "UPDATE profesores SET codigo_verificacion = :codigo_verificacion WHERE codigo_verificacion = :verification_code";
        $stmt_profesores = $pdo->prepare($sql_profesores);
        $stmt_profesores->bindParam(':codigo_verificacion', $verification_code);
        $stmt_profesores->bindParam(':verification_code', $verification_code);
        $stmt_profesores->execute();

        $pdo->commit();
        exit('success');
    } catch (Exception $e) {
        $pdo->rollBack();
        exit('error');
    }
} else {
    exit('error');
}

?>

<!DOCTYPE html>


<?php /*
require_once "conectar2.php";


if (isset($_POST['verification_code'])) {
    $verification_code = $_POST['verification_code'];
    $pdo = Database::connect();
    $sql = "UPDATE alumnos SET estado_ver=1 WHERE codigo_verificacion=?";
    $q = $pdo->prepare($sql);
    $q->execute(array($verification_code));

    Database::disconnect();

    exit('success');
} else {
    exit('error');
}
*/
?>

<!DOCTYPE html>