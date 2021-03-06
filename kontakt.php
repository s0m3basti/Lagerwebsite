<?php
    // cookie für Cookieabfrage setzten
    require "files/cookie_set.php";
?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <?php
            // alle benötigten files laden
            include 'files/linkmaker.php';
            include 'files/datenzugriff.php';
            
        ?>
		<title> Kontakt | DRK Sommercamp </title>
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="CSS/styles.css">
        <link rel="stylesheet" href="CSS/Kontakt.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	</head>
    
    <body>
        <?php
            // Header + Cookieabfrage einfügen
            include 'files/head.php';
            require 'files/cookie.php';
        ?>
        <div class="bg">
        <div id="Inhalt">
            <h1>Kontaktformular</h1><br>
            <p id="title">
                Sie können jederzeit mit uns Kontakt aufnehmen, dies ist über das untenstehende Kontaktformular möglich.<br>
                Sie können uns jedoch auch über <a href="https://www.facebook.com/DRK.Sommercamp/" target="_blank" class="old-link">Facebook</a> erreichen, dort ist eine Antwort in der Regel früher zu erwarten.
            </p> <br> <br>
                <form method="post" action="kontakt.php">
                <div class="zentrierte-tabelle">
                <table id="Kontakt">
                    <tr>
                        <td>Vorname:</td>
                        <td><input type="text" name="vorname" required></td>
                    </tr> 
                    <tr>
                        <td>Nachname:</td>
                        <td><input type="text" name="nachname" required></td>
                    </tr> 
                    <tr>
                        <td>Ihre E-Mail-Adresse:</td>
                        <td><input type="email" name="email" required></td>
                    </tr>
                    <tr>
                        <td>Ihre Nachricht:</td>
                        <td><textarea cols="50" rows="10" required name="nachricht"></textarea></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="&nbsp Absenden &nbsp" id="submit" name="submit">&nbsp&nbsp&nbsp&nbsp<input type="reset" value="&nbsp Eingabe zurücksetzen &nbsp"></td>
                    </tr>
                    <tr>
                        <?php
                            // wenn abgesendet, dann mail an kontaktmail mit eingegebenen Daten
                            if(isset($_POST['submit'])){
                                mail("$kontaktmail","Kontaktanfrage auf Sommercamp.de","Eine Anfrage von ".$_POST['vorname']." ".$_POST['nachname']." mit dem Inhalt: \n\n ".$_POST['nachricht'].".","From: Server<".$_POST['email'].">");
                            echo "E-Mail wurde gesendet";
                            }
                        ?>
                    </tr>  
                </table>
                </div>
            </form>
            <br><br>
            <p class="disclaimer">
                Während des Lagers ist eine Kontaktaufnahme via Telefon selbstverständlich möglich. Jedoch können wir leider keine ganzjährigen Auskünfte via Telefon ermöglichen. Wir bitten um ihr Verständnis.   
            </p>
        </div>
        </div> 
         <?php
            // Footer einfügen 
            include 'files/footer.php';
         ?>
    </body>
</html>