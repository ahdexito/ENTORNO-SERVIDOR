<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contador de visitas</title>
</head>
<body>
    <h1>Contador de visitas</h1>
    <?php
        // DEFINIR TIEMPO DE EXPIRACIÓN A 1 AÑO
        $expiracion = time() + (3600 * 24 * 365);

        // ESTABLECER COOKIE A PARTIR DE LA SEGUNDA VISITA
        setcookie("contador", 2, $expiracion);

        // SI EXISTE SUMAR 1
        if (isset($_COOKIE["contador"])) {
            $contador = $_COOKIE["contador"];
            $contador++;
            setcookie("contador", $contador, $expiracion);
            echo "<p>Has visitado esta página " . $_COOKIE["contador"] . " veces.</p>";
        }
        // SI NO EXISTE (PRIMERA VEZ), MUESTRA MENSAJE INICIAL
        else {
            echo "<p>Has visitado esta página 1 vez.</p>";
        }

        
        // LA COOKIE LA CREA DESPUÉS DE MOSTRAR LA PÁGINA POR PRIMERA VEZ,
        // ES POR ESTO QUE PARA LA PRIMERA VISITA NO ACCEDO AL VALOR 
        // DE LA COOKIE PORQUE NO EXISTE
    ?>
</body>
</html>