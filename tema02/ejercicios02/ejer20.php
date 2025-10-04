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

    $filas = 7;

    for ($i = 1; $i <= $filas; $i++) {

        // parte superior del rombo
        if ($i <= 4) {
            $espacios = 4 - $i;
            $asteriscos = 2 * $i - 1;
        }

        // parte inferior del rombo
        else {
            $espacios = $i - 4;
            $asteriscos = 2 * ($filas - $i) + 1;
        }
        
        // imprimir espacios
        for ($j = 1; $j <= $espacios; $j++) echo "&nbsp";

        // imprimir asteriscos
        for ($j = 1; $j <= $asteriscos; $j++) echo "*";
    
        echo "<br>";
    }
?>