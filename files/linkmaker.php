<?php
    function linkmaker($dest){
            if(strpos($_SERVER['PHP_SELF'], 'Lagerwebsite') == 1){
                $link = 'https://'.$_SERVER['HTTP_HOST'].'/Lagerwebsite'.$dest;
            }
            else{
                $link = 'http://'.$_SERVER['HTTP_HOST'].$dest;
            }
        return $link;
    }
//Enter a link as a string in parameters
//get a finished link the same on any plattform
?>