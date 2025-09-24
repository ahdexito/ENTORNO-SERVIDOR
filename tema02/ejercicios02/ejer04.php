<?php
    /*
    4.- Crea un programa que, teniendo un número almacenado en una variable, diga si el número es par o impar.
    */

    $numero = 3;

    if ($numero % 2 == 0) {
        echo "<p>El número " . $numero . " es par.";
    }

    else {
        echo "<p>El número ". $numero . " es impar.";
    }
?>