<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejer06</title>
</head>
<body>
    <?php

        // crear la matriz y asignarle los valores aleatorios
        $filas = 4;
        $columnas = 5;
        for ($i = 0; $i < $filas; $i++) {

            for ($j = 0; $j < $columnas; $j++ ) {

                $matriz[$i][$j] = rand(1, 50);
            }
        }

        // crear arrays para guardar las sumas
        $naranja = array(0, 0, 0, 0);
        $verde = array(0, 0, 0, 0, 0);

        // variable que suma todas las celdas
        $sumaTotal = 0;

        // sumar las celdas según el eje
        for ($i = 0; $i < $filas; $i++) {

            for ($j = 0; $j < $columnas; $j++) {

                $naranja[$i] += $matriz[$i][$j];
                $verde[$j] += $matriz[$i][$j];
                $sumaTotal += $matriz[$i][$j];
            }
        }

        // imprimir tabla
        echo "<table>";
        
        for ($i = 0; $i < $filas; $i++) {

            echo "<tr>";

            for ($j = 0; $j < $columnas; $j++) {

                // imprimir los números de cada celda
                echo "<td>";
                echo $matriz[$i][$j];
                echo "</td>";
            }

            // imprimir columna de sumas
            echo "<td style='background-color:orange'>";
            echo $naranja[$i];
            echo "</tr>";
        }

        // imprimir fila de sumas
        echo "<tr>";
        for ($i = 0; $i < 5; $i++) {
            echo "<td style='background-color:green'>";
            echo $verde[$i];
            echo "</td>";
        } 
        
        // imprimir celda suma total
        echo "<td style='background-color:blue'>";
        echo $sumaTotal;
        echo "</td>";

        echo "</table>";
    ?>
</body>
</html>