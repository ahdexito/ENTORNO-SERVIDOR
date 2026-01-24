<?php
    session_start();
    if(!isset($_SESSION["rol"])) {
        header("location:../index.php");
        die();
    }

    include("../db/db.inc");

    // PAGINADOR
    $num_lineas = 10;
    $pagina = isset($_GET['pag']) ? max(1, intval($_GET['pag'])) : 1;
    $offset = ($pagina - 1) * $num_lineas;

    // TOTAL DE REGISTROS
    $total_resultado = $conn->query("SELECT COUNT(*) AS total FROM pedidos");
    $total_filas = $total_resultado->fetch_assoc()['total'];
    $total_paginas = ceil($total_filas / $num_lineas);

    // OBTENER PEDIDOS CON NOMBRE DE CLIENTE
    $sql = "SELECT p.*, c.nombre, c.apellidos 
            FROM pedidos p 
            JOIN clientes c ON p.cliente_id = c.id 
            ORDER BY p.fecha DESC 
            LIMIT $num_lineas OFFSET $offset";
    
    $resultado = $conn->query($sql);
    $pedidos = $resultado->fetch_all(MYSQLI_ASSOC);

    // LÓGICA DE RANGO PARA EL PAGINADOR
    $rango = 1; 
    $inicio = max(1, $pagina - $rango);
    $fin = min($total_paginas, $pagina + $rango);

    // CAMBIAR ESTADO DE PEDIDO
    if (isset($_GET["estado"]) && isset($_GET["id"])) {
        $id_pedido = intval($_GET["id"]);
        $nuevo_estado = $_GET["estado"];
        
        $stmt = $conn->prepare("UPDATE pedidos SET estado = ? WHERE id = ?");
        $stmt->bind_param("si", $nuevo_estado, $id_pedido);
        $stmt->execute();

        if ($nuevo_estado == 'enviado') {
            $sql_stock =
                "UPDATE productos SET activo = 0
                WHERE id IN (
                    SELECT producto_id
                    FROM linea_pedido
                    WHERE pedido_id = ?)";
            $stmt_stock = $conn->prepare($sql_stock);
            $stmt_stock->bind_param("i", $id_pedido);
            $stmt_stock->execute();
        }

        elseif ($nuevo_estado == 'cancelado') {
            $sql_stock = 
            "UPDATE productos SET activo = 1
            WHERE id IN(
                SELECT producto_id
                FROM linea_pedido
                WHERE pedido_id = ?)";
            $stmt_stock = $conn->prepare($sql_stock);
            $stmt_stock->bind_param("i", $id_pedido);
            $stmt_stock->execute();
        }

        elseif ($nuevo_estado == 'pendiente' || $nuevo_estado == 'pagado') {
            $sql_stock = 
            "UPDATE productos SET activo = 2
            WHERE id IN(
                SELECT producto_id
                FROM linea_pedido
                WHERE pedido_id = ?)";
            $stmt_stock = $conn->prepare($sql_stock);
            $stmt_stock->bind_param("i", $id_pedido);
            $stmt_stock->execute();
        }

        header("location:gestion_pedidos.php?pag=$pagina");
        exit();
    }

    // ELIMINAR PEDIDO Y DEVOLVER STOCK
if (isset($_GET["eliminar"])) {
    $id_pedido = intval($_GET["eliminar"]);

    // Devolver stock (activo = 1) a los productos de este pedido
    $sql_stock = 
        "UPDATE productos SET activo = 1 
        WHERE id IN (
            SELECT producto_id 
            FROM linea_pedido 
            WHERE pedido_id = ?)";
    $stmt_stock = $conn->prepare($sql_stock);
    $stmt_stock->bind_param("i", $id_pedido);
    $stmt_stock->execute();

    // Borrar las líneas del pedido
    $stmt_lineas = $conn->prepare(
        "DELETE FROM linea_pedido 
        WHERE pedido_id = ?");
    $stmt_lineas->bind_param("i", $id_pedido);
    $stmt_lineas->execute();

    // Borrar el pedido
    $stmt_pedido = $conn->prepare(
        "DELETE FROM pedidos 
        WHERE id = ?");
    $stmt_pedido->bind_param("i", $id_pedido);
    $stmt_pedido->execute();

    header("location:gestion_pedidos.php?pag=$pagina&msg=Pedido eliminado y stock restaurado");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Pedidos | Admin</title>
    <link rel="stylesheet" href="../css/admin/gestion_clientes/gestion_clientes.css">
    <script src="https://kit.fontawesome.com/bc8e4b1cda.js" crossorigin="anonymous"></script>
    <style>
        .estado { padding: 4px 8px; border-radius: 4px; font-size: 0.85em; font-weight: bold; }
        .pendiente { background: #ffeaa7; color: #d6a316; }
        .pagado { background: #55efc4; color: #00b894; }
        .cancelado { background: #ff7675; color: #d63031; }
        .acciones {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 25px;

            select {
                width: 150px;
                height: 30px;
                background-color: #222222;
                color: #fff;
                font-size: 1.1em;
                font-family: 'Inter';
            }
        }
    </style>
</head>
<body>
    <header>
        <a href="../index.php">
            <img src="../img/logo-horizontal.png" alt="logotipo" class="logo logo-large">
        </a>
        <div class="actions">
            <div class="atras">
                <a href="panel_admin.php"><i class="fa-regular fa-circle-left icono-accion"></i></a>
                <p>Atrás</p>
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
                <i class="fa-solid fa-truck-ramp-box icono-header"></i>
                <h2>Gestión de Pedidos</h2>
            </div>
            <hr>

            <div class="caja-overflow">
                <table>
                    <thead>
                        <tr>
                            <th>Acciones</th>
                            <th>ID Pedido</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Total</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pedidos as $p): ?>
                        <tr>
                            <td class="acciones">
                                <a href="detalle_pedido.php?id=<?= $p['id'] ?>" title="Ver productos">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <select onchange="location.href='?id=<?= $p['id'] ?>&pag=<?= $pagina ?>&estado=' + this.value">
                                    <option value="pendiente" <?= $p['estado']=='pendiente'?'selected':'' ?> >Pendiente</option>
                                    <option value="pagado" <?= $p['estado']=='pagado'?'selected':'' ?> >Pagado</option>
                                    <option value="enviado" <?= $p['estado']=='enviado'?'selected':'' ?> >Enviado</option>
                                    <option value="cancelado" <?= $p['estado']=='cancelado'?'selected':'' ?> >Cancelar</option>
                                </select>
                                <a href="?eliminar=<?= $p['id'] ?>&pag=<?= $pagina ?>" 
                                    title="Eliminar pedido" 
                                    onclick="return confirm('¿Estás seguro? Se borrará el pedido y los productos volverán a estar a la venta.')">
                                        <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </td>
                            <td>#<?= $p['id'] ?></td>
                            <td><?= date("d/m/Y H:i", strtotime($p['fecha'])) ?></td>
                            <td><?= htmlspecialchars($p['nombre'] . " " . $p['apellidos']) ?></td>
                            <td><?= number_format($p['total'], 2) ?> €</td>
                            <td>
                                <span class="estado <?= $p['estado'] ?>">
                                    <?= strtoupper($p['estado']) ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="paginador">
                <?php if ($pagina > 1): ?>
                    <a href="?pag=<?= $pagina - 1 ?>" class="icono-flecha"><i class="fa-solid fa-angle-left"></i></a>
                <?php endif; ?>

                <?php for ($i = $inicio; $i <= $fin; $i++): ?>
                    <a href="?pag=<?= $i ?>" class="<?= $i == $pagina ? 'activo' : '' ?>"><?= $i ?></a>
                <?php endfor; ?>

                <?php if ($pagina < $total_paginas): ?>
                    <a href="?pag=<?= $pagina + 1 ?>" class="icono-flecha"><i class="fa-solid fa-angle-right"></i></a>
                <?php endif; ?>
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