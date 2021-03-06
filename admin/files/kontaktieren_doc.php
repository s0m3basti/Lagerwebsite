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
    require "tcpdf/tcpdf.php";

    try{
        $db = new PDO("$host; $name" ,$user,$pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT *
                FROM tbl_stammdaten s, tbl_srgb e, tbl_anmeldedaten a
                WHERE s.TeilnehmerID = e.TeilnehmerID 
                AND s.TeilnehmerID = a.TeilnehmerID
                AND Jahr = $jahr
                ORDER BY s.Geschlecht, s.LagerAlter, s.Nachname, s.Vorname DESC;";

        $data = [];
        
        array_push($data,
            "Nr.,Nachname_Kind,Vorname_Kind,Nachname_Eltern,Vorname_Eltern,Strasse,PLZ,Ort,E-Mail,Kommentar,Preis,Raten,T-Shirt,Groesse");
        $i = 0;
        foreach ($db->query($sql) as $row){
            $i++;
            array_push($data,
                $i.','.
                $row['Nachname'].','.
                $row['Vorname'].','.
                $row['e_Nachname'].','.
                $row['e_Vorname'].','.
                $row['Strasse'].','.
                $row['PLZ'].','.
                $row['Ort'].','.
                $row['email'].','.
                $row['Notizen'].','.
                $row['zahlungsdaten'].','.
                $row['Raten_anzahl'].','.
                $row['Shirts_anzahl'].','.
                $row['Shirts_groesse']
            );
        }
    }
    catch(PDOException $e){
        $fehler = $e->getMessage();
        $html.= "Es ist ein Fehler bei der Kommunikation mit der Datenbank aufgetreten. </br> $fehler";
    }
    finally{
        $db = null;
    }

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="kontaktdaten.csv"');

    $fp = fopen('php://output', 'wb');

    foreach ( $data as $line ) {
        $val = explode(",",$line);
        fputcsv($fp, $val);
    }
    fclose($fp);

    //header("Location:ausgabe_download.php?output=uebersicht");
    // header("Location:../ausgabe.php?task=1");
?>