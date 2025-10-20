<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejer03</title>
</head>
<body>
    <?php
        

        do {
            $numero = rand(0, 20);

            $diaSemana = match ($numero) {
                1 => "Lunes",
                2 => "Martes",
                3 => "Miércoles",
                4 => "Jueves",
                5 => "Viernes",
                6 => "Sábado",
                7 => "Domingo",
                default => "Debes elegir un día entre [1-7]"
            };

            echo "<h1 style='color: red'>Días de la semana</h1>";
            echo "<h3 style='color: blue'>El día elegido aleatoriamente es el nº: $numero</h3>";
            echo "<p style='color: green'>$diaSemana</p>";

        } while ($numero == 0 || $numero > 7);

        
    ?>
</body>
</html>