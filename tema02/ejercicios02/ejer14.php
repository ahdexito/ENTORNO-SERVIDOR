<?php
    /*
    14.- Crea un programa que calcula la cantidad de cifras que tiene un número entero positivo almacenado en una variable.
    */

    $numero = 1234;
    $contador = 0;

    while ($numero > 0) {
        $numero = $numero / 10;
        $contador++;
    }

    echo "<p>El número " . $numero . " tiene " . $contador . " cifras.";
?>