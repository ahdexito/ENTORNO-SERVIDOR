<?php
    /*
    8. Programar un algoritmo recursivo en PHP que permita invertir un
    número. Ejemplo: Entrada: 123 Salida: 321
    */

    function invertir($num, $numInvertido = 0) {

        // si el número es 0, devolver el número invertido acumulado
        if ($num == 0) return $numInvertido;

        else {
            // recortar el último número y lo pegamos en el nuevo
            $numInvertido = $numInvertido * 10 + ($num % 10);

            // llamada recursiva a la función quitando el último número
            return invertir(intval($num / 10), $numInvertido);
        }
    }

    $numero = 123;

    echo "Número original: $numero <br>";

    echo "Número invertido: " . invertir($numero);
?>