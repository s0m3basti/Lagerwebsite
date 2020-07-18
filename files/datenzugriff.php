<?php
    $link = linkmaker("/files/daten.txt");

    $datei = fopen("$link", "r");
    $anfang = fgets($datei);
    $ende = fgets($datei);
    $jahr = fgets($datei);
    $preis = fgets($datei);
    $shirtpreis = fgets($datei);
    $kontaktmail = fgets($datei);
    $anmeldungmail = fgets($datei);
    $status = fgets($datei);
    fclose($datei);
?>