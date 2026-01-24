<?php
    session_start();
    if(!isset($_SESSION["rol"])) {
        header("location:../index.php");
        die();
    }

    include("../db/db.inc");

    // Verificar que recibimos un ID de pedido válido
    if (!isset($_GET['id'])) {
        header("location:gestion_pedidos.php");
        exit();
    }

    $id_pedido = intval($_GET['id']);

    // Obtener datos generales del pedido y del cliente
    $sql_pedido = 
        "SELECT p.*, c.nombre, c.apellidos, c.email, c.direccion, c.poblacion 
        FROM pedidos p 
        JOIN clientes c ON p.cliente_id = c.id 
        WHERE p.id = ?";
    
    $stmt = $conn->prepare($sql_pedido);
    $stmt->bind_param("i", $id_pedido);
    $stmt->execute();
    $pedido = $stmt->get_result()->fetch_assoc();

    if (!$pedido) {
        die("Pedido no encontrado.");
    }

    // Obtener los productos vinculados a este pedido
    $sql_productos = 
        "SELECT lp.precio AS precio_compra, pr.nombre, pr.imagen, pr.talla, pr.id AS prod_id
        FROM linea_pedido lp
        JOIN productos pr ON lp.producto_id = pr.id
        WHERE lp.pedido_id = ?";
    
    $stmt_p = $conn->prepare($sql_productos);
    $stmt_p->bind_param("i", $id_pedido);
    $stmt_p->execute();
    $productos = $stmt_p->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle Pedido #<?= $id_pedido ?></title>
    <link rel="stylesheet" href="../css/admin/detalle_pedido/detalle_pedido.css">
    <script src="https://kit.fontawesome.com/bc8e4b1cda.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <a href="../index.php">
            <img src="../img/logo-horizontal.png" alt="logotipo" class="logo logo-large">
            <img src="../img/logo-horizontal-recortado.png" alt="logotipo" class="logo logo-small">
        </a>
        <div class="actions">
            <div class="atras">
                <a href="gestion_pedidos.php"><i class="fa-regular fa-circle-left icono-accion"></i></a>
                <p>Volver</p>
            </div>
            <div class="panel">
                <a href="panel_admin.php"><i class="fa-solid fa-bars-progress icono-accion"></i></a>
                <p>Panel</p>
            </div>
            <div class="usuario dropdown">
                <i class="fa-solid fa-user icono-usuario dropdown-btn icono-accion" id="dropdown-btn"></i>

                <div class="dropdown-content">
                    <a href="#"><i class="fa-solid fa-gear icono-dropdown"></i>Ajustes</a>
                    <hr>
                    <a href="desconectar_admin.php"><i class="fa-solid fa-arrow-right-from-bracket icono-dropdown"></i>Cerrar sesión</a>
                </div>

                <?php echo "<p>" . $_SESSION["nombre"] . "</p>"?>
            </div>
        </div>
    </header>

    <main>
        <section class="panel-control">
            <div class="section-header">
                <i class="fa-solid fa-receipt icono-header"></i>
                <h2>Detalle del pedido #<?= $id_pedido ?></h2>
            </div>
            <hr>

            <div class="detalle-container">
                <div class="info-bloque">
                    <div>
                        <h3><i class="fa-solid fa-user"></i> Datos del cliente</h3>
                        <p><strong><?= htmlspecialchars($pedido['nombre'] . " " . $pedido['apellidos']) ?></strong></p>
                        <p><?= htmlspecialchars($pedido['email']) ?></p>
                    </div>
                    <div>
                        <h3><i class="fa-solid fa-location-dot"></i> Envío</h3>
                        <p><?= htmlspecialchars($pedido['direccion']) ?></p>
                        <p><?= htmlspecialchars($pedido['poblacion']) ?></p>
                    </div>
                    <div>
                        <h3><i class="fa-solid fa-calendar"></i> Fecha</h3>
                        <p><?= date("d/m/Y H:i", strtotime($pedido['fecha'])) ?></p>
                        <p>Estado: <strong><?= strtoupper($pedido['estado']) ?></strong></p>
                    </div>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>Producto</th>
                            <th>Talla</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $p): ?>
                        <tr>
                            <td><img src="../img/<?= htmlspecialchars($p['imagen']) ?>" class="img-mini"></td>
                            <td><?= htmlspecialchars($p['nombre']) ?> (ID: <?= $p['prod_id'] ?>)</td>
                            <td><?= htmlspecialchars($p['talla']) ?></td>
                            <td><?= number_format($p['precio_compra'], 2) ?> €</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="total-destacado">
                    <p>Total pagado: <strong><?= number_format($pedido['total'], 2) ?> €</strong></p>
                </div>
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
        <script src="../js/dropdown.js"></script>
    </footer>
</body>
</html>