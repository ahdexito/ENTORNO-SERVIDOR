<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php
        // OBTENER DATOS DEL ARCHIVO
        $nombre_tmp = $_FILES["imagen"]["tmp_name"];
        $nombre_tmp = $_FILES["imagen"]["tmp_name"];

        // CARPETA DONDE SE GUARDAN LAS IMÁGENES
        $directorio = "img/";
        // GENERAR NOMBRE ÚNICO
        $nombre = uniqid("", true) . "_" . basename($nombre_original);

        // GUARDAR RUTA DE DESTINO
        $ruta_final = $directorio . $nombre;

        // EXTENSIÓN
        $extensionArchivo = strtolower(pathinfo($nombre, PATHINFO_EXTENSION));

        // EXTENSIONES PERMITIDAS
        $extensionPermitida = ['jpg', 'jpeg', 'png', 'gif', 'webp'];


        if (in_array($extensionArchivo, $extensionPermitida)) {

            if (move_uploaded_file($nombre_tmp, $ruta_final)) {

                echo "<h2>Imagen subida correctamente</h2>";

                // MOSTRAR IMAGEN Y TÍTULO
                echo "<img src='$ruta_final' style='max-width:300px; display:block; margin-top:10px;'><br>";
                echo "<h3>" . htmlspecialchars($_POST['nombre']) . "</h3>";
            }
            else echo "Error al mover el archivo.";
        }
        else echo "El archivo no es una imagen válida.";
    ?>

</body>
</html>