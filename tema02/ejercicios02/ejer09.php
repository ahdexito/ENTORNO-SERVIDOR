<?php
    /*
    9.- Crea un programa que muestre por pantalla los números del 1 al 10. Utiliza los 3 tipos de bucles vistos en clase.
    */

    // BUCLE 'WHILE'

    $i = 1;

    echo "Bucle 'while': ";

    while($i <= 10) {
        // imprimir número
        echo $i;

        // imprimir ', ' o '.' según corresponda
        if ($i < 10) echo ", ";
        else echo ".<br>";

        // incrementar el número
        $i++;
    }

    //////////////////////////////////////////

    // BUCLE 'DO-WHILE'

    $i = 1;

    echo "Bucle 'do-while': ";

    do {   
        // imprimir número
        echo $i;

        // imprimir ', ' o '.' según corresponda
        if ($i < 10) echo ", ";
        else echo ".<br>";

        // incrementar el número
        $i++;

    } while($i <= 10);

    //////////////////////////////////////////

    // BUCLE 'FOR'

    echo "Bucle 'for': ";

    for ($i = 1; $i <= 10; $i++) {
        // imprimir número
        echo $i;

        // imprimir ', ' o '.' según corresponda
        if ($i < 10) echo ", ";
        else echo ".<br>";
    }
?>