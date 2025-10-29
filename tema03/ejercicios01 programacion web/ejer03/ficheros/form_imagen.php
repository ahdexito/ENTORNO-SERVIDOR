<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejer03</title>
</head>
<body>
    <form action="subir_imagen.php" method="post" enctype="multipart/form-data">
        <label for="nombre">Introduce el nombre del archivo</label><br>
        <input type="text" name="nombre"><br><br>
        <label for="imagen">Selecciona la imagen que deseas subir</label><br>
        <input type="file" name="imagen"><br><br>
        <input type="submit" value="enviar">
    </form>
</body>
</html>