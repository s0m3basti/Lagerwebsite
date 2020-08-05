<h2> Ändern der Stammdaten <h2>
<table class="avwe">
    <form method="POST" action="files/avwsenden.php?id=<?php echo $_GET['id'] ?>&type=1">
        <tr><td><label>Vorname des Kindes</td><td><input type="text" name="vorname" value="<?php echo $vorname ?>"></label></td></tr>
        <tr><td><label>Nachname des Kindes</td><td><input type="text" name="nachname" value="<?php echo $nachname?>"></label></td></tr>
        <tr><td><label>Geschlecht des Kindes</td><td> 
            <?php
            if($geschlecht == "maennlich"){
            echo' <select name="geschlecht"><option value="maennlich" selected>Männlich</option><option value="weiblich">Weiblich</option></select>';
            }
            else{
                echo' <select name="geschlecht"><option value="maennlich">Männlich</option><option selected value="weiblich">Weiblich</option></select>';
            }
            ?>
        </label></td></tr>
        <tr><td><label>Geburtstag des Kindes</td><td><input type="date" name="gebdatum" value="<?php echo $gebdatum ?>"></label></td></tr>
        <tr><td colspan="2"><button type="submit" class="avw edit">Änderungen speichern</button><td></tr>
    </form>
</table>