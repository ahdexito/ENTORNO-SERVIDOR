<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>resultado</title>
</head>
<body>
    <header>
        <h1>Resultado de Búsqueda</h1>
    </header>

    <main>
        <?php
            echo "<p><b>Texto de búsqueda:</b> " . $_POST["busqueda"] . "</p>";
            echo "<p><b>Filtro de búsqueda:</b> " . $_POST["buscar"] . "</p>";
            echo "<p><b>Tipo de libro:</b> " . $_POST["tipo"] . "</p>";
        ?>

        <a href="form_libros.php"><button>Volver</button></a>
    </main>
    
    <footer>
    </footer>
</body>
</html>