<?php
    /*
    16.- Crea un programa que teniendo un número entre 1 y 50 almacenado en una variable, el programa debe mostrar todos los números entre 1 y 50 exceptuando el almacenado por el usuario. Utiliza continue para evitar ese número.
    */

    $numero = 35;

    for ($i = 1; $i <= 50; $i++) {
        if ($i == $numero) continue;
        echo "<p>" . $i . " </p>";
    }
?>