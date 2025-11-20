<?php
    session_start();

    // VALIDAR REFERER
    if (!isset($_SERVER['HTTP_REFERER']) || 
        parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) !== $_SERVER['HTTP_HOST']) {

        echo "<h1>Error: Debes rellenar el formulario en nuestra web</h1>";
        header("Refresh:2; url=ej9_form_login.php");
        die();
    }


    // VALIDAR USUARIO
    if (!isset($_POST["nombre"]) || empty(trim($_POST["nombre"]))) {
        echo "<h1 style='color:red'>El nombre de usuario es obligatorio</h1>";
        header("Refresh:3; url=ej9_form_login.php");
        die();
    }

    $nombre = htmlspecialchars(trim($_POST["nombre"]));


    // VALIDAR CONTRASEÑA
    if (!isset($_POST["contra"]) || empty(trim($_POST["contra"]))) {
        echo "<h1 style='color:red'>La contraseña es obligatoria</h1>";
        header("Refresh:3; url=ej9_form_login.php");
        die();
    }

    $contra = htmlspecialchars($_POST["contra"]);


    // VALIDAR CONTRASEÑA CORRECTA
    if ($contra !== "1234") {
        echo "<h1 style='color:red'>La contraseña es incorrecta</h1>";
        header("Refresh:3; url=ej9_form_login.php");
        die();
    }


    // VALIDAR NOMBRE Y CREAR SESIÓN
    if ($nombre === "admin") {
        $_SESSION["usuario"] = "admin";
        $_SESSION["rol"] = 1;
    }

    elseif ($nombre === "usuario") {
        $_SESSION["usuario"] = "usuario";
        $_SESSION["rol"] = 2;
    }

    else {
        echo "<h1 style='color:red'>El nombre deber ser 'usuario' o 'admin'</h1>";
        header("Refresh:3; url=ej9_form_login.php");
        die();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>

    <style>
        <?php
            if ($_SESSION["rol"] == 1) echo "body { background-color: aquamarine; }";
            if ($_SESSION["rol"] == 2) echo "body { background-color: lightsalmon; }";
        ?>
    </style>
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION["usuario"]; ?></h1>

    <br><br>

    <a href="ej9_desconectar.php"><button>Cerrar sesión</button></a>
</body>
</html>