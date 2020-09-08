<?php
    // alle benötigten Files laden
    include '../files/linkmaker.php';
    include '../files/datenzugriff.php';

    // cookie für die Cookieabfrage setzten
    require "../files/cookie_set.php";

    
    //Für Voranmeldung
    //Wenn eine Mailadresse eingegeben wurde
    if($_GET['mail'] == 1){
        require("../Datenbank/writer.php");

        //Daten an Variablen binden
        $date = date("Y-m-d H:i");
        $mail = $_POST['email'];
        
        //Injection funktion
        function injection($input){
            if(preg_match("/;/",$input) == 0){ 
                return false;
            }
            else{
                return true;
            }
        }

        //Lenght funktion
        function length($input, $max_length, $min_length){
            if(strlen($input)>$max_length ||  strlen($input)<$min_length){
                return true;   
            }
            else{
                return false;
            }
        }

        //wenn was anschlägt
        if(injection($mail) || length($mail, 299, 4)){
            $message = "Bei ihrer Eingabe ist ein Fehler aufgetreten, bitte versuchen sie es mit einer anderen E-Mail-Adresse erneut.";
        }
        else{
            //ansonsten testen ob die Mailadresse schon in Db steht
            try{
                $db = new PDO("$host; $name" ,$user,$pass);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT * FROM voranmeldung WHERE email='$mail'";

                foreach ($db->query($sql) as $row);
                $mail_db = $row['email'];
            }
            catch(PDOException $e){
                $fehler = $e->getMessage();
            }
            finally{
                $db = null;
            }

            //wenn ja dann errormessage
            if($mail == $mail_db){
                $message = "Ihre E-Mail-Adresse wurde bereits erfasst und sie werden informiert.";
            }
            else{
                //wenn nein dann eintragen
                try{
                    $db = new PDO("$host; $name" ,$user,$pass);
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $sql = "INSERT INTO voranmeldung (email, date) 
                            VALUES(:email, :date)";

                    $statement = $db->prepare($sql);
                    $statement->bindValue(':email',$mail);
                    $statement->bindValue(':date',$date);
                    $statement->execute();

                    $message = "Ihr E-Mail-Adresse wurde erfasst. Wir melden uns bei ihnen.";
                }
                catch(PDOException $e){
                    $fehler = $e->getMessage();
                    $message = "Es ist ein Fehler aufgetreten. </br> $fehler";
                }
                finally{
                    $db = null;
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="de">
    <head>
		<title> Anmeldung <?php echo $jahr ?> | DRK Sommercamp </title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../CSS/styles.css">
        <link rel="stylesheet" href="../CSS/anmeldung.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico">
        <script type="text/javascript" src="<?php echo(linkmaker("/files/active.js"))?>"></script>
        <script>
            //Momentanen Anmeldestatus an JS übergeben
            const message = <?php if(isset($_GET['message'])){echo $_GET['message'];}else{echo 0;}; ?>
        </script>
        <script src="files/messagebox.js" defer></script>

	</head>
    
    <body>
        <?php
            // Header + Cookieabfrage einfügen
            include '../files/head.php';
            require '../files/cookie.php';
        ?>
    <div class="bg">
            <div id="Inhalt">
                <div class="message" id="messagebox">
                </div>
                <h1>Anmeldung</h1><br>
                <p>
                    Auch in diesem Jahr ist es wieder möglich sich für das DRK Sommercamp vom <?php echo $anfang ?> bis zum <?php echo $ende ?> online und schriftlich an zu melden.
                </p><br><br>
                <div class="button-group">  
                    <a href="../dokumente/Anmeldung_2020.pdf" target="_blank"><button style="width:50%" id="offline">Anmeldung hier herunterladen <br> und per Brief an uns senden</button></a>
                    <a href="online.php"><button style="width:50%" id="online">Anmeldung hier online ausfüllen</button></a>
                </div> 
            </div>

            <div class="popup" id="popup">
                <div class="popup_content">
                    <?php
                        //anhand des Status ausgeben was im Popup stehen soll
                        if($status == "keine_anmeldung"){
                            include("files/keine_anmeldung.html");
                        }
                        else{
                            include("files/voranmeldung.html");
                        }
                    ?>
                </div>
            </div>

            <script>
                var status = "<?php echo $status ?>";
                
                //kein Popup wenn Status "anmeldung"
                if(status != "anmeldung"){
                    if(status == "keine_anmeldung"){
                        document.getElementById('popup').style.display = "flex";
                    }
                    if(status == "voranmeldung"){
                        document.getElementById('popup').style.display = "flex";
                    }
                }
            </script>

        </div>

        <?php
            // Footer einfügen 
            include '../files/footer.php';
        ?>
    </body>
</html>