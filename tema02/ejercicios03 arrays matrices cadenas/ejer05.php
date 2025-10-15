<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        echo "<h1> EJERCICIO 5 </h1>";

        /*
        5. Teniendo el código html básico de una página web, utiliza PHP para recorrer un array con el nombre de 5 frutas (las pones tú), y utilizando foreach genera una lista desordenada, mostrando cada fruta como un elemento de la lista.
        */

        // declaración de array con 5 frutas
        $frutas = array("Pera", "Manzana", "Melocotón", "Naranja", "Cerezas");

        // abrir etiqueta de lista desordenada
        echo "<ul>";

        // recorrer array con foreach
        foreach ($frutas as $fruta) {
            echo "<li> $fruta </li>";
        }  

        // cerrar etiqueta de lista desordenada
        echo "</ul>";
    ?>
</body>
</html>