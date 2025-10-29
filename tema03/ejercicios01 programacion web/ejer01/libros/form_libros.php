<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>buscar</title>
</head>
<body>
    <header>
        <h1>Buscador de Libros</h1>
    </header>
    <main>
        <form name="buscador" method="post" action="result_libros.php">
            <label for="busqueda">Texto de Búsqueda</label><br>
            <input type="text" id="busqueda" name="busqueda"><br><br>


            <p>Buscar en:</p>
            <input type="radio" id="titulo" name="buscar" value="Título del libro">
            <label for="titulo">Título del libro</label><br>

            <input type="radio" id="nombre" name="buscar" value="Nombre del autor">
            <label for="nombre">Nombre del autor</label><br>

            <input type="radio" id="editorial" name="buscar" value="Editorial">
            <label for="editorial">Editorial</label><br><br>


            <label for="tipo">Tipo de Libro:</label><br>
            <select id="tipo" name="tipo">
                <option>Selecciona una opción</option>
                <option>Fantasía</option>
                <option>Misterio</option>
                <option>Terror</option>
                <option>Aventura</option>
            </select><br><br>


            <button type="submit">Buscar</button>
        </form>
    </main>
    <footer>
    </footer>
</body>
</html>