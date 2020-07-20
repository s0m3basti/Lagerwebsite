<?php
session_start();
if(!isset($_SESSION['userid'])) {
    header("Location: ../login.php?er=1");
}
 
//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['userid'];
$uvorname = $_SESSION['vorname'];
$unachname = $_SESSION['nachname'];
$umail = $_SESSION['mail'];
$urechte = $_SESSION['rechte'];

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
</head>
<body>
    <?php
        require("files/nav.html");
    ?>
    <!--
    <div class="userdaten">
        <p>Hallo <?php echo ($uvorname." ".$unachname) ?></p>
    </div>
    -->
    <?php

        if(!isset($_GET['new'])){
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
            if(isset($_GET['new']) && isset($_GET['id'])){
                echo "Hier werden bestehende Konten bearbeitet";
                include 'files/bnvedit.php';
            }
            else{
                echo "Hier werden neue Konten erstellt";
                include 'files/bnvnew.php';
            }
        }
    ?>    
</body>
</html>