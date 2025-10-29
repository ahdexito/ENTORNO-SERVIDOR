<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejer03</title>
</head>
<body>
    <?php
        $directorio = "/img";
        $nombre_tmp = $_FILES["imagen"]["tmp_name"];
        $nombre = $_FILES["imagen"]["name"];
        $ruta_final = $directorio . $nombre;




    ?>
</body>
</html>