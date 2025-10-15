<?php
    echo "<h1> EJERCICIO 3 </h1>";

    /*
    3. Escribe un programa en PHP que contenga una función llamada intercambia que, reciba 2 parámetros numéricos por referencia, y lo que haga sea intercambiar sus valores. Es decir, si recibe el parámetro $a y el $b, debe hacer que $a tome el valor de $b, y $b tome el valor de $a.
    */

    function intercambia(&$a, &$b) {
        // definir variable de paso
        $x = 0;

        // intercambiar valores
        $x = $a;
        $a = $b;
        $b = $x;
    }

    // definir variables
    $a = 5;
    $b = 10;

    // imprimir valores previos
    echo "<p>Valores sin intercambiar: a = $a; b = $b</p>";

    // llamada a la función
    intercambia($a, $b);

    // imprimir valores intercambiados
    echo "<p>Valores intercambiados: a = $a; b = $b</p>";
?>