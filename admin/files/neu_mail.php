<?php
    $to = $email;
    $betreff = "Bestätigung des Anmeldungseingangs für das DRK Sommercamp $jahr";
    $from = "From: DRK Sommercamp <no-reply@drksommercamp.de>\n";
    $from .= "Reply-To: anmeldung@drksommercamp.de\n";
    $from .= "Content-Type: text/html\n";
    $text = "
    <img src=\"http://www.lagertest.de/img/logo.png\" style=\"float: right; margin-top: 1%; margin-right: 5%; width: 15%;\";>
    <h1 style=\"font-family: Arial; font-size: 18pt; text-decoration: underline; font-weight: bold;\">Anmeldung zum DRK Sommercamp $jahr </h1>
    <p style=\"font-family: Arial; font-size: 14pt\">Hiermit bestätigen wir ihnen den Erhalt der Anmeldung für das DRK Sommercamp $jahr.
        <br>Die Anmeldung ist jetzt in unserem System hinterlegt.
        <br>Sie erhalten von uns zusätzlich eine schriftliche Anmeldebestätigung via Post.
        <br>Hier können sie noch einmal ihre Angaben einsehen. 
        <br>Sollten sie einen Fehler finden, wenden sie sich bitte an: <a href=\"mailto:$kontaktmail\">$kontaktmail</a>.
    </p>
    <p style=\"font-family: Arial; font-size: 14pt\">Mit freundlichen Grü&szligen ihr DRK Sommercamp Team
        <br>
    </p>
    <hr>
    <table style=\"width: 50%; font-family: Arial; font-size: 14pt;\">
        <tr><td colspan=\"2\"><h2 style=\"font-size: 16pt; text-decoration: underline; font-weight: bold;\">Angaben zum Kind</h2></td></tr>
        <tr><td><b>Vorname des Kindes:</b></td> <td>$k_vorname</td></tr>
        <tr><td><b>Nachname des Kindes:</b></td><td>$k_nachname</td></tr>
        <tr><td><b>Geschlecht:</b></td><td>$geschlecht</td></tr>
        <tr><td><b>Geburtsdatum:</b></td><td>$gebdatum</td></tr>
        <tr><td colspan=\"2\"><hr></td></tr>
        <tr><td colspan=\"2\"><h2 style=\"font-size: 16pt; text-decoration: underline; font-weight: bold;\">Angaben zum Sorgeberechtigten:</h2></td></tr>
        <tr><td><b>Vorname:</b></td><td>$e_vorname</td></tr>
        <tr><td><b>Nachname:</b></td><td>$e_nachname</td></tr>
        <tr><td><b>Straße und Hausnummer:</b></td><td>$strasse</td></tr>
        <tr><td><b>Postleitzahl:</b></td><td>$plz</td></tr>
        <tr><td><b>Ort:</b></td><td>$ort</td></tr>
        <tr><td><b>Tel. (privat):</b></td><td>$tel_pri</td></tr>
        <tr><td><b>Tel. (mobil):</b></b></td><td>$tel_handy</td></tr>
        <tr><td><b>Tel. (dienstlich):</b></td><td>$tel_dienstl</td></tr>
        <tr><td><b>E-Mail-Adresse:</b></td><td>$email</td></tr>
        <tr><td><b>Mitglied:</b></td><td>$mitglied</td></tr>
        <tr><td><b>Mitarbeiter:</b></td><td>$mitarbeiter</td></tr>
        <tr><td colspan=\"2\"><hr></td></tr>
        <tr><td colspan=\"2\"><h2 style=\"font-size: 16pt; text-decoration: underline; font-weight: bold;\">Angaben für den Betreuer </h2></td></tr>
        <tr><td><b>Schwimmer:</b></td><td>$schwimmer</td></tr>
        <tr><td><b>Schwimmstufe:</b></td><td>$schwimmstufe</td</tr>
        <tr><td><b>Badeerlaubnis:</b></td><td>$badeerlaubnis</td></tr>
        <tr><td><b>Springen ins Wasser:</b></td><td>$springen</td></tr>
        <tr><td><b>Spezielle Er&aumlhrung:</b></td><td>$ernaehrung</td></tr>
        <tr><td><b>Krankheiten:</b></td><td>$krankheit</td></tr>
        <tr><td><b>Medikamente:</b></td><td>$medikamente</td></tr>
        <tr><td><b>Taschengeldbetreuung:</b></td><td>$taschengeld</td></tr>
        <tr><td><b>Krankenversicherung (Art):</b></td><td>$kv_art</td></tr>
        <tr><td><b>Krankenversicherung:</b></td><td>$kv_name</td></tr>
        <tr><td><b>Bef&oumlrderung in privatem KFZ:</b></td><td>$kfz</td></tr>
        <tr><td><b>Ratenzahlung:</b></td><td>$raten</td></tr>
        <tr><td><b>Ratenanzahl:</b></td><td>$ratenanzahl</td></tr>
        <tr><td><b>Tshirts:</b></td><td>$shirts</td></tr>
        <tr><td><b>Shirt-Anzahl:</b></td><td>$shirts_anzahl</td></tr>
        <tr><td><b>Shirt-Gr&ouml&szlige:</b></td><td>$shirts_groesse</td></tr>
    </table>
    <hr> 
    </html> 
    ";
    mail($to,$betreff,$text,$from);
?>