<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- 25.- Teniendo el código html básico de una página web, utiliza PHP mostrar por pantalla un cuadrado exactamente igual (fíjate bien en los encabezados, tanto de las filas como de las columnas) al de la imagen con las tablas de multiplicar.  -->
    
    <style>
        table {
            text-align: center;
            vertical-align: center;
            font-family: Arial, Helvetica, sans-serif;
            font-size: large;
            font-weight: bold;
        }

        td {
            border: 1px solid;
            width: 50px;
            height: 50px;
        }

        table tbody tr td:first-child {
            color: white;
            background-color: orange;
        }

        table thead {
            color: white;
            background-color: blue;
        }
    </style>

</head>
<body>
    <?php    
        // abrir etiqueta de tabla y encabezado de tabla
        echo "<table border=\"1\"><thead>";

        // recorrer las filas de la tabla
        for ($i = -1; $i <= 10; $i++) {
            // cerrar encabezado y abrir cuerpo de tabla
            if ($i == 0) echo "</thead><tbody>";

            // abrir fila de tabla
            echo "<tr>";

            // recorrer las columnas de la tabla
            for ($j = -1; $j <= 10; $j++) {
                // imprimir la 'x'
                if ($i == -1 && $j == -1) echo "<td>x</td>";

                // imprimir encabezado
                else if ($i == -1) echo "<td>" . $j . "</td>";

                // imprimir casillas izquierda
                else if ($j == -1) echo "<td>" . $i . "</td>";

                // imprimir el resto
                else echo "<td>" . $i * $j . "</td>";
            }

            // cerrar fila de tabla
            echo "</tr>";
        }

        // cerrar cuerpo de tabla y etiqueta de tabla
        echo "</tbody></table>";
    ?>
</body>
</html>