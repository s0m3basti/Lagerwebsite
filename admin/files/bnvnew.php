<div class="bnv">
    <h1>Neuen Nutzer erstellen</h1>
    <h2>
        Gib im Formular alle Daten für den Nutzer ein.<br>
        Mit dem zugewiesenen Benutzernamen wird dann ein Account erstellt.<br>
        Das Passwort muss bei der ersten Anmeldung hinterlegt werden.
    </h2>
    <div class="bnv_form">
        <form method="POST" action="files/bnvsenden.php?new=1">
            <table class="bnv">
                <tr><td><label>Benutzername:</label></td><td><input type="text" name="username" class="bnv" required></td></tr>
                <tr><td><label>Passwort:</label></td><td><input type="password" name="password1" class="bnv" required></td></tr>
                <tr><td><label>Passwort (wiederholen):</label></td><td><input type="password" name="password2" class="bnv" required></td></tr>
                <tr><td><label>Vorname:</label></td><td><input type="text" name="firstname" class="bnv" required></td></tr>
                <tr><td><label>Nachname:</label></td><td><input type="text" name="surname" class="bnv" required></td></tr>
                <tr><td><label>E-Mail-Adresse:</label></td><td><input type="email" name="email" class="bnv" required></td></tr>
                <tr><td><label>Rechte:</label></td><td><input type="number" min="1" max="3" value="1" name="rights" class="bnv" required></td></tr>
            </table>
            <input type="submit" value="Benutzer erstellen" class="bnv">
        </form>
        <div class="message" id="messagebox">
        </div>
    </div>
</div>