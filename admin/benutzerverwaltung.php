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
    <title> Benutzerverwaltung | Admin | DRK Sommercamp </title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico" id="favicon">
    <link rel="stylesheet" href="CSS/admin.css">
    <script>
        const message = <?php if(isset($_GET['message'])){echo($_GET['message']);}else{echo(0);}?>;
    </script>
    <script src="files/bnvmessagebox.js" defer></script>
</head>
<body>
    <?php
        // Nav einfügen
        require("files/nav.html");
    ?>
    <?php
        // hier noch seperate Ansichten in einzelnen Dokumenten
        if(!isset($_GET['new'])){
            // wenn noch keine Art gesetzt wurde dann Tabelle anzeigen
            switch($urechte){
                case 1:
                    include 'files/bnv1.php';
                    break;
                case 2:
                    include 'files/bnv2.php';
                    break;
                case 3:
                    include 'files/bnv3.php';
                    break;
            }
        }
        else{
            // übergeben werte an die speziellen funktionen
            if(isset($_GET['new']) && isset($_GET['id'])){
                include 'files/bnvedit.php';
            }
            else{
                include 'files/bnvnew.php';
            }
        }
    ?>    
</body>
</html>