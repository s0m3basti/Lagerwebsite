<?php
    $id = $_GET['id'];

    try{
        $db = new PDO("$host; $name" ,$user,$pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT * 
                FROM tbl_stammdaten s,tbl_srgb e, tbl_anmeldedaten a
                WHERE s.TeilnehmerID = e.TeilnehmerID
                AND s.TeilnehmerID = a.TeilnehmerID
                AND s.TeilnehmerID = "'.$id.'";';

        foreach ($db->query($sql) as $row);

        $vorname = $row['Vorname'];
        $nachname = $row['Nachname'];
        $geschlecht = $row['Geschlecht'];
        $gebdatum = $row['Geburtstag'];
        $e_nachname = $row['e_Nachname'];
        $e_vorname = $row['e_Vorname'];
        $strasse = $row['Strasse'];
        $plz = $row['PLZ'];
        $ort = $row['Ort'];
        $tel_pri = $row['Tel_pri'];
        $tel_handy = $row['Tel_handy'];
        $tel_dienstl = $row['Tel_dienstl'];
        $email = $row['email'];
        $mitglied = $row['mitglied'];
        $mitarbeiter = $row['mitarbeiter'];
        $schwimmer = $row['Schwimmer'];
        $schwimmstufe = $row['Schwimmstufe'];
        $badeerlaubnis = $row['Badeerlaubnis'];
        $springen = $row['Springen'];
        $ernaehrung = $row['Ernaehrung'];
        $krankheit = $row['Krankheit'];
        $medikamente = $row['Medikamente'];
        $taschengeld = $row['Taschengeld'];
        $versicherung_art = $row['Versicherung_art'];
        $versicherung_name = $row['Versicherung_name'];
        $kfz = $row['KFZ'];
        $ratenzahlung = $row['Ratenzahlung'];
        $raten_anzahl = $row['Raten_anzahl'];
        $shirts = $row['Shirts'];
        $shirts_anzahl = $row['Shirts_anzahl'];
        $shirts_groesse = $row['Shirts_groesse'];

        $_SESSION['id'] = $id;
        $_SESSION['k_nachname'] = $nachname;
        $_SESSION['k_vorname'] = $vorname;
        $_SESSION['geschlecht'] = $geschlecht;
        $_SESSION['gebdatum'] = $gebdatum;
        $_SESSION['e_nachname'] = $e_nachname;
        $_SESSION['e_vorname'] = $e_vorname;
        $_SESSION['strasse'] = $strasse;
        $_SESSION['plz'] = $plz;
        $_SESSION['ort'] = $ort;
        $_SESSION['tel_pri'] = $tel_pri;
        $_SESSION['tel_handy'] = $tel_handy;
        $_SESSION['tel_dienstl'] = $tel_dienstl;
        $_SESSION['email'] = $email;
        $_SESSION['mitglied'] = $mitglied;
        $_SESSION['mitarbeiter'] = $mitarbeiter;
        $_SESSION['schwimmer'] = $schwimmer;
        $_SESSION['schwimmstufe'] = $schwimmstufe;
        $_SESSION['badeerlaubnis'] = $badeerlaubnis;
        $_SESSION['springen'] = $springen;
        $_SESSION['ernaehrung'] = $ernaehrung;
        $_SESSION['krankheit'] = $krankheit;
        $_SESSION['medikamente'] = $medikamente;
        $_SESSION['taschengeld'] = $taschengeld;
        $_SESSION['versicherung_art'] = $versicherung_art;
        $_SESSION['versicherung_name'] = $versicherung_name;
        $_SESSION['kfz'] = $kfz;
        $_SESSION['ratenzahlung'] = $ratenzahlung;
        $_SESSION['raten_anzahl'] = $raten_anzahl;
        $_SESSION['shirts'] = $shirts;
        $_SESSION['shirts_anzahl'] = $shirts_anzahl;
        $_SESSION['shirts_groesse'] = $shirts_groesse;
    }
    catch(PDOException $e){
        $fehler = $e->getMessage();
        echo "Es ist ein Fehler bei der Kommunikation mit der Datenbank aufgetreten. </br> $fehler";
    }
    finally{
        $db = null;
    }

    echo '<h2>Die Anmeldung von '.$vorname.' '.$nachname.', geboren am '.date("d.m.Y",strtotime($gebdatum)).', kann hier bearbeitet oder gelöscht werden.</h2>';
    echo "<p>Sei dir bewusst das alle Änderungen auswirkungen mit sich tragen, wenn eine Anmeldung gelöscht wurde ist sie weg. <br><b>Alle Änderungen werden getraked!</b></p>";

    switch($_GET['type']){
        case 1:
            require "files/avwedit1.php";
            break;
        case 2:
            require "files/avwedit2.php";
            break;
        case 3:
            require "files/avwedit3.php";
            break;
        case 4: 
            require "files/avwedit4.php";
            break;
    }

    echo '<a href="verwalten.php?id='.$id.'"><button type="button" class="avw back">Zurück</button></a>';
?>