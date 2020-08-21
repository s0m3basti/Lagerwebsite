<div class="bnv">
    <h1>Benutzerverwaltung</h1>
    <h2>Hier können alle Nutzer angezeigt werden.</h2>
    <div class="bnv_show">
        <?php
        try{
            $db = new PDO("$host; $name" ,$user,$pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            echo "<table class='tbl_user'>";
            echo "<tr class='tr_user_head'><td>Username</td><td>Vorname</td><td>Nachname</td><td>E-Mail-Adresse</td><td>Rechte</td></tr>";

            $sql = "SELECT * FROM login ORDER BY rights DESC;";
            foreach ($db->query($sql) as $row){
                echo "<tr class='tr_user'><td class='td_user'>".$row['user_name']."</td><td class='td_user'>".$row['firstname']."</td><td class='td_user'>".$row['surname']."</td><td class='td_user'>".$row['email']."</td><td class='td_user'>".$row['rights']."</td></tr>";
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

</div>