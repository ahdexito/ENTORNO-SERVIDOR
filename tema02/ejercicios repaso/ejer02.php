<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejer02</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- Estamos creado la web de una tienda online, en concreto, el código de un buscador de productos. Nos piden que creemos un script que solucione el problema de filtrado de productos, mostrando solo los productos que ha elegido filtrar el usuario. La información de los productos la tenemos en un Array multidimensional llamado $aProductos, en posiciones consecutivas (0, 1, 2, 3) y en cada una un array con dos datos, la categoría del producto y el nombre del producto. En la variable $categoria recibiremos el código de la categoría de productos a mostrar. El array tendría un contenido SIMILAR al siguiente:
    $array = array(
    0 => array( 'categoria' => 33, 'nombre' => 'Zapatos lala' ),
    1 => array( 'categoria' => 24, 'nombre' => 'Pantalones lolo' ),
    2 => array( 'categoria' => 33, 'nombre' => 'Zapatos lulu' ),
    3 => array( 'categoria' => 23, 'nombre' => 'Camiseta lili' ),
    ..............
    );
    Debes mostrar el nombre de los productos de la categoría seleccionada en las filas de una tabla formateada con bootstrap. -->
</head>
<body>
    <header>
        <h1> EJERCICIO 2 </h1>
    </header>
    <main>
        <?php
            // almacenar productos en array
            $aProductos = array(
                0 => array( 'categoria' => 33, 'nombre' => 'Zapatos lala' ),
                1 => array( 'categoria' => 24, 'nombre' => 'Pantalones lolo' ),
                2 => array( 'categoria' => 33, 'nombre' => 'Zapatos lulu' ),
                3 => array( 'categoria' => 23, 'nombre' => 'Camiseta lili' )
            );

            // categoría a filtrar
            $categoria = 33;

            // abrir tabla e imprimir encabezado
            echo "<table class='table table-success table-striped'>";
            echo "<thead><tr><th>Categoría</th><th>Nombre</th></tr></thead>";
            echo "<tbody>";

            // recorrer cada elemento del array
            foreach($aProductos as $producto) {

                // verificar si el valor almacenado en 'categoria' coincide con el introducido
                if ($producto['categoria'] == $categoria) {
                    // imprimir cada celda que coincide
                    echo "<tr>";
                    echo "<td>" . $producto['categoria'] . "</td>";
                    echo "<td>" . $producto['nombre'] . "</td>";
                    echo "</tr>";
                }
            }
            
            // cerrar tabla
            echo "</tbody>";
            echo "</table>";
        ?>
    </main>
    <footer>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
    </footer>
</body>
</html>