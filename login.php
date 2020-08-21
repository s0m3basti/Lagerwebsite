<?php
    require "files/cookie_set.php";

    session_start();
    require("Datenbank/writer.php");

    if($_GET['er'] == 1){
        $errorMessage = "Sie müssen sich zuerst anmelden!";
    }

    if($_GET['logout'] == 1){
        session_destroy();
 
        $errorMessage = "Logout Erfolgreich";
    }

    if(isset($_GET['login'])){
        $bn = $_POST['bn'];
        $pw = $_POST['pw'];

        try{
            $db = new PDO("$host; $name" ,$user,$pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM login WHERE user_name = '$bn';";
            foreach ($db->query($sql) as $row);
        }
        catch(PDOException $e){
            $fehler = $e->getMessage();
            echo $fehler;
        }
        finally{
            $db = null;
        }

        

        if($user != false && password_verify($pw,$row['password'])){
            $_SESSION['userid'] = $row['id'];
            $_SESSION['vorname'] = $row['firstname'];
            $_SESSION['nachname'] = $row['surname'];
            $_SESSION['mail'] = $row['email'];
            $_SESSION['rechte'] = $row['rights'];

            if($row['pwset'] == true){
                header("Location: admin/index.php");
            }
            else{
                header("Location: admin/pwset.php");
            }
            $errorMessage = "angemeldet";
        }
        else{
            $errorMessage = "Benutzername oder Passwort war falsch. Bitte versuchen sie es erneut";
        }
    }                               
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <?php
            include 'files/linkmaker.php';
        ?>
		<title> Admin-Login | DRK Sommercamp </title>
		<meta charset="UTF-8">
        <link rel="stylesheet" href="CSS/styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	</head>
    
    <body>
         <!-- Header einfügen-->
          <?php
                include 'files/head.php';
                require 'files/cookie.php';
            ?>
        <div class="bg">
            <div id="Inhalt" class="login">

                <h1>Admin-Login</h1>
                <p>Bitte gib deinen Benutzernamen und dein Passwort ein</p><br>
                <form name="login" method="POST" action="login.php?login=1">
                    <table id="table_login">
                        <tr>
                            <td><label>Benutzernamen </td>
                            <td><input type="text" name="bn"></td>
                        </tr>
                        <tr>
                            <td><label>Passwort </td>
                            <td><input type="password" name="pw"></td>
                        </tr>
                        <tr>
                            <td scope="colgroup" colspan="2" style="text-align:center"><input type="submit" name="submit" value="Anmelden"></td>
                        </tr>
                        <tr>
                            <td scope="colgroup" colspan="2" style="text-align:center"><p><?php echo $errorMessage ?></p></td>
                        </tr>
                    </table>
                </form> 
            </div>
        
            <!-- Footer einfügen -->
            <?php
                include 'files/footer.php';
            ?>
        </div>
    </body>
</html>