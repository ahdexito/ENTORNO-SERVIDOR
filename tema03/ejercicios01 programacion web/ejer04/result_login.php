<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        body {
            padding: 30px;
        }
    </style>
    <title>resultado</title>
</head>
<body>
    <?php


        /*
        if (isset($_POST["nombre"]) && !empty(trim($_POST["nombre"])) && filter_var($_POST["email"]), FILTER_VALIDATE_EMAIL)
        $nombre = htmlspecialchars($_POST["nombre"]);
        else {
            echo "<h1>El nombre de usuario es incorrecto</h1>";
            header("Refresh:3; url=ej9_form_login.php"); 
        }
        */


        $usuario = [
            "email" => $_POST["email"],
            "contra" => $_POST["contra"]
        ];

        echo "<h1>Registro</h1>";

        $email_sanitizado = filter_var($usuario["email"], FILTER_SANITIZE_EMAIL);
        $patron_seguro =  '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';

        if (preg_match($patron_seguro, $usuario["contra"])) {
            echo "<p>Usuario: " . $usuario["email"] . "</p>";
            echo "<p>Contraseña: " . $usuario["contra"] . "</p>";
        }
        
        else {
            echo "<p>La contraseña no cumple con los requisitos de seguridad.</p>";
        }
    ?>
    <a href="ej4_form_login.php"><button class="btn btn-primary">Volver</button></a>

    <footer><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script></footer>
</body>
</html>