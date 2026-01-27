<?php
include("db/db.inc");

$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validación de formato de email
    if(isset($_POST["email"]) && !empty($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        
        // Validación de presencia de contraseña
        if(isset($_POST["password"]) && !empty($_POST["password"])) {
            
            // Limpieza de datos (email) y cifrado (password)
            $email_input = trim($_POST["email"]);
            $password_input = $_POST["password"];

            // Preparación de consulta segura contra SQL Injection
            $stmt = $conn->prepare("SELECT id, nombre, email, password FROM clientes WHERE email = ?");
            $stmt->bind_param("s", $email_input);
            $stmt->execute();
            $result = $stmt->get_result();

            // Verificación de existencia del usuario
            if ($cliente = $result->fetch_assoc()) {

                if (password_verify($password_input, $cliente["password"])) {
                    
                    session_start();

                    $_SESSION["id_cliente"] = $cliente["id"];
                    $_SESSION["nombre"] = $cliente["nombre"];
                    $_SESSION["email"] = $cliente["email"];

                    header("location:./index.php");
                    die();
                } else {
                    // Contraseña incorrecta
                    $error_msg = "El email y/o la contraseña NO coinciden.";
                }
            } else {
                // Email no encontrado
                $error_msg = "El email y/o la contraseña NO coinciden.";
            }

            $stmt->close();
        } else {
            $error_msg = "Error en el campo 'contraseña'.";
        }
    } else {
        if (isset($_POST["email"])) {
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

        <p>¿No tienes cuenta? <a href="registro.php">Regístrate</a></p>
        <p class="admin"><a href="admin/login_admin.php">Soy administrador</a></p>
    </main>
</body>
</html>