<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejer02</title>
</head>
<body>
    <?php
        $numero = rand(1, 7);

        $diaSemana = match ($numero) {
            1 => "Lunes",
            2 => "Martes",
            3 => "Miércoles",
            4 => "Jueves",
            5 => "Viernes",
            6 => "Sábado",
            7 => "Domingo"
        };

        echo "<h1 style='color: red'>Días de la semana</h1>";
        echo "<h3 style='color: blue'>El día elegido aleatoriamente es el nº: $numero</h3>";
        echo "<p style='color: green'>$diaSemana</p>";
    ?>
</body>
</html>