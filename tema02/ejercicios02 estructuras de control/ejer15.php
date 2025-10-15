<?php
    /*
    15.- Crea un programa que teniendo un número entre 1 y 50. El programa debe mostrar tantas letras A como indique ese número, se debe usar break para terminar.
    */

    $numero = 47;
    $contador = 0;

    do {
        // imprimir A
        echo "A ";
        // decrementar el número
        $numero--;
        // aumentar el contador de repeticiones del bucle
        $contador++;
        // salir del bucle cuando sea 0
        if ($numero == 0) break;
    } while (true);

    echo "<p>Hay un total de " . $contador . " 'A's.</p>";
?>