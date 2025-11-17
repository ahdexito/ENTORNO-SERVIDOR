<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejer03</title>
</head>
<body>
    <?php
        $directorio = "img/";
        $nombre_tmp = $_FILES["imagen"]["tmp_name"];
        $nombre = uniqid('', true) . $_FILES["imagen"]["name"];
        $ruta_final = $directorio . $nombre;

        $fileName = basename($nombre);
        $extensionArchivo = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
        $extensionPermitida = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
        if (in_array($extensionArchivo, $extensionPermitida)) {
            if (move_uploaded_file($nombre_tmp, $ruta_final)) {
                echo "<img src='$ruta_final'>";
                echo "<h1>" . $_POST['nombre'] . "</h1>";
            } else {
                echo "Error al subir el archivo.";
                
            }
        } else {
            echo "Extensión de archivo no permitida.";
            
        }
    ?>
</body>
</html>