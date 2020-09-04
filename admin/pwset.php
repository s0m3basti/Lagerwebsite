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

// Maske zum eingeben eines neuen Passworts
// redirect auf Benutzerverwaltung senden
?>

<!DOCTYPE HTML>
<head>
    <title> Passwort festlegen | Admin | DRK Sommercamp </title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico" id="favicon">
    <link rel="stylesheet" href="CSS/admin.css">
</head>
<body>
    <div class="pwset">
        <h1>Passwort festlegen</h1>
        <h2>Hallo <?php echo $uvorname." ".$unachname;?>, lege bitte im unteren Feld dein Passwort fest.</h2>

        <form method="POST" action="files/bnvsenden.php?new=3">
            <table class="bnv">
                <tr><td><label>Passwort:</label></td><td><input type="password" name="password1" class="bnv" required></td></tr>
                <tr><td><label>Passwort (wiederholen):</label></td><td><input type="password" name="password2" class="bnv" required></td></tr>
                <tr style="text-align:center;"><td colspan="2"><input type="submit" value="Passwort setzten" class="bnv"></td></tr>
            </table>
        </form>
    </div>
</body>
</html>