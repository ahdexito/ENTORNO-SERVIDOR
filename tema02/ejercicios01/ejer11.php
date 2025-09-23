<?php
/*
11.- Un año en Júpiter (el tiempo que tarda Júpiter en hacer un giro completo alrededor del Sol)
equivale aproximadamente a 12 años terrestres. Realizar un programa que permita convertir los
días terrestres en años jovianos. Añadir los comentarios pertinentes a cada línea del programa.
*/
    // declaración de variable 'día terrestre'. 4380 días son 12 años
    $dia_terrestre = 4380;
    // declaración de variable 'año joviano', realizando la conversión de un día terrestre a año terrestre,
    // y de año terrestre a año joviano
    $anyo_joviano = ($dia_terrestre / 365) / 12;

    // imprimir el resultado
    echo "<p>El resultado es $anyo_joviano</p>";
    
?>