<?php
    $expiracion = time() + (10 * 60);

    setcookie("nombredeusuario", $_POST["nombre"], $expiracion);
    setcookie("idioma", $_POST["idioma"], $expiracion);

    echo "<h2>Las cookies se han guardado</h2>";

    header("Refresh:3; url=ej6.cookies.php");
?>