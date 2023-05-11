<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require_once "../PHPMailer-master/src/Exception.php";
require_once "../PHPMailer-master/src/PHPMailer.php";
require_once "../PHPMailer-master/src/SMTP.php";



function enviarCorreoReset($email)
{
    $pdo = Database::connect();
    $verification_code = md5(uniqid());

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "
          SELECT nombre FROM (
              SELECT email FROM alumnos
              UNION
              SELECT email FROM jueces
              UNION
              SELECT email FROM profesores
          ) AS usuarios WHERE email = :u
      ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':u', $email);
    $stmt->execute();
    $nombre = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $smtp_host = 'smtp.office365.com';
    $smtp_port = 587;
    $smtp_username = 'expo.ingenieria@outlook.com';
    $smtp_password = '!Yyt*sWxz7t-*NQNp_d@Tx@cyK-xcvvNkTr6-WoH*wMc6NNE-k6EZFrs3.YAYUXz_frqhjT7@hQTfot-mDM2Y_4gufM7e4oGiEsL';


    $subject = "Cambia tu Contraseña";
    $message = "Hola $nombre,\n\nHaga clic en el siguiente enlace para actualizar su contraseña: http://localhost/expoingenierias/login/verify-resetpass.php?token=$verification_code";


    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPDebug = 0; // Puedes activar esta opción para depurar el envío de correos electrónicos
    $mail->Host = $smtp_host;
    $mail->Port = $smtp_port;
    $mail->SMTPSecure = 'tls'; // Configura STARTTLS
    $mail->SMTPAuth = true;
    $mail->Username = $smtp_username;
    $mail->Password = $smtp_password;
    $mail->setFrom('expo.ingenieria@outlook.com', 'Rafa'); // Configura el remitente
    $mail->addAddress($email, $nombre); // Configura el destinatario
    $mail->Subject = $subject;
    $mail->Body = $message;


    Database::disconnect();
}

?>




<script>
    window.onload = function() {
        var verification_code = '<?php echo $_GET["token"]; ?>';


        <?php
        $pdo = Database::connect();
        $sql = "
            SELECT email FROM (
                SELECT email FROM alumnos
                UNION
                SELECT email FROM jueces
                UNION
                SELECT email FROM profesores
            ) AS usuarios WHERE  resetcontraseña = :code
            ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':u', $u);
        $stmt->bindParam(':code', $verification_code);
        $stmt->execute();
        $email = $stmt->fetchAll(PDO::FETCH_ASSOC);
        Database::disconnect();

        ?>


        if (verification_code) {
            // Hacer una petición a tu archivo PHP para verificar el código
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'contraseñanueva.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.send('verification_code=' + verification_code + 'email=' + '<?php echo $email ?>');

        }

    }
</script>