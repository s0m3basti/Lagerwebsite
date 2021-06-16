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

    $id = $_POST['id'];
    $null = 0;

    if($_POST['type'] == "ganz"){
        try{
            $db = new PDO("$host; $name" ,$user,$pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $sql = 'UPDATE tbl_anmeldedaten
                    SET zahlungsdaten = '.$null.'
                    WHERE TeilnehmerID = "'.$id.'";';            
            $stmt_t = $db->prepare($sql);  
            $stmt_t->execute();
            header("Location:../zahlung.php?message=1");
        }
        catch(PDOException $e){
            $fehler = $e->getMessage();
            header("Location:../zahlung.php?message=2");
        }
        finally{
            $db = null;
        }

    }
    else{
        try{
            $db = new PDO("$host; $name" ,$user,$pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $sql="SELECT *
                    FROM tbl_anmeldedaten
                    WHERE TeilnehmerID = '".$id."';";
            foreach ($db->query($sql) as $row);
                $vorher = $row['zahlungsdaten'];
                $neu = $vorher - $_POST['betrag'];
                if($neu == 0){
                    $neu = "null";
                }
            $sql = "UPDATE tbl_anmeldedaten
                    SET zahlungsdaten = ".$neu."
                    WHERE TeilnehmerID = '".$id."';";
            
            $stmt_t = $db->prepare($sql);  
            $stmt_t->execute();

            header("Location:../zahlung.php?message=3");
        }
        catch(PDOException $e){
            $fehler = $e->getMessage();
            header("Location:../zahlung.php?message=2");
        }
        finally{
            $db = null;
        }
    }    
?>