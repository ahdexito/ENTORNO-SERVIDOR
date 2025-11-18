<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ej6</title>
</head>
<body>
    <?php
        if(isset($_COOKIE["nombredeusuario"])) {
            $usuario = $_COOKIE["nombredeusuario"];
            $idioma = $_COOKIE["idioma"];

            if ($idioma == "esp")
                echo "<h2>Bienvenido de nuevo, $usuario</h2>";
            elseif ($idioma == "eng")
                echo "<h2>Welcome again, $usuario</h2>";
            else echo "<h2>Error al seleccionar idioma</h2>";
        }
        else echo "<h2>Bienvenido</h2>";

    ?>

    <form action="ej6_guarda_pref.php" method="POST">
        <label for="nombre">Introduce tu nombre: </label>
        <input type="text" name="nombre" placeholder="Nombre">

        <br><br>

        <label for="idioma">Elige idioma: </label>
        <select name="idioma">
            <option value="" disabled selected>Selecciona una opción</option>
            <option value="esp">Español</option>
            <option value="eng">English</option>
        </select>

        <br><br>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>