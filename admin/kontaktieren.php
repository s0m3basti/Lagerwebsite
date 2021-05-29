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
require '../Datenbank/writer.php';

?>

<!DOCTYPE HTML>
<head>
    <title> Teilnehmer kontaktieren | Admin | DRK Sommercamp </title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico" id="favicon">
    <link rel="stylesheet" href="CSS/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php
        // Nav einfügen
        require("files/nav.html");
    ?>
    <div class="content">
        <h1>Teilnehmer kontaktieren</h1>
        <?php
            // Ausgabe anhand der Userrechte
            switch($urechte){
                // Nur Sufe 3 User Teilnehmer kontaktieren
                case 1:
                case 2:
                    echo "Du kannst leider keine Teilnehmer kontaktieren. <br> Solltest du es können, wende dich bitte an $supportmail";
                    break;
                case 3:
                    echo '
                        <h2>Liste mit Kontaktdaten herunterladen</h2>
                        <form action="files/kontaktieren_doc.php">
                            <input type="submit" class="ausgabe" value="Übersicht ausgeben">
                        </form><br>
                        <p>Du kannst die csv-Datei, dann einfach in Excel importieren und damit arbeiten!</p>
                        <hr>
                        <p> Später soll man hier per Knopfdruck Teilnehmer informieren können!</p>
                    ';
                    break;
            }
        ?>
    </div>    
</body>
</html>