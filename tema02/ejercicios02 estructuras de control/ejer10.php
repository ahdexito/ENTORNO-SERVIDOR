<?php
    /*
    10.- Crea un programa que muestre por pantalla los números del 10 al 1. Utiliza los 3 tipos de bucles vistos en clase.
    */

    // BUCLE 'WHILE'

    $i = 10;

    echo "Bucle 'while': ";

    while($i >= 1) {
        // imprimir número
        echo $i;

        // imprimir ', ' o '.' según corresponda
        if ($i > 1) echo ", ";
        else echo ".<br>";

        // decrementar el número
        $i--;
    }

    //////////////////////////////////////////

    // BUCLE 'DO-WHILE'

    $i = 10;

    echo "Bucle 'do-while': ";

    do {   
        // imprimir número
        echo $i;

        // imprimir ', ' o '.' según corresponda
        if ($i > 1) echo ", ";
        else echo ".<br>";

        // decrementar el número
        $i--;

    } while($i >= 1);

    //////////////////////////////////////////

    // BUCLE 'FOR'

    echo "Bucle 'for': ";

    for ($i = 10; $i >= 1; $i--) {
        // imprimir número
        echo $i;

        // imprimir ', ' o '.' según corresponda
        if ($i > 1) echo ", ";
        else echo ".<br>";
    }
?>