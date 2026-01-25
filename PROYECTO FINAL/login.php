<?php
/**
 * ARCHIVO: login.php
 * DESCRIPCIÓN: Gestiona el inicio de sesión de los clientes.
 */

// Inclusión del archivo de conexión a la base de datos
include("db/db.inc");

 // Variable para capturar mensajes y mostrarlos en el cuerpo
$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validación de formato de Email
    if(isset($_POST["email"]) && !empty($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        
        // Validación de presencia de contraseña
        if(isset($_POST["password"]) && !empty($_POST["password"])) {
            
            // Limpieza de datos (Email) y cifrado (Password)
            $email = htmlspecialchars(trim($_POST["email"]));
            $password = sha1($_POST["password"]);

            // Preparación de consulta segura contra SQL Injection
            $check = $conn -> prepare("SELECT id, nombre, email FROM clientes WHERE email = ? AND password = ?");
            $check -> bind_param("ss", $email, $password);
            $check -> execute();
            $check -> store_result();

            // Verificación de existencia del usuario
            if ($check -> num_rows > 0) {
                session_start();

                // Extracción de datos para la sesión
                $check -> bind_result($id, $nombre, $emailDB);
                $check -> fetch();

                $_SESSION["id_cliente"] = $id;
                $_SESSION["nombre"] = $nombre;
                $_SESSION["email"] = $emailDB;

                // Redirección segura antes de que exista salida de texto
                header("location:./index.php");
                die();
            } else {
                $error_msg = "El email y/o la contraseña NO coinciden.";
            }
        } else {
            $error_msg = "Error en el campo 'contraseña'.";
        }
    } else {
        if(isset($_POST["email"])) {
            $error_msg = "El email NO es válido.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/cliente/login/login.css">
    <script src="https://kit.fontawesome.com/bc8e4b1cda.js" crossorigin="anonymous"></script>
</head>
<body>
    <main>
        <img src="img/logo-vertical.png" alt="logotipo">
        <h1>¡Bienvenid@!</h1>

        <?php 
        // Renderizado de errores si existen tras el procesamiento superior
        if (!empty($error_msg)): ?>
            <div class='error'>
                <i class='fa-solid fa-triangle-exclamation'></i><?php echo $error_msg; ?>
            </div>
        <?php endif; ?>

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