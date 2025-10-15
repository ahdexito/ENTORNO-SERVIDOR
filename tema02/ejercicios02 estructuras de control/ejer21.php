<?php
    /*
    21.- Escribir un programa que calcule el número de días de un mes, dados los valores numéricos del mes y del año.
    */

    $mes = 10;
    $anyo = 2025;

    // determinar si el año es bisiesto
    $bisiesto = $anyo % 4 == 0;

    // determinar la cantidad de días según el mes
    if ($mes == 2) $dias = $bisiesto ? 29 : 28;
    
    else if ($mes == 4 || $mes == 6 || $mes == 9 || $mes == 11) $dias = 30;

    else $dias = 31;
    
    echo "<p>En el mes " . $mes . " y año " . $anyo . " hay " . $dias . " dias.</p>";
?>