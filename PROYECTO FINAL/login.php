<?php
    include("db/db.inc");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login/login.css">
    <script src="https://kit.fontawesome.com/bc8e4b1cda.js" crossorigin="anonymous"></script>
</head>
<body>
    <main>
        <img src="img/logo-vertical.png" alt="logotipo">
        <h1>¡Bienvenid@!</h1>

        <?php
            if(isset($_POST["email"]) && !empty($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                if(isset($_POST["password"]) && !empty($_POST["password"])) {
                    $email = htmlspecialchars(trim($_POST["email"]));
                    $password = htmlspecialchars(sha1($_POST["password"]));

                    $check = $conn -> prepare("SELECT nombre, email, rol FROM usuarios WHERE email = ? AND password = ?");
                    
                    $check -> bind_param("ss", $email, $password);
                    $check -> execute();
                    $check -> store_result();

                    if ($check -> num_rows > 0) {
                        session_start();

                        $check -> bind_result($nombre, $emailDB, $rol);
                        $check -> fetch();

                        $_SESSION["nombre"] = $nombre;
                        $_SESSION["rol"] = $rol;
                        $_SESSION["email"] = $emailDB;

                        header("location:./index.php");
                        die();
                    }

                    else {
                        echo "<div class='error'><i class='fa-solid fa-triangle-exclamation'></i>El email y/o la contraseña NO coinciden.</div>";
                    }
                }

                else {
                    echo "<div class='error'><i class='fa-solid fa-triangle-exclamation'></i>Error en el campo 'contraseña'.</div>";
                }
            }

            else {
                if(isset($_POST["email"])) {
                    echo "<div class='error'><i class='fa-solid fa-triangle-exclamation'></i>El email NO es válido.</div>";
                }
            }
        ?>

        <form method="POST">
            <h2>Iniciar sesión</h2>
            <hr>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <hr>
            <button type="submit">Entrar</button>
        </form>

        <p>¿No tienes cuenta? <a href="#">Regístrate</a></p>
        <p class="admin"><a href="admin/login_admin.php">Soy administrador</a></p>
    </main>
</body>
</html>