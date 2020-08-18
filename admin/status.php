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
    <link rel="stylesheet" href="CSS/admin.css" !important>
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
                switch($_GET['message']){
                    case 1:
                        echo '<div class="message" id="messagebox" style="background-color: #f44336; margin-left: 0">Es ist ein Fehler aufgetreten. Der Status wurde nicht geändert.</div>';
                        break;
                    case 2:
                        echo '<div class="message" id="messagebox" style="background-color: #4CAF50; margin-left: 0">Der Status wurde geändert <br> Es wurden '.$_GET["mailcount"].' Mails versendet. <br> Die Datenbank wurde vorbereitet.</div>';
                        break;
                    case 3:
                        echo '<div class="message" id="messagebox" style="background-color: #f44336; margin-left: 0">Es gab ein Problem mit der Datenbank. Der Status wurde dennoch geändert.</div>';
                        break;
                    case 4: 
                        echo '<div class="message" id="messagebox" style="background-color: #4CAF50; margin-left: 0">Die Anmeldung wurde erfolgreich deaktiviert.</div>';
                        break;
                    case 5: 
                        echo '<div class="message" id="messagebox" style="background-color: #4CAF50; margin-left: 0">Die Voranmeldung wurde erfolgreich aktiviert.</div>';
                        break;
                    case 6: 
                        echo '<div class="message" id="messagebox" style="background-color: #4CAF50; margin-left: 0">Die Anmeldung wurde erfolgreich reaktiviert.</div>';
                        break;
                }
            }
        ?>
        <h1>Status der Anmeldung ändern</h1>
        <p> Der Verlauf besteht aus 3 Schritten, der Voranmledung, der Anmeldung und einer deaktivierten Phase. 
        </p>
        <?php
            switch($status){
                case "voranmeldung":
                    echo '
                        <h2>Der momentane Status lautet: Voranmeldung</h2>
                        <table style="margin:auto; width:50%; text-align:center;">
                            <tr><td colspan="3" style="">
                                <progress id="status" value="33" max="100" style="width:100%; height: 20px; border-radius: 0px; background-color: white;"></progress>
                            </td></tr>
                            <tr>
                                <td style=" width: 33%;">Voranmeldung</td>
                                <td style=" width: 33%;">Anmeldung</td>
                                <td style=" width: 33%;">Anmeldung deaktiviert</td>
                            </tr>
                        </table>
                    ';
                    break;
                case "anmeldung":
                    echo '
                    <h2>Der momentane Status lautet: Anmeldung</h2>
                    <table style="margin:auto; width:50%; text-align:center;">
                        <tr><td colspan="3" style="">
                            <progress id="status" value="66" max="100" style="width:100%; height: 20px; border-radius: 0px; background-color: white;"></progress>
                        </td></tr>
                        <tr>
                            <td style=" width: 33%;">Voranmeldung</td>
                            <td style=" width: 33%;">Anmeldung</td>
                            <td style=" width: 33%;">Anmeldung deaktiviert</td>
                        </tr>
                    </table>
                    ';
                    break;
                case "keine_anmeldung":
                    echo '
                    <h2>Der momentane Status lautet: Anmeldung deaktiviert</h2>
                    <table style="margin:auto; width:50%; text-align:center;">
                        <tr><td colspan="3" style="">
                            <progress id="status" value="100" max="100" style="width:100%; height: 20px; border-radius: 0px; background-color: white;"></progress>
                        </td></tr>
                        <tr>
                            <td style=" width: 33%;">Voranmeldung</td>
                            <td style=" width: 33%;">Anmeldung</td>
                            <td style=" width: 33%;">Anmeldung deaktiviert</td>
                        </tr>
                    </table>
                    ';
                    break;
            }


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