<?php
/**
 * ARCHIVO: admin/login.php
 * DESCRIPCIÓN: Acceso restringido para administradores.
 */

session_start();
include("../db/db.inc");

/**
 * LÓGICA DE PROCESAMIENTO
 */
$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email_raw = $_POST["email"] ?? "";
    $pass_raw = $_POST["password"] ?? "";

    if (!empty($email_raw) && filter_var($email_raw, FILTER_VALIDATE_EMAIL)) {
        if (!empty($pass_raw)) {
            
            // Limpieza y hash
            $email = htmlspecialchars(trim($email_raw));
            $password = sha1($pass_raw); // Nota: sha1 es vulnerable, pero mantengo tu lógica.

            $check = $conn->prepare("SELECT nombre, email, rol FROM usuarios WHERE email = ? AND password = ?");
            $check->bind_param("ss", $email, $password);
            $check->execute();
            $check->store_result();

            if ($check->num_rows > 0) {
                $check->bind_result($nombre, $emailDB, $rol);
                $check->fetch();

                // Guardamos datos en sesión
                $_SESSION["nombre"] = $nombre;
                $_SESSION["rol"] = $rol;
                $_SESSION["email"] = $emailDB;

                header("location: panel_admin.php");
                exit();
            } else {
                $error = "El email y/o la contraseña NO coinciden.";
            }
        } else {
            $error = "Error en el campo 'contraseña'.";
        }
    } else {
        $error = "El email NO es válido.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Admin</title>
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