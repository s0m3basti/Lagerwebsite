<?php
    include '../files/linkmaker.php';
    include '../files/datenzugriff.php';

    if($status != "anmeldung"){
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="de">
    <head>
		<title> Online-Anmeldung 2020 | DRK Sommercamp </title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../CSS/styles.css">
        <link rel="stylesheet" href="../CSS/online.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico">
        <script type="text/javascript" src="<?php echo(linkmaker("/files/active.js")) ?>"></script>
        <!--<script defer type="text/javascript"> 
            function countDown(init){
                if (init || --document.getElementById( "counter" ).firstChild.nodeValue > 0 )
	            window.setTimeout( "countDown()" , 1000 );
            };
 
            window.setTimeout('window.location = "http://www.lagertest.de/anmeldung"',10000);
        </script>-->
	</head>
    <body onload="countDown(true)">
        <?php
            include '../files/head.php';
        ?>
        <div class="bg">
        <div id="Inhalt">

        <?php
            $id = $_POST['id'];
            $k_nachname = $_POST['kind_nachname'];
            $k_vorname = $_POST['kind_name'];
            $k_geschlecht = $_POST['kind_geschlecht'];
            $k_geburtstag = $_POST['kind_geb'];
            $e_nachname = $_POST['eltern_name'];
            $e_vorname = $_POST['eltern_vorname'];
            $e_straße = $_POST['strasse'];
            $e_plz = $_POST['plz'];
            $e_ort = $_POST['ort'];
            $e_telpriv = $_POST['tel_priv'];
            $e_telhandy = $_POST['tel_handy'];
            $e_teldienstl = $_POST['tel_dienst'];
            $e_email = $_POST['email'];
            $mitglied = $_POST['mitglied'];
            $mitarbeiter = $_POST['mitarbeiter'];
            $schwimmer = $_POST['schwimmer'];
            $stufe = $_POST['schwimmstufe'];
            $baden = $_POST['baden'];
            $springen = $_POST['springen'];
            $ernaehrung = $_POST['ernaehrung'];
            $krankheit = $_POST['krankheit'];
            $medikamente = $_POST['medizin'];
            $taschengeld = $_POST['geld'];
            $kv_art = $_POST['kv_art'];
            $versicherung = $_POST['versicherung'];
            $kfz = $_POST['kfz'];
            $raten = $_POST['raten'];
            $raten_anzahl = $_POST['anzahl'];
            $shirt = $_POST['shirt'];
            $shirtanz = $_POST['shirtanzahl'];
            $shirtgr = $_POST['shirtgroesse'];

            //----------------------------------------------
            //----Funktionen zum überprüfen der Eingaben----
            //----------------------------------------------

            //wenn keins enthalten, dann false
            function injection($input){
                if(preg_match("/;/",$eingabe) == 0){ 
                    return false;
                }
                else{
                    //echo("</br>Die Funktion injection hat bei $input angeschlagen! </br>");
                    return true;
                }
            }

            function length($input, $max_length, $min_length){
                if(strlen($input)>$max_length ||  strlen($input)<$min_length){
                    //echo("</br>Die Funktion length hat bei $input angeschlagen! </br>");
                    return true;   
                }
                else{
                    return false;
                }
            }

            //----------------------------------------------
            
            if(injection($k_nachname)||injection($k_vorname)||injection($e_nachname)||injection($e_vorname)||injection($e_straße)||injection($e_plz)||injection($e_ort)||injection($e_telpriv)||injection($e_telhandy)||injection($e_teldienstl)||injection($e_email)||injection($stufe)||injection($ernaehrung)||injection($krankheit)||injection($medikamente)||injection($versicherung)){
                $test_injection = true;
            }
            else{
                $test_injection = false;
            }

            if(length($k_nachname, 100, 2)||length($k_vorname, 100, 2)||length($e_nachname, 100, 2)||length($e_vorname, 100, 2)||length($e_straße, 100, 2)||length($e_plz, 5, 5)||length($e_ort, 50, 2)||length($e_telpriv, 20, 0)||length($e_telhandy, 20, 0)||length($e_teldienstl, 20, 0)||length($e_email, 320, 3)||length($stufe, 20, 0)||length($ernaehrung, 1000, 0)||length($krankheit, 1000, 0)||length($medikamente, 1000, 0)||length($versicherung, 100, 2)){
                $test_length = true;
            }
            else{
                $test_length = false;
            }
            
            //$test = preg_match("/;/","Halllo;;");
            //echo($test);
            //echo("Das ist die Injection: $test_injection </br>");
            //echo("Das ist die Länge: $test_length </br>");

            //-------------------------

            if($k_geschlecht === "female"){
                $k_geschlecht = "weiblich";
            }
            if($k_geschlecht === "male"){
                $k_geschlecht = "maennlich";
            }


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

            $anfang = strtotime($anfang);
            $anfang = date("Y-m-d", $anfang);

            $lageralter = $anfang-$k_geburtstag;

            $datum = date('Y-m-d');

            if (! isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip_adresse = $_SERVER['REMOTE_ADDR'];
            }
            else{
                $ip_adresse = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }

            //--------------------------------------------------

            if($test_injection == true || $test_length == true){
                mail("$anmeldungmail", "Beim Check ist ein Fehler aufgetreten", "Bei der Anmeldung von $k_vorname $k_nachname durch $e_email wurde ein Fehler gefunden,", "Anmeldungsfehler <fehler@lagertest.de>");
                require("files/eintrag_check_fail.html");
            }
            else{

                require 'files/email_touser.php';
                require 'files/email_tous.php';

                require("../Datenbank/writer.php");
                    try{
                        $db = new PDO("$host; $name" ,$user,$pass);
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //--------------Stammdaten eintragen -------------------------
                        $sql_stammdaten = "INSERT INTO tbl_stammdaten (TeilnehmerID, Nachname, Vorname, Geschlecht, Geburtstag, LagerAlter, Jahr) 
                            VALUES (:id, :nachname, :vorname, :geschlecht, :geburtstag, :lageralter, :jahr)";
                        
                        $stmt_t = $db->prepare($sql_stammdaten);
                        $stmt_t->bindValue(':id',$id);
                        $stmt_t->bindValue(':nachname', $k_nachname);
                        $stmt_t->bindValue(':vorname', $k_vorname);
                        $stmt_t->bindValue(':geschlecht', $k_geschlecht);
                        $stmt_t->bindValue(':geburtstag', $k_geburtstag);
                        $stmt_t->bindValue(':lageralter', $lageralter);
                        $stmt_t->bindValue(':jahr', $jahr);

                        $stmt_t->execute();

                //--------------Anmeldedaten eintragen -------------------------
                        $sql_anmeldedaten = "INSERT INTO tbl_anmeldedaten (TeilnehmerID,  Schwimmer, Schwimmstufe, Badeerlaubnis, Springen, Ernaehrung, Krankheit, Medikamente, Taschengeld, Versicherung_art, Versicherung_name, KFZ, Ratenzahlung, Raten_anzahl, Shirts, Shirts_anzahl, Shirts_groesse, Datum, IP_Adresse) 
                            VALUES (:id, :schwimmer, :schwimmstufe, :badeerlaubnis, :springen, :ernaerung, :krankheit, :medikamente, :taschengeld, :versicherung_art, :versicherung_name, :kfz, :ratenzahlung, :raten_anzahl, :shirts, :shirts_anzahl, :shirts_groesse, :datum, :ip_adresse)";
                        
                        $stmt_t = $db->prepare($sql_anmeldedaten);
                        $stmt_t->bindValue(':id',$id);
                        $stmt_t->bindValue(':schwimmer', $schwimmer);
                        $stmt_t->bindValue(':schwimmstufe', $stufe);
                        $stmt_t->bindValue(':badeerlaubnis', $baden);
                        $stmt_t->bindValue(':springen', $springen);
                        $stmt_t->bindValue(':ernaerung', $ernaehrung);
                        $stmt_t->bindValue(':krankheit', $krankheit);
                        $stmt_t->bindValue(':medikamente', $medikamente);
                        $stmt_t->bindValue(':taschengeld', $taschengeld);
                        $stmt_t->bindValue(':versicherung_art', $kv_art);
                        $stmt_t->bindValue(':versicherung_name', $versicherung);
                        $stmt_t->bindValue(':kfz', $kfz);
                        $stmt_t->bindValue(':ratenzahlung', $raten);
                        $stmt_t->bindValue(':raten_anzahl', $raten_anzahl);
                        $stmt_t->bindValue(':shirts', $shirt);
                        $stmt_t->bindValue(':shirts_anzahl', $shirtanz);
                        $stmt_t->bindValue(':shirts_groesse', $shirtgr);
                        $stmt_t->bindValue(':datum', $datum);
                        $stmt_t->bindValue(':ip_adresse', $ip_adresse);

                        $stmt_t->execute();

                //--------------Eltern eintragen -------------------------
                        $sql_eltern = "INSERT INTO tbl_srgb (TeilnehmerID, e_Nachname, e_Vorname, Strasse, PLZ, Ort, Tel_pri, Tel_handy, Tel_dienstl, email, mitglied, mitarbeiter, Datum, IP_Adresse)
                            VALUES(:id, :nachname, :vorname, :strasse, :plz, :ort, :tel_p, :tel_h, :tel_d, :email, :mitglied, :mitarbeiter, :datum, :ip_adresse);";

                        $stmt_e = $db->prepare($sql_eltern);
                        $stmt_e->bindValue(':id', $id);
                        $stmt_e->bindValue(':nachname', $e_nachname);
                        $stmt_e->bindValue(':vorname', $e_vorname);
                        $stmt_e->bindValue(':strasse', $e_straße);
                        $stmt_e->bindValue(':plz', $e_plz);
                        $stmt_e->bindValue(':ort', $e_ort);
                        $stmt_e->bindValue(':tel_p', $e_telpriv);
                        $stmt_e->bindValue(':tel_h', $e_telhandy);
                        $stmt_e->bindValue(':tel_d', $e_teldienstl);
                        $stmt_e->bindValue(':email', $e_email);
                        $stmt_e->bindValue(':mitglied', $mitglied);
                        $stmt_e->bindValue(':mitarbeiter', $mitarbeiter);
                        $stmt_e->bindValue(':datum', $datum);
                        $stmt_e->bindValue(':ip_adresse', $ip_adresse);

                        $stmt_e->execute();

                        $db_send = true;
                    }
                    catch(PDOException $e){
                        $fehler = $e->getMessage();

                        $db_send = false;
                    }
                    finally{
                        $db = null;
                    }
                
                if($mail_send_us == true && $db_send == true){
                    include('files/eintrag_erstellt.html');
                }
                if($mail_send_us == true && $db_send == false){
                    include('files/eintrag_erstellt.html');
                    mail("$anmeldungmail","Mail angekommen, aber nicht in Datenbank","Die Anmeldung von $k_vorname $k_nachname, mit der ID $id, ist nur als Mail eingegangen. <br/> Bei der Verarbeitung der Datenbank gab es einen Fehler <br/> Fehlercode: <br/> $fehler","Anmeldungsfehler <fehler@lagertest.de>");
                }
                if($mail_send_us == false && $db_send == true){
                    include('files/eintrag_erstellt.html');
                    mail("$anmeldungmail", "Anmeldung in Datenbank, aber nicht als Mail", "Die Anmeldung von $k_vorname $k_nachname, mit der $id, ist nur in der Datenbank vorhanden und nicht als separate Mail.", "Anmeldungsfehler <fehler@lagertest.de>" );
                }
                if($mail_send_us == false && $db_send == false){
                    include('files/eintrag_fehler.html');
                    mail("$anmeldungmail", "Fehler bei der Anmeldung", "Die Anmeldung von $k_nachname $k_nachname kam nicht als Mail oder Datenbankeintrag an. <br/> Fehlercode: <br/> $fehler", "Anmeldungsfehler <fehler@lagertest.de>");
                }
                if($mail_send_user == false){
                    echo("Beim senden der E-Mail an sie ist ein Fehler aufgetreten. Diese Meldung ist auch bei uns eingegangen. <br/> Senden sie uns bitte eine Mail an $kontaktmail mit dem Vor- und Nachname ihres Kindes. </br>");
                    mail("$anmeldungmail", "Fehler beim senden der Mail an User", "Die Anmeldung von $k_vorname $k_nachname wurde nicht an die Angegebene Mail weitergeleitet. <br/> Im besten Fall meldet sich der User bei uns, er hat eine Meldung erhalten, wenn nicht müssten wir Kontakt  aufnehmen.", "Anmeldungsfehler <fehler@lagertest.de>");
                }
            }
        ?>

        </div>
        </div>
        <?php
         include '../files/footer.php';
        ?>
    </body>
</html>