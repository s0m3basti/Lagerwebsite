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

if(!isset($_GET["view"])){
    header("Location:?view=1");
}
else{
    if($_GET["view"] == 1){
        $view = 1;
    }
    else{
        $view = 2;
    }
}
if(!isset($_POST["type"])){
    $_POST['type'] = 0;
}
?>

<!DOCTYPE HTML>
<head>
    <title> Statistik | Admin | DRK Sommercamp </title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico" id="favicon">
    <link rel="stylesheet" href="CSS/admin.css" !important>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <script src="files/stats_createChart.js"></script>

</head>
<body>
    <?php
        require("files/nav.html");
    ?>
    <div class="content">
        <h1>Teilnehmerstatistiken zum DRK-Sommercamp</h1>
        <?php

           if($view == 1){
                echo '
                    <div class="auswahl">
                        <a href="?view=1"><button type="button" class="stats active">Statistiken des aktuellen Jahren</button></a><a href ="?view=2"><button type="button" class="stats unactive">Statistiken aller Daten</button></a>
                    </div>
                ';
                echo '<p class="picker">Art der Statistik auswählen';
                echo '
                    <form method="POST" style="text-align: left; padding: 10px; padding-top: 0;">
                    <select id="picker" class="picker" name="type" onchange="this.form.submit()">
                        <option value="0" default>Statistik auswählen</option>
                        <option value="1">Geschlecht</option>
                        <option value="2">Alter</option>
                    </select>
                    </form>
                    </p>
                <hr>';
           }
           else{
               echo '
                    <div class="auswahl">
                    <a href="?view=1"><button type="button" class="stats unactive">Statistiken des aktuellen Jahren</button></a><a href ="?view=2"><button type="button" class="stats active">Statistiken aller Daten</button></a>
                    </div>
               ';
               echo '<p class="picker" style="text-align: right;">Art der Statistik auswählen';
               echo '
                    <form method="POST" style="text-align: right; padding: 10px; padding-top: 0;">
                    <select id="picker" class="picker" name="type" onchange="this.form.submit()">
                        <option value="0" default>Statistik auswählen</option>
                        <option value="1">Geschlecht</option>
                        <option value="2">Alter</option>
                    </select>
                    </form>
                    </p>
                <hr>';
           }
            
            echo "$view </br>";
            echo $_POST['type'];
        ?>
        <div class="container">
            <canvas id="myChart" height="100%" ></canvas>
        </div>

        <script>
            <?php
                if($view == 1){
                    switch($_POST['type']){
                        case 1:
                            $data = array();
                            $labels = array();
                            try{
                                $db = new PDO("$host; $name" ,$user,$pass);
                                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        
                                $sql = 'SELECT Geschlecht AS name, COUNT(Geschlecht) AS anzahl
                                            FROM tbl_stammdaten
                                            WHERE Jahr = '.$jahr.'
                                            GROUP BY Geschlecht';
                                foreach ($db->query($sql) as $row){
                                    $name = '"'.$row["name"].'"';
                                    array_push($labels, $name);
                                    array_push($data, $row["anzahl"]);
                                };
                            }
                            catch(PDOException $e){
                                $fehler = $e->getMessage();
                                echo "Es ist ein Fehler bei der Kommunikation mit der Datenbank aufgetreten. </br> $fehler";
                            }
                            finally{
                                $db = null;
                            }

                            $labels;
                            $data;
                            $type= "pie";
                            $colors = array('"#3498a3"','"#a83273"');
                            $title = "Geschlechter";
                            echo 'createChart(['.implode(",",$labels) ."] ,[". implode(",",$data).'],"'. $type.'",['. implode(",",$colors).'],"'. $title.'")';
                            break;
                        case 2:
                            $data = array();
                            $labels = array();
                            try{
                                $db = new PDO("$host; $name" ,$user,$pass);
                                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        
                                $sql = 'SELECT Geschlecht , LagerAlter AS name, Count(LagerAlter) AS anzahl
                                        FROM `tbl_stammdaten` 
                                        WHERE Jahr = 2020
                                        GROUP BY LagerAlter, Geschlecht
                                        ORDER BY LagerAlter, Geschlecht;';
                                foreach ($db->query($sql) as $row){
                                    $name = '"'.$row["name"].'"';
                                    array_push($labels, $name);
                                    array_push($data, $row["anzahl"]);
                                };
                            }
                            catch(PDOException $e){
                                $fehler = $e->getMessage();
                                echo "Es ist ein Fehler bei der Kommunikation mit der Datenbank aufgetreten. </br> $fehler";
                            }
                            finally{
                                $db = null;
                            }

                            $labels;
                            $data;
                            $type= "bar";
                            $colors = array('"#3498a3"','"#a83273"');
                            $title = "Alter";
                            echo 'createChart(['.implode(",",$labels) ."] ,[". implode(",",$data).'],"'. $type.'",['. implode(",",$colors).'],"'. $title.'")';
                            break;
                    }
                }
                else{

                }


                //switch anweisung für verschiedene Views (Datenbankabfragen und createChart commands)
                // zu manchen dann eventuell noch Prozentwerte Berechnen

                //$labels = array('"Männlich"', '"Weiblich"');
                //$data = array(25, 10);
                //$type = "pie";
                //$colors = array('"#3498a3"','"#a83273"');
                //$title = "Geschlechter";

                //echo 'createChart(['.implode(",",$labels) ."] ,[". implode(",",$data).'],"'. $type.'",['. implode(",",$colors).'],"'. $title.'")';
            ?>      
        </script>
        <br>
        <p>Sollten mehr oder andere Statistiken gewünscht werden, gerne einfach bescheid geben.</p>
    </div>    
</body>
</html>