<?php
    /*
    11.- Crea un programa que muestre los primeros 5 números impares
    */

    // número a imprimir
    $numero = 1;

    // contador de impares
    $contador = 0;

    echo "Primeros 5 números impares: ";

    do {
        // verificar si el número es impar
        if ($numero % 2 != 0) {
            // si lo es, se imprime
            echo $numero;

            // imprimir ', ' o '.' según corresponda
            if ($contador < 4) echo ", ";
            else echo ".<br>";

            // incrementar el contador de impares
            $contador++;
        }

        // incrementar el número a verificar e imprimir
        $numero++;
    } while ($contador < 5);
?>