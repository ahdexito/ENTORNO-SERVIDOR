<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- 22.- Teniendo el código html básico de una página web, utiliza PHP para mostrar en una etiqueta h1 para mostrar el mensaje “Bienvenido de nuevo”, y en una etiqueta p “Este contenido es para usuarios registrados”, si al evaluar una variable llamada $logueado su valor es true. En caso contrario, utiliza una etiqueta h1 para mostrar el mensaje “Por favor, inicia sesión”, y en una etiqueta p “Crea una cuenta, o ingresa para acceder a más contenido”. -->
    
</head>
<body>
    <?php
        $logeado = true;

        // imprimir según si es true o false
        if ($logeado) {
            echo "<h1>Bienvenido de nuevo</h1>";
            echo "<p>Este contenido es para usuarios registrados</p>";
        }
        else {
            echo "<h1>Por favor, inicia sesión</h1>";
            echo "<p>Crea una cuenta, o ingresa para acceder a más contenido</p>";
        }
    ?>
</body>
</html>    