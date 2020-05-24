<?php
    $datei = fopen("http://lagertest.de/files/daten.txt", "r");
    $anfang = fgets($datei);
    $ende = fgets($datei);
    $jahr = fgets($datei);
    $preis = fgets($datei);
    $shirtpreis = fgets($datei);
    $status = fgets($datei);
    fclose($datei);
?>