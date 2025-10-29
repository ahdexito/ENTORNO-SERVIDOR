<?php
    echo "<p><b>Departamento: </b>" . $_POST["departamento"] . "</p>";
    echo "<p><b>Presupuesto asignado: </b>";
    switch ($_POST["departamento"]) {
        case "INFORMÁTICA":
            echo "500€</p>";
            break;
        case "LENGUA":
            echo "300€</p>";
            break;
        case "MATEMÁTICAS":
            echo "300€</p>";
            break;
        case "INGLÉS":
            echo "400€</p>";
            break;
    }
?>