<h2>Um in den Bearbeitungsmodus zu kommen, klicke bitte doppelt auf die zu bearbeitende Zeile.</h2>
<?php
    try{
        $db = new PDO("$host; $name" ,$user,$pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $i = 0;
        echo "<table class='avw'>";
        echo "<tr class='avw_head'><td></td><td>Vorname des Teilnehmers</td><td>Nachname des Teilnehmers</td><td>Geschlecht</td><td>Geburtstag</td><td>Alter im Lager</td><td>Vorname des Erzb</td><td>Nachname des Erzb</td><td>Straße</td><td>Postleitzahl</td><td>Ort</td><td>Telefon (privat)</td><td>Telefon (Handy)</td><td>Telefon (dienstl.)</td><td>E-Mail-Adresse</td><td>Mitglied</td><td>Mitarbeiter</td><td>Schwimmer</td><td>Schwimmstufe</td><td>Badeerlaubnis</td><td>Springen ins Wasser</td><td>Ernaehrung</td><td>Krankheiten</td><td>Medikamente</td><td>Taschengeld</td><td>Art der Versciherung</td><td>Name der Versicherung</td><td>Ptivate KFZ</td><td>Ratenzahlung</td><td>Tshirts</td><td>Datum der Anmeldung</td><td>IP-Adresse der Anmeldung</td></tr>";

        $sql = "SELECT * 
                    FROM tbl_stammdaten s,tbl_srgb e, tbl_anmeldedaten a
                    WHERE s.TeilnehmerID = e.TeilnehmerID
                    AND s.TeilnehmerID = a.TeilnehmerID
                    AND Jahr = $jahr 
                    ORDER BY Geschlecht, nachname, Vorname;";
        foreach ($db->query($sql) as $row){

            $i = $i + 1;
            echo "<tr class='avw'><td class='avw'>".$i."</td><td class='avw'>".$row['Nachname']."</td><td class='avw'>".$row['Vorname']."</td><td class='avw'>".$row['Geschlecht']."</td><td class='avw'>".date('d.m.Y',strtotime($row['Geburtstag']))."</td><td class='avw'>".$row['LagerAlter']."</td></tr>";
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