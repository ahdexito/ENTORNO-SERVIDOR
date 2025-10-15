<?php
/*
10.- Escribe un programa que realizando los cálculos necesarios muestre el número de segundos
que tiene un año.
*/
    // declaración de variable 'año'
    $anyo = 1;
    // declaración de la variable 'segundos', asignando su valor mediante la multiplicación de la anterior
    $segundos = $anyo * 365 * 24 * 60 * 60;

    // imprimir resultado
    echo "<p>En $anyo año/s hay $segundos segundos</p>";
?>