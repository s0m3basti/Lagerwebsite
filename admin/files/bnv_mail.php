<?php
    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Load Composer's autoloader
    require '../../files/phpmailer/vendor/autoload.php';
    require '../../Datenbank/mail.php';

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {

        $mail->SMTPDebug = SMTP::DEBUG_OFF;                         // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = $mail_host;                       // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = $mail_u;                  // SMTP username
        $mail->Password   = $mail_pw;                          // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = $mail_port;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('no-replay@drk-sommercamp.de', 'DRK Sommercamp');
        $mail->addAddress($email);                          // Add a recipient
        $mail->addReplyTo($supportmail, 'Support @ DRK Sommercamp');

        // Content
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';                                  
        $mail->Subject = 'Dein Admin-Account wurde angelegt';
        $mail->Body    = "
            <img src=\"".linkmaker("/img/logo.png")."\" style=\"float: right; margin-top: 1%; margin-right: 5%; width: 15%;\";>
            <h1 style=\"font-family: Arial; font-size: 18pt; text-decoration: underline; font-weight: bold;\">Dein Admin-Account wurde angelegt</h1>
            <p style=\"font-family: Arial; font-size: 14pt\">
                Hallo $vorname,
                <br>Dein Account wurde soeben angelegt. Die Anmeldedaten lauten:
                <br>
                <br>Benutzername: $username
                <br>Passwort: $passwort1
                <br>
                <br>Bei deiner ersten Anmeldung wirst du aufgefordert das Passwort zu ändern.
            </p>
            <p style=\"font-family: Arial; font-size: 14pt\">Mit freundlichen Grü&szligen 
                <br>Dein DRK Sommercamp Team
                <br>
            </p>
            <hr>
            </html> 
            ";
    $mail->send();
    //echo 'Message has been sent';
    } catch (Exception $e) {
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
?>
