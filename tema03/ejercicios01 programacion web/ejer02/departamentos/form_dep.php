<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulario</title>
</head>
<body>
    <header>
        <h1>Departamentos</h1>
    </header>
    <main>
        <form name="departamentos" method="post" action="presupuesto.php">
            <label for="departamento">Departamento:</label><br>
            <select id="departamento" name="departamento">
                <option>Selecciona una opción</option>
                <option>Informática</option>
                <option>Lengua</option>
                <option>Matemáticas</option>
                <option>Inglés</option>
            </select><br><br>

            <button type="submit">Enviar</button>
        </form>
    </main>
</body>
</html>