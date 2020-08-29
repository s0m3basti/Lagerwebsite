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

    $logtext = 'Der Status der Anmeldung wurde am '.date("Y-m-d H:i:s").' von '.$_SESSION['userid'].' ('.$_SESSION['vorname'].' '.$_SESSION['nachname'].') von '.$_GET['von'].' nach '.$_GET['nach'].' geändert.';
    $logtext = utf8_decode($logtext);
    $log = "../../changelogs/status.txt";
    $logdata = fopen("$log", "a");
    fwrite($logdata, $logtext."\n");
    fclose($logdata);

    switch($prozess){
        case null:
            header("Location:../status.php?message=1");
            break;
        case "vorzanm":
            /* Neu Daten einlesen */
            $new_anfang = $_POST['anfang'];
            $new_ende = $_POST['ende'];
            $new_jahr = $_POST['jahr'];
            $new_preis = $_POST['preis'];
            $new_frühbucher = $_POST['frühbucher'];
            $new_frühbis = $_POST['frühbis'];
            $new_shirtpreis = $_POST['shirtpreis'];
            $new_status = "anmeldung";

            /*neu Daten umformatieren*/
            $new_anfang = strtotime($new_anfang);
            $new_anfang = date('d.m.Y',$new_anfang);
            $new_ende = strtotime($new_ende);
            $new_ende= date('d.m.Y', $new_ende);
            $new_frühbis = date('d.m.Y', strtotime($new_frühbis));

            /* neu Daten speichern */
            $handle = fopen("../../files/daten.txt", "w");
            fwrite($handle, $new_anfang."\n");
            fwrite($handle, $new_ende."\n");
            fwrite($handle, $new_jahr."\n");
            fwrite($handle, $new_preis."\n");
            fwrite($handle, $new_shirtpreis."\n");
            fwrite($handle, $new_frühbucher."\n");
            fwrite($handle, $new_frühbis."\n");
            fwrite($handle, $kontaktmail);
            fwrite($handle, $anmeldungmail);
            fwrite($handle, $supportmail);
            fwrite($handle, $new_status);
            fclose($handle);


            try{
                $db = new PDO("$host; $name" ,$user,$pass);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            /* wichtige Daten aus Arbeitstabelle kopieren */
                $sql = '
                    INSERT INTO tbl_historie (id, jahr, vorname, nachname, geschlecht, lageralter, schwimmer, badeerlaubnis, springen, 
                                                ernaehrung, taschengeld, kfz, ratenzahlung, shirts, shirts_anzahl, shirts_groesse, umfrage, art, datum)
                    SELECT s.TeilnehmerID, s.Jahr, s.Vorname, s.Nachname, s.Geschlecht, s.LagerAlter, a.Schwimmer, a.Badeerlaubnis, a.Springen,
                            a.Ernaehrung, a.Taschengeld, a.KFZ, a.Ratenzahlung, a.Shirts, a.Shirts_anzahl, a.Shirts_groesse, a.umfrage, a.art, a.Datum
                    FROM tbl_stammdaten s , tbl_anmeldedaten a
                    WHERE s.TeilnehmerID = a.TeilnehmerID
                    AND s.Jahr != 0;
                ';
                $stmt = $db->prepare($sql);
                $stmt->execute();

            /* Mails an alle Voranmelder versenden */
                $mail_count = 0;

                $sql = "SELECT email FROM voranmeldung;";
                foreach ($db->query($sql) as $row){
                    require "status_mail.php";
                    $mail_count = $mail_count + 1;
                }
            /* Mails an alle bisherigen Teilnehmer senden */
            // Kann später aktiviert werden
                // $sql = "SELECT e.email 
                //         FROM tbl_stammdaten s, tbl_srgb e
                //         WHERE Jahr = $new_jahr-1 
                //         AND s.TeilnehmerID = e.TeilnehmerID;";
                // foreach ($db->query($sql) as $row){
                //         require "status_mail.php";
                //         $mail_count++;
                // }

            /* Löschen der Voranmelder, der Elterndaten und der Anmeldedaten des letzten Jahres. */
                $stmt = $db->prepare("DELETE FROM voranmeldung");
                $stmt->execute();

                $stmt = $db->prepare("DELETE FROM tbl_stammdaten");
                $stmt->execute();

                $stmt = $db->prepare("DELETE FROM tbl_srgb");
                $stmt->execute();

                $stmt = $db->prepare("DELETE FROM tbl_anmeldedaten");
                $stmt->execute();

            /* Leert den changelog der Anmeldungsänderung */
                $fp = fopen("../../changelogs/anmeldung.txt", "w");
                fclose($fp);

            /* Gruppen .csv löschen*/

            $csv = "doc/gruppen.csv";
            unlink($csv);

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
            fwrite($handle, $frühbucher);
            fwrite($handle, $frühbis);
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
            fwrite($handle, $frühbucher);
            fwrite($handle, $frühbis);
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
            fwrite($handle, $frühbucher);
            fwrite($handle, $frühbis);
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