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
        // Nav einfügen 
        require("files/nav.html");
    ?>
    <div class="content">
        <h1>Gruppen erstellen</h1>
        <?php
            switch($urechte){
                // keine Gruppen erstellbar
                case 1:
                case 2:
                    echo '
                        Du kannst leider keine Gruppen erstellen. <br>
                        Solltest du es können, wende dich bitte an '.$supportmail.'
                    ';
                    break;
                case 3:
                    // wenn file noch nicht existiert
                    // erstmalige erstellung
                    if(!file_exists("files/doc/gruppen.csv")){
                        if(!isset($_GET['create'])){
                            // wenn noch keine Anzahl angegeben ist diese eingeben
                            echo '
                                <h2> Es existiert noch keine Gruppeneinteilung </h2>
                                <p> Du kannst jetzt erstmals Gruppen bilden, du kannst alle Eingaben später ändern.
                                    <br><b> Alter dürfen sich nicht überschneiden! </b>
                                </p><br>
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
                            // anhand der Anzahl Tabelle erstellen
                            // Anzahl immernoch änderbar
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
                    // wenn dabei schon existiert
                    else{
                        // csv datei in array packen
                        $csv = array_map('str_getcsv', file('files/doc/gruppen.csv'));

                        // array durchlaufen um den start der weiblichen gruppen zu ermitteln
                        for($i = 0; $i<count($csv); $i++){
                            if($csv[$i][0] == "w1"){
                                $wstart = $i;
                            }
                        }
                        $mgr = $wstart;
                        $wgr = count($csv) - $wstart;


                        echo'
                            <h2>Es wurden bereits Gruppen erstellt</h2>
                            <p> Du kannst die Einteilung nochmal ändern oder dir Dokumente ausgeben lassen </p>
                        ';
                        if(!isset($_GET['edit'])){
                            echo '<a href="?edit&mgr='.$mgr.'&wgr='.$wgr.'"><button class="ausgabe">Jetzt bearbeiten</button></a><br>';
                        }
                        // tabellen mit Daten eingeben
                        if(isset($_GET['edit'])){

                            echo'<a href="gruppen.php"><button class="ausgabe gelb">Bearbeiten zuklappen</button></a><br><hr>';                          
                            echo '
                                <p> Du kannst die Anzahl der Gruppen und die Angaben ändern.
                                    <br> Solltest du auch die Anzahl der Gruppen ändern, werden die eingetragenen Daten nicht übernommen!
                                    <br> <b> Alter dürfen sich nicht überschneiden! </b>
                                </p><br>
                                <form action="gruppen.php" method="GET">
                                    <input type="text" name="edit" value="1" hidden>
                                    <table class="ausgabe_auswahl">
                                        <tr>
                                            <td>Anzahl an männlichen Gruppen</td>
                                            <td><input type="number" min="2" max="5" value="'.$_GET['mgr'].'" name="mgr" required></td>
                                        </tr>
                                        <tr>
                                            <td>Anzahl an weiblichen Gruppen</td>
                                            <td><input type="number" min="2" max="5" value="'.$_GET['wgr'].'" name="wgr" required></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><input type="submit" class="ausgabe" value="Bestätigen"></td>
                                        </tr>
                                    </table>
                                </form>
                            ';

                            echo'
                                <form action="files/gruppen_senden.php" method="POST">
                                    <input type="text" name="edit" value="1" hidden>
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
                            if($_GET['edit'] == 1){
                                for($i = 1 ; $i <= $_GET['mgr']; $i++){
                                    echo '
                                        <tr>
                                            <td>Männlich '.$i.':</td>
                                            <td><input type="number" min="7" max="16" name="m_min_'.$i.'" value="" required></td>
                                            <td><input type="number" min="7" max="16" name="m_max_'.$i.'" value="" required></td>
                                            <td><input type="text" name="m_name_'.$i.'" value=""></td>
                                            <td><input type="text" name="m_betreuer_'.$i.'" value=""></td>
                                            <td><input type="text" name="m_zelt_'.$i.'" value=""></td>
                                        </tr>
                                    ';
                            }
                            for($i = 1 ; $i <= $_GET['wgr']; $i++){
                                echo '
                                    <tr>
                                        <td>Weiblich '.$i.':</td>
                                        <td><input type="number" min="7" max="16" name="w_min_'.$i.'" value="" required></td>
                                        <td><input type="number" min="7" max="16" name="w_max_'.$i.'" value="" required></td>
                                        <td><input type="text" name="w_name_'.$i.'" value=""></td>
                                        <td><input type="text" name="w_betreuer_'.$i.'" value=""></td>
                                        <td><input type="text" name="w_zelt_'.$i.'" value=""></td>
                                    </tr>
                                ';
                            }
                            }
                            else{
                                for($i = 1 ; $i <= $_GET['mgr']; $i++){
                                    echo '
                                        <tr>
                                            <td>Männlich '.$i.':</td>
                                            <td><input type="number" min="7" max="16" name="m_min_'.$i.'" value="'.$csv[$i-1][1].'" required></td>
                                            <td><input type="number" min="7" max="16" name="m_max_'.$i.'" value="'.$csv[$i-1][2].'" required></td>
                                            <td><input type="text" name="m_name_'.$i.'" value="'.$csv[$i-1][3].'"></td>
                                            <td><input type="text" name="m_betreuer_'.$i.'" value="'.$csv[$i-1][4].'"></td>
                                            <td><input type="text" name="m_zelt_'.$i.'" value="'.$csv[$i-1][5].'"></td>
                                        </tr>
                                    ';
                            }
                            for($i = 1 ; $i <= $_GET['wgr']; $i++){
                                echo '
                                    <tr>
                                        <td>Weiblich '.$i.':</td>
                                        <td><input type="number" min="7" max="16" name="w_min_'.$i.'" value="'.$csv[$i+$wstart-1][1].'" required></td>
                                        <td><input type="number" min="7" max="16" name="w_max_'.$i.'" value="'.$csv[$i+$wstart-1][2].'" required></td>
                                        <td><input type="text" name="w_name_'.$i.'" value="'.$csv[$i+$wstart-1][3].'"></td>
                                        <td><input type="text" name="w_betreuer_'.$i.'" value="'.$csv[$i+$wstart-1][4].'"></td>
                                        <td><input type="text" name="w_zelt_'.$i.'" value="'.$csv[$i+$wstart-1][5].'"></td>
                                    </tr>
                                ';
                            }
                            }
                            
                            echo '
                                <tr>
                                    <td colspan="6"><input type="submit" value="Gruppen bearbeiten" class="ausgabe"></td>
                                </tr>
                                </table>
                            </form>
                            <h2>Solltest du die Änderungen verwerfen wollen, klicke auf "Bearbeiten zuklappen". Die Änderungen werden dann nicht gespeichert.</h2>';
                        }
                        echo'
                            <hr>
                            <h2>Dokumente ausgeben</h2>
                            <div class="auswahl">
                                <a href ="files/gruppen_ausgabe1.php"><button type="button" class="auswahl unactive">Anmeldungsübersicht ausgeben</button></a>
                                <a href ="files/gruppen_ausgabe2.php"><button type="button" class="auswahl unactive">Zeltlisten ausgeben</button></a>
                                <a href ="files/gruppen_ausgabe3.php"><button type="button" class="auswahl unactive">Alle Anmeldungen ausgeben</button></a>
                            </div>
                        ';
                    }


                    break;

            }
        ?>
    </div>    
</body>
</html>