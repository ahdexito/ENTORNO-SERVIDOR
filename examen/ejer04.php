<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejer04</title>
</head>
<body>
    <?php
        function validarPrimo($numero) {
            $entre2 = false;
            $entre3 = false;
            $entre5 = false;
            $entre10 = false;

            // comprobar si el número recibido es divisible entre cada número, si no es él mismo
            if ($numero != 2) $entre2 = ($numero % 2 == 0) ? true : false;
            if ($numero != 3) $entre3 = ($numero % 3 == 0) ? true : false;
            if ($numero != 5) $entre5 = ($numero % 5 == 0) ? true : false;
            if ($numero != 10) $entre10 = ($numero % 10 == 0) ? true : false; 

            // devolver resultado si cumple alguna condición
            return (!($entre2 || $entre3 || $entre5 || $entre10));
        }

        $numero = 7;
        echo "<p>¿El número $numero es primo?</p>";
        if (validarPrimo($numero) == true) echo "<p>true</p>";
        else echo "<p>false</p>";
    ?>
</body>
</html>