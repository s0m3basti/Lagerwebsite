<!DOCTYPE html>
<html lang="de">
    <head>
        <?php
            include 'files/linkmaker.php';
        ?>
		<title> News | DRK Sommercamp </title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="CSS/styles.css">
        <link rel="stylesheet" href="CSS/news.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
        <script type="text/javascript" src="<?php echo(linkmaker("/files/active.js"))?>"></script>
	</head>
    
    <body>
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/de_DE/sdk.js#xfbml=1&version=v6.0"></script>
        <!-- Header einfügen-->
            <?php
                include 'files/head.php';
            ?>
        <!--
           <p><img src="img/Header.png" alt="Informationen zum Sommercamp"  height="200px"></p></div>
                <h2>Beispiel Überschrift</h2>
                <p class="date">31.31.31</p>
                <br>
                <p>Beispieltext
                </p>
                <hr> 
        -->

        <div class="bg"> 
            <div id="Inhalt">
                <h1>News</h1><br>
                <p id="subhead">Hier erhalten sie die neuesten und wichtigsten Informationen rund um das Sommercamp.</p>
                <hr>
                <table>
                    <tr valign="top">
                        <td id="left">
                            <div class="news"><img src="img/Header.png" alt="Informationen zum Sommercamp"  height="200px"></p></div>
                            <h2>Beispiel Überschrift</h2>
                            <p class="date">31.31.31</p>
                            <br>
                            <p>Beispieltext
                            </p>
                            <hr>
                            <h2>Beitrag über das Sommercamp 2018 vom Teltowkanal</h2>
                            <p class="date">07.10.2018</p>
                            <br>
                            <p>
                                Wie auch in den letzten Jahren hat der Teltowkanal mal wieder einen Beitrag über das DRK Sommercamp gedreht.
                            </p><br>
                            <div>
                                <iframe width="90%" height="600" src="https://www.youtube.com/embed/DAdVkooPw-o?start=553" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="float:center"></iframe>
                            </div>
                            <p class="source">Quelle: Teltowkanal/Youtube (https://www.youtube.com/embed/DAdVkooPw-o) </p>
                            <hr>
                            <div class="news"><img src="img/preis-news.png" alt="Der Orstverbandsvorsitzende des DRK OV Königs Wusterhausen bei der Verleiung des Preises" class="news" height="350px"></div>
                            <h2>DRK Sommercamp erhält Auszeichnung</h2>
                            <p class="date">21.11.2015</p>
                            <br>
                            <p>
                                Das DRK Sommercamp konnte in diesem Jahr den Silbernen Preis des <a href="http://www.takeoffaward.de/" target="_blank">"Take of Award"</a> gewinnen. <br>
                                Wir wurden ausgezeichnet für das Engagement im Umgang im Geflüchteten. <br>
                                Das Preisgeld wird für die Umsetzung undFinanzierung des Ausgezeichneten Projektes genutzt. <br>
                                Dadurch wird ermöglicht das wir nächstes Jahr im Sommercamp 2016 10 Kinder von Geflüchteten begrüßen dürfen. <br>
                                Diese Auszeichnung erfreut uns natürlich alle sehr!
                            </p>
                            <hr>
                        </td>
                        <td id="right">
                            <h2>Immer sofort die aktuellsten Nachrichten</h2><br>
                            <div class="fb-page" data-href="https://www.facebook.com/DRK.Sommercamp/" data-tabs="timeline" data-width="400px" data-height="1080" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/DRK.Sommercamp/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/DRK.Sommercamp/">DRK Sommercamp</a></blockquote></div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
         <!-- Footer einfügen -->
        <?php
            include 'files/footer.php';
        ?>
    </body>
</html>