<?php
    echo "<h1> EJERCICIO 9 </h1>";

    /*
    9. Mediante un array bidimensional, almacena el nombre, altura y email de 5 personas.
    Para ello, crea un array de personas, siendo cada persona un array asociativo: [
    ['nombre'=>'Aitor', 'altura'=>182, 'email'=>'aitor@correo.com'],[…],… ] Posteriormente, recorre el array y muéstralo en una tabla HTML.
    */

    // declarar el array
    $personas = [
        ['nombre' => 'Aitor', 'altura' => 182, 'email' => 'aitor@correo.com'],
        ['nombre' => 'Xavi', 'altura' => 167, 'email' => 'xavi@correo.com'],
        ['nombre' => 'Emma', 'altura' => 171, 'email' => 'emma@correo.com'],
        ['nombre' => 'Jenni', 'altura' => 175, 'email' => 'jenni@correo.com'],
        ['nombre' => 'Alfredo', 'altura' => 186, 'email' => 'alfredo@correo.com']
    ];

    // abrir etiqueta de tabla
    echo "<table border='1' cellspacing='0'>";
    // definir encabezado de la tabla
    echo "<tr><th>Nombre</th><th>Altura</th><th>Email</th></tr>";

    // recorrer el array para mostrarlo en una tabla
    foreach ($personas as $persona) {

        // abrir etiqueta de fila

        foreach ($persona as $dato) {
            // imprimir celda con el dato
            echo "<td>$dato</td>";
        }

        // cerrar etiqueta de fila
        echo "</tr>";
    }

    // cerrar etiqueta de tabla
    echo "</table>";
?>