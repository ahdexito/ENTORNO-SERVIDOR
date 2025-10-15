<?php
/*
6.- Crea un programa nuevo, y declara la constante PI como 3.14159. A continuación, crea un
variable llamada r (y guarda en ella un valor para el radio). El programa deberá mostrar el área
de esa circunferencia. (Recuerda pi * r2)
*/  
    // declaración de constante 'PI'
    const PI = 3.14159;
    // declaración de variable 'radio'
    $r = 3;
    // declaración de variable 'resultado', realizando el cálculo para obtener el área
    $resultado = PI * ($r * $r);

    // imprimir resultado
    echo "<p>El valor del área de la circunferencia es $resultado</p>";
?>