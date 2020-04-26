<!DOCTYPE html>
<html lang="de">
    <head>
		<title> Admin-Login | DRK Sommercamp </title>
		<meta charset="UTF-8">
        <link rel="stylesheet" href="CSS/styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	</head>
    
    <body>
         <!-- Header einfügen-->
          <?php
                include 'files/head.html';
            ?>
        <div class="bg">
            <div id="Inhalt" class="login">
                <h1>Admin-Login</h1>
                <p>Bitte gib deinen Benutzernamen und dein Passwort ein</p><br>
                <form name="login" method="POST" action="admin/index.php">
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
                    </table>
                </form> 
            </div>
        
            <!-- Footer einfügen -->
            <?php
                include 'files/footer.html';
            ?>
        </div>
    </body>
</html>