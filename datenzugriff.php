<?php
    $datei = fopen("daten.txt","r");
    $anfang = fgets($datei);
    $ende = fgets($datei);
    $jahr = fget($datei);

    echo $anfang;
    echo $ende;
    echo $jahr;

    fclose($datei);
?>