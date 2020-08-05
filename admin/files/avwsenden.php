<?php
    
    session_start();
    if(!isset($_SESSION['userid'])) {
        header("Location: ../login.php?er=1");
    }
+
    require "../../files/linkmaker.php";
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
            echo changetest($_SESSION['k_vorname'], $_POST["vorname"]);
            echo changetest($_SESSION["k_nachname"], $_POST["nachname"]);
            echo changetest($_SESSION["geschlecht"], $_POST["geschlecht"]);
            echo changetest($_SESSION["gebdatum"], $_POST["gebdatum"]);
            //beim Geburtstag dann auch das neue lageralter berechenn
            break;
        case 2:
            break;
        case 3:
            break;
        case 4:
            break;
    }

    //header("Location:verwalten.php?id=$id");
?>