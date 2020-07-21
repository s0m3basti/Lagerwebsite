<?php
    session_start();
    if(!isset($_SESSION['userid'])) {
        header("Location: ../login.php?er=1");
    }
    if($_SESSION['rechte'] != 3){
        header("Location:../benutzerverwaltung.php");
    }
    
    echo "Hier wird der User mit der Id:".$_GET['id']."gelöscht.";

    require "../../Datenbank/writer.php";

    try{
        $db = new PDO("$host; $name" ,$user,$pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "DELETE FROM login WHERE id = ".$_GET['id'].";";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        header("Location:../benutzerverwaltung.php?message=1");
        
    }
    catch(PDOException $e){
        $fehler = $e->getMessage();
        echo $fehler;
        header("Location:../benutzerverwaltung.php?message=2");
    }
    finally{
        $db = null;
    }
?>