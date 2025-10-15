<?php
    /*
    19.- Crea un programa que dé al usuario la oportunidad de adivinar un número entre 1 y 100, en un máximo de 6 intentos. En cada pasada se debe avisar si se ha pasado o se ha quedado corto.
    */

    $clave = 55;

    echo "Adivina la clave secreta<br>";

    for ($i = 0; $i < 6; $i++) {
        $entrada = rand(1, 100);

        echo "Has introducido " . $entrada;
        if ($clave < $entrada) echo ", la clave es menor.";
        else if ($clave > $entrada) echo ", la clave es mayor.";
        else {
            echo ". Has ganado.";
            break;
        }

        echo "<br>";
    }
        

?>