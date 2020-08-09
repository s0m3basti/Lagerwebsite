<?php
    $to = $row['email'];
    $betreff = "Die Anmeldung für das nächste DRK Sommercamp wurde aktiviert";
    $from = "From: DRK Sommercamp <no-reply@drksommercamp.de>\n";
    $from .= "Reply-To: kontakt@drksommercamp.de\n";
    $from .= "Content-Type: text/html\n";
    $text = "
    <img src=\"http://www.lagertest.de/img/logo.png\" style=\"float: right; margin-top: 1%; margin-right: 5%; width: 15%;\";>
    <h1 style=\"font-family: Arial; font-size: 18pt; text-decoration: underline; font-weight: bold;\">Anmeldung  für das nächjährige DRK Sommercamp wurde aktiviert </h1>
    <p style=\"font-family: Arial; font-size: 14pt\">
        Hiermit teilen wir ihnen mit, dass die Anmeldung für das nächjährige Sommercamp so eben freigeschalten wurde.
        <br> Sie können die Anmeldung jetzt auf unserer Webseite ausfüllen.
        <br> Den Link dazu finden sie hier <a href=\"www.lagertest.de/anmeldung\">Unsere Webseite </a>
        <br>
        <br>Sie erhalten diese E-Mail, da sie sich eine Benachrichtigung gewünscht haben. 
        <br>Ihre Daten wurde sofort nach senden dieser Mail gelöscht.
    </p>
    <p style=\"font-family: Arial; font-size: 14pt\">Mit freundlichen Grü&szligen ihr DRK Sommercamp Team
        <br>
    </p>
    </html> 
    ";
    mail($to,$betreff,$text,$from);
?>