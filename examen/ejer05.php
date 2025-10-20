<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejer05</title>
</head>
<body>
    <?php
        // crear array desordenado
        $desordenado = array();

        for ($i = 0; $i < 20; $i++) {
            $desordenado[$i] = rand(0, 100);
        }

        // imprimir array desordenado
        echo "<h1>Array desordenado</h1>";
        for ($i = 0; $i < 20; $i++) {
            echo $desordenado[$i] . " | ";
        }

        // crear array ordenado
        $ordenado = array();

        // guardar primero los pares
        for ($i = 0; $i < 20; $i++) {
            if ($desordenado[$i] % 2 == 0) {
                array_push($ordenado, $desordenado[$i]);
            }
        }

        // después guardar los impares
        for ($i = 0; $i < 20; $i++) {
            if ($desordenado[$i] % 2 != 0) {
                array_push($ordenado, $desordenado[$i]);
            }
        }

        // imprimir array ordenado
        echo "<h1>Array ordenado</h1>";
        for ($i = 0; $i < 20; $i++) {
            echo $ordenado[$i] . " | ";
        }
    ?>
</body>
</html>