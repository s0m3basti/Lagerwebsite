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
                        <option disabled>---------------------------</option>
                        <option value="1">Geschlechterverteilung</option>
                        <option value="2">Alter (nach Geschlecht)</option>
                        <option value="5">Schwimmer / Nichtschwimmer</option>
                        <option value="6">Essenswünsche?</option>
                        <option value="7">Taschengeldverwaltung?</option>
                        <option value="8">Privates KFZ?</option>
                        <option value="9">T-Shirts?</option>
                        <option value="10">Anzahl an T-Shirts</option>
                        <option value="11">T-Shirt-Größen</option>
                        <option disabled>---------------------------</option>
                        <option value="3">Art der Anmeldung</option>
                        <option value="4">Monat der Anmeldung</option>
                        <option value="12">Umfrageergebnis</option>
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
                        <option value="1" disabled>Comming Soon ...</option>
                    </select>
                    </form>
                    </p>
                <hr>';
           }
            
            //echo "$view </br>";
            //echo $_POST['type'];

            if($_POST['type'] == 0){
                echo ' </br> Bitte wähle eine Statistik aus die du sehen möchtest.';
            }
        ?>
        <div class="container">
            <canvas id="myChart" height="100%" ></canvas>
        </div>
        <p id="legende"></p>
        <script>
            <?php
                if($view == 1){
                    switch($_POST['type']){
                        case 1: // Geschlechtervergleich
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
                            $colors = array('"blue"','"pink"');
                            $title = "Geschlechterverteilung";
                            $legende = true;
                            echo 'createPieChart(['.implode(",",$labels) ."] ,[". implode(",",$data).'],"'. $type.'",['. implode(",",$colors).'],"'. $title.'", '.$legende.')';
                            break;

                        case 2: //Altersvergleich diff
                            $data = array();
                            $dataname = "Gesamt";
                            $data1 = array();
                            $data1name = "männlich";
                            $data2 = array();
                            $data2name = "weiblich";
                            $data = array_fill(0,8,0);
                            $data1 = array_fill(0,8,0);
                            $data2 = array_fill(0,8,0);
                            $labels = array(8,9,10,11,12,13,14,15);

                            try{
                                $db = new PDO("$host; $name" ,$user,$pass);
                                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        

                                $sql = 'SELECT Geschlecht as geschlecht, LagerAlter AS name, Count(LagerAlter) AS anzahl
                                        FROM `tbl_stammdaten` 
                                        WHERE Jahr = '.$jahr.'
                                        AND Geschlecht = "maennlich"
                                        GROUP BY LagerAlter, Geschlecht
                                        ORDER BY LagerAlter, Geschlecht;';
                                foreach ($db->query($sql) as $row){
                                    switch($row['name']){
                                        case 8:
                                            $data1[0] = $row['anzahl'];
                                            break;
                                        case 9:
                                            $data1[1] = $row['anzahl'];
                                            break;
                                        case 10:
                                            $data1[2] = $row['anzahl'];
                                            break;
                                        case 11:
                                            $data1[3] = $row['anzahl'];
                                            break;
                                        case 12:
                                            $data1[4] = $row['anzahl'];
                                            break;
                                        case 13:
                                            $data1[5] = $row['anzahl'];
                                            break;
                                        case 14:
                                            $data1[6] = $row['anzahl'];
                                            break;
                                        case 15:
                                            $data1[7] = $row['anzahl'];
                                            break;
                                    }
                                };
                                $sql = 'SELECT Geschlecht as geschlecht, LagerAlter AS name, Count(LagerAlter) AS anzahl
                                        FROM `tbl_stammdaten` 
                                        WHERE Jahr = '.$jahr.'
                                        AND Geschlecht = "weiblich"
                                        GROUP BY LagerAlter, Geschlecht
                                        ORDER BY LagerAlter, Geschlecht;';
                                foreach ($db->query($sql) as $row){
                                    switch($row['name']){
                                        case 8:
                                            $data2[0] = $row['anzahl'];
                                            break;
                                        case 9:
                                            $data2[1] = $row['anzahl'];
                                            break;
                                        case 10:
                                            $data2[2] = $row['anzahl'];
                                            break;
                                        case 11:
                                            $data2[3] = $row['anzahl'];
                                            break;
                                        case 12:
                                            $data2[4] = $row['anzahl'];
                                            break;
                                        case 13:
                                            $data2[5] = $row['anzahl'];
                                            break;
                                        case 14:
                                            $data2[6] = $row['anzahl'];
                                            break;
                                        case 15:
                                            $data2[7] = $row['anzahl'];
                                            break;
                                    }
                                    
                                };
                                $sql = 'SELECT  LagerAlter AS name, Count(LagerAlter) AS anzahl
                                        FROM `tbl_stammdaten` 
                                        WHERE Jahr = '.$jahr.'
                                        GROUP BY LagerAlter
                                        ORDER BY LagerAlter;';
                                foreach ($db->query($sql) as $row){
                                    switch($row['name']){
                                        case 8:
                                            $data[0] = $row['anzahl'];
                                            break;
                                        case 9:
                                            $data[1] = $row['anzahl'];
                                            break;
                                        case 10:
                                            $data[2] = $row['anzahl'];
                                            break;
                                        case 11:
                                            $data[3] = $row['anzahl'];
                                            break;
                                        case 12:
                                            $data[4] = $row['anzahl'];
                                            break;
                                        case 13:
                                            $data[5] = $row['anzahl'];
                                            break;
                                        case 14:
                                            $data[6] = $row['anzahl'];
                                            break;
                                        case 15:
                                            $data[7] = $row['anzahl'];
                                            break;
                                    }
                                    
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
                            $title = "Alter nach Geschlecht";
                            $legende = true;
                            echo 'createChartVgl(['.implode(",",$labels) .'] ,"'.$dataname.'", ['. implode(",",$data).'] ,"'.$data1name.'", ['. implode(",",$data1).'],"'.$data2name.'",['. implode(",",$data2).'],"'. $type.'","'. $title.'", '.$legende.');';

                            break;
                        
                        case 3: // Art der Anmeldung
                            $data = array();
                            $labels = array();
                            try{
                                $db = new PDO("$host; $name" ,$user,$pass);
                                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        
                                $sql = 'SELECT Art AS name, COUNT(Art) AS anzahl
                                            FROM tbl_stammdaten s, tbl_anmeldedaten a
                                            WHERE s.TeilnehmerID = a.TeilnehmerID
                                            AND Jahr = '.$jahr.'
                                            GROUP BY Art';
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
                            $colors = array('"white"','"grey"');
                            $title = "Art der Anmeldung";
                            $legende = false;
                            echo 'createChart(['.implode(",",$labels) ."] ,[". implode(",",$data).'],"'. $type.'",['. implode(",",$colors).'],"'. $title.'", '.$legende.')';
                            break;

                            case 4: //Monat der Anmeldung
                                $data = array();
                                $labels = array();
                                try{
                                    $db = new PDO("$host; $name" ,$user,$pass);
                                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            
                                    $sql = 'SELECT MONTH(Datum) AS name, COUNT(MONTH(Datum)) AS anzahl
                                                FROM tbl_stammdaten s, tbl_anmeldedaten a
                                                WHERE s.TeilnehmerID = a.TeilnehmerID
                                                AND Jahr = '.$jahr.'
                                                GROUP BY MONTH(Datum)';
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
                                $colors = array('"white"','"grey"');
                                $title = "Monat der Anmeldung";
                                $legende = false;
                                echo 'createChart(['.implode(",",$labels) ."] ,[". implode(",",$data).'],"'. $type.'",['. implode(",",$colors).'],"'. $title.'", '.$legende.')';
                                break;

                                case 5: //Schwimmer
                                    $data = array();
                                    $labels = array();
                                    try{
                                        $db = new PDO("$host; $name" ,$user,$pass);
                                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                
                                        $sql = 'SELECT Schwimmer AS name, COUNT(Schwimmer) AS anzahl
                                                    FROM tbl_stammdaten s, tbl_anmeldedaten a
                                                    WHERE s.TeilnehmerID = a.TeilnehmerID
                                                    AND Jahr = '.$jahr.'
                                                    GROUP BY Schwimmer';
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
                                    $colors = array('"green"','"red"');
                                    $title = "Schwimmer";
                                    $legende = true;
                                    echo 'createPieChart(['.implode(",",$labels) ."] ,[". implode(",",$data).'],"'. $type.'",['. implode(",",$colors).'],"'. $title.'", '.$legende.')';
                                    break;

                                    case 6: //Ernnährungswünsche
                                        $data = array();
                                        $labels = array();
                                        try{
                                            $db = new PDO("$host; $name" ,$user,$pass);
                                            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    
                                            $sql = 'SELECT ernaehrung AS name, COUNT(ernaehrung) AS anzahl
                                                        FROM tbl_stammdaten s, tbl_anmeldedaten a
                                                        WHERE s.TeilnehmerID = a.TeilnehmerID
                                                        AND Jahr = '.$jahr.'
                                                        AND ernaehrung = ""';
                                            foreach ($db->query($sql) as $row){
                                                array_push($labels, '"Keine"');
                                                array_push($data, $row["anzahl"]);
                                            };
                                            $sql = 'SELECT ernaehrung AS name, COUNT(ernaehrung) AS anzahl
                                                        FROM tbl_stammdaten s, tbl_anmeldedaten a
                                                        WHERE s.TeilnehmerID = a.TeilnehmerID
                                                        AND Jahr = '.$jahr.'
                                                        AND ernaehrung != ""';
                                            foreach ($db->query($sql) as $row){
                                                array_push($labels, '"Anmerkungen"');
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
                                        $colors = array('"white"','"black"');
                                        $title = "Anmerkung bei der Ernährung";
                                        $legende = false;
                                        echo 'createChart(['.implode(",",$labels) ."] ,[". implode(",",$data).'],"'. $type.'",['. implode(",",$colors).'],"'. $title.'", '.$legende.')';
                                        break;

                                        case 7: //Taschengeld
                                            $data = array();
                                            $labels = array();
                                            try{
                                                $db = new PDO("$host; $name" ,$user,$pass);
                                                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                        
                                                $sql = 'SELECT Taschengeld AS name, COUNT(Taschengeld) AS anzahl
                                                            FROM tbl_stammdaten s, tbl_anmeldedaten a
                                                            WHERE s.TeilnehmerID = a.TeilnehmerID
                                                            AND Jahr = '.$jahr.'
                                                            GROUP BY Taschengeld';
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
                                            $colors = array('"green"','"red"');
                                            $title = "Taschengeldverwaltung?";
                                            $legende = false;
                                            echo 'createChart(['.implode(",",$labels) ."] ,[". implode(",",$data).'],"'. $type.'",['. implode(",",$colors).'],"'. $title.'", '.$legende.')';
                                            break;

                                            case 8: //KFZ
                                                $data = array();
                                                $labels = array();
                                                try{
                                                    $db = new PDO("$host; $name" ,$user,$pass);
                                                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                            
                                                    $sql = 'SELECT KFZ AS name, COUNT(KFZ) AS anzahl
                                                                FROM tbl_stammdaten s, tbl_anmeldedaten a
                                                                WHERE s.TeilnehmerID = a.TeilnehmerID
                                                                AND Jahr = '.$jahr.'
                                                                GROUP BY KFZ';
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
                                                $colors = array('"green"','"red"');
                                                $title = "Beförderung in privat KFZ?";
                                                $legende = false;
                                                echo 'createChart(['.implode(",",$labels) ."] ,[". implode(",",$data).'],"'. $type.'",['. implode(",",$colors).'],"'. $title.'", '.$legende.')';
                                                break;

                                                case 9: //Shirts
                                                    $data = array();
                                                    $labels = array();
                                                    try{
                                                        $db = new PDO("$host; $name" ,$user,$pass);
                                                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                
                                                        $sql = 'SELECT shirts AS name, COUNT(shirts) AS anzahl
                                                                    FROM tbl_stammdaten s, tbl_anmeldedaten a
                                                                    WHERE s.TeilnehmerID = a.TeilnehmerID
                                                                    AND Jahr = '.$jahr.'
                                                                    GROUP BY shirts';
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
                                                    $colors = array('"green"','"red"');
                                                    $title = "Shirts?";
                                                    $legende = false;
                                                    echo 'createChart(['.implode(",",$labels) ."] ,[". implode(",",$data).'],"'. $type.'",['. implode(",",$colors).'],"'. $title.'", '.$legende.')';
                                                    break;

                                                    case 10: //Anzahl an Shirts
                                                        $data = array();
                                                        $labels = array();
                                                        try{
                                                            $db = new PDO("$host; $name" ,$user,$pass);
                                                            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                    
                                                            $sql = 'SELECT Shirts_anzahl AS name, COUNT(Shirts_anzahl) AS anzahl
                                                                        FROM tbl_stammdaten s, tbl_anmeldedaten a
                                                                        WHERE s.TeilnehmerID = a.TeilnehmerID
                                                                        AND Jahr = '.$jahr.'
                                                                        AND Shirts_anzahl != ""
                                                                        GROUP BY Shirts_anzahl';
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
                                                        $colors = array('"black"','"black"','"black"','"black"','"black"');
                                                        $title = "Anzahl an Shirts pro Kind";
                                                        $legende = false;
                                                        echo 'createChart(['.implode(",",$labels) ."] ,[". implode(",",$data).'],"'. $type.'",['. implode(",",$colors).'],"'. $title.'", '.$legende.')';
                                                        break;

                                                        case 11: //Größen der Shirts
                                                            $data = array();
                                                            $labels = array();
                                                            try{
                                                                $db = new PDO("$host; $name" ,$user,$pass);
                                                                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                        
                                                                $sql = 'SELECT Shirts_groesse AS name, COUNT(Shirts_groesse) AS anzahl
                                                                            FROM tbl_stammdaten s, tbl_anmeldedaten a
                                                                            WHERE s.TeilnehmerID = a.TeilnehmerID
                                                                            AND Jahr = '.$jahr.'
                                                                            AND Shirts_groesse != ""
                                                                            GROUP BY Shirts_groesse';
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
                                                            $colors = array('"red"','"blue"','"lightblue"','"orange"','"pink"','"purple"','"grey"','"yellow"','"lightred"','"lightgrey"');
                                                            $title = "Größe von Shirts";
                                                            $legende = true;
                                                            echo 'createPieChart(['.implode(",",$labels) ."] ,[". implode(",",$data).'],"'. $type.'",['. implode(",",$colors).'],"'. $title.'", '.$legende.')';
                                                            break;

                                                            case 12: //Größen der Shirts
                                                                $data = array();
                                                                $labels = array();
                                                                try{
                                                                    $db = new PDO("$host; $name" ,$user,$pass);
                                                                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                            
                                                                    $sql = 'SELECT umfrage AS name, COUNT(umfrage) AS anzahl
                                                                                FROM tbl_stammdaten s, tbl_anmeldedaten a
                                                                                WHERE s.TeilnehmerID = a.TeilnehmerID
                                                                                AND Jahr = '.$jahr.'
                                                                                GROUP BY umfrage';
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
                                                                $colors = array('"red"','"blue"','"lightblue"','"orange"','"pink"','"purple"','"grey"','"yellow"','"lightred"','"lightgrey"');
                                                                $title = "Wie haben sie von uns Erfahren?";
                                                                $legende = false;
                                                                echo 'createChart(['.implode(",",$labels) ."] ,[". implode(",",$data).'],"'. $type.'",['. implode(",",$colors).'],"'. $title.'", '.$legende.')';
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