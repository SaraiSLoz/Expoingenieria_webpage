<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "../databasereg.php";

require_once "../PHPMailer-master/src/Exception.php";
require_once "../PHPMailer-master/src/PHPMailer.php";
require_once "../PHPMailer-master/src/SMTP.php";

function enviarcomentarios_profe_alumno($email, $nombre, $comentario)
{
    $smtp_host = 'smtp.office365.com';
    $smtp_port = 587;
    $smtp_username = 'expo.ingenieria@outlook.com';
    $smtp_password = '!Yyt*sWxz7t-*NQNp_d@Tx@cyK-xcvvNkTr6-WoH*wMc6NNE-k6EZFrs3.YAYUXz_frqhjT7@hQTfot-mDM2Y_4gufM7e4oGiEsL';


    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // Enviar correo al alumno
    $subject = "Comentarios de tu Proyecto | Modificaciones Necesarias";
    $message = "Estimado(a) $nombre,\n\nLe informamos que se ha realizado la revisión de tu proyecto y este requiere de modificaciones:\n\n$comentario";


    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = $smtp_host;
    $mail->Port = $smtp_port;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = $smtp_username;
    $mail->Password = $smtp_password;
    $mail->setFrom('expo.ingenieria@outlook.com', 'Rafa');
    $mail->addAddress($email);
    $mail->Subject = $subject;
    $mail->Body = $message;

    if ($mail->send()) {
        echo 'El correo electrónico ha sido enviado exitosamente.';
    } else {
        echo 'Ocurrió un error al enviar el correo electrónico: ' . $mail->ErrorInfo;
    }

    Database::disconnect();
}

?>

<!DOCTYPE html>