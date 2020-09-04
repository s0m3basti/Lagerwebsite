<?php
    if(isset($_GET['cookie'])){
        setcookie('BesterKeksderWelt', 'true', time() + 2628000 );
        header('Location:'.$_GET['url']);
    }
    //cookie setzten und auf ursprung zurück weiterleiten
?>