const box = document.getElementById("messagebox")

switch(message){
    case 0:
        box.innerHTML = "";
        box.style.display = "none";
        break;
    case 1:
        box.innerHTML = '<h2> Anmeldung war Erfolgreich </h2> <p>Ihre Anmeldung ist bei uns eingegangen. <br> Sie sollten in den nächsten Minuten eine Anmeldebestätigung via E-Mail bekommen.<br> Geschieht dies nicht, wenden sie sich <a class="old-link" href="../Kontakt.php"> hier</a> an uns.'
        box.style.display = "box";
        box.style.backgroundColor = "#4CAF50";
        break;
    case 2:
        box.innerHTML = '<h2> Anmeldung war Erfolgreich </h2> <p>Ihre Anmeldung ist bei uns eingegangen. <br> Sie sollten in den nächsten Minuten eine Anmeldebestätigung via E-Mail bekommen.<br> Geschieht dies nicht, wenden sie sich <a class="old-link" href="../Kontakt.php"> hier</a> an uns. <br> Unter Umständen meldet sich in der nächsten Zeit ein Mitglied aus unserem team bei ihnen.'
        box.style.display = "box";
        box.style.backgroundColor = "#4CAF50";
        break;
    case 3:
        box.innerHTML = '<h2>Anmeldung fehlgeschlagen</h2><p>Bei der Anmeldung ist ein Fehler passiert.<br> Der Fehlercode wurde bereits an einen Systemadministrator gesendet.<br> Der Fehler wird zum nächstmöglichen Zeitpunkt behandelt.<br> Bitte versuchen sie es später erneut.</p>';
        box.style.display = "box";
        box.style.backgroundColor = "#f44336";
        break;
    case 4:
        box.innerHTML = '<h2> Anmeldung war Erfolgreich </h2> <p>Ihre Anmeldung ist bei uns eingegangen. <br> <b>Wie es scheint ist die Bestätigungsmail nich an sie gesendet worden.</b> <br> Kontaktieren sie uns bitte <a class="old-link" href="../Kontakt.php"> hier</a>. <br>';
        box.style.display = "box";
        box.style.backgroundColor = "#4CAF50";
        break;
    case 5:
        box.innerHTML = '<h2>Probleme bei der Anmeldung</h2><p>Bei der Anmeldung sind unstimmigkeiten Aufgefallen.<br> Bitte versuchen sie es mit veränderten Eingaben erneut.<br> Sollte der Fehler nochmals auftreten kontaktieren sie uns <a class="old-link" href="../Kontakt.php"> hier</a>.<br><br>Bitte verwenden sie für die Anmeldung einen gängigen Browser wie Google Chrome oder Mozilla Firefox, lassen sie außerdem JavaScript aktiviert um keine Kompatibilitätsprobleme hervorzurufen.</p>';
        box.style.display = "box";
        box.style.backgroundColor = "#f44336";
        break;
    default:
        box.style.display = "none";
        break;
}