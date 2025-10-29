<?php
    // Crea una cookie llamada 'nombre_usuario' con el valor 'Paco'
    setcookie("nombre_usuario", "Angel");


    
    // Crea una cookie que caducará en 30 días
    // $expiracion = time() + (7 * 24 * 60 * 60); // 30 días en segundos
    // setcookie("recuerdame", "si", $expiracion);
    // echo "Las cookies han sido configuradas.";

    if (isset($_COOKIE["nombre_usuario"])) {
        print "<h1>Hola, " . $_COOKIE["nombre_usuario"] . "</h1>";

        $_COOKIE["nombre_usuario"] = "Pepe";
        print "<h2>Hola, " . $_COOKIE["nombre_usuario"] . "</h2>";
    }
?>