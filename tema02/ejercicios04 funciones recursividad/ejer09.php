<?php
    /*
    9. Realiza un programa en PHP que emplee recursividad para sumar los dígitos de
    un número entero no negativo. Por ejemplo, la suma de los dígitos del 3433 es.
    El programa no se limitará a escribir el resultado de la suma, sino que también
    escribirá todos los sumandos utilizados: 3 + 4 + 3 + 3 = 13.
    Numero: 3433
    Resultado: 3 + 4 + 3 + 3 + = 13
    */

    function sumarDigitos($num) {
        // caso base
        if ($num < 10) {
            // mostrar último número sin el '+'
            echo $num;
            // devolver el número
            return $num;
        }

        else {
            // obtener el últmo dígito del número
            $ultimo = $num % 10;
            // obtener el resto del número recortando último dígito
            $resto = ($num - $ultimo) / 10;
            // mostrar el dígito con el '+'
            echo $ultimo . " + ";
            // devolver el dígito con la suma del resto
            return $ultimo + sumarDigitos($resto);
        }
    }
    
    $numero = 3433;

    echo "Número: $numero <br> Resultado: ";
    $resultado = sumarDigitos($numero);
    echo " = $resultado";
?>