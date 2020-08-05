<h2> Ändern der Angaben für den Betreuer <h2>
<table class="avwe">
    <form method="POST" action="files/avwsenden.php?id=<?php echo $_GET['id'] ?>&type=3">
        <?php
            if($schwimmer ==  "ja"){
                echo '<tr><td><label>Schwimmer</td><td><select><option selected value="ja">Ja</option><option value="nein">Nein</option></select></label></td></tr>';
            }
            else{
                echo '<tr><td><label>Schwimmer</td><td><select><option value="ja">Ja</option><option selected value="nein">Nein</option></select></label></td></tr>';
            }
        ?>
        <tr><td><label>Schwimmstufe</td><td><input type="text" value="<?php echo $schwimmstufe ?>"></label></td></tr>
        <?php
            if($badeerlaubnis == "ja"){
                echo '<tr><td><label>Badeerlaubnis</td><td><select><option selected value="ja">Ja</option><option value="nein">Nein</option></select></label></td></tr>';
            }
            else{
                echo '<tr><td><label>Badeerlaubnis</td><td><select><option value="ja">Ja</option><option selected value="nein">Nein</option></select></label></td></tr>';
            }
            if($springen == "ja"){
                echo '<tr><td><label>Springen</td><td><select><option selected value="ja">Ja</option><option value="nein">Nein</option></select></label></td></tr>';
            }
            else{
                echo '<tr><td><label>Springen</td><td><select><option value="ja">Ja</option><option selected value="nein">Nein</option></select></label></td></tr>';
            }
        ?>
        <tr><td><label>Ernährung</td><td><input type="text" value="<?php echo $ernaehrung ?>"></label></td></tr>
        <tr><td><label>Krankheiten</td><td><input type="text" value="<?php echo $krankheit ?>"></label></td></tr>
        <tr><td><label>Medikamente</td><td><input type="text" value="<?php echo $medikamente ?>"></label></td></tr>
        <?php
            if($taschengeld == "ja"){
                echo '<tr><td><label>Taschengeldverwaltung</td><td><select><option selected value="ja">Ja</option><option value="nein">Nein</option></select></label></td></tr>';
            }
            else{
                echo '<tr><td><label>Taschengeldverwaltung</td><td><select><option value="ja">Ja</option><option selected value="nein">Nein</option></select></label></td></tr>';
            }
            if($versicherung_art == "gesetzlich"){
                echo '<tr><td><label>Art der KV</td><td><select><option selected value="gesetzlich">Gesetzlich</option><option value="privat">Privat</option></select></label></td></tr>';
            }
            else{
                echo '<tr><td><label>Art der KV</td><td><select><option value="gesetzlich">Gesetzlich</option><option selected value="privat">Privat</option></select></label></td></tr>';
            }
        ?>
        <tr><td><label>Name der Versicherung</td><td><input type="text" value="<?php echo $versicherung_name ?>"></label></td></tr>
        <?php
        if($kfz == "ja"){
            echo '<tr><td><label>KFZ</td><td><select><option selected value="ja">Ja</option><option value="nein">Nein</option></select></label></td></tr>';
            }
            else{
                echo '<tr><td><label>KFZ</td><td><select><option value="ja">Ja</option><option selected value="nein">Nein</option></select></label></td></tr>';
            }
            if($ratenzahlung == "ja"){
                echo '<tr><td><label>Ratenzahlung</td><td><select><option selected value="ja">Ja</option><option value="nein">Nein</option></select></label></td></tr>';
            }
            else{
                echo '<tr><td><label>Ratenzahlung</td><td><select><option value="ja">Ja</option><option selected value="nein">Nein</option></select></label></td></tr>';
            } 
        ?>
        <tr><td><label>Ratenanzahl</td><td><input type="number" value="<?php echo $raten_anzahl ?>"></label></td></tr>
        <?php
            if($shirts == "ja"){
                echo '<tr><td><label>Shirts</td><td><select><option selected value="ja">Ja</option><option value="nein">Nein</option></select></label></td></tr>';
            }
            else{
                echo '<tr><td><label>Shirts</td><td><select><option value="ja">Ja</option><option selected value="nein">Nein</option></select></label></td></tr>';
            }
        ?>
        <tr><td><label>Shirtanzahl</td><td><input type="number" value="<?php echo $shirts_anzahl ?>"></label></td></tr>
        <tr><td><label>Shirtsgröße</td><td><input type="text" value="<?php echo $shirts_groesse ?>"></label></td></tr>
        <tr><td colspan="2"><button type="submit" class="avw edit">Änderungen speichern</button></td></tr>
    </form>
</table>