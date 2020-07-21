<?php
    require '../Datenbank/writer.php';

    $id = $_GET['id'];
    try{
        $db = new PDO("$host; $name" ,$user,$pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM login WHERE id = '$id';";
        foreach ($db->query($sql) as $row);
    }
    catch(PDOException $e){
        $fehler = $e->getMessage();
        echo $fehler;
    }
    finally{
        $db = null;
    }
?>
<div class="bnv">
    <h1>Nutzer bearbeiten</h1>
    <h2>
        Hier kannst du alle Daten für den Benutzer bearbeiten und ihn löschen
    </h2>
    <div class="bnv_form">
        <form method="POST" action="files/bnvsenden.php?new=2&id=<?php echo $id ?>">
            <table class="bnv">
                <tr><td><label>Benutzername:</label></td><td><input type="text" name="username" class="bnv" value="<?php echo $row['user_name'] ?>" required></td></tr>
                <tr><td><label>Vorname:</label></td><td><input type="text" name="firstname" class="bnv" value="<?php echo $row['firstname'] ?>" required></td></tr>
                <tr><td><label>Nachname:</label></td><td><input type="text" name="surname" class="bnv"  value="<?php echo $row['surname'] ?>" required></td></tr>
                <tr><td><label>E-Mail-Adresse:</label></td><td><input type="email" name="email" class="bnv"  value="<?php echo $row['email'] ?>" required></td></tr>
                <tr><td><label>Rechte:</label></td><td><input type="number" min="1" max="3" name="rights" class="bnv"  value="<?php echo intval($row['rights']) ?>" required></td></tr>
            </table>
            <h2>
                Solltest du das Kennwort ändern wollen, gib es bitte hier ein, bleibt das Feld unberührt, bleibt auch dein bisheriges Kennwort bestehen.
            </h2>
            <table class="bnv">
                <tr><td><label>Neues Passwort:</label></td><td><input type="text" name="passwort" class="bnv"></td></tr>
            </table>   
            <input type="submit" value="Benutzer bearbeiten" class="bnv">
        </form>
    </div>
</div>