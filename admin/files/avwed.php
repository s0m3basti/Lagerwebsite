<?php
    
    switch($_GET['type']){
        case 1:
            try{
                $db = new PDO("$host; $name" ,$user,$pass);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
                $sql = 'SELECT * 
                        FROM tbl_stammdaten
                        WHERE TeilnehmerID = "'.$_GET['id'].'";';
                foreach ($db->query($sql) as $row);
        
                $nachname = $row['Vorname'];
                $vorname = $row['Nachname'];
                $geschlecht = $row['Geschlecht'];
                $gebdatum = $row['Geburtstag'];
            }
            catch(PDOException $e){
                $fehler = $e->getMessage();
                echo "Es ist ein Fehler bei der Kommunikation mit der Datenbank aufgetreten. </br> $fehler";
            }
            finally{
                $db = null;
            }

            require "files/avwedit1.php";
            break;
        case 2:
            try{
                $db = new PDO("$host; $name" ,$user,$pass);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
                $sql = 'SELECT * 
                        FROM tbl_srgb
                        WHERE TeilnehmerID = "'.$_GET['id'].'";';
                foreach ($db->query($sql) as $row);
        
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
            }
            catch(PDOException $e){
                $fehler = $e->getMessage();
                echo "Es ist ein Fehler bei der Kommunikation mit der Datenbank aufgetreten. </br> $fehler";
            }
            finally{
                $db = null;
            }

            require "files/avwedit2.php";
            break;
        case 3:
            try{
                $db = new PDO("$host; $name" ,$user,$pass);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
                $sql = 'SELECT * 
                        FROM tbl_anmeldedaten
                        WHERE TeilnehmerID = "'.$_GET['id'].'";';
                foreach ($db->query($sql) as $row);
        
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

            }
            catch(PDOException $e){
                $fehler = $e->getMessage();
                echo "Es ist ein Fehler bei der Kommunikation mit der Datenbank aufgetreten. </br> $fehler";
            }
            finally{
                $db = null;
            }

            require "files/avwedit3.php";
            break;
        case 4: 
            
            require "files/avwedit4.php";
            break;
    }

?>