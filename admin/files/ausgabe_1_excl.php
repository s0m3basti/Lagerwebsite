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
    
    require '../../files/linkmaker.php';
    require '../../files/datenzugriff.php';
    require '../../Datenbank/writer.php';

    $logtext = 'Das Dokument: Anmeldungsübersicht wurde am '.date("Y-m-d H:i:s").' von '.$_SESSION['userid'].' ('.$_SESSION['vorname'].' '.$_SESSION['nachname'].') erstellt und heruntergeladen.';
    $logtext = utf8_decode($logtext);
    $log = "../../changelogs/ausgabe.txt";
    $logdata = fopen("$log", "a");
    fwrite($logdata, $logtext."\n");
    fclose($logdata);

    $html = '<br><br><br><br><br>
                <table style="width: 100%; font-size: 10pt; border: solid 1px black; padding: 2px;">
                <tr style="border: solid 1px black; text-align: center; background-color: lightgrey;">
                    <td style="border: solid 1px black; width: 3%;"></td>
                    <td style="border: solid 1px black;width: 21%;">Vorname</td>
                    <td style="border: solid 1px black;width: 21%;">Nachname</td>
                    <td style="border: solid 1px black;width: 10%;">Geschlecht</td>
                    <td style="border: solid 1px black;width: 10%;">Geburtstag</td>
                    <td style="border: solid 1px black;width: 5%;">Alter im Lager</td>
                    <td style="border: solid 1px black;width: 10%;">Gruppe</td>
                    <td style="border: solid 1px black;width: 10%;">Betreuer</td>
                    <td style="border: solid 1px black;width: 10%;">Zelt</td>
                </tr>';
                try{
                    $db = new PDO("$host; $name" ,$user,$pass);
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                    $i = 0;
                    $g = 0;
                    $sql = "SELECT * 
                            FROM tbl_stammdaten 
                            WHERE Jahr = $jahr 
                            ORDER BY Geschlecht, LagerAlter, Nachname, Vorname DESC;";
                    foreach ($db->query($sql) as $row){
                        $i++;

                        if($row['Geschlecht'] == "maennlich"){
                            $html.= '<tr style="border: solid 1px black;">
                                <td style="border: solid 1px black; text-align:left; background-color: #ccf5ff;">'.$i.'</td>
                                <td style="border: solid 1px black; text-align:right; background-color: #ccf5ff;">'.$row['Vorname'].'</td>
                                <td style="border: solid 1px black; text-align:right; background-color: #ccf5ff;">'.$row['Nachname'].'</td>
                                <td style="border: solid 1px black; text-align:right; background-color: #ccf5ff;">'.$row['Geschlecht'].'</td>
                                <td style="border: solid 1px black; text-align:right; background-color: #ccf5ff;">'.date('d.m.Y',strtotime($row['Geburtstag'])).'</td>
                                <td style="border: solid 1px black; text-align:right; background-color: #ccf5ff;">'.$row['LagerAlter'].'</td>
                                <td style="border-right: solid 1px black; background-color: #ccf5ff;"></td>
                                <td style="border-right: solid 1px black; background-color: #ccf5ff;"></td>
                                <td style="border-right: solid 1px black; background-color: #ccf5ff;"></td>
                                </tr>';
                        }
                        else{
                            if($g == 0){
                                $g++;
                                $html.= '<tr style="border: solid 1px black;">
                                <td style="border: solid 1px black; border-top: solid 2px black; text-align:left; background-color: #ffc299;">'.$i.'</td>
                                <td style="border: solid 1px black; border-top: solid 2px black; text-align:right; background-color: #ffc299;">'.$row['Vorname'].'</td>
                                <td style="border: solid 1px black; border-top: solid 2px black; text-align:right; background-color: #ffc299;">'.$row['Nachname'].'</td>
                                <td style="border: solid 1px black; border-top: solid 2px black; text-align:right; background-color: #ffc299;">'.$row['Geschlecht'].'</td>
                                <td style="border: solid 1px black; border-top: solid 2px black; text-align:right; background-color: #ffc299;">'.date('d.m.Y',strtotime($row['Geburtstag'])).'</td>
                                <td style="border: solid 1px black; border-top: solid 2px black; text-align:right; background-color: #ffc299;">'.$row['LagerAlter'].'</td>
                                <td style="border-right: solid 1px black; border-top: solid 2px black; background-color: #ffc299;"></td>
                                <td style="border-right: solid 1px black; border-top: solid 2px black; background-color: #ffc299;"></td>
                                <td style="border-right: solid 1px black; border-top: solid 2px black; background-color: #ffc299;"></td>
                                </tr>';
                            }   
                            else{
                                $html.= '<tr style="border: solid 1px black;">
                                <td style="border: solid 1px black; text-align:left; background-color: #ffc299;">'.$i.'</td>
                                <td style="border: solid 1px black; text-align:right; background-color: #ffc299;">'.$row['Vorname'].'</td>
                                <td style="border: solid 1px black; text-align:right; background-color: #ffc299;">'.$row['Nachname'].'</td>
                                <td style="border: solid 1px black; text-align:right; background-color: #ffc299;">'.$row['Geschlecht'].'</td>
                                <td style="border: solid 1px black; text-align:right; background-color: #ffc299;">'.date('d.m.Y',strtotime($row['Geburtstag'])).'</td>
                                <td style="border: solid 1px black; text-align:right; background-color: #ffc299;">'.$row['LagerAlter'].'</td>
                                <td style="border-right: solid 1px black; background-color: #ffc299;"></td>
                                <td style="border-right: solid 1px black; background-color: #ffc299;"></td>
                                <td style="border-right: solid 1px black; background-color: #ffc299;"></td>
                                </tr>';
                            }
                        }                    
                    };
                }
                catch(PDOException $e){
                    $fehler = $e->getMessage();
                    $html.= "Es ist ein Fehler bei der Kommunikation mit der Datenbank aufgetreten. </br> $fehler";
                }
                finally{
                    $db = null;
                }
            
        $html .= 
            '</table>';

    header('Content-Type: application/xls');
    header('Content-Disposition: attachment; filename=download.xls');
    echo $html;
?>