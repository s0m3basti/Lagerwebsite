<?php
session_start();
if(!isset($_SESSION['userid'])) {
    header("Location: ../login.php?er=1");
}
 
//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['userid'];
?>

<!DOCTYPE HTML>
<head>
    <title> Datenverwaltung | Admin | DRK Sommercamp </title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" id="favicon">
    <link rel="stylesheet" href="CSS/admin.css">
</head>
<body>
    <?php
        require("files/nav.html");
    ?>
    <div class="userdaten">
        <p>Hallo <?php echo $userid ?></p>
    </div>
    <div class="daten">
       <h1>Daten der Seite bearbeiten</h1>
       <h2>Hier sieht man eine Auflistung aller dynamsichen Daten der Webseite, wenn sie hier geändert werden, werden sie überall auf der Webseite geändert.</h2>

        <table class="daten">
            <tr>
                <td>Name des Datums</td>
                <td>Input-Feld</td>
                <td>Formatierung</td>
            </tr>
        </table>
    </div>
</body>
</html>