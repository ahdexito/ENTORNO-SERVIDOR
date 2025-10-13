<?php
    echo "<h1> EJERCICIO 3 </h1>";

    /*
    3. Crea un array de 5 números enteros llamado num. Asígnales 5 valores aleatorios. Debes mostrar en una tabla generada dinámicamente el array en orden inverso. Además, debes mostrar en una etiqueta <p> la suma total de todos los elementos del array.
    */

    // declarar array vacío
    $num = array();

    // añadir números aleatorios al array
    for ($i = 0; $i < 5; $i++) {
        array_push($num, rand(1, 10));
    }

    // declarar variable "suma"
    $suma = 0;

    // abrir etiqueta tabla y fila
    echo "<table border=\"1\"> <tr>";

    // mostrar el array en orden inverso
    for ($i = count($num) - 1; $i >= 0; $i--) {
        // sumar cada número del array
        $suma += $num[$i];

        echo "<td> $num[$i] </td>";
    }

    // cerrar etiqueta fila y tabla
    echo "</tr> </table>";

    // imprimir resultado
    echo "<p>Resultado = $suma </p>";
?>