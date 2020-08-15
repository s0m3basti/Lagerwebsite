<?php
if(isset($_GET['cookie'])){
    setcookie('cookie', 'true', time() + 2628000 );
}
if(!isset($_COOKIE['cookie'])){
    echo '
        <div class="cookie">
            <div class="cookie-container">
                <p>
                    <b>Verwendung von Cookies</b>
                    <br>Um unsere Webseite für Sie optimal zu gestalten und fortlaufend verbessern zu können, verwenden wir Cookies. Durch die weitere Nutzung der Webseite stimmen Sie der Verwendung von Cookies zu.
                    <br>Weitere Informationen zu Cookies erhalten Sie in unserer <a href="<?php echo linkmaker("/datenschutz.php") ?>Datenschutzerklärung</a>.
                    <br><a href="?cookie"><button>Verstanden!</button></a>
                </p>
            </div>
        </div>
    ';
}
?>