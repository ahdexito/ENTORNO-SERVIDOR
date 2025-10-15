<?php
    echo "<h1> ACTIVIDAD 4 </h1>";

    /*
    4. Escribe un programa en PHP que contenga una función llamada calcularDto que, recibe un parámetro $precio con el precio de una compra, y un parámetro opcional llamado $descuento con el porcentaje de descuento a aplicar. Si no se pone este segundo parámetro, el valor por defecto será 0. La función devolverá con una devolución el precio con el descuento aplicado. Utiliza después la función desde el código PHP para calcular el descuento de un precio de 230 euros con un 10% de descuento, y el de un precio de 95 euros sin indicar descuento.
    */

    function calcularDto($precio, $descuento = 0) {

        // devolver el precio final aplicando el descuento
        return $precio - $precio * ($descuento / 100);
    }

    // declaración de variables
    $precio = 230;
    $descuento = 20;
    $resultado = calcularDto($precio, $descuento);

    // imprimir resultado
    echo "<p>Precio: $precio €; Descuento: $descuento %; Precio con descuento: $resultado €</p>";
?>