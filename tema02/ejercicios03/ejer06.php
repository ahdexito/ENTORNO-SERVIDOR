<?php
    echo "<h1> EJERCICIO 6 </h1>";

    /*
    6. Escribe un programa que permita al usuario rellenar una matriz de 10x10 con números aleatorios entre 1 y 50. determine la posición del número mayor almacenado en la matriz. 
    */

    // declarar matriz y variables
    $matriz = [];
    $maximo = 0;
    $fila = 0;
    $columna = 0;

    // recorrer matriz con dos bucles
    for ($i = 0; $i < 10; $i++) {

        for ($j = 0; $j < 10; $j++) {
            // guardar número aleatorio en variable
            $numero = rand(1, 50);
            // asignar número a la posición $i $j de la matriz
            $matriz[$i][$j] = $numero;

            // comparar si el número es el máximo
            if ($numero > $maximo) {
                // guardar su valor y su posición
                $maximo = $numero;
                $fila = $i + 1;
                $columna = $j + 1;
            }
        }
    }

    // imprimir la matriz en una tabla para comprobar el resultado

    // abrir etiqueta de tabla
    echo "<table border=\"1\">";

    // recorrer matriz con dos bucles
    for ($i = 0; $i < 10; $i++) {

        // abrir etiqueta de fila
        echo "<tr>";

        for ($j = 0; $j < 10; $j++) {

            // imprimir cada número en una casilla
            echo "<td>" . $matriz[$i][$j] . "</td>";
        }

        // cerrar etiqueta de fila
        echo "</tr>";
    }

    // cerrar etiqueta de tabla
    echo "</table>";

    // imprimir resultado
    echo "<h2> El número máximo es $maximo, se encuentra en la fila $fila y en la columna $columna </h2>"
?>