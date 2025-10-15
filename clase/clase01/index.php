<?php
    echo "<p>Bienvenido a la <b>programación PHP</b></p>";
?>

<?="Bienvenido a la programación PHP"; ?>

<?php
print "<h2>Holaaaa</h2>"
?>

<?php
    $num = 5;
    echo "El contenido de num es $num <br>";

    echo "El contenido de num es " .$num;

    printf("<br>El contenido de num es %d <br>", $num);

    $nombre = "Pedro";
    $edad = 21;

    echo "Mi nombre es $nombre y tengo $edad años<br>";
    printf("Mi nombre es %s y tengo %d años", $nombre, $edad);

    $pi = 3.14;
    $precio = 12.125;

    echo "<p>El valor de pi es $pi</p>";

    echo "<p>El precio es $precio</p>";

    printf("<p>El precio redondeado es %.2f</p>", $precio);

    // Comentario de una línea

    /*
    Comentario de varias líneas
    */
    
    $salir = FALSE; // variable booleana
    $x = 23; // variable entera
    $cadena = "hola"; // variable string
    $precio = 12.125; // varible decimal

    $valor = "13";
    $cantidad = intval($valor);
    echo $cantidad;
?>