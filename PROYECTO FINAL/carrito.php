<?php
    session_start();
    require_once "db/db.inc";

    // Obtener IDs de la sesión (keys)
    $ids_carrito = isset($_SESSION['carrito']) ? array_keys($_SESSION['carrito']) : [];
    $productos_carrito = [];
    $total = 0;

    if (!empty($ids_carrito)) {

        // Convertir array de IDs a lista separada por comas
        $lista_ids = implode(",", array_map('intval', $ids_carrito));

        // Consultar datos de artículos
        $sql = "SELECT * FROM productos WHERE id IN ($lista_ids)";
        $resultado = $conn->query($sql);

        // Guardar filas de consulta en array
        while ($fila = $resultado->fetch_assoc()) {
            $productos_carrito[] = $fila;
            $total += $fila['precio'];
        }
    }

    // ELIMINAR LINEA PRODUCTO
    if (isset($_GET["eliminar"])) {
        $id_producto = intval($_GET["eliminar"]);

        if (isset($_SESSION['carrito'][$id_producto])) {
            unset($_SESSION['carrito'][$id_producto]);
        }

        header("location:carrito.php");
        exit();
    }

    // PROCESAR INFO DEL PEDIDO
    if (isset($_POST['confirmar_pedido']) && !empty($productos_carrito)) {
        // Redireccionar si no está logeado
        if (!isset($_SESSION['id_cliente'])) {
            header("location:login.php");
            exit();
        }

        $cliente_id = $_SESSION['id_cliente'];

        $conn->begin_transaction();
        try {
            $stmt = $conn->prepare("INSERT INTO pedidos (cliente_id, total, estado) VALUES (?, ?, 'pendiente')");
            $stmt->bind_param("id", $cliente_id, $total);
            $stmt->execute();

            $pedido_id = mysqli_insert_id($conn);

            $stmt_linea = $conn->prepare("INSERT INTO linea_pedido (pedido_id, producto_id, precio) VALUES (?, ?, ?)");
            $stmt_update = $conn->prepare("UPDATE productos SET activo = 2 WHERE id = ?");

            foreach ($productos_carrito as $p) {
                // Insertar línea
                $stmt_linea->bind_param("iid", $pedido_id, $p['id'], $p['precio']);
                $stmt_linea->execute();

                // Actualizar producto reservado
                $stmt_update->bind_param("i", $p['id']);
                $stmt_update->execute();
            }

            $conn->commit();
            
            unset($_SESSION['carrito']);
            header("location:gracias.php");
            exit();
        }

        catch (Exception $e) {
            $conn->rollback();
            $error_pedido = "Error al procesar: " . $e->getMessage();
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
            <div class="section-header">
                <i class="fa-solid fa-cart-shopping icono-header"></i>
                <h2>Resumen de artículos</h2>
            </div>
            <hr>

            <article>
                <?php 
                    if (empty($productos_carrito)) echo '<h2 class="cesta-vacia">Aún no has agregado ningún producto...</h2>';

                    $total = 0;
                    foreach ($productos_carrito as $p): 
                        $total += $p['precio']; ?>

                    <div class="linea-pedido">
                        <img src="imagenes_productos/<?= htmlspecialchars($p['imagen']) ?>" alt="imagen producto">
                        <p class="prod-nombre"> <?= $p['nombre'] . " " . $p['talla'] ?> </p>
                        <p class="prod-precio"> <?= $p['precio'] ?> €</p>
                        <a href="?eliminar=<?= $p['id'] ?>">
                            <i class="fa-regular fa-trash-can icono-papelera"></i>
                        </a>
                    </div>
                <?php endforeach; ?>
            </article>
            <hr>

            <?php if (!empty($productos_carrito)): ?>
                <form method="POST">
                    <input type="hidden" name="total_pago" value="<?= $total ?>">
                    <button type="submit" name="confirmar_pedido" class="btn-1">
                        Confirmar pedido (<?= $total ?> €)
                    </button>
                </form>
            <?php endif; ?>
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