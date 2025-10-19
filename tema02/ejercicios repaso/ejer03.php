<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejer03</title>

    <!-- Escribe un programa que, dado el alto en una variable, muestre una imagen de triángulos como la siguiente: -->
</head>
<body>
    <h1> EJERCICIO 3 </h1>
    <?php
        $alto = 6;
        
        for ($i = $alto; $i > 0; $i--) {

            for ($j = $i; $j > 0; $j--) {
                echo "*";
            }

            for ($k = $i; $k < $alto; $k++) {
                echo "^";
            }

            for ($l = $i; $l < ($alto - 1); $l++) {
                echo "^";
            }

            for ($m = $i; $m > 0; $m--) {
                if ($m != $alto) echo "*";
            }

            echo "<br>";
        }
        
    ?>
</body>
</html>