<?php
    // cookie für Cookieabfrage setzten
    require "../files/cookie_set.php";

    // alle benötigten files laden
    include '../files/linkmaker.php';
    include '../files/datenzugriff.php';
    
    //wenn keine Anmeldung dann auf Seite mit PopUp verweisen
    if($status != "anmeldung"){
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="de">
    <head>
		<title> Online-Anmeldung 2020 | DRK Sommercamp </title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../CSS/styles.css">
        <link rel="stylesheet" href="../CSS/online.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico">
        <script>
            <?php 
                // Preise ans JS übergebene
                if(date('Y-m-d')<=date('Y-m-d', strtotime($frühbis))){
                    echo 'const basis = '.$frühbucher.';';
                    $mompreis = $frühbucher;
                }
                else{
                    echo 'const basis = '.$preis.';';
                    $mompreis = $preis;
                }
            ?>
            const shirt = <?php echo $shirtpreis?>;
        </script>
        <script defer src="files/check.js"></script>
        <script defer src="files/preis.js"></script>
	</head>
    <body>
        <?php
            //// Header + Cookieabfrage einfügen
            include '../files/head.php';
            require '../files/cookie.php';
            
            //Berechnung des Maximalen und Minimalen alters
            //für änderungen die Zahlen ändern (8/15)
            $anfangx = strtotime($anfang);
            $anfang = date("Y-m-d", $anfangx);
            $endex = strtotime($ende);
            $ende = date("Y-m-d", $endex);

            $minyear = $anfang - 8;
            $maxyear = $anfang - 15;

            $date_a = date("-m-d",$anfangx);
            $date_e = date("-m-d",$endex);

            $min = $minyear.$date_a;
            $max = $maxyear.$date_e;

            // ID für die Anmeldung setzten
            $id=uniqid();
        ?>
        <div class="bg">
        <div id="Inhalt">
           <h1>Verbindliche Anmeldung zum DRK Sommercamp 2020</h1><br>
           <p class="sub">Bitte das Formular vollständig ausfüllen.<br> Optionale Angaben sind mit * gekennzeichnet.</p>
            <br>
               <form id="anmeldung" method="POST" action="files/senden.php" >
               <table id="t_anmeldung" class="zentrierte-tabelle">
                   <input type="hidden" name="id" value="<?php echo $id ?>">
                   <tr style="height: 1px;">
                       <td style="width: 20%;"></td>
                       <td style="width: 30%;"></td>
                       <td style="width: 20%;"></td>
                       <td style="width: 30%;"></td>
                   </tr>
                    <tr>
                        <td scope="colgroup" colspan="4"><h2>Mein Kind:</h2></td>
                    </tr>    
                    <tr>
                       <td>Vorname des Kindes:&nbsp</td>
                       <td> <input type="text" name="kind_vorname" id="kind_vorname" class="normal"><br><p class="fehler" id="er_kind_nachname"></p></td>
                       <td>Nachname des Kindes:&nbsp</td>
                       <td> <input type="text" name="kind_nachname" id="kind_nachname" class="normal"><br><p class="fehler" id="er_kind_name"></p></td>
                   </tr>
                   <tr>
                       <td><label><input type="radio" name="kind_geschlecht" id="kind_geschlecht_female" value="female"> weiblich</label><br></td>
                       <td><label><input type="radio" name="kind_geschlecht" id="kind_geschlecht_male" value="male"> männlich</label><p class="fehler" id="er_kind_geschlecht"></p></td>
                       <td>Geburtsdatum:&nbsp</td>
                       <td><input type="date" name="kind_geb" id="kind_geb" min="<?php echo $max ?>" max="<?php echo $min ?>"><br><p class="fehler" id="er_kind_geb"></p></td> 
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td scope="colgroup" colspan="4"><h2>Angaben zu den Sorgeberechtigten:</h2></td>
                    </tr>
                    <tr>    
                        <td>Vorname:&nbsp</td>
                        <td> <input type="text" name="eltern_vorname" id="eltern_vorname" class="normal" ><br><p class="fehler" id="er_eltern_vorname"></p></td>
                        <td>Nachname:&nbsp</td>
                        <td> <input type="text" name="eltern_name" id="eltern_name"class="normal" > <br><p class="fehler" id="er_eltern_name"></p> </td>
                    </tr>
                    <tr>    
                        <td>Straße & Hausnummer:&nbsp</td>
                        <td scope="colgroup" colspan="3"><input type="text" name="strasse" id="strasse" class="wide" ><br><p class="fehler" id="er_strasse"></p></td>
                    </tr>
                    <tr>    
                        <td>Postleitzahl:&nbsp</td>
                        <td> <input type="text" name="plz" id="plz" class="short"><br><p class="fehler" id="er_plz" ></p> </td>
                        <td>Ort:&nbsp</td>
                        <td> <input type="text" name="ort" id="ort" class="normal"> <br><p class="fehler" id="er_ort" ></p></td>
                    </tr>
                    <tr>    
                        <td>Tel.(privat)*:&nbsp</td>
                        <td> <input type="text" name="tel_priv" id="tel_priv" class="normal"> <br><p class="fehler" id="er_tel_priv"></p></td>
                        <td>Tel.(mobil)*:&nbsp</td>
                        <td> <input type="text" name="tel_handy" id="tel_handy" class="normal"><br><p class="fehler" id="er_tel_handy"></p></td>
                    </tr>
                    <tr>    
                        <td>Tel.(dienstlich)*:&nbsp</td>
                        <td> <input type="text" name="tel_dienst" id="tel_dienst" class="normal"> <br><p class="fehler" id="er_tel_dienst"></p></td>
                        <td>
                        <td>
                    </tr>
                    <tr>    
                        <td><b>E-Mail-Adresse:&nbsp</b></td>
                        <td scope="colgroup" colspan="3"><input type="email" name="email" id="email" class="wide" ><br><p class="fehler" id="er_email"></p></td>
                    </tr>
                    <tr>
                        <td scope="colgroup" colspan="4">Ich bin <label><input type="checkbox" name="mitglied" id="mitglied"> aktives Mitglied </label> <label><input type="checkbox" name="mitarbeiter" id="mitarbeiter"> Mitarbeiter </label> im DRK Kreisverband Fläming-Spreewald e.V.</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td scope="colgroup" colspan="4"><h2>Angaben für den Betreuer:</h2></td>
                    </tr>
                    <tr>    
                        <td>Mein Kind ist:&nbsp</td>
                        <td> <label><input type="radio" name="schwimmer" id="schwimmer_ja" value="ja" checked > Schwimmer </label> &nbsp&nbsp&nbsp(Stufe:* <input type="text" name="schwimmstufe" id="schwimmstufe" class="short">)<br><p class="fehler" id="er_schwimmstufe"></p></td>
                        <td> <label><input type="radio" name="schwimmer" id="schwimmer_nein" value="nein"> Nichtschwimmer</label></td>

                    </tr>
                    <tr>    
                        <td>Badeerlaubnis erteilt*:&nbsp</td>
                        <td> <label><input type="radio" name="baden" id="baden_ja" value="ja" checked > Ja</label></td>
                        <td> <label><input type="radio" name="baden" id="baden_nein" value="nein"> Nein</label></td>
                        <td></td>
                    </tr>
                    <tr>    
                        <td>Springen ins Wasser:&nbsp</td>
                        <td> <label><input type="radio" name="springen" id="springen_ja" value="ja" checked > Erlaubt </label></td>
                        <td> <label><input type="radio" name="springen" id="springen_nein" value="nein"> Nicht erlaubt </label></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td scope="colgroup" colspan="4">Spezielle Ernährung/ Vegetarisch&nbsp</td>
                    </tr>
                    <tr>
                        <td scope="colgroup" colspan="4"><input type="text" name="ernaehrung" id="ernaehrung" class="wide"><br><p class="fehler" id="er_ernaehrung"></p></td>
                    </tr>
                    <tr>
                        <td scope="colgroup" colspan="4">Liegen akute oder chronische Krankheiten vor? Wenn ja, welche?&nbsp</td>
                    </tr>
                    <tr>
                            <td scope="colgroup" colspan="4"><input type="text" name="krankheit" id="krankheit" class="wide"><br><p class="fehler" id="er_krankheit"></p></td>
                    </tr>
                    <tr>
                        <td scope="colgroup" colspan="4">Müssen regelmäßig Medikamente genommen werden? Wenn ja, welche?&nbsp</td>
                    </tr>
                    <tr>
                            <td scope="colgroup" colspan="4"><input type="text" name="medizin" id="medizin" class="wide"><br><p class="fehler" id="er_medizin"></p></td>
                    </tr>
                    <tr>
                        <td scope="colgroup" colspan="2">Taschengeldverwaltung durch den Betreuer erwünscht? (empfohlen)</td>
                        <td><label><input type="radio" name="geld" id="geld_ja" value="ja" checked > Ja </label></td>
                        <td><label><input type="radio" name="geld" id="geld_nein" value="nein"> Nein </label></td>
                    </tr>
                    <tr>
                        <td scope="colgroup" colspan="4">Mein Kind ist <label><input type="radio" name="kv_art" id="kv_art_prv" value="privat"> privat</label> / <label><input type="radio" name="kv_art" id="kv_art_ges" value="gesetzlich"> gesetzlich</label> krankenversichert bei:&nbsp</td>
                    </tr>
                    <tr>
                        <td scope ="colgroup" colspan ="4"><p class="fehler" id="er_kvart"></p></td>
                    </tr>
                    <tr>
                        <td scope="colgroup" colspan="4"><input type="text" name="versicherung" id="versicherung" class="wide" disabled="true" ><br><p class="fehler" id="er_versicherung"></p></td>
                    </tr>
                    <tr>
                        <td scope="colgroup" colspan="2">Mein Kind darf im Rahmen des Sommercamps mit privaten KFZ befördert werden?</td>
                        <td><label><input type="radio" name="kfz" id="kfz_ja" value="ja" checked > Ja </label></td>
                        <td><label><input type="radio" name="kfz" id="kfz_nein" value="nein"> Nein </label></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td scope="colgroup" colspan="4"><h2>Zahlungsmodalitäten:&nbsp</h2></td>
                    </tr>
                    <tr>
                        <td>Ratenzahlung:</td>
                        <td><label><input type="radio" name="raten" id="raten_ja" value="ja"> Ja </label>&nbsp&nbsp&nbsp Raten:&nbsp <input type="number" name="anzahl" id="anzahl" min="2" max="3" disabled="true">&nbsp(max. 3)<br><p class="fehler" id="er_anzahl"></td>
                        <td><label><input type="radio" name="raten" id="raten_nein" value="nein"  checked> Nein</label></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td scope="colgroup" colspan="4"><h2>Zusatzbestellung Sommercamp Shirt:&nbsp</h2></td>
                    </tr>
                    <tr>
                        <td scope="colgroup" colspan="4">Sie haben die Möglichkeit Sommercamp-T-Shirts zu bestellen. Je T-Shirt werden zusätzlich 15,00 € berechnet. Die Ausgabe der T-Shirts erfolgt bei der Anreise.</td>
                    </tr>
                    <tr>
                        <td><label><input type="radio" name="shirt" id="shirt_ja" value="ja">Ich bestelle &nbsp</label></td>
                        <td scope="colgroup" colspan="3"><input type="number" name="shirtanzahl" id="shirtanzahl" min="1" max="5" disabled="true">
                            &nbsp;T-Shirts in der Größe&nbsp;
                            <select name="shirtgroesse" id="shirtgroesse" disabled="true">
                                <option value="default"> Größe auswählen </option>
                                <option value="98/104"> 98/104 </option>
                                <option value="110/116"> 110/116 </option>
                                <option value="122/128"> 122/128 </option>
                                <option value="134/140"> 134/140 </option>
                                <option value="146/152"> 146/152 </option>
                                <option value="158/164"> 158/164 </option>
                                <option value="S"> S </option>
                                <option value="M"> M </option>
                                <option value="L"> L </option>
                                <option value="XL"> XL </option>
                                <option value="XXL"> XXL </option>
                                <option value="cool" selected></option>
                            </select></td>
                    </tr>
                    <tr>
                        <td scope="colgroup" colspan="2"><label><input type="radio" name="shirt" id="shirt_nein" value="nein" checked>Keine T-Shirts gewünscht.</label><br><p class="fehler" id="er_shirtgroesse"></p></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td scope="colgroup" colspan="4"><h2>Umfrage:</h2></td>
                    </tr>
                    <tr>
                        <td scope="colgroup" colspan="2">Wie haben sie von DRK Sommercamp erfahren? <br> (Diese Angabe ist nicht verpflichtend)</td>
                        <td scope="colgroup" colspan="2">
                            <select name="umfrage" id="umfrage">
                                <option value="keine_angaben" default>keine Angaben</option>
                                <option value="kontakte">Persönliche Kontakte</option>
                                <option value="teilnehmer">Teilnehmer</option>
                                <option value="facebook">Facebook</option>
                                <option value="webseite">Webseite</option>
                                <option value="flyer">Flyer</option>
                                <option value="presse">Presse</option>
                                <option value="fernsehen">Fernsehen</option>
                                <option value="kreisverband">Kreisverband</option>
                                <option value="veranstaltungen">Veranstaltungen</option>
                                <option value="andere_werbung">Andere Werbemaßnahmen</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td scope="colgroup" colspan="4"><h2>Wichtige Informationen zum Anmeldeverfahren:&nbsp</h2></td>
                    </tr>
                    <tr>
                        <td scope="colgroup" colspan="4">Nach Eingang der Anmeldung erhalten sie eine Anmeldebestätigung. Bei Reiserücktritt später als 14 Tage vor Beginn der Maßnahme stellt der DRK-OV-Königs Wusterhausen Ihnen die anfallenden Kosten in voller Höhe in Rechnung. Bei plötzlicher Erkrankung reichen Sie uns bitte die Kopie des Krankenscheins ein.
                                Eine Erstattung für bestellte T-Shirts ist nicht möglich.</td>
                    </tr>
                    <tr>
                        <td scope="colgroup" colspan="4"><h2>Als Sorgeberechtigte(r) erkläre ich:&nbsp</h2></td>
                    </tr>
                    <tr>
                        <td scope="colgroup" colspan="4">
                            <ul>
                                <li>Für die Dauer des Sommercamps übertrage ich die Ausübung der Personensorge über mein Kind dem DRK-OV Königs Wusterhausen. Ich bin damit einverstanden, dass die Ausübung im erforderlichen Ausmaß weiter übertragen wird. Dabei ist mir bewusst, dass die Aufsicht über mein Kind von den verantwortlichen GruppenleiterInnen nur in einem Umfang wahrgenommen werden kann, der zumutbar ist. Dies gilt insbesondere zu Zeiten der Nachtruhe oder während anderer, unaufschiebbarer Verrichtungen.</li>
                                <li>Den Weisungen der Aufsichtspersonen hat mein Kind nachzukommen. Mir ist bewusst, dass ein schuldhaftes Verhalten meines Kindes eine Haftung des DRK-OV Königs Wusterhausen ausschließen kann. Ich bin damit einverstanden, dass mein Kind bei schwerwiegenden Verstößen gegen die Freizeitordnung sowie aus pädagogischen Gründen (z. B. nicht mehr vertretbares Heimweh) die Maßnahmen vorzeitig auf eigene Kosten abbrechen muss. Aufenthaltskosten für den Rest der Freizeit werden nicht zurückerstattet. Mir ist bekannt, dass ich sicherzustellen habe, dass entweder ich selbst oder eine von mir beauftragte Person für diese Zeit mein Kind aufnimmt. Diese beauftragte Person muss ebenfalls das Recht haben zu entscheiden, auf welche Weise das Kind befördert wird.</li>
                                <li>Ich verpflichte mich, vor Campbeginn dem DRK-OV Königs Wusterhausen Auskunft über den Gesundheitszustand meines Kindes zu erteilen. Kurzfristige Veränderungen teile ich dem DRK-OV Königs Wusterhausen mit. Auch andere Umstände, welche einer besonderen Fürsorge für das Kind bedürfen (z.B.: das Kind ist Asthmatiker, Bettnässer, muss medikamentös versorgt werden, usw.), teile ich dem DRK-OV Königs Wusterhausen mit.</li>
                                <li>Ich bin damit einverstanden, dass erforderliche, vom Arzt für dringend erachtete Schutzimpfungen sowie sonstige ärztliche Maßnahmen, einschließlich dringend erforderlicher Operationen, veranlasst werden, wenn aufgrund besonderer Umstände mein Einverständnis nicht mehr rechtzeitig eingeholt werden kann.</li>
                                <li>Mein Kind ist zum Zeitpunkt des Campbeginns frei von ansteckenden Krankheiten, Läusen oder Nissen. Ist das Kind vor dem Sommercamp erkrankt oder besteht der Verdacht auf Lausbefall ist eine ärztliche Bestätigung (Ferienlagertauglichkeit) bei der Anreise vorzulegen.</li>
                                <li>Ich bin damit einverstanden, dass Foto-, Film- und Audioaufnahmen, die von meinem Kind während des Sommercamps gemacht werden für soziale Medien, Veröffentlichungen und Marketingzwecke des DRK-OV- Königs Wusterhausen verwendet werden dürfen.</li>
                            </ul>
                            <br> Der Teilnahmebeitrag beträgt für den Gesamtzeitraum <p id="preis" style="display:inline;"><?php echo trim($mompreis)?></p>,- €. Abweichende Preise bei kürzerer Teilnahme oder Anmeldung mehrerer eigener Kinder bitte vorab per Mail erfragen <?php echo($kontaktmail) ?> erfragen.
                        </td>
                    </tr>
                    <tr>
                        <td scope="colgroup" colspan="4"><label class="list"><input type="checkbox" name="final" class="list" required><span class="list"><b> Mit Absenden dieses Formulars erkläre ich mich mit den o.g. Bedingungen einverstanden und melde mein Kind verbindlich zum Sommercamp 2020 an.</span></label></td>
                    </tr>
                    <tr>
                        <td scope="colgroup" colspan="4"><label class="list"><input type="checkbox" name="datenschutz" class="list" required> <span class="list">Ich habe die Erklärungen zur Speicherung und Nutzung personenbezogener Daten unter <a href="../datenschutz.php" class="old-link" target="_blank">Datenschutzerklärung</a> gelesen und erkläre mich damit einverstanden.</span></label></td>
                    </tr>
                    <tr>
                        <td scope="colgroup" colspan="4" style="text-align:center"><input name="Submit" id="submit" type="submit" class="submit_button" value="Kostenpflichtig bestellen"><br><p class="fehler" id="er_submit"></p></td>
                    </tr>
               </table>
           </form>
           <br>
        </div>
        </div>
        <?php
            // Footer einfügen 
            include '../files/footer.php';
        ?>
    </body>
</html>