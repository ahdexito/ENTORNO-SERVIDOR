<?php
    echo "<h1> EJERCICIO 6 </h1>";

    /*
    6. Realiza un programa en php que tenga una función recursiva que calcule el factorial de un número, que recibirá como argumento. La función debe devolver el factorial o -1 si el número no es válido.
    */

    function factorial($numero) {
        // condición que finaliza la recursividad
        if ($numero == 0) return 1;
        // condición que reitera la función restando 1
        else return $numero * factorial($numero - 1);
    }

    $numero = 5;
    $resultado = factorial($numero);

    echo "<p>El factorial de $numero es: $resultado</p>";
?>