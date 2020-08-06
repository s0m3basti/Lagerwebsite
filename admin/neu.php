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
    <title> Anmeldung hinzufügen | Admin | DRK Sommercamp </title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico" id="favicon">
    <link rel="stylesheet" href="CSS/admin.css">
</head>
<body>
    <?php
        require("files/nav.html");
    ?>
    <div class="content">
        <h1>Neue Anmeldung hinzufügen</h1>
        <?php
            switch($urechte){
                case 1:
                    echo "Du kannst leider keine neuen Anmeldungen ins System einfügen <br> Solltest du es können, wende dich bitte an $supportmail";
                    break;
                case 2:
                case 3:
                    require "files/neuform.php";
                    break;
                
            }
        ?>
    </div>    
</body>
</html>