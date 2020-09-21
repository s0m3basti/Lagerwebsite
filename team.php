<?php
    // cookie für Cookieabfrage setzten
    require "files/cookie_set.php";
?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <?php
            // alle benötigten files laden
            include 'files/linkmaker.php';
        ?>
		<title> Das Team | DRK Sommercamp </title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="CSS/styles.css">
        <link rel="stylesheet" href="CSS/team.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
        <script type="text/javascript" src="<?php echo(linkmaker("/files/active.js"))?>"></script>
	</head>
    
    <body>
        <?php
            // Header + Cookieabfrage einfügen
            include 'files/head.php';
            require 'files/cookie.php';
        ?>
        <div class="bg">       
            <div id="Inhalt">
                <h1>Steckbriefe der Teammitglieder</h1>
                <br>
                <p class="vorwort">
                    Hier wird einmal das gesamte Team des DRK-Sommercamps vorgestellt. <br>
                    Wir alle investieren einen großen Teil unserer Freizeit in dieses Projekt und sind alle mit vollem Herzen dabei, natürlich alles Ehrenamtlich.
                </p>
                <hr class ="steckbrief">

                <?php
                    error_reporting(0);

                    // Nummer der Steckbriefdateien im Ordner zählen
                    $folder = "files/team/";
                    $files = glob($folder."*.txt");
                    $number = count($files);

                    //Für jede Steckbriefdatei
                    for($i = 0; $i <  $number; $i++){
                        //den file öffnen und auslesen
                        $text = fopen("$files[$i]","r");
                        $name = fgets($text);
                        $gebdatum = fgets($text);
                        $ort = fgets($text);
                        $rolle = fgets($text);
                        $motivation = fgets($text);
                        $erlebnis = fgets($text);
                        $warum = fgets($text);
                        $img = fgets($text);
                        fclose($text);

                        //manche Daten umwandeln
                        $gebdatum = strtotime($gebdatum);
                        $gebdatum = date("Y-m-d", $gebdatum);
                        $heute = date("Y-m-d");
                        $alter = $heute - $gebdatum;
                        if($alter == 0 ){
                            $alter = "encrypted";
                        }
                    
                        //Überprüfen ob es ein Bild gibt
                        $img = "files/team/img/$img";
                        if(!file_exists($img)){
                            $img = "files/team/img/standart.png";
                        }

                        //Anmeldung mit allen Daten ausgeben
                        echo '
                            <div class="all">
                            <div class = "steckbrief">
                                <table class = "steckbrief">
                                    <tr class = "steckbrief">
                                        <td class ="steckbrief links">Name:</td>
                                        <td class ="steckbrief rechts">'.$name.'</td>
                                    </tr>
                                    <tr class = "steckbrief">
                                        <td class ="steckbrief links">Alter:</td>
                                        <td class ="steckbrief rechts">'.$alter.'</td>
                                    </tr>
                                    <tr class = "steckbrief">
                                        <td class ="steckbrief links">Ort:</td>
                                        <td class ="steckbrief rechts">'.$ort.'</td>
                                    </tr>
                                    <tr class = "steckbrief">
                                        <td class ="steckbrief links">Rolle:</td>
                                        <td class ="steckbrief rechts">'.$rolle.'</td>
                                    </tr>
                                    <tr class = "steckbrief">
                                        <td class ="steckbrief links">Motivation:</td>
                                        <td class ="steckbrief rechts">'.$motivation.'</td>
                                    </tr>
                                    <tr class = "steckbrief">
                                        <td class ="steckbrief links">Bestes Erlebnis:</td>
                                        <td class ="steckbrief rechts">'.$erlebnis.'</td>
                                    </tr>
                                    <tr class = "steckbrief">
                                        <td class ="steckbrief links">Warum hier?</td>
                                        <td class ="steckbrief rechts">'.$warum.'</td>
                                    </tr>
                                </table>
                                </div>
                                <div class="img">
                                    <img src='.$img.' alt="Bild des Teammitglieds" class="steckbrief">
                                </div>
                                </div>
                                <hr class ="steckbrief">
                        ';
                    }
                ?>
            </div>
        </div>
        <?php
            // Footer einfügen
            include 'files/footer.php';
        ?>
    </body>
</html>