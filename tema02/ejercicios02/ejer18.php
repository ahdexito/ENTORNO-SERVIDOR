<?php
    /*
    18.- Realiza un programa que muestre las tablas de multiplicar de la siguiente forma:
    Tabla del 1
    **********
    1 x 1 = 1
    1 x 2 = 2
    1 x 3 = 3
    1 x 4 = 4
    1 x 5 = 5
    1 x 6 = 6
    1 x 7 = 7
    1 x 8 = 8
    1 x 9 = 9
    1 x 10 = 10
    Tabla del 2
    **********
    2 x 1 = 2
    2 x 2 = 4
    */

    for ($i = 1; $i <= 10; $i++) {
        echo "Tabla del " . $i . "<br>**********<br>";

        for ($j = 1; $j <= 10; $j++) {
            echo $i . " x " . $j . " = " . $i * $j . "<br>";
        }

        echo "<br>";
    }
?>