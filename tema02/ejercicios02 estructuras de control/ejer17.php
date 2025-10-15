<?php
    /*
    17.-Realiza un programa utilizando bucles que muestre por pantalla la siguiente figura:
    *
    **
    ***
    ****
    *****
    */

    $caracter = "*";
    $tamanyo = 5;

    for ($i = 1; $i <= $tamanyo; $i++) {
        for ($j = 0; $j < $i; $j++) {
            echo $caracter;
        }
        echo "<br>";
    }
?>