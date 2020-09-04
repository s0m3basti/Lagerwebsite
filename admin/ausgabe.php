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
    <title> Anmeldungen ausgeben | Admin | DRK Sommercamp </title>
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
        <h1>Anmeldungen ausgeben</h1>
        <?php
            // Ausgabe anhand der Userrechte
            switch($urechte){
                // Nur Sufe 3 User können Anmeldungen ausgeben
                case 1:
                case 2:
                    echo "Du kannst leider keine Anmeldungen ausgeben. <br> Solltest du es können, wende dich bitte an $supportmail";
                    break;
                case 3:
                    // wenn keine Task gesetzt ist
                    //standart nav anzeigen
                    if(!isset($_GET['task'])){
                        echo '
                        <div class="auswahl">
                            <a href="?task=1"><button type="button" class="auswahl unactive">Anmeldungsübersicht ausgeben</button></a><a href ="?task=2"><button type="button" class="auswahl unactive">Spezielle Anmeldung ausgeben</button></a><a href ="?task=3"><button type="button" class="auswahl unactive">Angaben für den Betreuer</button></a>
                        </div>
                        ';
                    }
                    else{
                        // nach Tasks aufgeschlüsselt
                        switch($_GET['task']){
                            case 1: // Anmeldungsübersicht ausgeben
                                echo '
                                    <div class="auswahl">
                                        <a href="?task=1"><button type="button" class="auswahl active">Anmeldungsübersicht ausgeben</button></a><a href ="?task=2"><button type="button" class="auswahl unactive">Spezielle Anmeldung ausgeben</button></a><a href ="?task=3"><button type="button" class="auswahl unactive">Angaben für den Betreuer</button></a>
                                    </div>
                                ';
                                echo '
                                    <h2>
                                        Hiermit kann eine Tabelle mit allen Teilnehmern erstellt und heruntergeladen werden.
                                    </h2>
                                ';
                                // download buttom
                                // eigentlich unnötig, wird direkt heruntergeladen
                                if(!isset($_GET['download'])){
                                    echo '
                                        <form action="files/ausgabe_1.php" method="POST">
                                            <input type="submit" class="ausgabe" value="PDF-Übersicht ausgeben">
                                        </form>
                                        <br>
                                        <form method="post" action="files/ausgabe_1_excl.php">
                                            <input type="submit" name="export" class="ausgabe" value="Excel-Übersicht ausgeben (Experimental)" />
                                        </form>
                                    ';
                                }
                                else{
                                    echo'
                                        <a href="files/doc/übersicht.pdf" download><button class="download">Herunterladen</button></a>
                                    ';

                                }
                                break;
                            case 2: // Spezielle Anmeldung
                                echo '
                                    <div class="auswahl">
                                        <a href="?task=1"><button type="button" class="auswahl unactive">Anmeldungsübersicht ausgeben</button></a><a href ="?task=2"><button type="button" class="auswahl active">Spezielle Anmeldung ausgeben</button></a><a href ="?task=3"><button type="button" class="auswahl unactive">Angaben für den Betreuer</button></a>
                                    </div>
                                ';
                                // wenn kein Vor oder Nachname gegeben
                                // Standarttabelle ausgeben
                                // function dblclick für weiterleitung
                                if(!isset($_GET['vorname']) || !isset($_GET['nachname'])){
                                    echo'
                                        <h2>
                                            Such nach Teilnehmer*in:
                                        </h2>
                                        <form method="GET" action="ausgabe.php">
                                            <input type="text" name="task" value="2" hidden> 
                                            <input type="text" name="vorname" placeholder="Vorname eingeben"> und / oder
                                            <input type="text" name="nachname" placeholder="Nachname eingeben"><br>
                                            <input type="submit" value="Suchen ..." class="ausgabe">
                                        </form>
                                        <br>
                                        <hr>
                                    ';
                                    echo '
                                        <h2>
                                            Oder wähle aus der List der Teilnehmer*innen die Anmeldung aus, welche du ausgeben möchtest. (Doppelklick)
                                        </h2>
                                    ';
                                    try{
                                        $db = new PDO("$host; $name" ,$user,$pass);
                                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                
                                        $i = 0;
                                        echo "<table class='index'>";
                                        echo "<tr class='index_head'><td></td><td>Vorname</td><td>Nachname</td><td>Geschlecht</td><td>Geburtstag</td><td>Alter im Lager</td></tr>";
                                
                                        $sql = "SELECT * FROM tbl_stammdaten WHERE Jahr = $jahr ORDER BY Geschlecht, LagerAlter, Nachname, Vorname  DESC;";
                                        foreach ($db->query($sql) as $row){
                                            $i++;
                                            echo '<tr class="index" ondblclick="window.location=\'files/ausgabe_2.php?id='.$row['TeilnehmerID'].'\'">
                                                    <td class="index">'.$i.'</td>
                                                    <td class="index">'.$row['Vorname'].'</td>
                                                    <td class="index">'.$row['Nachname'].'</td>
                                                    <td class="index">'.$row['Geschlecht'].'</td>
                                                    <td class="index">'.date('d.m.Y',strtotime($row['Geburtstag'])).'</td>
                                                    <td class="index">'.$row['LagerAlter'].'</td>
                                                </tr>';
                                        };
                                        echo "</table>";
                                    }
                                    catch(PDOException $e){
                                        $fehler = $e->getMessage();
                                        echo "Es ist ein Fehler bei der Kommunikation mit der Datenbank aufgetreten. </br> $fehler";
                                    }
                                    finally{
                                        $db = null;
                                    }
                                }
                                else{
                                    // wenn vor oder nachname gegeben
                                    // dann mit LIKE Operator in DB gesucht
                                    // Tabelle mit Ergebnisse ausgegeben
                                    $vorname = $_GET['vorname'];
                                    $nachname = $_GET['nachname'];
                                    echo'
                                        <h2>
                                            Such nach Teilnehmer*in:
                                        </h2>
                                        <form method="GET" action="ausgabe.php">
                                            <input type="text" name="task" value="2" hidden> 
                                            <input type="text" name="vorname" value="'.$vorname.'" placeholder="Vorname eingeben"> und / oder
                                            <input type="text" name="nachname" value="'.$nachname.'"placeholder="Nachname eingeben"><br>
                                            <input type="submit" value="Suchen ..." class="ausgabe">
                                        </form>
                                        <a href="?task=2"><button class="ausgabe gelb">Zurücksetzen</button></a>
                                    ';
                                    echo '
                                        <h2>
                                            Wähle einen der Vorschläge via Doppelklick aus oder suche erneut.
                                        </h2>
                                    ';
                                    try{
                                        $db = new PDO("$host; $name" ,$user,$pass);
                                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                
                                        $i = 0;
                                        echo "<table class='index'>";
                                        echo "<tr class='index_head'><td></td><td>Vorname</td><td>Nachname</td><td>Geschlecht</td><td>Geburtstag</td><td>Alter im Lager</td></tr>";
                                
                                        if($vorname != ""){
                                            $where = "AND Vorname LIKE '%$vorname%' ";
                                        }
                                        if($nachname != ""){
                                            $where = "AND Nachname LIKE '%$nachname%' ";
                                        }
                                        if($nachname != "" && $vorname != ""){
                                            $where = "AND Nachname LIKE '%$nachname%'
                                                        AND Vorname LIKE '%$vorname%'";
                                        }

                                        $sql = "SELECT COUNT(*) as anzahl, TeilnehmerID
                                                FROM tbl_stammdaten 
                                                WHERE Jahr = $jahr"
                                                .$where. 
                                                "ORDER BY Geschlecht, LagerAlter, Nachname, Vorname;";

                                        foreach ($db->query($sql) as $row){
                                            if($row['anzahl'] == 1 ){
                                                header("Location:files/ausgabe_2.php?id=".$row['TeilnehmerID']);
                                            }
                                        }

                                        $sql = "SELECT * 
                                                FROM tbl_stammdaten 
                                                WHERE Jahr = $jahr"
                                                .$where. 
                                                "ORDER BY Geschlecht, LagerAlter, Nachname, Vorname;";

                                        foreach ($db->query($sql) as $row){
                                            $i++;
                                            echo '<tr class="index" ondblclick="window.location=\'files/ausgabe_2.php?id='.$row['TeilnehmerID'].'\'">
                                                    <td class="index">'.$i.'</td>
                                                    <td class="index">'.$row['Vorname'].'</td>
                                                    <td class="index">'.$row['Nachname'].'</td>
                                                    <td class="index">'.$row['Geschlecht'].'</td>
                                                    <td class="index">'.date('d.m.Y',strtotime($row['Geburtstag'])).'</td>
                                                    <td class="index">'.$row['LagerAlter'].'</td>
                                                </tr>';
                                        };
                                        echo "</table>";
                                    }
                                    catch(PDOException $e){
                                        $fehler = $e->getMessage();
                                        echo "Es ist ein Fehler bei der Kommunikation mit der Datenbank aufgetreten. </br> $fehler";
                                    }
                                    finally{
                                        $db = null;
                                    }
                                }
                                break;
                            case 3: // Alle Anmeldungen
                                // downloadbutton für die Übersicht
                                echo '
                                    <div class="auswahl">
                                        <a href="?task=1"><button type="button" class="auswahl unactive">Anmeldungsübersicht ausgeben</button></a><a href ="?task=2"><button type="button" class="auswahl unactive">Spezielle Anmeldung ausgeben</button></a><a href ="?task=3"><button type="button" class="auswahl active">Angaben für den Betreuer</button></a>
                                    </div>
                                ';
                                echo'
                                    <h2>Tabelle der Teilnehmer mit Angaben für den Betreuer ausgeben</h2>
                                    <form action="files/ausgabe_3.php" method="POST">
                                        <input type="submit" value="Dokument erstellen" class="ausgabe">
                                    </form>
                                ';
                                break;
                    
                            }
                    }
                    break;
            }
        ?>
    </div>    
</body>
</html>