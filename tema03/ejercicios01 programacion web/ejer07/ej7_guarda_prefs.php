<?php
    $expiracion = time() + (5 * 60);

    setcookie("nombreusu", $_POST["nombre"], $expiracion);
    
    if (isset($_POST["usar_color"])) {
        setcookie("colorusu", $_POST["color"], $expiracion);
    }

    header("Location:ej7_index.php");
?>