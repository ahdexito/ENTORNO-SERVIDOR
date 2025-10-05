<?php
    /*
    6.- Crea un programa que, teniendo una letra almacenada en una variable, diga si es una vocal.
    */

    $letra = "b";

    switch ($letra) {
        // recoger las letras que sean una vocal
        case "a": case "e": case "i": case"o": case "u":
            echo "<p>La letra '" . $letra . "' es una vocal.</p>";
            break;
        // recoger el resto de letras que no sean vocal
        default:
            echo "<p>La letra '" . $letra . "' es una consonante.</p>";
            break;
    }
?>