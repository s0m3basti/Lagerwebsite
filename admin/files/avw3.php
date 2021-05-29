<h2>Hier werden alle Anmeldungen komplett dargestellt.</h2>
<h2>Um in den Bearbeitungsmodus zu kommen, klicke bitte doppelt auf die zu bearbeitende Zeile.</h2>
<?php

    function leer($var){
        if($var == "" || $var == null ){
            return "N/A";
        }
        else{
            return $var;
        }
    }
    function ratenanzahl($var, $anzahl){
        if($var == "nein"){
            return "nein";
        }
        else{
            return $var.": ".$anzahl;
        }
    }
    function shirtanzahl($var, $anzahl, $gr){
        if($var == "nein"){
            return "nein";
        }
        else{
            return $var." : ".$anzahl." : ".$gr;
        }
    }
    function notizen($var){
        if($var == null || $var == ""){
            return "n";
        }
        else{
            return "y";
        }
    }

    try{
        $db = new PDO("$host; $name" ,$user,$pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $i = 0;
        echo "<table class='avw'>";
        echo "<tr class='avw_head'>
                <td class='avw_head avw_id'><a href='?sort=Geschlecht,LagerAlter,Nachname,Vorname' class='index_head'><img src='img/back-arrow.png' height='20'></a></td>
                <td class='avw_head'><a href='?sort=Vorname' class='index_head'>Vorname des Teilnehmers</a></td>
                <td class='avw_head'><a href='?sort=Nachname' class='index_head'>Nachname des Teilnehmers</a></td>
                <td class='avw_head'><a href='?sort=Geschlecht' class='index_head'>Geschlecht</td><td class='avw_head'>Geburtstag</a></td>
                <td class='avw_head'><a href='?sort=LagerAlter' class='index_head'>Alter im Lager</a></td>
                <td class='avw_head'><a href='?sort=e_Vorname' class='index_head'>Vorname des Erzb</a></td>
                <td class='avw_head'><a href='?sort=e_Nachname' class='index_head'>Nachname des Erzb</a></td>
                <td class='avw_head'><a href='?sort=Strasse' class='index_head'>Straße</a></td>
                <td class='avw_head'><a href='?sort=PLZ' class='index_head'>Postleitzahl</a></td>
                <td class='avw_head'><a href='?sort=Ort' class='index_head'>Ort</a></td>
                <td class='avw_head'><a href='?sort=Tel_pri' class='index_head'>Telefon (privat)</a></td>
                <td class='avw_head'><a href='?sort=Tel_handy' class='index_head'>Telefon (Handy)</a></td>
                <td class='avw_head'><a href='?sort=Tel_dienstl' class='index_head'>Telefon (dienstl.)</a></td>
                <td class='avw_head'><a href='?sort=email' class='index_head'>E-Mail-Adresse</a></td>
                <td class='avw_head'><a href='?sort=mitglied' class='index_head'>Mitglied</a></td>
                <td class='avw_head'><a href='?sort=mitarbeiter' class='index_head'>Mitarbeiter</a></td>
                <td class='avw_head'><a href='?sort=Schwimmer' class='index_head'>Schwimmer</a></td>
                <td class='avw_head'><a href='?sort=Schwimmstufe' class='index_head'>Schwimmstufe</a></td>
                <td class='avw_head'><a href='?sort=Badeerlaubnis' class='index_head'>Badeerlaubnis</a></td>
                <td class='avw_head'><a href='?sort=Springen' class='index_head'>Springen ins Wasser</a></td>
                <td class='avw_head'><a href='?sort=Ernaehrung' class='index_head'>Ernaehrung</a></td>
                <td class='avw_head'><a href='?sort=Krankheit' class='index_head'>Krankheiten</a></td>
                <td class='avw_head'><a href='?sort=Medikamente' class='index_head'>Medikamente</a></td>
                <td class='avw_head'><a href='?sort=Taschengeld' class='index_head'>Taschengeld</a></td>
                <td class='avw_head'><a href='?sort=Versicherung_art' class='index_head'>Art der Versciherung</a></td>
                <td class='avw_head'><a href='?sort=Versicherung_name' class='index_head'>Name der Versicherung</a></td>
                <td class='avw_head'><a href='?sort=KFZ' class='index_head'>Private KFZ</a></td>
                <td class='avw_head'><a href='?sort=Ratenzahlung' class='index_head'>Ratenzahlung</a></td>
                <td class='avw_head'><a href='?sort=Shirts' class='index_head'>Tshirts</a></td>
                <td class='avw_head'><a href='?sort=umfrage' class='index_head'>Umfrage</a></td>
                <td class='avw_head'><a href='?sort=art' class='index_head'>Art</a></td>
                <td class='avw_head'><a href='?sort=datum' class='index_head'>Datum der Anmeldung</a></td>
                <td class='avw_head'><a href='?sort=Notizen' class='index_head'>Notizen</a></td>
                <td class='avw_head'><a href='?sort=IP_Adresse' class='index_head'>IP-Adresse der Anmeldung</a></td>
            </tr>";

        if(!isset($_GET['sort'])){
            $sort = "Geschlecht,LagerAlter,Nachname,Vorname";
        }
        else{
            $sort = $_GET['sort'];
        }    

        $sql = "SELECT * 
                    FROM tbl_stammdaten s,tbl_srgb e, tbl_anmeldedaten a
                    WHERE s.TeilnehmerID = e.TeilnehmerID
                    AND s.TeilnehmerID = a.TeilnehmerID
                    AND Jahr = $jahr 
                    ORDER BY $sort;";
        foreach ($db->query($sql) as $row){


            $i = $i + 1;
            echo 
            '<tr class="avw" ondblclick="window.location=\'verwalten.php?id='.$row['TeilnehmerID'].'\'">
                <td class="avw">'.$i.'</td>
                <td class="avw">'.$row['Vorname'].'</td>
                <td class="avw">'.$row['Nachname'].'</td>
                <td class="avw">'.$row['Geschlecht'].'</td>
                <td class="avw">'.date('d.m.Y',strtotime($row['Geburtstag'])).'</td>
                <td class="avw">'.$row['LagerAlter'].'</td>
                <td class="avw">'.$row['e_Vorname'].'</td>
                <td class="avw">'.$row['e_Nachname'].'</td>
                <td class="avw">'.$row['Strasse'].'</td>
                <td class="avw">'.$row['PLZ'].'</td>
                <td class="avw">'.$row['Ort'].'</td>
                <td class="avw">'.leer($row['Tel_pri']).'</td>
                <td class="avw">'.leer($row['Tel_handy']).'</td>
                <td class="avw">'.leer($row['Tel_dienstl']).'</td>
                <td class="avw">'.$row['email'].'</td>
                <td class="avw">'.$row['mitglied'].'</td>
                <td class="avw">'.$row['mitarbeiter'].'</td>
                <td class="avw">'.$row['Schwimmer'].'</td>
                <td class="avw">'.leer($row['Schwimmstufe']).'</td>
                <td class="avw">'.$row['Badeerlaubnis'].'</td>
                <td class="avw">'.$row['Springen'].'</td>
                <td class="avw text">'.leer($row['Ernaehrung']).'</td>
                <td class="avw text">'.leer($row['Krankheit']).'</td>
                <td class="avw text">'.leer($row['Medikamente']).'</td>
                <td class="avw">'.$row['Taschengeld'].'</td>
                <td class="avw">'.$row['Versicherung_art'].'</td>
                <td class="avw">'.$row['Versicherung_name'].'</td>
                <td class="avw">'.$row['KFZ'].'</td>
                <td class="avw">'.ratenanzahl($row['Ratenzahlung'],$row['Raten_anzahl']).'</td>
                <td class="avw">'.shirtanzahl($row['Shirts'],$row['Shirts_anzahl'],$row['Shirts_groesse']).'</td>
                <td class="avw">'.$row['umfrage'].'</td>
                <td class="avw">'.$row['art'].'</td>
                <td class="avw">'.$row['Datum'].'</td>
                <td class="avw">'.notizen($row['Notizen']).'</td>
                <td class="avw">'.$row['IP_Adresse'].'</td>
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
?>