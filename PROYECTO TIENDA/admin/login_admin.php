<?php

session_start();
include("../db/db.inc");

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email_raw = $_POST["email"] ?? "";
    $pass_raw = $_POST["password"] ?? "";

    if (!empty($email_raw) && filter_var($email_raw, FILTER_VALIDATE_EMAIL)) {
        if (!empty($pass_raw)) {
            
            // Limpieza y hash
            $email_input = trim($email_raw);
            $password_input = $pass_raw;

            $stmt = $conn->prepare("SELECT nombre, email, password, rol FROM usuarios WHERE email = ?");
            $stmt->bind_param("s", $email_input);
            $stmt->execute();
            $result =$stmt->get_result();

            if ($usuario = $result->fetch_assoc()) {

                if (password_verify($password_input, $usuario["password"])) {

                    // Guardamos datos en sesión
                    $_SESSION["nombre"] = $usuario["nombre"];
                    $_SESSION["rol"] = $usuario["rol"];
                    $_SESSION["email"] = $usuario["email"];

                    header("location:panel_admin.php");
                    exit();
                } else {
                    $error = "El email y/o la contraseña NO coinciden.";
                }
            } else {
                $error = "El email y/o la contraseña NO coinciden.";
            }

            $stmt->close();
        } else {
            $error = "Error en el campo 'contraseña'.";
        }
    } else {
        if (!empty($email_raw)) {
            $error = "El email NO es válido.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="../css/cliente/login/login.css">
    <script src="https://kit.fontawesome.com/bc8e4b1cda.js" crossorigin="anonymous"></script>
</head>
<body>
    <main>
        <img src="../img/logo-vertical.png" alt="logotipo">
        <h1>Panel de administrador</h1>

        <?php if ($error): ?>
            <div class='error'>
                <i class='fa-solid fa-triangle-exclamation'></i><?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <h2>Iniciar sesión</h2>
            <hr>
            <input type="email" name="email" placeholder="Email" required 
                value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
            <input type="password" name="password" placeholder="Contraseña" required>
            <hr>
            <button type="submit">Entrar</button>
        </form>

        <p><a href="../login.php">Soy cliente</a></p>
    </main>
</body>
</html>