<?php
    /*
    12.- Crea un programa que calcule la suma de los números pares del 1 al 30.
    */

    $total = 0;

    for ($i = 0; $i <= 30; $i++) {
        // verificar si es par con módulo de 2
        if ($i % 2 == 0) {
            // acumular número a la suma
            $total += $i;
        }
    }

    echo "<p>La suma total es " . $total . "</p>";
?>