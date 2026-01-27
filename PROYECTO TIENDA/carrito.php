<?php

session_start();
require_once "db/db.inc";

/**
 * LÓGICA DE ELIMINACIÓN (GET)
 * Se procesa antes de cargar los productos para que el resumen esté actualizado.
 */
if (isset($_GET["eliminar"])) {
    $id_producto = intval($_GET["eliminar"]);

    if (isset($_SESSION['carrito'][$id_producto])) {
        unset($_SESSION['carrito'][$id_producto]);
    }

    header("location:carrito.php");
    exit();
}

/**
 * PREPARACIÓN DE DATOS DEL CARRITO
 */
$ids_carrito = isset($_SESSION['carrito']) ? array_keys($_SESSION['carrito']) : [];
$productos_carrito = [];
$total = 0;

if (!empty($ids_carrito)) {
    // Sanitización de IDs para la consulta IN
    $lista_ids = implode(",", array_map('intval', $ids_carrito));
    $sql = "SELECT * FROM productos WHERE id IN ($lista_ids)";
    $resultado = $conn->query($sql);

    while ($fila = $resultado->fetch_assoc()) {
        $productos_carrito[] = $fila;
        $total += $fila['precio'];
    }
}

/**
 * PROCESO DE CONFIRMACIÓN DE PEDIDO (POST)
 * Uso de transacciones para asegurar la integridad de los datos.
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirmar_pedido']) && !empty($productos_carrito)) {
    
    // Verificación de sesión de cliente
    if (!isset($_SESSION['id_cliente'])) {
        header("location:login.php");
        exit();
    }

    $cliente_id = $_SESSION['id_cliente'];

    // Inicio de transacción: O se guarda todo, o nada.
    $conn->begin_transaction();
    try {
        // Insertar el pedido principal
        $stmt = $conn->prepare("INSERT INTO pedidos (cliente_id, total, estado) VALUES (?, ?, 'pagado')");
        $stmt->bind_param("id", $cliente_id, $total);
        $stmt->execute();
        $pedido_id = mysqli_insert_id($conn);

        // Preparar sentencias para líneas de pedido y actualización de stock
        $stmt_linea = $conn->prepare("INSERT INTO linea_pedido (pedido_id, producto_id, precio) VALUES (?, ?, ?)");
        $stmt_update = $conn->prepare("UPDATE productos SET activo = 2 WHERE id = ?");

        foreach ($productos_carrito as $p) {
            // Insertar detalle del producto en el pedido
            $stmt_linea->bind_param("iid", $pedido_id, $p['id'], $p['precio']);
            $stmt_linea->execute();

            // Marcar producto como reservado (activo = 2)
            $stmt_update->bind_param("i", $p['id']);
            $stmt_update->execute();
        }

        // Si todo ha ido bien, confirmamos los cambios
        $conn->commit();
        
        unset($_SESSION['carrito']);
        header("location:gracias.php");
        exit();

    } catch (Exception $e) {
        // Si hay error, revertimos cualquier cambio en la base de datos
        $conn->rollback();
        $error_pedido = "Error crítico al procesar el pedido: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen de Carrito</title>
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
                <?php if (isset($_SESSION["nombre"])): ?>
                    <i class="fa-solid fa-user icono-usuario dropdown-btn icono-accion"></i>
                    <div class="dropdown-content">
                        <?php if (isset($_SESSION["rol"])): ?>
                            <a href="admin/panel_admin.php"><i class="fa-solid fa-bars-progress icono-dropdown"></i>Panel admin</a>
                            <hr>
                        <?php endif; ?>
                        <a href="#"><i class="fa-solid fa-heart icono-dropdown"></i>Favoritos</a>
                        <hr>
                        <a href="#"><i class="fa-solid fa-gear icono-dropdown"></i>Ajustes</a>
                        <hr>
                        <a href="desconectar.php"><i class="fa-solid fa-arrow-right-from-bracket icono-dropdown"></i>Cerrar sesión</a>
                    </div>
                    <p><?= htmlspecialchars($_SESSION["nombre"]) ?></p>
                <?php else: ?>
                    <a href="login.php"><i class="fa-solid fa-user icono-accion"></i></a>
                    <p>Login</p>
                <?php endif; ?>
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

            <?php if (isset($error_pedido)): ?>
                <p class="error"><?= htmlspecialchars($error_pedido) ?></p>
            <?php endif; ?>

            <article>
                <?php if (empty($productos_carrito)): ?>
                    <h2 class="cesta-vacia">Aún no has agregado ningún producto...</h2>
                <?php else: ?>
                    <?php foreach ($productos_carrito as $p): ?>
                        <div class="linea-pedido">
                            <img src="img/<?= htmlspecialchars($p['imagen']) ?>" alt="imagen producto">
                            <p class="prod-nombre">
                                <?= htmlspecialchars($p['nombre']) ?> - <strong>Talla <?= htmlspecialchars($p['talla']) ?></strong>
                            </p>
                            <p class="prod-precio"><?= htmlspecialchars($p['precio']) ?> €</p>
                            <a href="?eliminar=<?= $p['id'] ?>" title="Eliminar producto">
                                <i class="fa-regular fa-trash-can icono-papelera"></i>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </article>
            <hr>

            <?php if (!empty($productos_carrito)): ?>
                <div class="confirmacion-container">
                    <form method="POST">
                        <button type="submit" name="confirmar_pedido" class="btn-1">
                            Confirmar pedido (<?= $total ?> €)
                        </button>
                    </form>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <div class="copy">
            <i class="fa-regular fa-copyright" style="color: #63E6BE;"></i>
            <div>   
                <p>Todos los derechos reservados. Ángel García, 2026.</p>
            </div>
        </div>
        <script src="js/dropdown.js"></script>
    </footer>
</body>
</html>