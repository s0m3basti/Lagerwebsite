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
    <title> Gruppen erstellen | Admin | DRK Sommercamp </title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico" id="favicon">
    <link rel="stylesheet" href="CSS/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php
        require("files/nav.html");
    ?>
    <div class="content">
        <h1>Gruppen erstellen</h1>
        <?php
            switch($urechte){
                case 1:
                case 2:
                    echo '
                        Du kannst leider keine Gruppen erstellen. <br>
                        Solltest du es können, wende dich bitte an '.$supportmail.'
                    ';
                    break;
                case 3:
                    
                    if(!file_exists("files/doc/gruppen.csv")){
                        if(!isset($_GET['create'])){
                            echo '
                                <h2> Es existiert noch keine Gruppeneinteilung </h2>
                                <p> Du kannst jetzt erstmals Gruppen bilden, du kannst alle Eingaben später ändern.</p><br>
                                <form action="gruppen.php" method="GET">
                                    <input type="text" name="create" value="1" hidden>
                                    <table class="ausgabe_auswahl">
                                        <tr>
                                            <td>Anzahl an männlichen Gruppen</td>
                                            <td><input type="number" min="2" max="5" value="3" name="mgr" required></td>
                                        </tr>
                                        <tr>
                                            <td>Anzahl an weiblichen Gruppen</td>
                                            <td><input type="number" min="2" max="5" value="3" name="wgr" required></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><input type="submit" class="ausgabe" value="Bestätigen"></td>
                                        </tr>
                                    </table>
                                </form>
                            ';
                        }
                        if(isset($_GET['create'])){
                            $count_m = $_GET["mgr"];
                            $count_w = $_GET["wgr"];
                            echo '
                                <h2> Es existiert noch keine Gruppeneinteilung </h2>
                                <p> Du kannst jetzt erstmals Gruppen bilden, du kannst alle Eingaben später ändern.</p><br>
                                <form action="gruppen.php" method="GET">
                                    <input type="text" name="create" value="1" hidden>
                                    <table class="ausgabe_auswahl">
                                        <tr>
                                            <td>Anzahl an männlichen Gruppen</td>
                                            <td><input type="number" min="2" max="5" value="'.$count_m.'" name="mgr" required></td>
                                        </tr>
                                        <tr>
                                            <td>Anzahl an weiblichen Gruppen</td>
                                            <td><input type="number" min="2" max="5" value="'.$count_w.'" name="wgr" required></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><input type="submit" class="ausgabe" value="Bestätigen"></td>
                                        </tr>
                                    </table>
                                </form>
                            ';

                            echo'
                                <form action="files/gruppen_senden.php" method="POST">
                                    <input type="text" name="create" value="1" hidden>
                                    <input type="text" name="mgr" value="'.$_GET["mgr"].'" hidden>
                                    <input type="text" name="wgr" value="'.$_GET["wgr"].'" hidden>
                                    <table class="ausgabe_auswahl">
                                        <tr>
                                            <td></td>
                                            <td colspan="2">Alter</td>
                                            <td colspan="4">Optionale Angaben</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Von</td>
                                            <td>Bis</td>
                                            <td>Gruppennummer</td>
                                            <td>Betreuer</td>
                                            <td>Zelt</td>
                                        </tr>
                            ';
                            for($i = 1 ; $i <= $count_m; $i++){
                                echo '
                                    <tr>
                                        <td>Männlich '.$i.':</td>
                                        <td><input type="number" min="7" max="16" name="m_min_'.$i.'" required></td>
                                        <td><input type="number" min="7" max="16" name="m_max_'.$i.'" required></td>
                                        <td><input type="text" name="m_name_'.$i.'"></td>
                                        <td><input type="text" name="m_betreuer_'.$i.'"></td>
                                        <td><input type="text" name="m_zelt_'.$i.'"></td>
                                    </tr>
                                ';
                            }
                            for($i = 1 ; $i <= $count_w; $i++){
                                echo '
                                    <tr>
                                        <td>Weiblich '.$i.':</td>
                                        <td><input type="number" min="7" max="16" name="w_min_'.$i.'" required></td>
                                        <td><input type="number" min="7" max="16" name="w_max_'.$i.'" required></td>
                                        <td><input type="text" name="w_name_'.$i.'"></td>
                                        <td><input type="text" name="w_betreuer_'.$i.'"></td>
                                        <td><input type="text" name="w_zelt_'.$i.'"></td>
                                    </tr>
                                ';
                            }
                            echo '
                                <tr>
                                    <td colspan="6"><input type="submit" value="Gruppen erstellen" class="ausgabe"></td>
                                </tr>
                                </table>
                            </form>';
                        }
                    }


                    break;

            }
        ?>
    </div>    
</body>
</html>