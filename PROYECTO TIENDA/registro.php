<?php
    include("db/db.inc");

    $error_msg = "";
    $exito = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if (
            empty($_POST["nombre"]) ||
            empty($_POST["email"]) ||
            empty($_POST["password"])
        ) {
            $error_msg = "Rellena todos los campos obligatorios.";
        } else {

            $nombre = $_POST["nombre"];
            $apellidos = $_POST["apellidos"] ?? "";
            $email = $_POST["email"];
            $password = $_POST["password"];
            $direccion = $_POST["direccion"] ?? "";
            $genero = $_POST["genero"] ?? "";
            $codpostal = $_POST["codpostal"] ?? "";
            $poblacion = $_POST["poblacion"] ?? "";
            $provincia = $_POST["provincia"] ?? "";

            // Comprobar si el email ya existe
            $stmt_check = $conn->prepare("SELECT id FROM clientes WHERE email = ?");
            $stmt_check->bind_param("s", $email);
            $stmt_check->execute();
            $res = $stmt_check->get_result();

            if ($res->num_rows > 0) {
                $error_msg = "<i class='fa-solid fa-triangle-exclamation'></i> Ya existe un usuario registrado con ese email.";
            } else {

                // encriptar contraseña
                $pass_encriptada = password_hash($password, PASSWORD_DEFAULT);

                // Insertar cliente
                $sql = "INSERT INTO clientes
                    (nombre, apellidos, genero, direccion, codpostal, poblacion, provincia, password, email)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

                $stmt_insert = $conn->prepare($sql);
                $stmt_insert->bind_param("sssssssss", $nombre, $apellidos, $genero, $direccion, $codpostal, $poblacion, $provincia, $pass_encriptada, $email);


                if ($stmt_insert->execute()) {
                    $exito = "<i class='fa-solid fa-circle-check'></i> Cuenta creada satisfactoriamente. <br> <a href='login.php'>Iniciar sesión</a>";
                } else {
                    $error_msg = "<i class='fa-solid fa-triangle-exclamation'></i> Ha ocurrido un error inesperado.";
                }

                $stmt_insert->close();
            }

            $stmt_check->close();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="css/cliente/login/login.css">
    <script src="https://kit.fontawesome.com/bc8e4b1cda.js" crossorigin="anonymous"></script>
</head>
<body>
    <main>
        <img src="img/logo-vertical.png" alt="logotipo">
        <?php 
        // Renderizado de errores si existen tras el procesamiento superior
            if (!empty($error_msg)): ?>
                <div class='error'>
                    <?php echo $error_msg; ?>
                </div>
        <?php endif; ?>

        <?php
        // Mensaje de registro exitoso
            if (!empty($exito)): ?>
                <div class="exito">
                    <?php echo $exito; ?>
                </div>
        <?php endif; ?>

        <form method="POST">

            <h2>Registrarse</h2>
            <hr>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre">
            <input type="text" name="apellidos" id="apellidos" placeholder="Apellidos">
            <select name="genero" id="genero" class="seleccion" required>
                <option value="" selected disabled>Género...</option>
                <option value="H">Hombre</option>
                <option value="M">Mujer</option>
                <option value="O">Otro</option>
            </select>
            <hr>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <hr>
            <input type="text" name="direccion" id="direccion" placeholder="Dirección">
            <input type="text" name="codpostal" id="codpostal" placeholder="Código Postal">
            <input type="text" name="poblacion" id="poblacion" placeholder="Población">
            <input type="text" name="provincia" id="provincia" placeholder="Provincia">

            <hr>
            <button type="submit">Confirmar</button>
        </form>

        <p>¿Tienes cuenta? <a href="login.php">Iniciar sesión</a></p>
        <p class="admin"><a href="admin/login_admin.php">Soy administrador</a></p>
    </main>
</body>
</html>