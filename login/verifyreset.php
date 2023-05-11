<?php
require_once "../databasereg.php";


if (isset($_POST['verification_code'])) {
    $verification_code = $_POST['verification_code'];
    $pdo = Database::connect();
    $sql = "UPDATE alumnos SET contraseña= WHERE resetpassword=?";
    $q = $pdo->prepare($sql);
    $q->execute(array($verification_code));

    Database::disconnect();

    exit('success');
} else {
    exit('error');
}

?>

<!DOCTYPE html>