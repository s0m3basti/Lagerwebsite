<?php
    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Load Composer's autoloader
    require '../../files/phpmailer/vendor/autoload.php';

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {

        $mail->SMTPDebug = SMTP::DEBUG_OFF;                         // Disable Debugg
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = $mail_host;                             // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = $mail_u;                                // SMTP username
        $mail->Password   = $mail_pw;                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = $mail_port;                             // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('no-reply@drk-sommercamp.de', 'DRK Sommercamp');        // Add a from-Adresse 
        $mail->addAddress($anmeldungmail);                                      // Add a recipient
        $mail->addReplyTo($anmeldungmail, 'Anmeldung @ DRK Sommercamp');        // Add a reply-Adress

        // Content
        $mail->isHTML(true);                                                    // set HTML
        $mail->CharSet = 'UTF-8';                                               // set UTF8  
        $mail->Subject = 'Neu Anmeldung für '.$k_vorname.' '.$k_nachname.'!';   // set subject
        $mail->Body    = "
        <h1 style=\"font-family: Arial; font-size: 18pt; text-decoration: underline; font-weight: bold;\">Neue Anmeldung eingegangen </h1>
        <table style=\"width: 50%; font-family: Arial; font-size: 14pt;\">
            <tr><td colspan=\"2\"><h2 style=\"font-size: 16pt; text-decoration: underline; font-weight: bold;\">Angaben zum Kind</h2></td></tr>
            <tr><td><b>Vorname des Kindes:</b></td> <td>$k_vorname</td></tr>
            <tr><td><b>Nachname des Kindes:</b></td><td>$k_nachname</td></tr>
            <tr><td><b>Geschlecht:</b></td><td>$k_geschlecht</td></tr>
            <tr><td><b>Geburtsdatum:</b></td><td>$k_geburtstag</td></tr>
            <tr><td colspan=\"2\"><hr></td></tr>
            <tr><td colspan=\"2\"><h2 style=\"font-size: 16pt; text-decoration: underline; font-weight: bold;\">Angaben zum Sorgeberechtigten:</h2></td></tr>
            <tr><td><b>Vorname:</b></td><td>$e_vorname</td></tr>
            <tr><td><b>Nachname:</b></td><td>$e_nachname</td></tr>
            <tr><td><b>Straße und Hausnummer:</b></td><td>$e_straße</td></tr>
            <tr><td><b>Postleitzahl:</b></td><td>$e_plz</td></tr>
            <tr><td><b>Ort:</b></td><td>$e_ort</td></tr>
            <tr><td><b>Tel. (privat):</b></td><td>$e_telpriv</td></tr>
            <tr><td><b>Tel. (mobil):</b></b></td><td>$e_telhandy</td></tr>
            <tr><td><b>Tel. (dienstlich):</b></td><td>$e_teldienstl</td></tr>
            <tr><td><b>E-Mail-Adresse:</b></td><td>$e_email</td></tr>
            <tr><td><b>Mitglied:</b></td><td>$mitglied</td></tr>
            <tr><td><b>Mitarbeiter:</b></td><td>$mitarbeiter</td></tr>
            <tr><td colspan=\"2\"><hr></td></tr>
            <tr><td colspan=\"2\"><h2 style=\"font-size: 16pt; text-decoration: underline; font-weight: bold;\">Angaben für den Betreuer </h2></td></tr>
            <tr><td><b>Schwimmer:</b></td><td>$schwimmer</td></tr>
            <tr><td><b>Schwimmstufe:</b></td><td>$stufe</td</tr>
            <tr><td><b>Badeerlaubnis:</b></td><td>$baden</td></tr>
            <tr><td><b>Springen ins Wasser:</b></td><td>$springen</td></tr>
            <tr><td><b>Spezielle Ernährung:</b></td><td>$ernaehrung</td></tr>
            <tr><td><b>Krankheiten:</b></td><td>$krankheit</td></tr>
            <tr><td><b>Medikamente:</b></td><td>$medikamente</td></tr>
            <tr><td><b>Taschengeldbetreuung:</b></td><td>$taschengeld</td></tr>
            <tr><td><b>Krankenversicherung (Art):</b></td><td>$kv_art</td></tr>
            <tr><td><b>Krankenversicherung:</b></td><td>$versicherung</td></tr>
            <tr><td><b>Beförderung in privatem KFZ:</b></td><td>$kfz</td></tr>
            <tr><td><b>Ratenzahlung:</b></td><td>$raten</td></tr>
            <tr><td><b>Ratenanzahl:</b></td><td>$raten_anzahl</td></tr>
            <tr><td><b>Tshirts:</b></td><td>$shirt</td></tr>
            <tr><td><b>Shirt-Anzahl:</b></td><td>$shirtanz</td></tr>
            <tr><td><b>Shirt-Gr&ouml&szlige:</b></td><td>$shirtgr</td></tr>
            <tr><td colspan=\"2\"><hr></td></tr>
            <tr><td colspan=\"2\"><h2 style=\"font-size: 12pt; text-decoration: underline; font-weight: bold;\">Informationen zur Anmeldung</h2></td></tr>
            <tr style=\"font-size: 12pt;\"><td>IP-Adresse</td><td>$ip_adresse</td></tr>
            <tr style=\"font-size: 12pt;\"><td>Datum</td><td>$datum</td></tr>
        </table>
        ";
    $mail->send();
    //echo 'Message has been sent';
    $mail_send_us = true;
    } catch (Exception $e) {
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    $mail_send_us = false;
    }
?>