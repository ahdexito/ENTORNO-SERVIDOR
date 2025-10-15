<?php
    echo "<h1> EJERCICIO 1 </h1>";

    /*
    1. Escribe un programa en PHP utilice dos funciones llamadas sumar y multiplicar. Ambas funciones deben generar 4 valores enteros aleatorios, entre 1 y 20. A continuación, devuelven la suma de los cuatro y su producto respectivamente (Las funciones no reciben nada y devuelven el resultado de la operación). Utilice mensajes
    */
    function sumar() {
        // declaración de variables
        $num1 = rand(1, 20);
        $num2 = rand(1, 20);
        $num3 = rand(1, 20);
        $num4 = rand(1, 20);

        // calcular y guardar resultado en variable
        $resultado = $num1 + $num2 + $num3 + $num4;

        // imprimir mensajes con cada número generado y su resultado
        echo "<h3>FUNCIÓN SUMAR</h2>";
        echo "<p>El primer valor entero generado: $num1</p>";
        echo "<p>El segundo valor entero generado: $num2</p>";
        echo "<p>El tercer valor entero generado: $num3</p>";
        echo "<p>El cuarto valor entero generado: $num4</p>";
        echo "<p>=========================================</p>";
        echo "<p>Suma de valores = $resultado</p>";
    }

    function multiplicar() {
        // declaración de variables
        $num1 = rand(1, 20);
        $num2 = rand(1, 20);
        $num3 = rand(1, 20);
        $num4 = rand(1, 20);

        // calcular y guardar resultado en variable
        $resultado = $num1 * $num2 * $num3 * $num4;

        // imprimir mensajes con cada número generado y su resultado
        echo "<h3>FUNCIÓN MULTIPLICAR</h2>";
        echo "<p>El primer valor entero generado: $num1</p>";
        echo "<p>El segundo valor entero generado: $num2</p>";
        echo "<p>El tercer valor entero generado: $num3</p>";
        echo "<p>El cuarto valor entero generado: $num4</p>";
        echo "<p>=========================================</p>";
        echo "<p>Producto de valores = $resultado</p>";
    }

    // llamada a las funciones
    sumar();

    echo "<br>";

    multiplicar();
?>