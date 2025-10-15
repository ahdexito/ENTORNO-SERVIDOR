<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- 23.- Teniendo el código html básico de una página web, utiliza PHP para generar una tabla HTML con dos columnas, donde cada fila muestra un número del 1 al 5 en una columna, y su correspondiente cuadrado en la otra columna, utilizando el bucle for para iterar. En el mismo documento, crea otras dos tablas similares utilizando el bucle while en una, y el do-while en la otra. -->
    
</head>
<body>
    <?php
        // creación de tabla con bucle 'for'
        echo "<h3>Tabla con bucle 'for'</h3>";
        echo "<table border=\"1\">";

        // crear las casillas
        for ($i = 1; $i <= 5; $i++) {
            echo "<tr>";
            echo "  <td>" . $i . "</td>";
            echo "  <td>&nbsp&nbsp</td>";
            echo "</tr>";
        }
        echo "</table>";

        /////////////////////////////////////////

        // creación de tabla con bucle 'while'
        echo "<h3>Tabla con bucle 'while'</h3>";
        echo "<table border=\"1\">";

        // crear las casillas
        $i = 1;
        while ($i <= 5) {
            echo "<tr>";
            echo "  <td>" . $i . "</td>";
            echo "<td>&nbsp&nbsp</td>";
            echo "</tr>";

            $i++;
        }
        echo "</table>";

        /////////////////////////////////////////

        // creación de tabla con bucle 'do while'
        echo "<h3>Tabla con bucle 'do while'</h3>";
        echo "<table border=\"1\">";

        // crear las casillas
        $i = 1;
        do {
            echo "<tr>";
            echo "  <td>" . $i . "</td>";
            echo "<td>&nbsp&nbsp</td>";
            echo "</tr>";

            $i++;
        } while ($i <= 5);
        echo "</table>";
    ?>
</body>
</html>