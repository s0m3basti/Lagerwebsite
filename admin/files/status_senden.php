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

    $prozess = null;

    if($_GET['von'] == "voranmeldung" && $_GET['nach'] == "anmeldung"){
        $prozess = "vorzanm"; 
    }
    if($_GET['von'] == "anmeldung" && $_GET['nach'] == "keine_anmeldung"){
        $prozess = "anmzkam"; 
    }
    if($_GET['von'] == "keine_anmeldung" && $_GET['nach'] == "voranmeldung"){
        $prozess = "kamzvor"; 
    }
    if($_GET['von'] == "keine_anmeldung" && $_GET['nach'] == "anmeldung"){
        $prozess = "kamzanm"; 
    }

    switch($prozess){
        case null:
            header("Location:../status.php?message=1");
            break;
        case "vorzanm":
            /* Neu Daten einlesen */
            $new_anfang = $_POST['anfang'];
            $new_ende = $_POST['ende'];
            $new_jahr = $_POST['jahr'];
            $new_status = "anmeldung";

            /*neu Daten umformatieren*/
            $new_anfang = strtotime($new_anfang);
            $new_anfang = date('d.m.Y',$new_anfang);
            $new_ende = strtotime($new_ende);
            $new_ende= date('d.m.Y', $new_ende);

            /* neu Daten speichern */
            $handle = fopen("../../files/daten.txt", "w");
            fwrite($handle, $new_anfang."\n");
            fwrite($handle, $new_ende."\n");
            fwrite($handle, $new_jahr."\n");
            fwrite($handle, $preis);
            fwrite($handle, $shirtpreis);
            fwrite($handle, $kontaktmail);
            fwrite($handle, $anmeldungmail);
            fwrite($handle, $supportmail);
            fwrite($handle, $new_status);
            fclose($handle);


            try{
                $db = new PDO("$host; $name" ,$user,$pass);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            /* Mails an alle Voranmelder versenden */
                $mail_count = 0;

                $sql = "SELECT email FROM voranmeldung;";
                foreach ($db->query($sql) as $row){
                    require "status_mail.php";
                    $mail_count = $mail_count + 1;
                }

            /* Löschen der Voranmelder, der Elterndaten und der Anmeldedaten des letzten Jahres. */
                $stmt = $db->prepare("DELETE FROM voranmeldung");
                $stmt->execute();

                $stmt = $db->prepare("DELETE FROM tbl_srgb");
                $stmt->execute();

                $stmt = $db->prepare("DELETE FROM tbl_anmeldedaten");
                $stmt->execute();

            /* message mit Mailanzahl zurückgeben */

                header("Location:../status.php?message=2&mailcount=$mail_count");
            }
            catch(PDOException $e){
                $fehler = $e->getMessage();
                header("Location:../status.php?message=3");
            }
            finally{
                $db = null;
            }
            break;

        case "anmzkam":
            /* Status setzten */
            $new_status = "keine_anmeldung";

            /* neu Daten speichern */
            $handle = fopen("../../files/daten.txt", "w");
            fwrite($handle, $anfang);
            fwrite($handle, $ende);
            fwrite($handle, $jahr);
            fwrite($handle, $preis);
            fwrite($handle, $shirtpreis);
            fwrite($handle, $kontaktmail);
            fwrite($handle, $anmeldungmail);
            fwrite($handle, $supportmail);
            fwrite($handle, $new_status);
            fclose($handle);

            header("Location:../status.php?message=4");

            break;

        case "kamzvor":

            /* Status setzten */
            $new_status = "voranmeldung";

            /* neu Daten speichern */
            $handle = fopen("../../files/daten.txt", "w");
            fwrite($handle, $anfang);
            fwrite($handle, $ende);
            fwrite($handle, $jahr);
            fwrite($handle, $preis);
            fwrite($handle, $shirtpreis);
            fwrite($handle, $kontaktmail);
            fwrite($handle, $anmeldungmail);
            fwrite($handle, $supportmail);
            fwrite($handle, $new_status);
            fclose($handle);

            header("Location:../status.php?message=5");

            break;

        case "kamzanm":
            /* Status setzten */
            $new_status = "anmeldung";

            /* neu Daten speichern */
            $handle = fopen("../../files/daten.txt", "w");
            fwrite($handle, $anfang);
            fwrite($handle, $ende);
            fwrite($handle, $jahr);
            fwrite($handle, $preis);
            fwrite($handle, $shirtpreis);
            fwrite($handle, $kontaktmail);
            fwrite($handle, $anmeldungmail);
            fwrite($handle, $supportmail);
            fwrite($handle, $new_status);
            fclose($handle);

            header("Location:../status.php?message=6");

            break;
    }

/*
    voranmeldung --> anmeldung
        Daten werden überprüft und geändert -
        mail wird an alle voranmelder gesendet -
        srgb und anmeldedaten werden gelöscht -
        stammdaten bleiben erhalten -
        status wird geändert - 

    anmeldung --> keine_anmeldung
        alle Daten bleiben erhalten -  
        status wird geändert - 

    keine_anmeldung --> voranmeldung
        voranmeldungstabelle wird gelöscht
        status wird geändert

        
    keine_anmeldung --> anmeldung
        alle Daten bleiben erhalten -
        status wird geändert -
*/

?>