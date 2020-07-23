<h2>Hier siehst du detailiert alle Anmeldungen.</h2>
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

    try{
        $db = new PDO("$host; $name" ,$user,$pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $i = 0;
        echo "<table class='avw'>";
        echo "<tr class='avw_head'><td class='avw_head avw_id'></td><td class='avw_head'>Vorname des Teilnehmers</td><td class='avw_head'>Nachname des Teilnehmers</td><td class='avw_head'>Geschlecht</td><td class='avw_head'>Geburtstag</td><td class='avw_head'>Alter im Lager</td><td class='avw_head'>Vorname des Erzb</td><td class='avw_head'>Nachname des Erzb</td><td class='avw_head'>Straße</td><td class='avw_head'>Postleitzahl</td><td class='avw_head'>Ort</td><td class='avw_head'>Telefon (privat)</td><td class='avw_head'>Telefon (Handy)</td><td class='avw_head'>Telefon (dienstl.)</td><td class='avw_head'>E-Mail-Adresse</td><td class='avw_head'>Mitglied</td><td class='avw_head'>Mitarbeiter</td><td class='avw_head'>Schwimmer</td><td class='avw_head'>Schwimmstufe</td><td class='avw_head'>Badeerlaubnis</td><td class='avw_head'>Springen ins Wasser</td><td class='avw_head'>Ernaehrung</td><td class='avw_head'>Krankheiten</td><td class='avw_head'>Medikamente</td><td class='avw_head'>Taschengeld</td><td class='avw_head'>Art der Versciherung</td><td class='avw_head'>Name der Versicherung</td><td class='avw_head'>Ptivate KFZ</td><td class='avw_head'>Ratenzahlung</td><td class='avw_head'>Tshirts</td><td class='avw_head'>Datum der Anmeldung</td><td class='avw_head'>IP-Adresse der Anmeldung</td></tr>";

        $sql = "SELECT * 
                    FROM tbl_stammdaten s,tbl_srgb e, tbl_anmeldedaten a
                    WHERE s.TeilnehmerID = e.TeilnehmerID
                    AND s.TeilnehmerID = a.TeilnehmerID
                    AND Jahr = $jahr 
                    ORDER BY Geschlecht, nachname, Vorname;";
        foreach ($db->query($sql) as $row){


            $i = $i + 1;
            echo 
            '<tr class="avw">
                <td class="avw">'.$i.'</td>
                <td class="avw">'.$row['Nachname'].'</td>
                <td class="avw">'.$row['Vorname'].'</td>
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
                <td class="avw">'.$row['Datum'].'</td>
                <td class="avw">'.$row['IP_Adresse'].'</td>
            </tr>';
        };
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