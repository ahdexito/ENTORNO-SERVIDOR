<?php
    session_start();

    // FUNCIÓN VALIDAR CADA CAMPO
    function validarCampo($campo) {
        return isset($_POST[$campo]) && !empty(trim($_POST[$campo]));
    }

    $campos = ["nombre", "apellidos", "email", "password", 
        "genero", "direccion", "postal", "poblacion", "provincia"];
    $errores = [];

    // VALIDAR CAMPOS Y GUARDAR MENSAJES DE ERROR
    foreach($campos as $campo) {
        if (!validarCampo($campo)) {
            $errores[] = "El campo '$campo' es obligatorio."; 
        }
    }

    // VALIDAR EMAIL
    $email_sanitizado = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    if (!filter_var($email_sanitizado, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El email no es válido.";
    }

    // SI HAY ERRORES, IMPRIMIR Y SALIR
    if (!empty($errores)) {
        foreach($errores as $error) {
            echo "<p style='color:red'>ERROR: $error</p>";
        }
        header("Refresh:4; url=ej08_sesiones.php");
        exit;
    }

    // SI NO HAY ERRORES, GUARDAR SESIÓN
    $_SESSION["usuario"] = htmlspecialchars($_POST["nombre"]);

    // VOLVER A PÁGINA PRINCIPAL
    header("Location:ej08_sesiones.php");
    exit;
?>