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
            return false;
        }
        else{

            $logtext = 'Die Anmeldung von '.$_SESSION['k_vorname'].' '.$_SESSION['k_nachname'].' wurde am '.date("Y-m-d H:i:s").' von '.$_SESSION['userid'].' ('.$_SESSION['vorname'].' '.$_SESSION['nachname'].') bearbeitet.  '.$old.' --> '.$new.'.';

            $log = "../../changelogs/anmeldung.txt";
            $logdata = fopen("$log", "a");
            fwrite($logdata, $logtext."\n");
            fclose($logdata);
            return true;
        }
    }

    switch($_GET["type"]){
        case 1:
            if(changetest($_SESSION['k_vorname'], $_POST["vorname"]) || changetest($_SESSION["k_nachname"], $_POST["nachname"]) || changetest($_SESSION["geschlecht"], $_POST["geschlecht"]) || changetest($_SESSION["gebdatum"], $_POST["gebdatum"])){
                    
    
                $anfang = strtotime($anfang);
                $anfang = date("Y-m-d", $anfang);
    
                $lageralter = $anfang-$_POST["gebdatum"];
                
                try{
                    $db = new PDO("$host; $name" ,$user,$pass);
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                    $sql = 'UPDATE tbl_stammdaten SET Nachname = "'.$_POST["vorname"].'", Vorname = "'.$_POST["nachname"].'", Geschlecht = "'.$_POST["geschlecht"].'", Geburtstag = "'.$_POST["gebdatum"].'", LagerAlter = "'.$lageralter.'" WHERE TeilnehmerID = "'.$id.'";';
                                    
                    $stmt = $db->prepare($sql);
                    $stmt->execute();

                    header("Location:../verwalten.php?id=$id&message=succsess");
                }
                catch(PDOException $e){
                    $fehler = $e->getMessage();
                    echo "Es ist ein Fehler bei der Kommunikation mit der Datenbank aufgetreten. </br> $fehler";
                    header("Location:../verwalten.php?id=$id&message=fail");
                }
                finally{
                    $db = null;
                }
            }            
            break;
        case 2:
            if($mitglied === "on"){
                $mitglied = "ja";
            }
            else{
                $mitglied = "nein";
            }

            if($mitarbeiter === "on"){
                $mitarbeiter = "ja";
            }
            else{
                $mitarbeiter = "nein";
            }
            break;
        case 3:
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

    //header("Location:verwalten.php?id=$id");
?>