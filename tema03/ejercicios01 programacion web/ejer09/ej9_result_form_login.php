<?php
    // prevenir ataques CSRF
    if (parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) != $_SERVER['HTTP_HOST']){
        echo "<h1>Error: Debes rellenar el formulario en nuestra web</h1>";
        header("Refresh:2; url=form_example.php");
    }

    // verificar que se haya recibido el usuario
    if (isset($_POST["nombre"]) && !empty(trim($_POST["nombre"])))
        $nombre = htmlspecialchars($_POST["nombre"]);
    else {
        echo "<h1 style='color:red'>El nombre de usuario es incorrecto</h1>";
        header("Refresh:3; url=ej9_form_login.php"); 
        die();
    }

    // verificar que la contraseña sea correcta y no este vacía
    if (isset($_POST["contra"]) || empty(trim($_POST["contra"]))) {
        if ($_POST["contra"] != "1234") {
            echo "<h1 style='color:red'>La contraseña es incorrecta</h1>";
            header("Refresh:3; url=ej9_form_login.php"); 
            die();
        }
    }
    else {
        echo "<h1 style='color:red'>Debes introducir la contraseña</h1>";
        header("Refresh:3; url=ej9_form_login.php"); 
        die();
    }

    // guardar variables de sesión para ADMIN
    if ($nombre == "admin") {
        session_start();

        $_SESSION["usuario"] = $nombre;
        $_SESSION["rol"] = 1;
    }

    // guardar variables de sesión para USUARIO
    elseif ($nombre == "usuario") {
        session_start();

        $_SESSION["usuario"] = $nombre;
        $_SESSION["rol"] = 2;
    }

    // regresar a inicio si no es válido
    else {
        echo "<h1>El nombre debe ser 'usuario' o 'admin'</h1>";
        header("Refresh:3; url=ej9_form_login.php"); 
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        
    </style>
</head>
<body>
    <?php
        // mostrar página personalizada para admin
        if (isset($_SESSION["rol"])) {
            if ($_SESSION["rol"] == 1) {
                echo "<style> body { background-color: aquamarine; } </style>";
                echo "<h1>Bienvenido, admin</h1>";
            }
        }

        // mostrar página personalizada para usuario
        if (isset($_SESSION["rol"])) {
            if ($_SESSION["rol"] == 2) {
                echo "<style> body { background-color: lightsalmon; } </style>";
                echo "<h1>Bienvenido, usuario</h1>";
            }
        }
    ?>

    <br><br>

    <a href="ej9_desconectar.php"><button>Cerrar sesión</button></a>
</body>
</html>