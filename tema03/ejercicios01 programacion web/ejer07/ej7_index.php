<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        <?php
            if (isset($_COOKIE["colorusu"]))
                echo "body { background-color: " . $_COOKIE["colorusu"] . ";}";
        ?>
    </style>
</head>
<body>
    <?php
        if (isset($_COOKIE["nombreusu"]))
            echo "<h2>Bienvenido, " . $_COOKIE["nombreusu"] . "</h2>";
        else echo "<h2>Página de inicio</h2>";
    ?>

    <a href="ej7_preferencias.php">Volver al formulario</a>

    <br><br>

    <?php
        if (!empty($_COOKIE))
            echo "<a href='ej7_borrar_prefs.php'>Borrar preferencias</a>";
    ?>
</body>
</html>