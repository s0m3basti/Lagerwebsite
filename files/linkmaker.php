<?php
    function linkmaker($dest){
        $link = 'https://'.$_SERVER['HTTP_HOST'].$dest;
        return $link;
    }
//Enter a link as a string in parameters
//get a finished link the same on any plattform
?>