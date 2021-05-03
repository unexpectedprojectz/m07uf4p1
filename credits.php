<?php
    $arxiu = fopen("credits.txt", "r") or die ("Error");
    while(!feof($arxiu)) {
        $linea = fgets($arxiu);
        $saltlinea = nl2br($linea);
        echo $saltlinea;
    }
?>