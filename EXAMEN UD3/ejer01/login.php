<?php
    session_start();

    // ERROR DE REFERER
    if (parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) != $_SERVER['HTTP_HOST']) {
        echo "<h1 style='color:red'>Error de referer</h1>";
        header("Refresh:2; url=index.php");
        die();
    }

    // VERIFICAR NOMBRE DE USUARIO
    if (!isset($_POST["user"]) || empty($_POST["user"])) {
        echo "<h1 style='color:red'>Debes introducir un usuario</h1>";
        header("Refresh:2; url=index.php");
        die();
    } else {
        $user = htmlspecialchars($_POST["user"]);
    }

    // VERIFICAR CONTRASEÑA
    if (!isset($_POST["password"]) || empty($_POST["password"])) {
        echo "<h1 style='color:red'>Debes introducir una contraseña</h1>";
        header("Refresh:2; url=index.php");
        die();
    } else {
        $password = htmlspecialchars($_POST["password"]);
    }

    // VERIFICAR QUE EL LOGIN ES VÁLIDO
    if ($user != "admin" && $user != "usuario") {
        echo "<h1 style='color:red'>El nombre de usuario debe ser 'usuario' o 'admin'</h1>";
        header("Refresh:2; url=index.php");
        die();
    }
    if ($password !== "admin" && $password !== "usuario") {
        echo "<h1 style='color:red'>La contraseña para '$user' no es correcta</h1>";
        header("Refresh:2; url=index.php");
        die();
    }

    // VERIFICAR COINCIDENCIA DE LOS CAMPOS
    if ($user !== $password) {
        echo "<h1 style='color:red'>La contraseña para '$user' no es correcta</h1>";
        header("Refresh:2; url=index.php");
        die();
    }

    // GUARDAR VARIABLE DE SESIÓN
    $_SESSION["nombre"] = $user;

    // REDIRIGIR A MAIN SI NO HUBO ERROR ESPERADO
    header("Location:main.php");
?>