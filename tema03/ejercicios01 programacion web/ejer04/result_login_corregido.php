<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="padding: 30px;">
    
    <?php
        // PREVENIR CSRF
        if (parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) != $_SERVER['HTTP_HOST']) {
            echo "<h1>Error: Debes rellenar el formulario en nuestra web</h1>";
            header("Refresh:2; url=ej4_form_login.php");
            die();
        }

        // GUARDAR DATOS EN ARRAY ASOCIATIVO
        $usuario = [
            "email" => $_POST["email"],
            "contra" => $_POST["contra"]
        ];

        // VALIDAR EMAIL
        if (!filter_var($usuario["email"], FILTER_VALIDATE_EMAIL)) {
            echo "<h2 style='color:red'>El email no es válido</h2>";
            echo "<a href='ej4_form_login.php' class='btn btn-primary mt-3'>Volver</a>";
            die();
        }

        // VALIDAR CONTRASEÑA
        $patron_seguro =  '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
        if (!preg_match($patron_seguro, $usuario['contra'])) {
            echo "<h2 style='color:red'>El patrón de la contraseña no es válido</h2>";
            echo "<a href='ej4_form_login.php' class='btn btn-primary mt-3'>Volver</a>";
            die();
        }

        // MOSTRAR RESUMEN
        echo "<h1>Resumen del formulario</h1>";
        echo "<p><strong>Email:</strong> {$usuario['email']}</p>";
        echo "<p><strong>Contraseña:</strong> {$usuario['contra']}</p>";
    ?>

    <br>
    <a href="ej4_form_login.php" class="btn btn-primary">Volver</a>

</body>
</html>