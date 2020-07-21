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

require "../files/linkmaker.php";
require "../files/datenzugriff.php";

switch($status){
    case "anmeldung":
        $status = 1;
        break;
    case "voranmeldung":
        $status = 2;
        break;
    case "keine_anmeldung":
        $status = 3;
        break;
}



?>

<!DOCTYPE HTML>
<head>
    <title> Übersicht | Admin | DRK Sommercamp </title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico" id="favicon">
    <link rel="stylesheet" href="CSS/admin.css">
    <script>
        const status = <?php echo $status ?>
    </script>
    <script src="files/indexstatus.js" defer></script>
</head>
<body>
    <?php
        require("files/nav.html");
    ?>
    <div class="content">
        <!--<div class="userdaten">
            <p>Hallo <?php echo ($uvorname." ".$unachname) ?></p>
        </div>-->
        <h1>Übersicht</h1>
        <h2>Hier siehst du den Momentanen stand der Anmeldung.</h2>
        <div class="status" id="div_status">
            Hier steht der Status des Momentanen standes
        </div>

        <div>
            <!-- Tabelle mit den Stammdaten goes here -->
        </div>
    </div>
</body>
</html>