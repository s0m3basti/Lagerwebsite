<h2> Löschen der Anmeldung <h2>
<p> Bist du dir sicher das die Anmeldung von <?php echo $_SESSION["vorname"] $_SESSION["nachname"]?> gelöscht werden soll?</p>
<br>
<form method="POST" action="files/avwsenden.php?id=<?php echo $_GET['id'] ?>&type=4">
    <label> <input type="submit" value="Anmeldung löschen"> </label>
</form>