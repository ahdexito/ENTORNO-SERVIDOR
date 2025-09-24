<?php
    /*
    6.- Crea un programa que, teniendo una letra almacenada en una variable, diga si es una vocal.
    */

    $letra = "b";

    switch ($letra) {
        case "a": case "e": case "i": case"o": case "u":
            echo "<p>La letra '" . $letra . "' es una vocal.</p>";
            break;
        default:
            echo "<p>La letra '" . $letra . "' es una consonante.</p>";
            break;
    }
?>