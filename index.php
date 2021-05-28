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
            include 'files/datenzugriff.php';  
        ?>
		<title> Startseite | DRK Sommercamp </title>
		<meta charset="UTF-8">
        <link rel="stylesheet" href="CSS/styles.css">
        <link rel="stylesheet" href="CSS/startseite.css">
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
                <a href="<?php echo(linkmaker("/anmeldung/index.php"))?>"> <img src="<?php echo(linkmaker("/img/Header.png"))?>" alt="Banner für das Sommercamp 2020" title="Zur Anmeldung klicken" id="test"></a>
                <h1>Spaß und Action im DRK-Sommercamp <?php echo $jahr ?></h1><br>
                <img src="<?php echo(linkmaker("/img/volleyball.png"))?>" alt="Kinder beim Volleyball spielen" id="vb">
                <p>
                    Das Sommercamp des Jugendrotkreuzes Königs Wusterhausen findet vom <?php echo $anfang ?> bis <?php echo $ende ?> statt. Tatkräftige Helfer bauen im bewaldeten und am Huschtesee gelegenen Gelände des KJF Prieros gGmbH unsere kleine Zeltstadt auf, um mit euch 13 erlebnisreiche Tage zu verbringen.
                </p><br>
                <img src="<?php echo(linkmaker("/img/basteln.png"))?>" alt="Kinder beim Basteln" id="basteln">
                <p>
                    In jedem Jahr steht das Camp unter einem bestimmten Motto, welches in einem großen Fest sein Höhepunkt erreicht. Bei den Vorbereitungen können die Kinder ihrer Kreativität freien Lauf lassen, indem sie Ihre Kostüme bzw. die Hintergrundkulisse selber basteln, natürlich mit der tatkräftigen Unterstützung der Betreuer. Mit einem kleinen Rollenspiel von den Betreuern wird das große Fest, in der Mitte des Camps, eröffnet. Anschließend können die Kinder bei verschiedenen Spielen ihre Teamfähigkeit, ihre Geschicklichkeit und ihr Zusammenhalt unter Beweis stellen. Mit einem gemütlichen Grillabend mit Lagerfeuer und Disco endet unser großes Fest.
                </p><br>
                
                <p>
                    Damit ist das Sommercamp aber noch nicht beendet. Es folgen noch viele tolle Aktionen. Einen Tag lang machen wir mit allen Kindern einen Ausflug. Wir waren schon im Sonnenblumenlabyrinth, im FEZ-Berlin und im Dinopark, wir versuchen aber jedes Jahr ein neues Highlight zu finden! An den restlichen Tagen vertreiben wir uns die Zeit mit Baden, Spielen, Basteln oder mit anderen schönen Ideen, sodass die Kinder immer mit viel Freude und Spaß dabei sind. Aber auch in der Nacht bieten wir den Kindern ein abwechslungsreiches Programm. Nicht nur eine Nachtwanderung steht auf dem Plan, sondern auch ein gemütlicher Waldspaziergang durch die Nacht.
                </p><br>
                <p>
                    Alles in allem können die Kinder erlebnisreiche Ferientage bei uns verbringen. 
                    Noch eine Bemerkung in eigener Sache: Ein großer Dank gilt allen ehrenamtlichen Betreuern und Helfern, die für die Durchführung des Sommercamps auf einen großen Teil Ihres Jahresurlaubes verzichten. Sowie den unterstützenden Firmen ohne die wir vieles im Sommercamp nicht realisieren könnten.
                    Wir freuen uns auf ein volles Sommercamp. Und sagen ab <?php echo $anfang ?> wieder: „Auf die Zelte, fertig, los.“
                </p><br>
            </div>
            <?php
                // Footer einfügen 
                include 'files/footer.php';
            ?>
        </div>
    </body>
</html>