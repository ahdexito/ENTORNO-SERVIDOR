<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejer02</title>
</head>
<body>
    <?php
        echo "<h1> EJERCICIO 2 </h1>";

        /*
        2. Teniendo el código html básico de una página web, utiliza php para declarar un array vacío llamado $historial. Agrega con array_push() las páginas: "Inicio", "Productos", "Carrito", "Pago". Muestra el historial completo en una tabla de 1 fila y 5 columnas. 
        Simula que el usuario presiona el botón "Atrás" quitando la última página visitada con array_pop(). Muestra el resultado en otra tabla, pero esta vez de 1 columna y 4 filas.
        */

        // declarar array vacío
        $historial = array();

        // añadir elementos al array
        array_push($historial, "Inicio", "Productos", "Carrito", "Pago");

        // abrir etiqueta tabla y fila
        echo "<table border=\"1\"> <tr>";

        // imprimir los elementos de la tabla en sus celdas
        foreach ($historial as $pagina) {
            echo "<td> $pagina </td>";
        }

        // cerrar etiqueta fila y tabla
        echo "</tr> </table>";

        // simular botón "atrás"
        echo "<p>[atrás]</p>";

        // abrir etiqueta tabla y fila
        echo "<table border=\"1\"> <tr>";

        // restar el último elemento del array
        array_pop($historial);

        // imprimir los elementos de la tabla en sus celdas
        foreach ($historial as $pagina) {
            echo "<td> $pagina </td>";
        }

        // cerrar etiqueta fila y tabla
        echo "</tr> </table>";
    ?>
</body>
</html>