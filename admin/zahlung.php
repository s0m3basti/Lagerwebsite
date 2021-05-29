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

require "../Datenbank/writer.php";
require "../files/linkmaker.php";
require "../files/datenzugriff.php";
?>

<!DOCTYPE HTML>
<head>
    <title> Zahlungsportal | Admin | DRK Sommercamp </title>
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
                switch($_GET['message']){
                    case "1":
                        echo '<div class="message" id="messagebox" style="background-color: #4CAF50; margin-left: 0">Teilnehmer wurde ausgebucht.</div>';
                        break;
                    case "2": 
                        echo '<div class="message" id="messagebox" style="background-color: #f44336; margin-left: 0">Es gab ein Problem mit der Datenbank, versuch es später erneut.</div>';
                        break;
                    case "3":
                        echo '<div class="message" id="messagebox" style="background-color: #4CAF50; margin-left: 0">Der Betrag wurde abgezogen und aktualisiert!</div>';
                        break;
                }
            }
        ?>
        <h1>Zahlungsportal</h1>
        <h2>Hier siehst du alle noch offenen Zahlungen.</h2>
        <?php
            switch($urechte){
                case 1:
                    echo 'Für dich gibt es hier leider nichts zu sehen';
                    break;
                case 2:
                case 3:
                    try{
                        $db = new PDO("$host; $name" ,$user,$pass);
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                        $i = 0;
                        echo "<table class='index'>";
                        echo "<tr class='index_head'>
                                    <td><a href='?sort=Nachname,Vorname' class='index_head'><img src='img/back-arrow.png' height='20'></a></td>
                                    <td><a href='?sort=Vorname' class='index_head' title='Sortieren'>Vorname des Kindes</a></td>
                                    <td><a href='?sort=Nachname' class='index_head' title='Sortieren'>Nachname des Kindes</a></td>
                                    <td><a href='?sort=Geschlecht' class='index_head' title='Sortieren'>Geschlecht des Kindes</a></td>
                                    <td><a href='?sort=Geburtstag' class='index_head' title='Sortieren'>Geburtstag</a></td>
                                    <td><a href='?sort=e_Vorname' class='index_head' title='Sortieren'>Vorname des Elter</a></td>
                                    <td><a href='?sort=e_Nachname' class='index_head' title='Sortieren'>Nachname des Elter</a></td>
                                    <td><a href='?sort=Ratenzahlung' class='index_head' title='Sortieren'>Ratenzahlung</a></td>
                                    <td><a href='?sort=Raten_anzahl' class='index_head' title='Sortieren'>Ratenanzahl</a></td>
                                    <td><a href='?sort=zahlungsdaten' class='index_head' title='Sortieren'>Offener Betrag</a></td>
                                    <td><a href='?sort=zahlungsdaten' class='index_head' title='Sortieren'>Teilbetrag gezahl</a></td>
                                    <td><a href='?sort=zahlungsdaten' class='index_head' title='Sortieren'>Ganzer Betrag gezahlt</a></td>
                                    </tr>";
                
                        if(!isset($_GET['sort'])){
                            $sort = "Nachname,Vorname";
                        }
                        else{
                            $sort = $_GET['sort'];
                        }    
                        
                        $sql = "SELECT * 
                                FROM tbl_stammdaten s, tbl_anmeldedaten a, tbl_srgb e
                                WHERE s.TeilnehmerID = a.TeilnehmerID
                                AND s.TeilnehmerID = e.TeilnehmerID
                                AND Jahr = $jahr
                                AND zahlungsdaten IS NOT null
                                ORDER BY $sort;";
                        foreach ($db->query($sql) as $row){

                            $i = $i + 1;
                            echo "<tr class='index'>
                                    <td class='index'>".$i."</td>
                                    <td class='index'>".$row['Vorname']."</td>
                                    <td class='index'>".$row['Nachname']."</td>
                                    <td class='index'>".$row['Geschlecht']."</td>
                                    <td class='index'>".date('d.m.Y',strtotime($row['Geburtstag']))."</td>
                                    <td class='index'>".$row['e_Vorname']."</td>
                                    <td class='index'>".$row['e_Nachname']."</td>
                                    <td class='index'>".$row['Ratenzahlung']."</td>
                                    <td class='index'>".$row['Raten_anzahl']."</td>
                                    <td class='index'>".$row['zahlungsdaten']." €</td>
                                    <td class='index'>
                                        <form action='files/zahlung_senden.php' method='POST'>
                                            <input type='number' name='betrag' placeholder='Betrag eingeben' min='-200' max='500' step='.01' required>€
                                            <input type='text' name='id' value='".$row['TeilnehmerID']."' hidden>
                                            <input type='text' name='type' value='teil' hidden>
                                            <input type='submit' value='Abbuchen'>
                                        </form>
                                    </td>
                                    <td class='index'>
                                        <form action='files/zahlung_senden.php' method='POST'>
                                            <input type='text' name='id' value='".$row['TeilnehmerID']."' hidden>
                                            <input type='text' name='type' value='ganz' hidden>
                                            <button type='submit'><i class='fa fa-check' aria-hidden='true'></i></button>
                                        </form>
                                    </td>
                                </tr>";
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

                    echo '
                        <hr>
                            <h2>Liste mit offenen Zahlungen ausgeben</h2>
                                <a href=files/zahlung_ausgabe1.php><button class="ausgabe">Liste Ausgeben</button></a>
                    ';

                    break;
            }
        ?>
    </div>
</body>
</html>