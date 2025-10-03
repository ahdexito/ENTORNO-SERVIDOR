<?php
    /*
    14.- Crea un programa que calcula la cantidad de cifras que tiene un número entero positivo almacenado en una variable.
    */

    $numero = 123456;
    $contador = 0;
    $resultado = $numero;

    while ($resultado > 0) {
        // uso de intdiv porque con el operador "/" da error
        $resultado = intdiv($resultado, 10);
        $contador++;
    }

    echo "<p>El número " . $numero . " tiene " . $contador . " cifras.";
?>