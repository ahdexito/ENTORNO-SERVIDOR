<?php
    // ERROR DE REFERER
    if (parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) != $_SERVER['HTTP_HOST']) {
        echo "<h1 style='color:red'>Error de referer</h1>";
        header("Refresh:2; url=ej3_examen.php");
        die();
    }

    // GUARDAR VALORES
    $nombre = htmlspecialchars($_GET["nombre"]);
    $email = htmlspecialchars($_GET["email"]);
    $telefono = htmlspecialchars($_GET["telefono"]);
    

    // VERIFICAR ENTRADA DE DATOS
    if (!isset($nombre) || empty($nombre)) {
        echo "<h1 style='color:red'>Debes introducir el nombre</h1>";
        header("Refresh:2; url=ej3_examen.php");
        die();
    }
    if (!isset($telefono) || empty($telefono)) {
        echo "<h1 style='color:red'>Debes introducir el teléfono</h1>";
        header("Refresh:2; url=ej3_examen.php");
        die();
    }
    if (!isset($email) || empty($email)) {
        echo "<h1 style='color:red'>Debes introducir el email</h1>";
        header("Refresh:2; url=ej3_examen.php");
        die();
    }

    // VERIFICAR FORMATO DEL EMAIL
    if (filter_var($email, FILTER_SANITIZE_EMAIL)) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<h1 style='color:red'>El formato del email es incorrecto</h1>";
            header("Refresh:2; url=ej3_examen.php");
            die();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
</head>
<body>
    <h1>Registro completado correctamente, <?php echo $nombre ?> </h1>

    <table style="border:5px solid lightblue ; width: 400px;">
        <thead style="background-color: lightcoral;">
            <tr>
                <td>Nombre</td>
                <td>Email</td>
                <td>Teléfono</td>
            </tr>
        </thead>
        <tbody style="background-color: lightsalmon">
            <tr>
                <td> <?php echo $nombre ?></td>
                <td> <?php echo $email ?> </td>
                <td> <?php echo $telefono ?> </td>
            </tr>
        </tbody>
    </table>
</body>
</html>