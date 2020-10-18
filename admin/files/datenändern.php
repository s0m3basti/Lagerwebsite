<?php
    require '../../files/linkmaker.php';
    require '../../files/datenzugriff.php';

    $anfang = $_POST['anfang'];
    $ende = $_POST['ende']; 
    $jahr = $_POST['jahr']; 
    $preis = $_POST['preis']; 
    $shirtpreis = $_POST['shirtpreis'];
    $frühbucher = $_POST['frühbucher'];
    $frühbis = $_POST['frühbis']; 
    $kontaktmail = $_POST['kontaktmail']; 
    $anmeldungmail = $_POST['anmeldungmail']; 
    $supportmail = $_POST['supportmail'];

    $anfang = strtotime($anfang);
    $anfang = date('d.m.Y',$anfang);
    $ende = strtotime($ende);
    $ende= date('d.m.Y', $ende);
    $frühbis = date('d.m.Y', strtotime($frühbis));

    $handle = fopen("../../files/daten.txt", "w");
    fwrite($handle, $anfang."\n");
    fwrite($handle, $ende."\n");
    fwrite($handle, $jahr."\n");
    fwrite($handle, $preis."\n");
    fwrite($handle, $shirtpreis."\n");
    fwrite($handle, $frühbucher."\n");
    fwrite($handle, $frühbis."\n");
    fwrite($handle, $kontaktmail."\n");
    fwrite($handle, $anmeldungmail."\n");
    fwrite($handle, $supportmail."\n");
    fwrite($handle, $status);
    fclose($handle);

    header("Location:../daten.php?erfolg=1");
?>