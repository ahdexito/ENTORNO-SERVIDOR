<?php
    if (isset($_POST["nombre"]) && !empty(trim($_POST["nombre"])))
        $nombre = htmlspecialchars($_POST["nombre"]);
    else {
        echo "<h1>El nombre de usuario es incorrecto</h1>";
        header("Refresh:3; url=ej9_form_login.php"); 
        die();
    }

    echo "<h1>Bienvenido $nombre</h1>";

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
        <?php
            if (isset($_SESSION["usuario"])) {
                if ($_SESSION["usuario"] == "usuario") {
                    echo ""
                }
            }
        ?>
    </style>
</head>
<body>
    
</body>
</html>