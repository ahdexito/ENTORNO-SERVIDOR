<?php
    /*
    20.- Realiza un programa utilizando bucles que muestre por pantalla la siguiente figura:
       *
      ***
     *****
    *******
     *****
      ***
       *
    */

    $asterisco = "*";
    $espacio = "&nbsp";

    for ($i = 1; $i <= 4; $i++) {

        for ($j = 1; $j <= $i + $j; $j++) {
            echo $asterisco;
        }
        echo "<br>";
    }
?>