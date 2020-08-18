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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="files/avwmessagebox.js" defer></script>
</head>
<body>
    <?php
        require("files/nav.html");
    ?>
    <div class="content">
        <?php
            if(isset($_GET['message'])){
                if($_GET['message'] == "succsess"){
                    echo '<div class="message" id="messagebox" style="background-color: #4CAF50; margin-left: 0">Anmeldung erfolgreich hinzugefügt!"</div>';
                }
                else{
                    echo '<div class="message" id="messagebox" style="background-color: #f44336; margin-left: 0">Fehler bei der Kommunikation mit der Datenbank!</div>';
                }
            }
        ?>
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