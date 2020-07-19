<?php
    require '../files/linkmaker.php';
    require '../files/datenzugriff.php';

    $anfang = $_POST['anfang'];
    $ende = $_POST['ende']; 
    $jahr = $_POST['jahr']; 
    $preis = $_POST['preis']; 
    $shirtpreis = $_POST['shirtpreis']; 
    $kontaktmail = $_POST['kontaktmail']; 
    $anmedlungmail = $_POST['anmeldungmail']; 
    $supportmail = $_POST['supportmail'];

    $anfang = strtotime($anfang);
    $anfang = date('d.m.Y',$anfang);
    $ende = strtotime($ende);
    $ende= date('d.m.Y', $ende);

    $handle = fopen("$link", "w");
    fwrite($handle, $anfang);
    fwrite($handle, $ende);
    fwrite($handle, $jahr);
    fwrite($handle, $preis);
    fwrite($handle, $shirtpreis);
    fwrite($handle, $kontaktmail);
    fwrite($handle, $anmeldungmail);
    fwrite($handle, $supportmail);
    fwrite($handle, $status);
    fclose($handle);

    header("Location:daten.php?erfolg=1");
?>