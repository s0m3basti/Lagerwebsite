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
           }
           else{
               echo '
                    <div class="auswahl">
                    <a href="?view=1"><button type="button" class="stats unactive">Statistiken des aktuellen Jahren</button></a><a href ="?view=2"><button type="button" class="stats active">Statistiken aller Daten</button></a>
                    </div>
               ';
           }

           echo '<p class="picker">Art der Statistik auswählen';
           echo '
                <form method="POST">
                <select id="picker" class="picker" name="type" onchange="this.form.submit()">
                    <option value="0" default>Statistik auswählen</option>
                    <option value="1">Alter</option>
                    <option value="2">Geschlecht</option>
                </select>
                </form>
            </p>
            <hr>';

            
            echo "$view </br>";
            echo $_POST['type'];
        ?>
        <div class="container">
            <canvas id="myChart" height="100%" ></canvas>
        </div>

        <script>
            <?php
                
                //switch anweisung für verschiedene Views (Datenbankabfragen und createChart commands)

                $labels = array('"Männlich"', '"Weiblich"');
                $data = array(25, 10);
                $type = "pie";
                $colors = array('"#3498a3"','"#a83273"');
                $title = "Geschlechter";

                echo 'createChart(['.implode(",",$labels) ."] ,[". implode(",",$data).'],"'. $type.'",['. implode(",",$colors).'],"'. $title.'")';
            ?>      
        </script>

    </div>    
</body>
</html>