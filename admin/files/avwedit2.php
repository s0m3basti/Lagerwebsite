<h2> Ändern der Angaben zum Sorgeberechtigten <h2>
<p> Bitte sei dir bewusst das alle Änderungen weitreichende Folgen haben und nicht so leicht zu korrigieren sind <br>
Änderungen sollte nur durchgeführt werden, wenn die wirklich notwendig sind.</p>
<p>Bei den Eingaben werden keinerlei hilfen Vorgenommen, bitte achtet also auf eine korrekte Formatierung und Eingabe.</p>
<br>
<?php
    echo 'Die Angaben gehören zur Anmeldung von '.$_SESSION['vorname'].' '.$_SESSION['nachname'].' geboren am '.$_SESSION['gebdatum'].'.';
?>
<br>
<form method="POST" action="files/avwsenden.php?id=<?php echo $_GET['id'] ?>&type=2">
    <label>Vorname des Sorgeberechtigten <input type="text" value="<?php echo $e_nachname ?>"></label><br>
    <label>Nachname des Sorgeberechtigten <input type="text" value="<?php echo $e_vorname ?>"></label><br>
    <label>Straße <input type="text" value="<?php echo $strasse ?>"></label><br>
    <label>Postleitzahl <input type="text" value="<?php echo $plz ?>"></label><br>
    <label>Ort <input type="text" value="<?php echo $ort ?>"></label><br>
    <label>Telefonnummer (Privat) <input type="text" value="<?php echo $tel_pri ?>"></label><br>
    <label>Telefonnummer (Handy) <input type="text" value="<?php echo $tel_handy ?>"></label><br>
    <label>Telefonnummer (Dienstlich) <input type="text" value="<?php echo $tel_dienstl ?>"></label><br>
    <label>E-Mail-Adresse <input type="email" value="<?php echo $email ?>"></label><br>
    <?php
    if($mitglied == "ja"){
        echo '<label>Mitglied <input type="checkbox" value="ja" checked></label><br>';
    }
    else{
        echo '<label>Mitglied <input type="checkbox" value="nein"></label><br>';
    }
    if($mitarbeiter == "ja"){
        echo '<label>Mitarbeiter <input type="checkbox" value="ja" checked></label><br>';
    }
    else{
        echo '<label>Mitarbeiter <input type="checkbox" value="nein"></label><br>';
    }
    ?>
    <input type="submit" value="Änderungen speichern">
</form>