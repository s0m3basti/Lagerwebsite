<?php
if(isset($_GET['cookie'])){
    setcookie('BesterKeksderWelt', 'true', time() + 2628000 );
    header("Location: /.");
}
?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <?php
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
        <!-- Header einfügen-->
        <?php
            include 'files/head.php';
            require 'files/cookie.php';
        ?>
        <div class="bg">       
            <div id="Inhalt">
                <!-- <p>
                    Work in Progress
                </p>
                <img src="img/work-in-progress.png" alt="Baustellenschild'Work in Progress'" title="Work in Progress" class="work"> -->

                <h1>Steckbriefer der Teammitglieder</h1>
                <br>
                <p class="vorwort">
                    Hier einen Text einfügen
                </p>
                <hr class ="steckbrief">

                <?php
                    error_reporting(0);

                    $folder = "files/team/";
                    $files = glob($folder."*.txt");
                    $number = count($files);

                    for($i = 0; $i <  $number; $i++){
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

                        $gebdatum = strtotime($gebdatum);
                        $gebdatum = date("Y-m-d", $gebdatum);
                        $heute = date("Y-m-d");
                        $alter = $heute - $gebdatum;
                        if($alter == 0 ){
                            $alter = "encrypted";
                        }

                    
                        $img = "files/team/img/$img";
                        if(!file_exists($img)){
                            $img = "files/team/img/standart.png";
                        }

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
         <!-- Footer einfügen -->
        <?php
            include 'files/footer.php';
        ?>
    </body>
</html>