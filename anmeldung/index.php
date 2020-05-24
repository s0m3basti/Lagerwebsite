<?php
    include '../files/datenzugriff.php';

    if($_GET['mail'] == 1){
        require("../Datenbank/writer.php");

        $date = date("YYYY-mm-dd HH:ii");
        $mail = $_POST['email'];

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
        <script type="text/javascript" src="http://lagertest.de/files/active.js"></script>
        

	</head>
    
    <body>
        <!-- Header einfügen-->
        <?php
            include '../files/head.html';
        ?>
    <div class="bg">
            <div id="Inhalt">
                <h1>Anmeldung</h1><br>
                <p>
                    Auch in diesem Jahr ist es wieder möglich sich für das DRK Sommercamp vom <?php echo $anfang ?> bis zum <?php echo $ende ?> online und schriftlich an zu melden.
                </p><br><br>
                <div class="button-group">  
                    <a href="files/Anmeldung_2020.pdf" target="_blank"><button style="width:50%" id="offline">Anmeldung hier herunterladen <br> und per Brief an uns senden</button></a>
                    <a href="online.php"><button style="width:50%" id="online">Anmeldung hier online ausfüllen</button></a>
                </div> 

            <p class="source"><br> <br>
                (Bildquellen: v.l.n.r &copy; spd-rlp.de (URL:https://www.spd-rlp.de/wp-content/uploads/2016/01/Briefkasten_Gelb-940x534.jpg| &copy;usvisaservice.de (URL:https://www.usvisaservice.de/assets/Visum-USA/ds-160-formular-passfoto.jpg) ))
            </p> 
            </div>

            <div class="popup" id="popup">
                <div class="popup_content">
                    <?php
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



        <!-- Footer einfügen -->
        <?php
            include '../files/footer.html';
        ?>
    </body>
</html>