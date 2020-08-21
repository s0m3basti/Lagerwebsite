<?php
    $to = $email;
    $betreff = "Dein Admin-Account wurde angelegt";
    $from = "From: DRK Sommercamp <no-reply@drksommercamp.de>\n";
    $from .= "Reply-To: anmeldung@drksommercamp.de\n";
    $from .= "Content-Type: text/html\n";
    $text = "
    <img src=\"http://www.lagertest.de/img/logo.png\" style=\"float: right; margin-top: 1%; margin-right: 5%; width: 15%;\";>
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
    <p style=\"font-family: Arial; font-size: 14pt\">Mit freundlichen Grü&szligen ihr DRK Sommercamp Team
        <br>
    </p>
    <hr>
    </html> 
    ";
    mail($to,$betreff,$text,$from);
?>