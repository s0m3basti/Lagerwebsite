<?php
session_start();
if(!isset($_SESSION['userid'])) {
    header("Location: ../login.php?er=1");
}
 
//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['userid'];
 
echo "Hallo User: ".$userid;
?>

<!DOCTYPE HTML>
<head>
    <title> Übersicht | Admin | DRK Sommercamp </title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico" id="favicon">
    <link rel="stylesheet" href="CSS/admin.css">
</head>
<body>
    <?php
        require("files/nav.html");
    ?>
    <div>
        <!-- Name des Angemeldeten goes here -->
    </div>

    <div>
        <!-- Statud der Anmeldung goes here -->
    </div>

    <div>
        <!-- Tabelle mit den Stammdaten goes here -->
    </div>
</body>
</html>