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
    <title> Anmeldungen verwalten | Admin | DRK Sommercamp </title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico" id="favicon">
    <link rel="stylesheet" href="CSS/admin.css">
</head>
<body>
    <?php
        require("files/nav.html");
    ?>
    <div class="content">
        <div class="message">
        </div>
        <h1>Anmeldungen verwalten</h1>
        <?php
            if(!isset($_GET['type'])){
                if(!isset($_GET['id'])){
                    switch($urechte){
                        case 1:
                            require "files/avw1.php";
                            break;
                        case 2:
                            require "files/avw2.php";
                            break;
                        case 3:
                            require "files/avw3.php";
                            break;
                    }
                }
                else{
                    switch($urechte){
                        case 1:
                        case 2:
                            header("Location:verwalten.php");
                            break;
                        case 3:
                            require "files/avweod.php";
                            break;
                    }
                }
            }
            else{
                switch($urechte){
                    case 1:
                    case 2:
                        header("Location:verwalten.php");
                        break;
                    case 3:
                        require "files/avwprepare.php";
                        break;
                }
            }
            
        ?>
    </div>    
</body>
</html>