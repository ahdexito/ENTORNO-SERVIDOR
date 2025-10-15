<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejer01</title>
</head>
<body>
    <?php
        echo "<h1> EJERCICIO 1 </h1>";

        /*
        1. Teniendo el código html básico de una página web, utiliza php para crear un array vacío llamado $compras. Agrega, con array_push() los elementos: "Leche", "Pan", "Huevos". 
        Muestra el array completo en una lista desordenada. Quita el último elemento con array_pop() y vuelve a mostrar el array, esta vez en una lista ordenada.
        */

        // declarar array vacío
        $compras = array();

        // añadir elementos al array
        array_push($compras, "Leche", "Pan", "Huevos");

        // abrir etiqueta lista desordenadaa
        echo "<ul>";

        // imprimir los elementos de la lista desordenada
        foreach ($compras as $producto) {
            echo "<li> $producto </li>";
        }

        // cerrar etiqueta lista desordenada
        echo "</ul>";

        // abrir etiqueta lista ordenada
        echo "<ol>";

        // restar el último elemento del array
        array_pop($compras);

        // imprimir los elementos de la lista ordenada
        foreach ($compras as $producto) {
            echo "<li> $producto </li>";
        }

        // cerrar etiqueta lista ordenada
        echo "</ol>";
    ?>
</body>
</html>