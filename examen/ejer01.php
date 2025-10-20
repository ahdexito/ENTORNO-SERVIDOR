<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejer01</title>
</head>
<body>
    <?php
        function calcularPrecio($alto, $ancho, $bordado) {
            $m2 = $alto * $ancho;
            $precio = 0.01;
            $precioBordado = 2.5;
            $envio = 3.25;

            $total = $m2 * $precio + $envio;
            if ($bordado == 1) $total += $precioBordado;

            echo "<h1>Desglose de la compra</h1>";
            // abrir tabla
            echo "<table>";

            // primera fila
            echo "<tr>";
            echo "<td>Bandera de ($alto x $ancho) $m2" . "cm.</td>";
            echo "<td>" . ($m2 * $precio) . " €</td>";
            echo "</tr>";

            // segunda fila
            echo "<tr>";
            if ($bordado == 1) {
                echo "<td>Con bordado</td>";
                echo "<td>$precioBordado €</td>";
            }
            else {
                echo "<td>Sin bordado</td>";
                echo "<td>0.00 €</td>";
            }
            echo "</tr>";

            // tercera fila
            echo "<tr>";
            echo "<td>Gastos de Envío</td>";
            echo "<td>$envio €</td>";
            echo "</tr>";

            // cuarta fila
            echo "<tr>";
            echo "<td>Total a pagar</td>";
            echo "<td>$total €</td>";
            echo "</tr>";

            echo "</table>";
        }

        calcularPrecio(rand(10, 40), rand(10, 40), rand(0, 1));
    ?>
</body>
</html>