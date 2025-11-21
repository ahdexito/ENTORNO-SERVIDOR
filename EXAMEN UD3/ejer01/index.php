<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="login.php" method="POST">
        <label for="user">Usuario</label>
        <input type="text" name="user" required placeholder="Tu usuario" >

        <br><br>

        <label for="password">Contraseña</label>
        <input type="password" name="password" required placeholder="Tu contraseña" >

        <br><br>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>