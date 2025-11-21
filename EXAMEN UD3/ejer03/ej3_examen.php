<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<body>
    <h1>Formulario</h1>
    <form action="ej3_procesar.php" method="GET">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" required placeholder="Tu nombre">

        <br><br>

        <label for="email">Email</label>
        <input type="email" name="email" required placeholder="Tu email">

        <br><br>

        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" required placeholder="Tu teléfono">

        <br><br>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>