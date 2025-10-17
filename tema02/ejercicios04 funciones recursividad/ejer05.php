<?php
    echo "<h1> EJERCICIO 5 </h1>";

    /*
    5. Escribe un programa en php que tenga una función para calcular potencias. La función debe recibir como parámetros la base y el exponente, que es opcional y tiene valor por defecto 2 (para elevar al cuadrado).
    */

    function calcular_potencias($base, $exponente = 2) {
        
        $resultado = $base;

        // iterar bucle según el tamaño del exponente
        for ($i = 1; $i < $exponente; $i++) {

            // acumular la multiplicación cada iteración
            $resultado *= $base;
        }

        return $resultado;
    }

    // probar la función pasando el valor del exponente
    $base = 3;
    $exponente = 3;
    $resultado = calcular_potencias($base, $exponente);

    echo "<h3>Función con exponente como parámetro</h3>";
    echo "<p>El resultado de elevar $base a $exponente es: $resultado</p>";

    // probar la función sin pasar el valor del exponente
    $base = 5;
    $resultado = calcular_potencias($base);

    // imprimir resultado
    echo "<h3>Función sin exponente como parámetro (2 por defecto)</h3>";
    echo "<p>El resultado de elevar $base a 2 es: $resultado</p>";
?>