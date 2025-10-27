<?php
    $directorio = "img/"; // carpeta del servidor para guardar imágenes
    $nombre_tmp = $_FILES["archivo"]["tmp_name"]; // nombre temporal que recibe el archivo
    $nombre = $_FILES["archivo"]["name"]; // nombre del archivo
    $ruta_final = $directorio . $nombre; // ruta final del archivo

    $fileName = basename($nombre);
    $extensionArchivo = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));


    $extensionPermitida = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
    if (in_array($extensionArchivo, $extensionPermitida)) {
        if (move_uploaded_file($nombre_tmp, $ruta_final)) {
            echo "El archivo se ha subido correctamente.";
        } else {
            echo "Error al subir el archivo.";
        }
    } else {
        echo "Extensión de archivo no permitida.";
    }
?>