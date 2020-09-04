<?php
    $link = linkmaker("/files/daten.txt");

    $datei = fopen("$link", "r");
    $anfang = fgets($datei);
    $ende = fgets($datei);
    $jahr = fgets($datei);
    $preis = fgets($datei);
    $shirtpreis = fgets($datei);
    $frühbucher = fgets($datei);
    $frühbis = fgets($datei);
    $kontaktmail = fgets($datei);
    $anmeldungmail = fgets($datei);
    $supportmail = fgets($datei);
    $status = fgets($datei);
    fclose($datei);

    /* Sollten mehr Daten dazu kommen, müssen die auch im datenändern.php und status_senden.php hinzugefügte werden. */
    //liest alle Daten aus daten.txt ein und macht sie im Dokument verwendbar
?>