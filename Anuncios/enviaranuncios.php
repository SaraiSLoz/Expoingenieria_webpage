<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('../databasereg.php');

require_once "../PHPMailer-master/src/Exception.php";
require_once "../PHPMailer-master/src/PHPMailer.php";
require_once "../PHPMailer-master/src/SMTP.php";

function enviarCorreoAnuncios($cont)
{
    $smtp_host = 'smtp.office365.com';
    $smtp_port = 587;
    $smtp_username = 'expo.ingenieria.tester@outlook.com';
    $smtp_password = 'Rafa12345678';


    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "
        SELECT email, nombre FROM (
            SELECT email, nombre FROM alumnos
            UNION
            SELECT email, nombre FROM jueces
            UNION
            SELECT email, nombre FROM profesores
        ) AS usuarios;
    ";
    $q = $pdo->query($sql);
    $resultado = $q->fetchAll(PDO::FETCH_ASSOC);

    Database::disconnect();




    // Enviar correo a cada juez asignado
    foreach ($resultado as $usuario) {
        $email = $usuario['email'];
        $nombre = $usuario['nombre'];

        // Enviar correo a usuario
        $subject = "Nuevo Anuncio - ExpoIngeniería";
        $message = "Estimado/a $nombre,\n\n$cont";

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = $smtp_host;
        $mail->Port = $smtp_port;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = $smtp_username;
        $mail->Password = $smtp_password;
        $mail->setFrom('expo.ingenieria.tester@outlook.com', 'Rafa');
        $mail->addAddress($email);
        $mail->Subject = $subject;
        $mail->Body = $message;

        if ($mail->send()) {
            echo 'El correo electrónico ha sido enviado exitosamente a ' . $email . '<br>';
        } else {
            echo 'Ocurrió un error al enviar el correo electrónico a ' . $email . ': ' . $mail->ErrorInfo . '<br>';
        }
    }

    Database::disconnect();
}



?>
<!DOCTYPE html>