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

    require "../../files/linkmaker.php";
    require "../../files/datenzugriff.php";
    require "../../Datenbank/writer.php";

//eingaben aus dem Form holen

    $id=$_POST['id'];
    $k_nachname=$_POST['k_nachname'];
    $k_vorname=$_POST['k_vorname'];
    $geschlecht=$_POST['geschlecht'];
    $gebdatum=$_POST['gebdatum'];
    $e_nachname=$_POST['e_nachname'];
    $e_vorname=$_POST['e_vorname'];
    $strasse=$_POST['strasse'];
    $plz=$_POST['plz'];
    $ort=$_POST['ort'];
    $tel_pri=$_POST['tel_pri'];
    $tel_handy=$_POST['tel_handy'];
    $tel_dienstl=$_POST['tel_dienstl'];
    $email=$_POST['email'];
    $mitglied=$_POST['mitglied'];
    $mitarbeiter=$_POST['mitarbeiter'];
    $schwimmer=$_POST['schwimmer'];
    $schwimmstufe=$_POST['schwimmstufe'];
    $badeerlaubnis=$_POST['badeerlaubnis'];
    $springen=$_POST['springen'];
    $ernaehrung=$_POST['ernaehrung'];
    $krankheit=$_POST['krankheit'];
    $medikamente=$_POST['medikamente'];
    $taschengeld=$_POST['taschengeld'];
    $kv_art=$_POST['kv_art'];
    $kv_name=$_POST['kv_name'];
    $kfz=$_POST['kfz'];
    $raten=$_POST['raten'];
    $ratenanzahl=$_POST['ratenanzahl'];
    $zahlungsinfo=$_POST['preis'];
    $shirts=$_POST['shirts'];
    $shirts_anzahl=$_POST['shirts_anzahl'];
    $shirts_groesse=$_POST['shirts_groesse'];


//neu Werte (online/analog ; IP/welcherUser; Datum; Lageralter)

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
    $lageralter = intval(date("Y",strtotime($anfang))) - intval(date("Y", strtotime($gebdatum)));

        if(intval(date("m",strtotime($gebdatum))) > intval(date("m", strtotime($anfang)))){
            $lageralter--;
        }
        else
            if(intval(date("m",strtotime($gebdatum))) == intval(date("m", strtotime($anfang))) && intval(date("d", strtotime($gebdatum))) > intval(date("d", strtotime($anfang)))){
                $lageralter--;
            }

    $zahlungsinfo = $zahlungsinfo + ($shirts_anzahl * $shirtpreis);

    $umfrage = "analog";

    $art = "analog";

    $datum = date('Y-m-d');

    $ip_adresse = $userid;

//eingaben in Datenbank schreiben

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
        $stmt_t->bindValue(':geschlecht', $geschlecht);
        $stmt_t->bindValue(':geburtstag', $gebdatum);
        $stmt_t->bindValue(':lageralter', $lageralter);
        $stmt_t->bindValue(':jahr', $jahr);

        $stmt_t->execute();

    //--------------Anmeldedaten eintragen -------------------------
        $sql_anmeldedaten = "INSERT INTO tbl_anmeldedaten (TeilnehmerID,  Schwimmer, Schwimmstufe, Badeerlaubnis, Springen, Ernaehrung, Krankheit, Medikamente, Taschengeld, Versicherung_art, Versicherung_name, KFZ, Ratenzahlung, Raten_anzahl, zahlungsdaten, Shirts, Shirts_anzahl, Shirts_groesse, umfrage, art, Datum, IP_Adresse) 
            VALUES (:id, :schwimmer, :schwimmstufe, :badeerlaubnis, :springen, :ernaerung, :krankheit, :medikamente, :taschengeld, :versicherung_art, :versicherung_name, :kfz, :ratenzahlung, :raten_anzahl,:zahlungsinfo, :shirts, :shirts_anzahl, :shirts_groesse, :umfrage, :art, :datum, :ip_adresse)";
        
        $stmt_t = $db->prepare($sql_anmeldedaten);
        $stmt_t->bindValue(':id',$id);
        $stmt_t->bindValue(':schwimmer', $schwimmer);
        $stmt_t->bindValue(':schwimmstufe', $schwimmstufe);
        $stmt_t->bindValue(':badeerlaubnis', $badeerlaubnis);
        $stmt_t->bindValue(':springen', $springen);
        $stmt_t->bindValue(':ernaerung', $ernaehrung);
        $stmt_t->bindValue(':krankheit', $krankheit);
        $stmt_t->bindValue(':medikamente', $medikamente);
        $stmt_t->bindValue(':taschengeld', $taschengeld);
        $stmt_t->bindValue(':versicherung_art', $kv_art);
        $stmt_t->bindValue(':versicherung_name', $kv_name);
        $stmt_t->bindValue(':kfz', $kfz);
        $stmt_t->bindValue(':ratenzahlung', $raten);
        $stmt_t->bindValue(':raten_anzahl', $ratenanzahl);
        $stmt_t->bindValue(':zahlungsinfo', $zahlungsinfo);
        $stmt_t->bindValue(':shirts', $shirts);
        $stmt_t->bindValue(':shirts_anzahl', $shirts_anzahl);
        $stmt_t->bindValue(':shirts_groesse', $shirts_groesse);
        $stmt_t->bindValue(':umfrage', $umfrage);
        $stmt_t->bindValue(':art', $art);
        $stmt_t->bindValue(':datum', $datum);
        $stmt_t->bindValue(':ip_adresse', $ip_adresse);

        $stmt_t->execute();

    //--------------Eltern eintragen -------------------------
        $sql_eltern = "INSERT INTO tbl_srgb (TeilnehmerID, e_Nachname, e_Vorname, Strasse, PLZ, Ort, Tel_pri, Tel_handy, Tel_dienstl, email, mitglied, mitarbeiter)
            VALUES(:id, :nachname, :vorname, :strasse, :plz, :ort, :tel_p, :tel_h, :tel_d, :email, :mitglied, :mitarbeiter);";

        $stmt_e = $db->prepare($sql_eltern);
        $stmt_e->bindValue(':id', $id);
        $stmt_e->bindValue(':nachname', $e_nachname);
        $stmt_e->bindValue(':vorname', $e_vorname);
        $stmt_e->bindValue(':strasse', $strasse);
        $stmt_e->bindValue(':plz', $plz);
        $stmt_e->bindValue(':ort', $ort);
        $stmt_e->bindValue(':tel_p', $tel_pri);
        $stmt_e->bindValue(':tel_h', $tel_handy);
        $stmt_e->bindValue(':tel_d', $tel_dienstl);
        $stmt_e->bindValue(':email', $email);
        $stmt_e->bindValue(':mitglied', $mitglied);
        $stmt_e->bindValue(':mitarbeiter', $mitarbeiter);

        $stmt_e->execute();

        require "neu_mail.php";
        header("Location:../neu.php?message=succsess");
    }
    catch(PDOException $e){
        $fehler = $e->getMessage();
        header("Location:../neu.php?message=fail&fehler=$fehler");
    }
    finally{
        $db = null;
    }
    
?>