<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "../databasereg.php";

require_once "../PHPMailer-master/src/Exception.php";
require_once "../PHPMailer-master/src/PHPMailer.php";
require_once "../PHPMailer-master/src/SMTP.php";


$smtp_host = 'smtp.office365.com';
$smtp_port = 587;
$smtp_username = 'expo.ingenieria@outlook.com';
$smtp_password = '!Yyt*sWxz7t-*NQNp_d@Tx@cyK-xcvvNkTr6-WoH*wMc6NNE-k6EZFrs3.YAYUXz_frqhjT7@hQTfot-mDM2Y_4gufM7e4oGiEsL';


$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Obtener información de los jueces asignados al proyecto
$sql2 = "SELECT DISTINCT id_juez
            FROM (
            SELECT id_juez1 AS id_juez FROM asigna_juez
            UNION
            SELECT id_juez2 AS id_juez FROM asigna_juez
            UNION
            SELECT id_juez3 AS id_juez FROM asigna_juez
            ) AS jueces
            WHERE id_juez IS NOT NULL;
            ";
$q2 = $pdo->query($sql2);
$result_jueces = $q2->fetchAll(PDO::FETCH_COLUMN);



// Enviar correo a cada juez asignado
foreach ($result_jueces as $id_juez) {
    $sql = "SELECT proyecto.titulo
            FROM proyecto 
            INNER JOIN asigna_juez ON proyecto.id_proy = asigna_juez.id_proy 
            WHERE asigna_juez.id_juez1 = :id_juez 
            OR asigna_juez.id_juez2 = :id_juez 
            OR asigna_juez.id_juez3 = :id_juez
            ";
    $q = $pdo->prepare($sql);
    $q->execute(array(':id_juez' => $id_juez));
    $result_proyecto = $q->fetchAll(PDO::FETCH_ASSOC);


    $sq0 = "SELECT matricula, tipo_juez FROM jueces_totales WHERE matricula=?";
    $q0 = $pdo->prepare($sq0);
    $q0->execute(array($id_juez));
    $result_juez_tipo = $q0->fetch(PDO::FETCH_ASSOC);

    if ($result_juez_tipo) {
        $matricula = $result_juez_tipo['matricula'];
        $tipo_juez = $result_juez_tipo['tipo_juez'];

        if ($tipo_juez == 'juez_interno') {
            $sql3 = "SELECT email FROM juez_interno WHERE matricula=?";
        } else {
            $sql3 = "SELECT email FROM jueces WHERE matricula=?";
        }
        $q3 = $pdo->prepare($sql3);
        $q3->execute(array($matricula));
        $result_juez_email = $q3->fetch(PDO::FETCH_ASSOC);

        if ($result_juez_email) {
            $email = $result_juez_email['email'];
            $proyectos = '';
            foreach ($result_proyecto as $proyecto) {
                $proyectos .= $proyecto['titulo'] . ', ';
            }
            $proyectos = rtrim($proyectos, ', ');

            // Enviar correo al juez
            $subject = "Asignación de proyectos para calificar";
            $message = "Estimado(a) juez(a),\n\nLe informamos que se le han asignado los siguientes proyectos para calificar:\n\n$proyectos\n\nPor favor, revise la lista de proyectos asignados en la plataforma.\n\nAtentamente,\nEl equipo organizador.";

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
        }
    }
}
Database::disconnect();


?>


<!DOCTYPE html>