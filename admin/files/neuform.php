<h2>Trage hier alle Daten ein die du auf der Anmeldung findest.</h2>
<p>Bitte verwende dabei exakte Eingaben, dieses Formular wird nicht weiter überprüft.
<br>Bitte trage alle Benötigten Werte ein. Solltest du dir unsicher sein, trage etwas ein. Die Anmeldung kann später noch geändert werden.
</p>

<?php
    $id=uniqid();
?>

<form method="POST" action="files/neusenden.php" >
    <table class="neu">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <tr class="neu">
            <td scope="colgroup" colspan="2"><h2>Stammdaten des Kindes:</h2></td>
        </tr>    
        <tr class="neu">
            <td class="neu">Vorname des Kindes:</td>
            <td class="neu"> <input type="text" name="k_vorname" size="30"></td>
        </tr>
        <tr class="neu">
            <td class="neu">Nachname des Kindes:</td>
            <td class="neu"> <input type="text" name="k_nachname" size="30"></td>
        </tr>
        <tr class="neu">
            <td class="neu">Geschlecht des Kindes:</td>
            <td class="neu"><select name="geschlecht"><option value="maennlich">Männlich</option><option value="weiblich">Weiblich</option></select></td>
        </tr>
        <tr class="neu">
            <td class="neu">Geburtstag des Kindes:</td>
            <td class="neu"><input type="date" name="gebdatum"></td>
        </tr>
        <tr class="neu">
            <td scope="colgroup" colspan="2"><h2>Angaben zu den Sorgeberechtigten:</h2></td>
        </tr>
        <tr class="neu">
            <td class="neu">Vorname des Sorgeberechtigten:</td>
            <td class="neu"><input type="text" name="e_vorname" size="30" ></td>
        </tr>               
        <tr class="neu">
            <td class="neu">Nachname des Sorgeberechtigten:</td>
            <td class="neu"><input type="text" name="e_nachname" size="30" ></td>
        </tr>
        <tr class="neu">
            <td class="neu">Straße:</td>
            <td class="neu"><input type="text" name="strasse" size="50" ></td>
        </tr>
        <tr class="neu">
            <td class="neu">Postleitzahl:</td>
            <td class="neu"><input type="text" name="plz" size="6"></td>
        </tr>
        <tr class="neu">
            <td class="neu">Ort:</td>
            <td class="neu"><input type="text" name="ort" size="30"></td>
        </tr>
        <tr class="neu">
            <td class="neu">Telefon (privat)</td>
            <td class="neu"><input type="text" name="tel_pri" size="30"></td>
        </tr>
        <tr class="neu">
            <td class="neu">Telefon (Handy)</td>
            <td class="neu"><input type="text" name="tel_handy" size="30"></td>
        </tr>
        <tr class="neu">
            <td class="neu">Telefon (dienstlich)</td>
            <td class="neu"><input type="text" name="tel_dienstl" size="30"></td>
        </tr>
        <tr class="neu">
            <td class="neu">E-Mail-Adresse</td>
            <td class="neu"><input type="email" name="email"  size="50" ></td>
        </tr>
        <tr class="neu">
            <td class="neu">Mitglied</td>
            <td class="neu"><input type="checkbox" name="mitglied"></td>
        </tr> 
        <tr class="neu">
            <td class="neu">Mitarbeiter</td>
            <td class="neu"><input type="checkbox" name="mitarbeiter"></td>
        </tr>
        <tr class="neu">
            <td scope="colgroup" colspan="2"><h2>Angaben für den Betreuer:</h2></td>
        </tr>  
        <tr class="neu">
            <td class="neu">Schwimmer</td>
            <td class="neu"><select name="schwimmer"><option value="ja">Ja</option><option value="nein">Nein</option></select></td>
        </tr> 
        <tr class="neu">
            <td class="neu">Schwimmstufe</td>
            <td class="neu"><input type="text" name="schwimmstufe" size="10"></td>
        </tr> 
        <tr class="neu">
            <td class="neu">Badeerlaubnis</td>
            <td class="neu"><select name="badeerlaubnis"><option value="ja">Ja</option><option value="nein">Nein</option></select></td>
        </tr> 
        <tr class="neu">
            <td class="neu">Springen</td>
            <td class="neu"><select name="springen"><option value="ja">Ja</option><option value="nein">Nein</option></select></td>
        </tr> 
        <tr class="neu">
            <td class="neu">Ernährung</td>
            <td class="neu"><input type="text" name="ernaehrung" size="90"></td>
        </tr> 
        <tr class="neu">
            <td class="neu">Krankheiten</td>
            <td class="neu"><input type="text" name="krankheit" id="krankheit" size="90"></td>
        </tr>           
        <tr class="neu">
            <td class="neu">Medikamente</td>
            <td class="neu"><input type="text" name="medikamente" size="90"></td>
        </tr> 
        <tr class="neu">
            <td class="neu">Taschengeldverwaltung</td>
            <td class="neu"><select name="taschengeld"><option value="ja">Ja</option><option value="nein">Nein</option></select></td>
        </tr> 
        <tr class="neu">
            <td class="neu">Art der KV</td>
            <td class="neu"><select name="kv_art"><option value="gesetzlich">Gesetzlich</option><option value="privat">Privat</option></select> </td>
        </tr> 
        <tr class="neu">
            <td class="neu">Name der KV</td>
            <td class="neu"><input type="text" name="kv_name" size="90"></td>
        </tr> 
        <tr class="neu">
            <td class="neu">Private KFZ</td>
            <td class="neu"><select name="kfz"><option value="ja">Ja</option><option value="nein">Nein</option></select></td>
        </tr> 
        <tr class="neu">
            <td class="neu">Ratenzahlung</td>
            <td class="neu"><select name="raten"><option value="ja">Ja</option><option value="nein">Nein</option></select></td>
        </tr> 
        <tr class="neu">
            <td class="neu">Ratenanzahl</td>
            <td class="neu"><input type="number" name="ratenanzahl" min="2" max="3"></td>
        </tr> 
        <tr class="neu">
            <td class="neu">Basispreis</td>
            <td class="neu"><input type="number" name="preis" value="<?php echo intval($preis) ?>">€</td>
        </tr> 
        <tr class="neu">
            <td class="neu">Shirts</td>
            <td class="neu"><select name="shirts"><option value="ja">Ja</option><option value="nein">Nein</option></select></td>
        </tr> 
        <tr class="neu">
            <td class="neu">Shirtanzahl</td>
            <td class="neu"><input type="number" name="shirts_anzahl" min="1" max="5"></td>
        </tr> 
        <tr class="neu">
            <td class="neu">Shirtgröße</td>
            <td class="neu"><input type="text" name="shirts_groesse" size="30"></td>
        </tr> 
        <tr class="neu">
            <td class="neu"></td>
            <td class="neu"></td>
        </tr> 
        <tr class="neu">
            <td scope="colgroup" colspan="2"><input type="submit" class="neu" value="Einfügen" size="45"><br></td>
        </tr>
    </table>
</form>
<br>
<p>Sobald die Anmeldung abgesendet wurde landet sie im System, zudem wird eine E-Mail an die angegebene Adresse gesendet.</p>