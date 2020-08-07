<?php
    switch($status){
        case "anmeldung":
            require "files/status_anmeldung.php";
            break;
        case "voranmeldung":
            require "files/status_voranmeldung.php";
            break;
        case "keine_anmeldung":
            require "files/status_keine_anmeldung.php";
            break;
    }


?>