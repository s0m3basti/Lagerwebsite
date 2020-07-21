<div class="bnv">
<h1>Benutzerverwaltung</h1>
<h2>Hier können alle Nutzer angezeigt, neue Nutzer hinzugefügt und alte Nutzer bearebeitet werden.</h2>
<div class="bnv_show">
<?php
    try{
        $db = new PDO("$host; $name" ,$user,$pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo "<table class='tbl_user'>";
        echo "<tr class='tr_user_head'><td>ID</td><td>Username</td><td>Vorname</td><td>Nachname</td><td>E-Mail-Adresse</td><td>Rechte</td><td>Passwort</td><td> </td><td> </td></tr>";

        $sql = "SELECT * FROM login ORDER BY rights DESC;";
        foreach ($db->query($sql) as $row){
            echo "<tr class='tr_user'><td class='td_user'>".$row['id']."</td><td class='td_user'>".$row['user_name']."</td><td class='td_user'>".$row['firstname']."</td><td class='td_user'>".$row['surname']."</td><td class='td_user'>".$row['email']."</td><td class='td_user'>".$row['rights']."</td>";
            if($row['password'] == "" || $row['password'] == null){
                echo "<td class='td_user'>is not set</td>";
            }
            else{
                echo "<td class='td_user'>is set</td>";
            }
            echo "<td class='td_user'><a href='benutzerverwaltung.php?new=2&id=".$row['id']."'><img src='img/edit.png' class='img_edit'></a></td><td class='td_user'><a href='files/bnvdelete.php&id=".$row['id']."'><img src='img/delete.png' class='img_edit'></a></td></tr>";
        };

        echo "</table>";
    }
    catch(PDOException $e){
        $fehler = $e->getMessage();
        echo $fehler;
    }
    finally{
        $db = null;
    }
    ?>
</div>
<div class="bnv_new">
    <p>Wenn du einen neuen Nutzer hinzufügen möchtest klick auf den Button:</p>
    <a href="benutzerverwaltung.php?new=1"><button id="new_user">Neuen Benutzer erstellen</button></a>
</div>
</div>
