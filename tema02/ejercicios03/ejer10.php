<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejer10</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <main>
        <?php
        echo "<h1> EJERCICIO 10 </h1>";

        /*
        10. Teniendo el código html básico de una página web, utiliza php para declarar la cadena: "aprendiendo php en el ies Torrevigía". 
        Reemplaza "php" por "PHP" usando str_replace(). 
        Muestra el contenido utilizando un popover de bootstrap. 
        Convierte toda la cadena a mayúsculas y muéstrala en un <h2>. 
        Convierte toda la cadena a minúsculas con y muéstrala en un <h3>. 
        [Ayuda. Mira la documentación de Bootstrap para popovers. Agrega los siguientes scripts en footer de tu página, debajo los scripts ya definidos. Asegúrate de dar a tu popover el mismo id que estás poniendo aquí.]
        */

        // declarar cadena original
        $cadena = "Aprendiendo php en el IES Torrevigía.";

        // declarar cadena modificada
        $nueva_cadena = str_replace("php", "PHP", $cadena);
        
        // convertir a mayúsculas
        $mayusculas = strtoupper($nueva_cadena);

        // convertir a minúsculas
        $minusculas = strtolower($nueva_cadena);
        ?>

        <!-- crear botón popover con el mensaje original y el modificado -->
        <button type="button" class="btn btn-lg btn-danger" id="miBotonPopover"
            data-bs-toggle="popover" 
            data-bs-title="Nueva cadena" 
            data-bs-content="<?php echo $nueva_cadena ?>">
                <?php echo $cadena ?>
        </button>

        <?php
            // imprimir la cadena en mayúsculas
            echo "<h2> $mayusculas </h2>";

            // imprimir la cadena en minúsculas
            echo "<h3> $minusculas </h3>";
        ?>
        
    </main>

    <footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            const popoverTriggerEl = document.getElementById('miBotonPopover');
            const popoverInstance = new bootstrap.Popover(popoverTriggerEl);
        </script>
    </footer>
</body>
</html>