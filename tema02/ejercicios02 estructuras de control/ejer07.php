<?php
    /*
    7.- Crea un programa que, teniendo tres números almacenados en tres variables, los muestre ordenados de menor a mayor.
    */

    // variables que almacenan los números a ordenar
    $numero1 = "1";
    $numero2 = "3";
    $numero3 = "2";

    // variable de paso
    $x;

    // intercambiar valores usando 'x' si el segundo es mayor que el primero
    if ($numero2 > $numero1) {
        $x = $numero1; $numero1 = $numero2; $numero2 = $x;
    } 
    if ($numero3 > $numero1) {
        $x = $numero3; $numero3 = $numero1; $numero1 = $x;
    }
    if ($numero3 > $numero2) {
        $x = $numero3; $numero3 = $numero2; $numero2 = $x;
    }
    
    echo "<p>Los número ordenados de mayor a menor son: " . $numero1 . ", " . $numero2 . ", ". $numero3 ."";
?>