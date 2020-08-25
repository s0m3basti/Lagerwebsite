<br>
<p> Du kannst die Anmeldung jetzt aktivieren. </p>
<p> Wenn du die Anmeldung jetzt aktivierst musst du die Daten für das nächste Jahr überprüfen, danach wird die Anmeldung freigegeben.
    <?php
        if(!isset($_GET["step"])){
            echo '
                <br> Die Daten der Anmeldungen aus dem letzten Jahr werden gelöscht und die Voranmelder werden via Mail informiert.
                <br> Sobald sie informiert wurden, werden auch ihre Daten gelöscht.
                <br>
                <a href = "?step=1"><button>Anmeldung aktivieren</button></a>
            ';
        }
        else{
            echo '
                <br> Gleiche hier die Daten für das nächste Jahr ab.
                <br> Sind sie falsch, gebe die Daten für das nächste Jahr ein.
                <form action="files/status_senden.php?von=voranmeldung&nach=anmeldung" method="POST">
                <table style="margin: auto">
                    <tr> <td>Jahr des nächsten Lagers</td><td><input type="number" name="jahr" value='.intval($jahr).'></td></tr>
                    <tr> <td>Anfang des nächsten Lagers</td><td><input type="date" name="anfang" value='.date('Y-m-d',strtotime($anfang)).'></td></tr>
                    <tr> <td>Ende des nächsten Lagers</td><td><input type="date" name="ende" value='.date('Y-m-d',strtotime($ende)).'></td></tr>
                    <tr> <td>Preis des nächsten Lagers</td><td><input type="number" name="preis" value='.intval($preis).'></td></tr>
                    <tr> <td>Frühbucherpreis des nächsten Lagers</td><td><input type="number" name="frühbucher" value='.intval($frühbucher).'></td></tr>
                    <tr> <td>Frühbucher bis einschließlich</td><td><input type="date" name="frühbis" value='.date('Y-m-d',strtotime($frühbis)).'></td></tr>
                    <tr> <td>Shirtpreis des nächsten Lagers</td><td><input type="number" name="shirtpreis" value='.intval($shirtpreis).'></td></tr>
                    <tr> <td colspan="2">Wenn die Daten nun stimmen klicke auf bestätigen.</td></tr>
                    <tr> <td colspan="2"><input type="submit" value="Bestätigen"></td></tr>
                </table>
                </form>
                <a href="status.php"><button>Zurück</button></a>
            ';
        }
    ?>

</p>
