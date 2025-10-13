<?php
    echo "<h1> EJERCICIO 8 </h1>";

    /*
    8. Rellena un array bidimensional de 6 filas por 9 columnas con números aleatorios comprendidos entre 100 y 999 (ambos incluidos). Todos los números deben ser distintos, es decir, no se puede repetir ninguno. Muestra a continuación por pantalla el contenido del array de tal forma que:
    1. La columna del máximo debe aparecer en azul.
    2. La fila del mínimo debe aparecer en verde
    3. El resto de números deben aparecer en negro.
    */
    
    // declarar matriz vacía
    $matriz = [];
    $numero = 0;

    // recorrer matriz para introducir datos
    for ($i = 0; $i < 6; $i++) {

        for ($j = 0; $j < 9; $j++) {

            // repetir tantas veces hasta que no esté repetido
            do {
                // generar número aleatorio
                $numero = rand(100, 999);

                // declarar variable 'boolean' que haga check de número repetido
                $repetido = false;

                // recorrer cada fila de la matriz
                foreach ($matriz as $fila) {

                    // verificar si el número se encuentra en la fila
                    if (in_array($numero, $fila)) {

                        // si lo está, se repetirá el bucle do-while
                        $repetido = true;
                        break;
                    }
                }
            } while ($repetido);

            // asignar el número único a su posición
            $matriz[$i][$j] = $numero;
        }
    }
    
    // declarar variables para guardar el número máximo y el mínimo, y sus posiciones
    $maximo = 99;
    $minimo = 1000;
    $columnaMax = 0;
    $filaMin = 0; 

    // recorrer matriz para encontrar número máximo y mínimo
    for ($i = 0; $i < 6; $i++) {

        for ($j = 0; $j < 9; $j++) {

            // si es mayor que el anterior, guardar valor y columna
            if ($matriz[$i][$j] > $maximo) {

                $maximo = $matriz[$i][$j];
                $columnaMax = $j;
            }

            // si es menor que el anterior, guardar valor y fila
            if ($matriz[$i][$j] < $minimo) {

                $minimo = $matriz[$i][$j];
                $filaMin = $i;
            }
        }
    }

    // abrir etiqueta de tabla
    echo "<table border='1' cellspacing='0'>";

    // recorrer matriz para imprimir como tabla
    for ($i = 0; $i < 6; $i++) {

        // abrir etiqueta de fila
        echo "<tr>";

        for ($j = 0; $j < 9; $j++) {

            // imprimir columna azul del número máximo
            if ($j == $columnaMax) {
                // imprimir número máximo en azul claro
                if ($matriz[$i][$j] == $maximo) echo "<td style='background-color:blue;color:cyan'>";
                // si no es el máximo en concreto, pinta la celda azul
                else echo "<td style='background-color:blue;color:white'>";
            }

            // imprimir fila verde del número mínimo
            else if ($i == $filaMin) {
                if ($matriz[$i][$j] == $minimo) echo "<td style='background-color:green;color:red'>";
                else echo "<td style='background-color:green;color:white'>";
            }

            // imprimir celda para el resto de números
            else  echo "<td>";

            echo $matriz[$i][$j] . "</td>";
        }

        // cerrar etiqueta de fila
        echo "</tr>";
    }

    // cerrar etiqueta de tabla
    echo "</table>";

    // imprimir números máximo y mínimo
    echo "<h2> Máximo: $maximo, Mínimo: $minimo </h2>";
?>