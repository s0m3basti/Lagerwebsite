<h2> Ändern der Angaben zum Sorgeberechtigten <h2>
<table class="avwe">
    <form method="POST" action="files/avwsenden.php?id=<?php echo $_GET['id'] ?>&type=2">
        <tr><td><label>Vorname des Sorgeberechtigten</td><td><input type="text" name="e_vorname" value="<?php echo $e_vorname ?>"></label></td></tr>
        <tr><td><label>Nachname des Sorgeberechtigten</td><td><input type="text" name="e_nachname" value="<?php echo $e_nachname ?>"></label></td></tr>
        <tr><td><label>Straße</td><td><input type="text" name="strasse" value="<?php echo $strasse ?>"></label></td></tr>
        <tr><td><label>Postleitzahl</td><td><input type="text" name="plz" value="<?php echo $plz ?>"></label></td></tr>
        <tr><td><label>Ort</td><td><input type="text" name="ort" value="<?php echo $ort ?>"></label></td></tr>
        <tr><td><label>Telefonnummer (Privat)</td><td><input type="text" name="tel_pri" value="<?php echo $tel_pri ?>"></label></td></tr>
        <tr><td><label>Telefonnummer (Handy)</td><td><input type="text" name="tel_handy" value="<?php echo $tel_handy ?>"></label></td></tr>
        <tr><td><label>Telefonnummer (Dienstlich)</td><td><input type="text" name="tel_dienstl" value="<?php echo $tel_dienstl ?>"></label></td></tr>
        <tr><td><label>E-Mail-Adresse</td><td><input type="email" name="email" value="<?php echo $email ?>"></label></td></tr>
        <?php
        if($mitglied == "ja"){
            echo '<tr><td><label>Mitglied</td><td><input type="checkbox" name="mitglied" checked></label></td></tr>';
        }
        else{
            echo '<tr><td><label>Mitglied</td><td><input type="checkbox" name="mitglied"></label></td></tr>';
        }
        if($mitarbeiter == "ja"){
            echo '<tr><td><label>Mitarbeiter</td><td><input type="checkbox" name="mitarbeiter" checked></label></td></tr>';
        }
        else{
            echo '<tr><td><label>Mitarbeiter</td><td><input type="checkbox" name="mitarbeiter"""></label></td></tr>';
        }
        ?>
        <tr><td colspan="2"><button type="submit" class="avw edit">Änderungen speichern</button</td></tr>
    </form>
</table>