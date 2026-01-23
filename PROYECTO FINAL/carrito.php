<?php
    session_start();

    // Obtener IDs de la sesión (keys)
    $ids_carrito = isset($_SESSION['carrito']) ? array_keys($_SESSION['carrito']) : [];

    $productos_carrito = [];

    if (!empty($ids_carrito)) {
        require_once "db/db.inc";

        // Convertir array de IDs a lista separada por comas
        $lista_ids = implode(",", $ids_carrito);

        // Consultar datos de artículos
        $sql = "SELECT * FROM productos WHERE id IN ($lista_ids)";
        $resultado = $conn->query($sql);

        // Guardar filas de consulta en array
        while ($fila = $resultado->fetch_assoc()) {
            $productos_carrito[] = $fila;
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio | Tienda</title>
    <link rel="stylesheet" href="css/cliente/carrito/carrito.css">
    <script src="https://kit.fontawesome.com/bc8e4b1cda.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <a href="index.php">
            <img src="img/logo-horizontal.png" alt="logotipo" class="logo logo-large">
            <img src="img/logo-horizontal-recortado.png" alt="logotipo" class="logo logo-small">
        </a>
        
        <input type="search" placeholder="Buscar aquí..." class="searchbar">

        <div class="actions">
            <div class="atras">
                <a href="index.php"><i class="fa-regular fa-circle-left icono-accion"></i></a>
                <p>Atrás</p>
            </div>

            <div class="carrito">
                <a href="#"><i class="fa-solid fa-cart-shopping icono-accion"></i></a>
                <p>Carrito</p>
            </div>

            <div class="usuario dropdown">
            <?php
                if (isset($_SESSION["nombre"])) {
                    ?>
                    <i class="fa-solid fa-user icono-usuario dropdown-btn icono-accion" id="dropdown-btn"></i>

                    <div class="dropdown-content">
                        <?php if (isset($_SESSION["rol"])) {
                            echo "<a href='admin/panel_admin.php'><i class='fa-solid fa-bars-progress icono-dropdown'></i>Panel admin</a>";
                            echo "<hr>";
                        }?>
                        <a href="#"><i class="fa-solid fa-heart icono-dropdown"></i>Favoritos</a>
                        <hr>
                        <a href="#"><i class="fa-solid fa-gear icono-dropdown"></i>Ajustes</a>
                        <hr>
                        <a href="desconectar.php"><i class="fa-solid fa-arrow-right-from-bracket icono-dropdown"></i>Cerrar sesión</a>
                    </div>
                    
                    <?php echo "<p>" . $_SESSION["nombre"] . "</p>";
                }
                else {
                    echo '<a href="login.php"><i class="fa-solid fa-user icono-accion"></i></a>';
                    echo "<p>Login</p>";
                }
            ?>
            </div>
        </div>
    </header>

    <main>
        <section>
            <h1>Resumen de artículos</h1>


            <div class="caja-overflow">
                <table>
                    <tbody>
                        <?php 
                        $total = 0;
                        foreach ($productos_carrito as $p): 
                            $total += $p['precio'];
                        ?>
                            <tr>
                                <td><img src="imagenes_productos/<?= htmlspecialchars($p['imagen']) ?>" alt="imagen producto"></td>
                                <td> <?= $p['nombre'] ?> </td>
                                <td> <?= $p['precio'] ?> €</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <footer>
        <div class="copy">
            <i class="fa-regular fa-copyright" style="color: #63E6BE;"></i>
            <div>   
                <p>Todos los derechos reservados.</p><br>
                <p>Ángel García, 2026.</p>
            </div>
        </div>
        <script src="js/dropdown.js"></script>
    </footer>
</body>
</html>