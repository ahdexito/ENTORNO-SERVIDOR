<?php
    echo "<h1> EJERCICIO 4 </h1>";

    /*
    4. Crea un array de 30 números enteros llamado num2. Inicializa el array con un bucle generando los números aleatoriamente entre 0 y 100. Una vez generado el array muestra en una etiqueta <h1>, el número más grande perteneciente al array, el número más pequeño y la media aritmética.
    */

    // declarar array vacío
    $num2 = array();

    // declarar variables
    $max = 0;
    $min = 30;
    $suma = 0;

    // añadir números aleatorios al array
    for ($i = 0; $i < 30; $i++) {
        // guardar número en una variable
        $numero = rand(0, 100);
        // introducir el número al array
        array_push($num2, $numero);

        // acumular la suma de cada variable
        $suma += $numero;

        // comparar máximo y mínimo
        if ($numero >= $max) $max = $numero;
        if ($numero <= $min) $min = $numero;
    }

    // calcular la media
    $media = $suma / 30;

    // imprimir resultado
    echo "<h2> Número máximo: $max, Número mínimo: $min, Media aritmética: $media </h2>";
?>