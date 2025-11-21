<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
</head>
<body>
    <h1>Bienvenido, <?php echo($_SESSION["nombre"]) ?> </h1>

    <br><br>

    <a href="logout.php"><button>Cerrar sesión</button></a>
</body>
</html>