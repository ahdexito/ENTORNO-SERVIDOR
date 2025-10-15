<?php
    echo "<h1> EJERCICIO 7 </h1>";

    /*
    7. Rellena un array de 100 elementos de manera aleatoria con valores M o F (por ejemplo ["M", "M", "F", "M", ...]). Una vez completado, vuelve a recorrerlo y calcula cuantos elementos hay de cada uno de los valores almacenando el resultado en un array asociativo ['M' => 44, 'F' => 66] (no utilices variables para contar las M o las F). Finalmente, muestra el resultado por pantalla.
    */

    // declarar array
    $letras = array();

    // recorrer array
    for ($i = 0; $i < 100; $i++) {

        // número aleatorio entre 0 y 1
        $x = rand(0, 1);

        // si el número es 0, se agrega "M"
        if ($x == 0) array_push($letras, "M");
        // si el número es 1, se agrega "F"
        else array_push($letras, "F");
    }

    // crear array asociativo con cada letra
    $resultado = ['M' => 0, 'F' => 0];

    // recorrer array con foreach
    foreach ($letras as $letra) {
        // sumar cada letra en su posición del array
        $resultado[$letra]++;
    }

    // imprimir resultado
    echo "<h2> M: " . $resultado['M'] . ", F: " . $resultado['F'] . "</h2>";
?>