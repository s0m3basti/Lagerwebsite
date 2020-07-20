<?php
    require "../Datenbank/writer.php";
    //if(!isset($_SESSION['userid'])) {
    //    header("Location: ../login.php?er=1");
    //}
    //if($_SESSION['userid'] != 3){
    //    header("Location:benutzerverwaltung.php");
    //}

    if($_POST['new'] == 1){
        $username = $_POST['username'];
        $vorname = $_POST['firstname'];
        $nachname = $_POST['surname'];
        $email = $_POST['email'];
        $rechte = $_POST['rights'];


        try{
            $db = new PDO("$host; $name" ,$user,$pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $passwort = null;

            $sql_einfügen = "INSERT INTO login (id, user_name, password, firstname, surname, email, rights) 
                                VALUES ('', :username, :passwort, :vorname, :nachname, :email, :rechte)";
                            
            $stmt_t = $db->prepare($sql_einfügen);
            $stmt_t->bindValue(':username', $username);
            $stmt_t->bindValue(':passwort', $passwort);
            $stmt_t->bindValue(':vorname', $vorname);
            $stmt_t->bindValue(':nachname', $nachname);
            $stmt_t->bindValue(':email', $email);
            $stmt_t->bindValue(':rechte', $rechte);

            $stmt_t->execute();
        }
        catch(PDOException $e){
            $fehler = $e->getMessage();
        }
        finally{
            $db = null;
        }

        header("Location:benutzerverwaltung.php?erfolg=1");
    }
    else{
        if($_POST['new'] == 2){

        }
        else{
            if($_POST['new'] == 3){

            }
        }

    }
?>