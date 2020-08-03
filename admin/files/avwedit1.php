<h2> Ändern der Stammdaten <h2>
<p> Bitte sei dir bewusst das alle Änderungen weitreichende Folgen haben und nicht so leicht zu korrigieren sind <br>
Änderungen sollte nur durchgeführt wer´den, wenn die wirklich notwendig sind.</p>
<p>Bei den Eingaben werden keinerlei hilfen Vorgenommen, bitte achtet also auf eine korrekte Formatierung und Eingabe.</p>
<br>
<form method="POST" action="files/avwsenden.php?id=<?php echo $_GET['id'] ?>&type=1">
    <label>Vorname des Kindes <input type="text" value="<?php echo $vorname ?>"></label><br>
    <label>Nachname des Kindes <input type="text" value="<?php echo $nachname?>"></label><br>
    <label>Geschlecht des Kindes 
        <?php
        if($geschlecht = "maennlich"){
           echo' <select><option value="maennlich" selected>Männlich</option><option value="weiblich">Weiblich</option></select>';
        }
        else{
            echo' <select><option value="maennlich">Männlich</option><option value="weiblich"  selected>Weiblich</option></select>';
        }
        ?>
    </label><br>
    <label>Geburtstag des Kindes <input type="date" value="<?php echo $gebdatum ?>"></label><br>
    <input type="submit" value="Änderungen speichern">
</form>