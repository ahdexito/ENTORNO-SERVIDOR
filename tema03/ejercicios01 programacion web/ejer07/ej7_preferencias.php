<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejer07</title>
</head>
<body>
    <form action="ej7_guarda_prefs.php" method="POST">
        <label for="nombre">Introduce tu nombre: </label>
        <input type="text" name="nombre">

        <br><br>

        <label for="color">Color favorito: </label>
        <input type="color" name="color">

        <br><br>

        <label for="usar_color">¿Usar color?</label>
        <input type="checkbox" name="usar_color" value="1">

        <br><br>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>