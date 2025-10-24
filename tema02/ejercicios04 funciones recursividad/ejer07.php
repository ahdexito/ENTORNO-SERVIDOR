<?php
    /*
    7. Realiza un programa en php que tenga una función recursiva que calcule el mcd
    de dos números, que recibirá como argumentos. La función debe devolver el
    mcd de esos dos números. [Sugerencia: tal vez sea conveniente que utilices el
    algoritmo de Euclides. Puedes encontrar información acerca de este algoritmo
    en es.wikipedia.org/wiki/Algoritmo_de_Euclides.]
    */

    function mcd($num1, $num2) {

        // si num2 es 0, el mcd es num1
        if ($num2 == 0) return $num1;
        
        // llamada recursiva a la función
        else return mcd($num2, $num1 % $num2);
    }

    $num1 = 104;
    $num2 = 12;

    echo "El MCD de $num1 y $num2 es: " . mcd($num1, $num2);
?>