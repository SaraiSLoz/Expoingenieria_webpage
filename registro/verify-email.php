<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "conectar2.php";

require_once "../PHPMailer-master/src/Exception.php";
require_once "../PHPMailer-master/src/PHPMailer.php";
require_once "../PHPMailer-master/src/SMTP.php";



function enviarCorreoVerificacion($email, $verification_code)
{
    $smtp_host = 'smtp.office365.com';
    $smtp_port = 587;
    $smtp_username = 'expo.ingenieria.tester@outlook.com';
    $smtp_password = 'Rafa12345678';

    $pdo = Database::connect();
    $sql = "SELECT nombre FROM alumnos WHERE email=?";
    $q = $pdo->prepare($sql);
    $q->execute(array($email));
    $result = $q->fetch(PDO::FETCH_ASSOC);
    $nombre = $result['nombre'];

    $subject = "Verificación de correo electrónico";
    $message = "Hola $nombre,\n\nHaga clic en el siguiente enlace para verificar su dirección de correo electrónico: http://ing.pue.itesm.mx/TC2005B_403_3/expoingenierias/registro/verify-email.php?token=$verification_code";


    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPDebug = 0; // Puedes activar esta opción para depurar el envío de correos electrónicos
    $mail->Host = $smtp_host;
    $mail->Port = $smtp_port;
    $mail->SMTPSecure = 'tls'; // Configura STARTTLS
    $mail->SMTPAuth = true;
    $mail->Username = $smtp_username;
    $mail->Password = $smtp_password;
    $mail->setFrom('expo.ingenieria.tester@outlook.com', 'Rafa'); // Configura el remitente
    $mail->addAddress($email, $nombre); // Configura el destinatario
    $mail->Subject = $subject;
    $mail->Body = $message;

    /*if ($mail->send()) {
        echo 'El correo electrónico ha sido enviado exitosamente.';
    } else {
        echo 'Ocurrió un error al enviar el correo electrónico: ' . $mail->ErrorInfo;
    }*/

    Database::disconnect();
}

?>




<script>
    window.onload = function() {
        var verification_code = '<?php echo $_GET["token"]; ?>';
        if (verification_code) {
            // Hacer una petición a tu archivo PHP para verificar el código
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'verify.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    // Verificación exitosa, muestra un mensaje o redirige a una página
                    alert('¡Tu correo electrónico ha sido verificado!');
                }
            };
            xhr.send('verification_code=' + verification_code);
        }
    }
</script>