<?php
    session_start();
    if(!isset($_SESSION['userid'])) {
        header("Location: ../login.php?er=1");
    }
+
    require "../../files/linkmaker.php";
    require "../../files/datenzugriff.php";
    require "../../Datenbank/writer.php";
    $id = $_GET['id'];

    function changetest($old, $new){
        if($old == $new){
            return 0;
        }
        else{

            $logtext = 'Die Anmeldung von '.$_SESSION['id'].' ('.$_SESSION['k_vorname'].' '.$_SESSION['k_nachname'].') wurde am '.date("Y-m-d H:i:s").' von '.$_SESSION['userid'].' ('.$_SESSION['vorname'].' '.$_SESSION['nachname'].') bearbeitet.  '.$old.' --> '.$new.'.';

            $log = "../../changelogs/anmeldung.txt";
            $logdata = fopen("$log", "a");
            fwrite($logdata, $logtext."\n");
            fclose($logdata);
            return 1;
        }
    }

    switch($_GET["type"]){
        case 1:
            if(changetest($_SESSION['k_vorname'], $_POST["vorname"]) + 
                changetest($_SESSION["k_nachname"], $_POST["nachname"]) + 
                changetest($_SESSION["geschlecht"], $_POST["geschlecht"]) + 
                changetest($_SESSION["gebdatum"], $_POST["gebdatum"]) > 0){
                    
    
                $anfang = strtotime($anfang);
                $anfang = date("Y-m-d", $anfang);
    
                $lageralter = $anfang-$_POST["gebdatum"];
                
                try{
                    $db = new PDO("$host; $name" ,$user,$pass);
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                    $sql = 'UPDATE tbl_stammdaten SET Nachname = "'.$_POST["nachname"].'", Vorname = "'.$_POST["vorname"].'", Geschlecht = "'.$_POST["geschlecht"].'", Geburtstag = "'.$_POST["gebdatum"].'", LagerAlter = "'.$lageralter.'" WHERE TeilnehmerID = "'.$id.'";';
                                    
                    $stmt = $db->prepare($sql);
                    $stmt->execute();

                    header("Location:../verwalten.php?message=succsess");
                }
                catch(PDOException $e){
                    $fehler = $e->getMessage();
                    echo "Es ist ein Fehler bei der Kommunikation mit der Datenbank aufgetreten. </br> $fehler";
                    header("Location:../verwalten.php?message=fail");
                }
                finally{
                    $db = null;
                }
            }            
            break;
        case 2:
            if($_POST["mitglied"] === "on"){
                $mitglied = "ja";
            }
            else{
                $mitglied = "nein";
            }

            if($_POST["mitarbeiter"] === "on"){
                $mitarbeiter = "ja";
            }
            else{
                $mitarbeiter = "nein";
            }
            if(changetest($_SESSION['e_nachname'], $_POST["e_nachname"]) +
                changetest($_SESSION['e_vorname'], $_POST["e_vorname"]) +
                changetest($_SESSION['strasse'], $_POST["strasse"]) +
                changetest($_SESSION['plz'], $_POST["plz"]) +
                changetest($_SESSION['ort'], $_POST["ort"]) + 
                changetest($_SESSION['tel_pri'], $_POST["tel_pri"]) + 
                changetest($_SESSION['tel_handy'], $_POST["tel_handy"]) +
                changetest($_SESSION['tel_dienstl'], $_POST["tel_dienstl"]) +
                changetest($_SESSION['email'], $_POST["email"]) +
                changetest($_SESSION['mitglied'], $mitglied) +
                changetest($_SESSION['mitarbeiter'], $mitarbeiter) > 0){

                try{
                    $db = new PDO("$host; $name" ,$user,$pass);
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                    $sql = 'UPDATE tbl_srgb SET 
                        e_Nachname = "'.$_POST["e_nachname"].'", 
                        e_Vorname = "'.$_POST["e_vorname"].'", 
                        Strasse = "'.$_POST["strasse"].'", 
                        PLZ = "'.$_POST["plz"].'", 
                        Ort = "'.$_POST["ort"].'", 
                        Tel_pri = "'.$_POST["tel_pri"].'", 
                        Tel_handy = "'.$_POST["tel_handy"].'", 
                        Tel_dienstl = "'.$_POST["tel_dienstl"].'", 
                        email = "'.$_POST["email"].'", 
                        mitglied = "'.$mitglied.'", 
                        mitarbeiter = "'.$mitarbeiter.'" 
                        WHERE TeilnehmerID = "'.$id.'";';
                                    
                    $stmt = $db->prepare($sql);
                    $stmt->execute();

                    header("Location:../verwalten.php?message=succsess");
                }
                catch(PDOException $e){
                    $fehler = $e->getMessage();
                    echo "Es ist ein Fehler bei der Kommunikation mit der Datenbank aufgetreten. </br> $fehler";
                    header("Location:../verwalten.php?message=fail");
                }
                finally{
                    $db = null;
                }

            }
            break;
        case 3:
            if(changetest($_SESSION['schwimmer'], $_POST["schwimmer"]) +
                changetest($_SESSION['schwimmstufe'], $_POST["schwimmstufe"]) +
                changetest($_SESSION['badeerlaubnis'], $_POST["badeerlaubnis"]) + 
                changetest($_SESSION['springen'], $_POST["springen"]) +
                changetest($_SESSION['ernaehrung'], $_POST["ernaehrung"]) + 
                changetest($_SESSION['krankheit'], $_POST["krankheit"]) + 
                changetest($_SESSION['medikamente'], $_POST["medikamente"]) + 
                changetest($_SESSION['taschengeld'], $_POST["taschengeld"]) + 
                changetest($_SESSION['versicherung_art'], $_POST["versicherung_art"]) + 
                changetest($_SESSION['versicherung_name'], $_POST["versicherung_name"]) + 
                changetest($_SESSION['kfz'], $_POST["kfz"]) +
                changetest($_SESSION['ratenzahlung'], $_POST["ratenzahlung"]) + 
                changetest($_SESSION['raten_anzahl'], $_POST["raten_anzahl"]) +
                changetest($_SESSION['shirts'], $_POST["shirts"]) + 
                changetest($_SESSION['shirts_anzahl'], $_POST["shirts_anzahl"]) + 
                changetest($_SESSION['shirts_groesse'], $_POST["shirts_groesse"]) > 0){

                try{
                    $db = new PDO("$host; $name" ,$user,$pass);
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                    $sql = 'UPDATE tbl_anmeldedaten SET 
                        Schwimmer = "'.$_POST["schwimmer"].'", 
                        Schwimmstufe = "'.$_POST["schwimmstufe"].'", 
                        Badeerlaubnis = "'.$_POST["badeerlaubnis"].'", 
                        Springen = "'.$_POST["springen"].'", 
                        Ernaehrung = "'.$_POST["ernaehrung"].'", 
                        Krankheit = "'.$_POST["krankheit"].'", 
                        Medikamente = "'.$_POST["medikamente"].'", 
                        Taschengeld = "'.$_POST["taschengeld"].'", 
                        Versicherung_art = "'.$_POST["versicherung_art"].'", 
                        Versicherung_name = "'.$_POST["versicherung_name"].'", 
                        KFZ = "'.$_POST["kfz"].'",
                        Ratenzahlung = "'.$_POST["ratenzahlung"].'",
                        Raten_anzahl = "'.$_POST["raten_anzahl"].'",
                        Shirts = "'.$_POST["shirts"].'",
                        Shirts_anzahl = "'.$_POST["shirts_anzahl"].'",
                        Shirts_groesse = "'.$_POST["shirts_groesse"].'" 
                        WHERE TeilnehmerID = "'.$id.'";';
                                    
                    $stmt = $db->prepare($sql);
                    $stmt->execute();

                    header("Location:../verwalten.php?message=succsess");
                }
                catch(PDOException $e){
                    $fehler = $e->getMessage();
                    echo "Es ist ein Fehler bei der Kommunikation mit der Datenbank aufgetreten. </br> $fehler";
                    header("Location:../verwalten.php?message=fail");
                }
                finally{
                    $db = null;
                }

            }
            break;
        case 4:

            $logtext = 'Die Anmeldung von '.$_SESSION['k_vorname'].' '.$_SESSION['k_nachname'].' wurde am '.date("Y-m-d H:i:s").' von '.$_SESSION['userid'].' ('.$_SESSION['vorname'].' '.$_SESSION['nachname'].') gelöscht.';

            $log = "../../changelogs/anmeldung.txt";
            $logdata = fopen("$log", "a");
            fwrite($logdata, $logtext."\n");
            fclose($logdata);

            try{
                $db = new PDO("$host; $name" ,$user,$pass);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
                $sql = 'UPDATE tbl_stammdaten SET Jahr = 0 WHERE TeilnehmerID = "'.$id.'";';
                                
                $stmt = $db->prepare($sql);
                $stmt->execute();

                header("Location:../verwalten.php?message=succsess");
            }
            catch(PDOException $e){
                $fehler = $e->getMessage();
                echo "Es ist ein Fehler bei der Kommunikation mit der Datenbank aufgetreten. </br> $fehler";
                header("Location:../verwalten.php?message=fail");
            }
            finally{
                $db = null;
            }
            break;
    }
?>