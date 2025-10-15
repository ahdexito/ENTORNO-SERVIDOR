<?php
    echo "<h1> EJERCICIO 2 </h2>";

    /*
    2. Crea una función llamada cuenta_funciones($a, $b) que recibe dos parámetros y vaya contando de un número al otro, separando los números por comas. Después, pruébala en el código PHP haciendo que cuente del 20 al 30.
    */

    function cuenta_funciones($a, $b) {
        
        // recorrer la diferencia entre las variables
        for ($i = $a; $i <= $b; $i++) {
            // imprimir cada número separado por comas menos el último
            if ($i == $b) echo "$i.";
            else echo "$i, ";
        }
    }

    // llamada a la función
    cuenta_funciones(20, 30);
?>