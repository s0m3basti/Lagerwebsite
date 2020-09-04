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
require "../Datenbank/writer.php";
require "../files/linkmaker.php";
require "../files/datenzugriff.php";

//status an eine ID binden
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
        const status = <?php echo $status ?>
    </script>
    <script src="files/indexstatus.js" defer></script>
</head>
<body>
    <?php
        // Nav einfügen
        require("files/nav.html");
    ?>
    <div class="content">
        <h1>Übersicht</h1>
        <h2>Hier siehst du den Momentanen stand der Anmeldung.</h2>
        <div class="status" id="div_status">
            <?php
                // Inhalt nach Status
                switch($status){
                    case 1:
                        // Wenn die Anmeldung aktiviert ist
                        echo "Die Anmeldung ist derzeitig aktiviert.</br>";
                            // Kennzahlen aus der Datenbank auslesen und ausgeben
                            try{
                                $db = new PDO("$host; $name" ,$user,$pass);
                                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                                $sql = "SELECT COUNT(*) AS anzahl FROM tbl_stammdaten WHERE Jahr = $jahr;";
                                foreach ($db->query($sql) as $row);

                                $anzahl = $row['anzahl'];

                                $sql = 'SELECT COUNT(*) AS anzahl FROM tbl_stammdaten WHERE Jahr = "'.$jahr.'" AND Geschlecht = "maennlich";';
                                foreach ($db->query($sql) as $row);

                                $anzahlm = $row['anzahl'];

                                $sql = 'SELECT COUNT(*) AS anzahl FROM tbl_stammdaten WHERE Jahr = "'.$jahr.'" AND Geschlecht = "weiblich";';
                                foreach ($db->query($sql) as $row);

                                $anzahlw = $row['anzahl'];
                                
                            }
                            catch(PDOException $e){
                                $fehler = $e->getMessage();
                                echo $fehler;
                                echo "Es konnte leider keine Anzahl von Anmeldungen bestimmt werden. </br> Es gibt wohl ein Problem mit der Datenbank.";
                            }
                            finally{
                                $db = null;
                            }
                        echo "Wir haben Momentan bereits $anzahl Anmeldungen gesammelt. </br> Davon sind $anzahlm Männlich und $anzahlw Weiblich. ";
                        break;
                    case 2:
                        // Wenn die Voranmeldung aktiviert ist
                        echo "Die Vornamledung ist derzeitig aktiviert. </br>";
                            // Zahl aller Voranmeldungen auslesen
                            try{
                                $db = new PDO("$host; $name" ,$user,$pass);
                                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                                $sql = "SELECT COUNT(*) AS anzahl FROM voranmeldung;";
                                foreach ($db->query($sql) as $row);

                                $anzahl = $row['anzahl'];
                            }
                            catch(PDOException $e){
                                $fehler = $e->getMessage();
                                echo "Es konnte leider keine Anzahl von Voranmeldungen bestimmt werden. </br> Es gibt wohl ein Problem mit der Datenbank.";
                            }
                            finally{
                                $db = null;
                            }
                        echo "Wir haben Momentan bereits $anzahl Voranmeldungen gesammelt.";
                        break;
                    case 3:
                        // wenn Anmeldung deaktiviert ist
                        echo "Die Anmeldung ist zur Zeit deaktiviert. </br> Niemand kann sich anmelden oder voranmelden.</br>";
                            // Kennzahlen auslesen und ausgeben
                            try{
                                $db = new PDO("$host; $name" ,$user,$pass);
                                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                                $sql = 'SELECT COUNT(*) AS anzahl FROM tbl_stammdaten WHERE Jahr = '.intval($jahr).';';
                                foreach ($db->query($sql) as $row);

                                $anzahl = $row['anzahl'];

                                $sql = 'SELECT COUNT(*) AS anzahl FROM tbl_stammdaten WHERE Jahr = "'.intval($jahr).'" AND Geschlecht = "maennlich";';
                                foreach ($db->query($sql) as $row);

                                $anzahlm = $row['anzahl'];

                                $sql = 'SELECT COUNT(*) AS anzahl FROM tbl_stammdaten WHERE Jahr = "'.intval($jahr).'" AND Geschlecht = "weiblich";';
                                foreach ($db->query($sql) as $row);

                                $anzahlw = $row['anzahl'];
                                
                            }
                            catch(PDOException $e){
                                $fehler = $e->getMessage();
                                echo $fehler;
                                echo "Es konnte leider keine Anzahl von Anmeldungen bestimmt werden. </br> Es gibt wohl ein Problem mit der Datenbank.";
                            }
                            finally{
                                $db = null;
                            }
                        echo "Wir haben $anzahl Anmeldungen gesammelt. </br> Davon sind $anzahlm Männlich und $anzahlw Weiblich. ";
                        break;
                }
            ?>
        </div>
        <div>
            <?php
                switch($status){
                    case 1:
                    case 3:
                        // wenn deaktiverit oder Anmeldung
                        echo "<h2>Übersicht aller Anmeldungen</h2>";
                            // Tabelle mit allen Anmeldungen ausgeben
                            // Name, Alter, Geschlecht
                            try{
                                $db = new PDO("$host; $name" ,$user,$pass);
                                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        
                                $i = 0;
                                echo "<table class='index'>";
                                echo "<tr class='index_head'>
                                            <td><a href='?sort=Geschlecht,LagerAlter,Nachname,Vorname' class='index_head'><img src='img/back-arrow.png' height='20'></a></td>
                                            <td><a href='?sort=Vorname' class='index_head' title='Sortieren'>Vorname</a></td>
                                            <td><a href='?sort=Nachname' class='index_head' title='Sortieren'>Nachname</a></td>
                                            <td><a href='?sort=Geschlecht' class='index_head' title='Sortieren'>Geschlecht</a></td>
                                            <td><a href='?sort=Geburtstag' class='index_head' title='Sortieren'>Geburtstag</a></td>
                                            <td><a href='?sort=LagerAlter' class='index_head' title='Sortieren'>Alter im Lager</a></td>
                                            </tr>";
                        
                                if(!isset($_GET['sort'])){
                                    $sort = "Geschlecht,LagerAlter,Nachname,Vorname";
                                }
                                else{
                                    $sort = $_GET['sort'];
                                }    
                                
                                $sql = "SELECT * FROM tbl_stammdaten WHERE Jahr = $jahr ORDER BY $sort;";
                                foreach ($db->query($sql) as $row){

                                    $i = $i + 1;
                                    echo "<tr class='index'><td class='index'>".$i."</td><td class='index'>".$row['Vorname']."</td><td class='index'>".$row['Nachname']."</td><td class='index'>".$row['Geschlecht']."</td><td class='index'>".date('d.m.Y',strtotime($row['Geburtstag']))."</td><td class='index'>".$row['LagerAlter']."</td></tr>";
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
                        break;
                    case 2:
                        //wenn Voranmeldung
                        echo "<h2>Übersicht aller Voranmeldungen</h2>";
                            //Tabelle der Voranmeldungen ausgeben
                            // email, Datum
                            try{
                                $db = new PDO("$host; $name" ,$user,$pass);
                                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        
                                $i = 0;
                                echo "<table class='index'>";
                                echo "<tr class='index_head'><td></td><td>E-Mail</td><td>Datum</td></tr>";
                        
                                $sql = "SELECT * FROM voranmeldung ORDER BY date DESC;";
                                foreach ($db->query($sql) as $row){

                                    $i = $i + 1;
                                    echo "<tr class='index'><td class='index'>".$i."</td><td class='index'>".$row['email']."</td><td class='index'>".date('d.m.Y',strtotime($row['date']))."</td></tr>";
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
                        break;
                }

                switch($urechte){
                    // wenn userechte der Stufe drei
                    case 1:
                    case 2:
                        break;
                    case 3:
                        // link zu den drei Logdateien
                        echo '
                            <h3>Logdateien anzeigen</h3>
                            <div class="auswahl">
                                <a href="../changelogs/anmeldung.txt" target="_blank"><button type="button" class="auswahl unactive">Anmeldungen bearbeiten</button></a><a href ="../changelogs/status.txt" target="_blank"><button type="button" class="auswahl unactive">Status der Anmeldung</button></a><a href ="../changelogs/ausgabe.txt" target="_blank"><button type="button" class="auswahl unactive">Ausgabe der Anmeldungen</button></a>
                            </div>
                        ';
                        break;
                }

            ?>
        </div>
    </div>
</body>
</html>