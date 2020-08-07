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
    <title> Status der Anmeldung ändern | Admin | DRK Sommercamp </title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico" id="favicon">
    <link rel="stylesheet" href="CSS/admin.css">
</head>
<body>
    <?php
        require("files/nav.html");
    ?>
    <div class="content">
        <?php
            if(isset($_GET['message'])){
                if($_GET['message'] == "succsess"){
                    echo '<div class="message" id="messagebox" style="background-color: #4CAF50; margin-left: 0">Die Aktion war erfolgreich!</div>';
                }
                else{
                    echo '<div class="message" id="messagebox" style="background-color: #f44336; margin-left: 0">Die Aktion war nicht erfolgreich!</div>';
                }
            }
        ?>
        <h1>Status der Anmeldung ändern</h1>
        <p> Der übliche Verlauf besteht aus 3 Schritten, der Vornamledung, der Anmeldung und einer deaktivierten Phase. 
            <br> Die Anmeldung kann zusätzlich in jeder Phase deaktiviert werden, bevor die Anmeldung aktiviert wird, muss es eine Voranmeldung geben.
        </p>
        <?php
            switch($urechte){
                case 1:
                case 2:
                    echo "Du bist leider nicht in der Lage den Status der Anmeldung zu ändern. <br> Sollte das so sein, wende dich bitte an $supportmail";
                    break;
                case 3:
                    require "files/statusändern.php";
                    break;
            }
        ?>
    </div>    
</body>
</html>