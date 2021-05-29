<?php
    try{
        $db = new PDO("$host; $name" ,$user,$pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT * 
                FROM tbl_stammdaten
                WHERE TeilnehmerID = "'.$_GET['id'].'";';
        foreach ($db->query($sql) as $row);


        $nachname = $row['Nachname'];
        $vorname = $row['Vorname'];
        $gebdatum = $row['Geburtstag'];
        $notizen = $row['Notizen'];
    }
    catch(PDOException $e){
        $fehler = $e->getMessage();
        echo "Es ist ein Fehler bei der Kommunikation mit der Datenbank aufgetreten. </br> $fehler";
    }
    finally{
        $db = null;
    }

    echo '<h2>Die Anmeldung von '.$vorname.' '.$nachname.', geboren am '.date("d.m.Y",strtotime($gebdatum)).', kann hier bearbeitet oder gelöscht werden.</h2>';
    echo "<p>Sei dir bewusst das alle Änderungen auswirkungen mit sich tragen, wenn eine Anmeldung gelöscht wurde ist sie weg. <br><b>Alle Änderungen werden getraked!</b></p>"
?>

<h3>Anmeldung ändern</h3>
<a href="?id=<?php echo $_GET['id']?>&type=1"><button class="avw edit" type="button">Stammdaten der Anmeldung ändern</button></a><br>
<a href="?id=<?php echo $_GET['id']?>&type=2"><button class="avw edit" type="button">Angaben zum Sorgeberechtigten ändern</button></a><br>
<a href="?id=<?php echo $_GET['id']?>&type=3"><button class="avw edit" type="button">Angaben für den Betreuer ändern</button></a><br>
<h3>Anmeldung löschen</h3>
<a href="?id=<?php echo $_GET['id']?>&type=4"><button class="avw delete" type="button">Anmeldung unwiederruflich löschen</button></a><br>
<h3>Notiz hinzufügen</h3>
<form action="files/avwsenden.php?id=<?php echo $_GET['id']?>&type=5" method="POST">
    <input type="hidden" value=<?php echo $_GET['id']?> name="id">
    <input type="text" value="<?php echo $notizen ?>" name="notizen" id="notizen">
    <input type="submit" value="Notiz speichern">
</form>
