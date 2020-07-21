<!DOCTYPE html>
<html lang="de">
    <head>
        <?php
            include 'files/linkmaker.php';
        ?>
		<title> Dokumente | DRK Sommercamp </title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="CSS/styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
        <script type="text/javascript" src="<?php echo(linkmaker("/files/active.js"))?>"></script>
	</head>
    
    <body>
        <!-- Header einfügen-->
        <?php
            include 'files/head.php';
        ?>
        <div class="bg">       
            <div id="Inhalt">
            <h1 class="doku">Dokumente</h1>
            <h2 class="doku">Hier erhalten sie einige der wichtigsten Dokumente, wie der Kofferpackliste, der Anmeldung und weitere zusätzliche Dateien.</h2>
            <table class="doku" id="dokumente">
                <tr id="dtbl_head" class="doku">
                    <td id="dtbl_left" class="doku"> Dokument </td>
                    <td id="dtbl_middle" class="doku"> Beschreibung </td>
                    <td id="dtbl_right" class="doku"> Link zur Datei </td>
                </tr>
                <!-- Beispiel für das Einfügen neuer Dokumente
                <tr class="doku">
                    <td class="doku_name">Name</td>
                    <td class="doku_besch">Beschreibung</td>
                    <td class="doku_link"><a href="Link" target="_blank">Link</a></td>
                </tr>    
                -->
                <tr class="doku">
                    <td class="doku_name">Anmeldung für das DRK Sommercamp</td>
                    <td class="doku_besch">Mit diesem Dokument können sie ihr Kind für das DRK Sommercamp anmelden. Einfach ausdrucken und per Post an die angegebene Adresse senden. <br> Aber da sie schon mal hier sind probieren sie doch unsere <a class="old-link" href="anmeldung/index.php">Online-Anmeldung</a>.<br> Das geht wesentlich schneller und ist zudem auch noch einfacher.</td>
                    <td class="doku_link"><a href="dokumente/Anmeldung_2020.pdf" target="_blank">Link</a></td>
                </tr>
                <tr class="doku">
                    <td class="doku_name">Packliste</td>
                    <td class="doku_besch">Nicht nur für sie ist es gut zu wissen was ihr Kind alles mit ins Abenteuer nehmen sollte. Auch für uns ist es von Vorteil, wenn wir wissen welche Sachen ihr Kind mitgebracht hat. Einfach ausdrucken und mit in den Koffer legen. Simpel wie genial.</td>
                    <td class="doku_link"><a href="Link" target="_blank">Link</a></td>
                </tr> 
                <tr class="doku">
                    <td class="doku_name">Name</td>
                    <td class="doku_besch">Beschreibung</td>
                    <td class="doku_link"><a href="Link" target="_blank">Link</a></td>
                </tr> 
            </table>
            <p class="doku">Um ein Dokument zu speichern gehen sie auf den Link zum Dokument. In dieser Ansicht könne sie es dann speichern oder direkt ausdrucken.</p>
            </div>
        </div>
         <!-- Footer einfügen -->
        <?php
            include 'files/footer.php';
        ?>
    </body>
</html>