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
            require 'files/datenzugriff.php';
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
            <?php
                // Header + Cookieabfrage einfügen
                include 'files/head.php';
                require 'files/cookie.php';
            ?>
        <!--
                <div class="news"><p><img class="news" src="img/Header.png" alt="Informationen zum Sommercamp"  height="200px"></p></div>
                <h2>Beispiel Überschrift</h2>
                <p class="date">31.31.2031</p>
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
                            <div class="news"><p><img class="news" src="img/news_2021.jpeg" alt="2021"  height="350px"></p></div>
                                <h2>Das Sommercamp 2021 steht in den Startlöchern</h2>
                                <p class="date">15.07.2021</p>
                                <br>
                                <p>Die finalen Vorbereitungen für das diesjährige Camp laufen aufhochtouren. Die Zelte sind bereits aufgebaut (Vielen Dank an alle fleißigen Helfer!). Ab Freitagabend ist das Team bereits in voller Stärke im Camp Vorort. <br><br>
                                    Am Sonntag, den 18.07.2021, ist Anreise. Bitte beachten Sie die Zeitslots die ihnen via Mail gesendet wurden, achten sie auf einen aktuellen Corona-Test für die Teilnehmer und geben sie ausreichend Masken für 13 spannende Tage mit. Nur so können wir einen reibungslosen Ablauf in Pandemiezeiten gewährleisten. <br><br>
                                    Der Countdown zum offizielle Start des DRK Sommercamps läuft.<br>
                                    Die Vorfreude ist riesig!
                                </p>
                                <hr> 
                            <div class="news"><p></p></div>
                                <h2>Sommercamp 2021 findet statt</h2>
                                <p class="date">24.05.2021</p>
                                <br>
                                <p>
                                Die Freude ist Groß. So wie die derzeitige Situation aussieht findet das Sommercamp statt. <br><br>
                                Kinder, Betreuer & Helfer dürfen am Sommercamp nur teilnehmen, wenn sie von einer Corona-Erkrankung nachweislich genesen oder mind. 14 Tage vor der Anreise vollständig geimpft worden sind. 
                                Trifft beides nicht zu, kann zur Anreise ein negatives Testergebnis vorgelegt werden welches nicht älter als 24 Stunden ist oder wir testen vor Ort mittels Schnelltest. <br><br>
                                Wir werden im Verlauf des Lagers mind. eine weitere (Selbst)Testung vornehmen. Hierfür ist die Einverständniserklärung der Sorgeberechtigten zwingend erforderlich. Eine Teilnahme ohne diese Erklärung ist nicht möglich.
                                Die Einverständniserklärung muss bei der Anreise unterschrieben werden. <br><br>
                                Im Speisesaal besteht die Verpflichtung zum Tragen eines Mund-Nase-Schutzes, wenn man nicht am Platz sitzt. Aus diesem Grund geben Sie ihrem Kind bitte ausreichend Masken mit.
                                </p>
                                <hr> 
                                <h2>Launch der neuen Sommercamp-Webseite</h2>
                                <p class="date">18.10.2020</p>
                                <br>
                                <p>
                                    Ab heute ist die neue Webseite des DRK-Sommercamps öffentlich.<br>
                                    Die Webseite bietet neben einem neuen Design auch einige neue Funktionen, wie zum Beispiel:
                                        <ul>
                                            <li>diesem Newsfeed</li>
                                            <li>einem Teamabschnitt</li>
                                            <li>Dokumente zum Herunterladen</li>
                                            <li>und einer verbesserten Anmeldung.</li>
                                        </ul><br>
                                    Zudem wurden auch interne Prozesse umgestellt. <br>
                                    Sollte es Fragen geben, wenden sie sich gerne an <a href="mailto:<?php echo $kontaktmail ?>" class="old-link"><?php echo trim($kontaktmail)?></a>.
                                </p>
                                <hr> 
                            <div class="news"><p></p></div>
                                <h2>Sommercamp 2020 fällt aus</h2>
                                <p class="date">18.05.2020</p>
                                <br>
                                <p>
                                Liebe Kinder,<br>
                                liebe Eltern,<br><br>
                                niemand konnte vorhersehen, wie sich die Situation entwickelt. Leider müssen wir jetzt mitteilen, dass das Sommerlager 2020 nicht stattfinden wird 🙁. Das Camp ist auf Gemeinschaft und Spaß ausgelegt. Wir werden trotz größter Anstrengungen die Vorgaben gemäß Eindämmungsverordnung in der Form nicht realisieren können, sodass wir uns schweren Herzens gemeinsam mit dem Kreisverband dazu entschlossen haben, das diesjährige Sommercamp abzusagen.<br>
                                Wir hoffen nun, dass sich die Lage zum nächsten Jahr beruhigt und wir 2021 wieder ein Sommercamp durchführen können. Informieren Sie sich dazu gern regelmäßig auf unserer Webseite oder auf Facebook.<br>
                                Wir wünschen Ihnen und Ihren Kindern, dass sie gesund durch diese außergewöhnliche Zeit kommen und freuen uns auf ein Wiedersehen 2021.<br>
                                Wir würden sie gern über das Sommerlager 2021 informieren und Ihnen Informationen direkt zusenden. Wenn Sie dies wünschen, informieren sie uns bitte per eMail.<br><br>
                                Viele Grüße vom gesamten Team des Sommerlagers<br>
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
                                Das DRK Sommercamp konnte in diesem Jahr den silbernen Preis des <a href="http://www.takeoffaward.de/" target="_blank">"Take of Award"</a> gewinnen. <br>
                                Wir wurden ausgezeichnet für das Engagement im Umgang mit Geflüchteten. <br>
                                Das Preisgeld wird für die Umsetzung und Finanzierung des ausgezeichneten Projektes genutzt. <br>
                                Dadurch wird ermöglicht, dass wir nächstes Jahr im Sommercamp 2016, 10 Kinder von Geflüchteten begrüßen dürfen. <br>
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
        <?php
            // Footer einfügen 
            include 'files/footer.php';
        ?>
    </body>
</html>