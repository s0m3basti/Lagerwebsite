<?php
// Session für Anmeldung starten, wenn nicht gesetzt redirect
session_start();
if(!isset($_SESSION['userid'])) {
    header("Location: ../login.php?er=1");
}
 
// Userdaten einlesen
$userid = $_SESSION['userid'];
$uvorname = $_SESSION['vorname'];
$unachname = $_SESSION['nachname'];
$umail = $_SESSION['mail'];
$urechte = $_SESSION['rechte'];

// alle benötigten files laden
require '../files/linkmaker.php';
require '../files/datenzugriff.php';

//Daten umwandeln damit das HTML sie interpretieren kann
$anfang=strtotime($anfang);
$anfang=date('Y-m-d',$anfang);
$ende=strtotime($ende);
$ende=date('Y-m-d',$ende);
$jahr=intval($jahr);
$preis=intval($preis);
$shirtpreis=intval($shirtpreis);
$frühbucher=intval($frühbucher);
$frühbis=date('Y-m-d', strtotime($frühbis));
?>

<!DOCTYPE HTML>
<head>
    <title> Datenverwaltung | Admin | DRK Sommercamp </title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico" id="favicon">
    <link rel="stylesheet" href="CSS/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
        const urechte = <?php echo($urechte); ?>;
        const state = <?php if(isset($_GET['erfolg'])){echo($_GET['erfolg']);}else{echo(0);}?>;
    </script>
    <script src="files/datendisable.js" defer></script>
</head>
<body>
    <?php
        // Nav einfügen
        require("files/nav.html");
    ?>
    <div class="erfolg" id="erfolg">
        <?php
            // Messagebox
            if($_GET['erfolg'] == 1){
                echo("Daten erfolgreich geändert!");
            }
        ?>
    </div>
    <div class="daten">
       <h1>Daten der Seite bearbeiten</h1>
       <h2>Hier sieht man eine Auflistung aller dynamsichen Daten der Webseite, wenn sie hier geändert werden, werden sie überall auf der Webseite geändert.</h2>

       <form class="daten" id="form_daten" method="POST" action="files/datenändern.php">
        <table class="daten">
            <tr class="daten">
                <td class="daten_head" id="daten_left">Name des Datums</td>
                <td class="daten_head" id="daten_middle">Input-Feld</td>
                <td class="daten_head" id="daten_right">Formatierung</td>
            </tr>
            <tr class="daten">
                <td class="daten">Anfangsdatum des Lagers</td>
                <td class="daten"><input type="date" class="daten" id="anfang" name="anfang" value="<?php echo($anfang)?>"></td>
                <td class="daten">dd.mm.yyyy</td>
            </tr>
            <tr class="daten">
                <td class="daten">Enddatum des Lagers</td>
                <td class="daten"><input type="date" class="daten" id="ende" name="ende" value="<?php echo($ende)?>"></td>
                <td class="daten">dd.mm.yyyy</td>
            </tr>
            <tr class="daten">
                <td class="daten">Jahr in dem das Lager statt findet</td>
                <td class="daten"><input type="number" class="daten" id="jahr" name="jahr" value="<?php echo($jahr)?>" min="<?php echo(date('Y')-1)?>" max="<?php echo(date('Y')+1)?>"></td>
                <td class="daten">yyyy</td>
            </tr>
            <tr class="daten">
                <td class="daten">Grundpreis</td>
                <td class="daten"><input type="number" class="daten" id="preis" name="preis" value="<?php echo($preis)?>" min="250" max="1000"> </td>
                <td class="daten">xxx</td>
            </tr>
            <tr class="daten">
                <td class="daten">Tshirtpreis</td>
                <td class="daten"><input type="number" class="daten" id="shirtpreis" name="shirtpreis" value="<?php echo($shirtpreis)?>" min="0" max="50"></td>
                <td class="daten">xx</td>
            </tr>
            <tr class="daten">
                <td class="daten">Frühbucherpreis</td>
                <td class="daten"><input type="number" class="daten" id="frühbucher" name="frühbucher" value="<?php echo($frühbucher)?>" min="200" max="1000"></td>
                <td class="daten">xxx</td>
            </tr>
            <tr class="daten">
                <td class="daten">Datum für Frühbucherpreis (bis einschließlich)</td>
                <td class="daten"><input type="date" class="daten" id="frühbis" name="frühbis" value="<?php echo($frühbis)?>"></td>
                <td class="daten">dd.mm.yyyy</td>
            </tr>
            <tr class="daten">
                <td class="daten">Kontakt-Email-Adresse</td>
                <td class="daten"><input type="email" class="daten" id="kontaktmail" name="kontaktmail" value="<?php echo($kontaktmail)?>"></td>
                <td class="daten">abc@abc.de</td>
            </tr>
            <tr class="daten">
                <td class="daten">Anmeldungs-Email-Adresse</td>
                <td class="daten"><input type="email" class="daten" id="anmeldungmail" name="anmeldungmail" value="<?php echo($anmeldungmail)?>"></td>
                <td class="daten">abc@abc.de</td>
            </tr>
            <tr class="daten">
                <td class="daten">Support-Email-Adresse</td>
                <td class="daten"><input type="email" class="daten" id="supportmail" name="supportmail" value="<?php echo($supportmail)?>"></td>
                <td class="daten">abc@abc.de</td>
            </tr>
        </table>
        <?php
            if($urechte >= 3){
                // Daten änderbar
                echo("
                    <div class=\"apply\">
                        Du darfst die Daten ändern, aber tu das mit bedacht. Es hat Webseitenumfassende auswirkungen. </br> 
                        <input type=\"submit\" id=\"submit\" class=\"datenbutton\" value=\"Änderungen übernehmen\"> </br>
                        Solltest du Änderungen gemacht haben ohne es zu wollen, verlasse einfach die Seite oder klicke hier. </br>
                        Solange nicht angezeigt wurde, das die Daten geändert wurden, wurden sie auch nicht geändert. </br>
                        <a href=\"index.php\"><button type=\"button\" id=\"nsubmit\" class=\"datenbutton\">Änderungen verwerfen</button></a> 

                    </div>
                ");
            }
            else{
                // Daten nicht änderbar
                echo("
                    <div class=\"apply\"> 
                        Du bist leider nicht in der Lage die Daten zu ändern. </br>
                        Falls du es seien sollte Kontaktiere mich bitte.
                    </div>
                ");
            }
        ?>
     </form>
     
    </div>
</body>
</html>