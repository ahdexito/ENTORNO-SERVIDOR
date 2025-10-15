<?php
    /*
    13.- Crea un programa que dada una letra (almacenada en una variable), diga si se trata de una vocal, una cifra o una consonante.
    */

    $letra = "u";

    $solucion = match ($letra) {
        "a", "e", "i", "o", "u" => "' es una vocal.",
        "1", "2", "3", "4", "5", "6", "7", "8", "9", "0" => "' es un dígito.",
        default => "' es una consonante."
    };

    echo "La letra '" . $letra . $solucion;

?>