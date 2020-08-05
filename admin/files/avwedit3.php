<h2> Ändern der Angaben für den Betreuer <h2>
<p> Bitte sei dir bewusst das alle Änderungen weitreichende Folgen haben und nicht so leicht zu korrigieren sind <br>
Änderungen sollte nur durchgeführt wer´den, wenn die wirklich notwendig sind.</p>
<p>Bei den Eingaben werden keinerlei hilfen Vorgenommen, bitte achtet also auf eine korrekte Formatierung und Eingabe.</p>
<br>
<?php
    echo 'Die Angaben gehören zur Anmeldung von '.$_SESSION['vorname'].' '.$_SESSION['nachname'].' geboren am '.$_SESSION['gebdatum'].'.';
?>
<br>
<form method="POST" action="files/avwsenden.php?id=<?php echo $_GET['id'] ?>&type=3">
    <?php
        if($schwimmer ==  "ja"){
            echo '<label>Schwimmer <select><option selected value="ja">Ja</option><option value="nein">Nein</option></select></label><br>';
        }
        else{
            echo '<label>Schwimmer <select><option value="ja">Ja</option><option selected value="nein">Nein</option></select></label><br>';
        }
    ?>
    <label>Schwimmstufe <input type="text" value="<?php echo $schwimmstufe ?>"></label><br>
    <?php
        if($badeerlaubnis == "ja"){
            echo '<label>Badeerlaubnis<select><option selected value="ja">Ja</option><option value="nein">Nein</option></select></label><br>';
        }
        else{
            echo '<label>Badeerlaubnis<select><option value="ja">Ja</option><option selected value="nein">Nein</option></select></label><br>';
        }
        if($springen == "ja"){
            echo '<label>Springen<select><option selected value="ja">Ja</option><option value="nein">Nein</option></select></label><br>';
        }
        else{
            echo '<label>Springen<select><option value="ja">Ja</option><option selected value="nein">Nein</option></select></label><br>';
        }
    ?>
    <label>Ernährung <input type="text" value="<?php echo $ernaehrung ?>"></label><br>
    <label>Krankheiten <input type="text" value="<?php echo $krankheit ?>"></label><br>
    <label>Medikamente <input type="text" value="<?php echo $medikamente ?>"></label><br>
    <?php
        if($taschengeld == "ja"){
            echo '<label>Taschengeldverwaltung<select><option selected value="ja">Ja</option><option value="nein">Nein</option></select></label><br>';
        }
        else{
            echo '<label>Taschengeldverwaltung<select><option value="ja">Ja</option><option selected value="nein">Nein</option></select></label><br>';
        }
        if($versicherung_art == "gesetzlich"){
            echo '<label>Art der KV<select><option selected value="gesetzlich">Gesetzlich</option><option value="privat">Privat</option></select></label><br>';
        }
        else{
            echo '<label>Art der KV<select><option value="gesetzlich">Gesetzlich</option><option selected value="privat">Privat</option></select></label><br>';
        }
    ?>
    <label>Name der Versicherung <input type="text" value="<?php echo $versicherung_name ?>"></label><br>
    <label>Vorname des Kindes <input type="text" value="<?php echo $vorname ?>"></label><br>
    <label>Vorname des Kindes <input type="text" value="<?php echo $vorname ?>"></label><br>
    <label>Vorname des Kindes <input type="text" value="<?php echo $vorname ?>"></label><br>
    <label>Vorname des Kindes <input type="text" value="<?php echo $vorname ?>"></label><br>
    <label>Vorname des Kindes <input type="text" value="<?php echo $vorname ?>"></label><br>
    <label>Vorname des Kindes <input type="text" value="<?php echo $vorname ?>"></label><br>
    <input type="submit" value="Änderungen speichern">
</form>