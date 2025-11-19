<?php
    // función para validar cada campo que recibe
    function validarCampo($campo) {
        return isset($_POST[$campo]) && !empty(trim($_POST[$campo]));
    }

    // array con los nombres de los campos
    $campos = ["nombre", "apellidos", "email", "password", "genero", "direccion", "postal", "poblacion", "provincia"];

    // array de errores
    $errores = [];

    // validar cada campo
    // si algún campo no es válido añade un mensaje al array de errores
    foreach ($campos as $campo) {
        if (!validarCampo($campo)) {
            $errores[] = "El campo '$campo' es obligatorio.";
        }
    }

    // sanitizar el email
    $_POST["email"] = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

    // validar el email
    // si no es válido se suma el mensaje al array de errores
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
        $errores[] = "<p style='color:red'>El email " . $_POST["email"] . " NO es válido</p>";

    // si hay errores los imprime y regresa al login
    if (!empty($errores)) {
        echo "<h3>ERROR:</h3>";
        foreach ($errores as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
        header("Refresh:5; url=ej5_form_registro.php");
        exit;
    }

    // si no hay errores continúa el código e imprime los datos
    echo "<h2>Datos recibidos</h2>";

    session_start();
    $_SESSION["usuario"] = $_POST["nombre"];
    header("Location:ej08_sesiones.php");
?>