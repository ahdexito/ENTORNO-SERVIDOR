<?php
    /*
    8.- Crea un programa que, teniendo dos números almacenados en dos variables, diga “Uno de los números es positivo”, “Los dos números son positivos” o bien “Ninguno de los números es positivo”, según corresponda.
    */

    $numero1 = 4;
    $numero2 = -7;

    // contador de números positivos
    $positivos = 0;

    // sumar al contador si el número es mayor que 0
    if ($numero1 > 0) $positivos++;
    if ($numero2 > 0) $positivos++;

    // imprimir mensaje según cantidad de positivos
    if ($positivos == 1) echo "<p>Uno de los números es positivo.</p>";
    else if ($positivos == 2) echo "<p>Los dos números son positivos.</p>";
    else echo "<p>Ninguno de los números es positivo.</p>";

?>