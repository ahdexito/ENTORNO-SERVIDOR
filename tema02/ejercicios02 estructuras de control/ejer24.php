<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- 24.- Teniendo el código html básico de una página web, utiliza PHP para mostrar una tabla html rellena con los números del 1 al 90, simulando un tablero del bingo. -->
    
</head>
<body>
    <?php

        echo "<h2>BINGO</h2>";
        echo "<table border=\"1\">";

        for ($i = 0; $i < 3; $i++) {

            echo "<tr>";

            for ($j = 0; $j < 9; $j++) {
                
                $numero = rand(1, 90);

                echo "<td>" . $numero . "</td>";
            }

            echo "</tr>";
        }

        echo "</table>";

    ?>
</body>
</html>