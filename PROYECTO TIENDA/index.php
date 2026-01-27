<?php

session_start();
include("db/db.inc");

// Procesamos las acciones antes de enviar cualquier HTML al navegador.
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_producto'])) {
    // Limpiamos el ID recibido
    $id = htmlspecialchars(trim($_POST['id_producto']));

    // Inicializamos el carrito si no existe para evitar errores de tipo
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Añadimos el producto si no estaba ya presente
    if (!isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id] = true;
    }

    header("Location:index.php");
    exit();
}

if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }
$total_carrito = count($_SESSION['carrito']);

/**
 * CONSULTAS DE BASE DE DATOS
 */
$productos = $conn->query(
    "SELECT * FROM productos 
    WHERE activo > 0
    ORDER BY id DESC 
    LIMIT 4"
);

/**
 * FUNCIÓN: getEstadoTexto
 * Mapea el ID del estado a un texto comprensible para el usuario.
 */
function getEstadoTexto($estado) {
    $estados = [
        1 => "A estrenar", 
        2 => "Como nuevo", 
        3 => "Buen estado", 
        4 => "Aceptable", 
        5 => "Bastante usado"
    ];
    return $estados[$estado] ?? "Desconocido";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="css/cliente/index/index.css">
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
            <div class="carrito">
                <?php if ($total_carrito > 0): ?>
                    <div class='num-articulos'><?= $total_carrito ?></div>
                <?php endif; ?>
                <a href="carrito.php"><i class="fa-solid fa-cart-shopping icono-accion"></i></a>
                <p>Carrito</p>
            </div>

            <div class="usuario dropdown">
                <?php if (isset($_SESSION["nombre"])): ?>
                    <i class="fa-solid fa-user icono-usuario dropdown-btn icono-accion"></i>
                    <div class="dropdown-content">
                        <?php if (isset($_SESSION["rol"])): ?>
                            <a href="admin/panel_admin.php"><i class="fa-solid fa-bars-progress icono-dropdown"></i>Panel de control</a>
                            <hr>
                        <?php endif; ?>
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
    
    <nav>
        <ul>
            <li><a href="productos_todos.php?f=chaqueta">Chaquetas</a></li>
            <li><a href="productos_todos.php?f=pantalon">Pantalones</a></li>
            <li><a href="productos_todos.php?f=botas">Botas</a></li>
            <li><a href="productos_todos.php?f=mono">Monos</a></li>
            <li><a href="productos_todos.php?f=mujer">Mujer</a></li>
            <li><a href="productos_todos.php">Ver todo</a></li>
        </ul>
    </nav>

    <main>
        <section class="novedades">
            <div class="section-header">
                <i class="fa-solid fa-fire icono-header"></i>
                <h2>Últimas novedades</h2>
            </div>
            <hr>

            <article>
                <?php foreach ($productos as $p): ?>
                    <div class="p-card">
                        <img src="img/<?= htmlspecialchars($p['imagen']) ?>" alt="<?= htmlspecialchars($p['nombre']) ?>" class="dropdown-btn">
                        
                        <div class="dropdown-content">
                            <img src="img/<?= htmlspecialchars($p['imagen']) ?>" alt="Detalle" class="imagen-dropdown">
                            <div class="dropdown-content-info">
                                <h1 class="prod-nombre"><?= htmlspecialchars($p['nombre']) ?></h1>
                                <ul>
                                    <li><p class="prod-talla">TALLA: <?= htmlspecialchars($p['talla']) ?></p></li>
                                    <li><p class="prod-genero">GÉNERO: <?= htmlspecialchars($p['genero']) ?></p></li>
                                    <li><p class="prod-material">MATERIAL: <?= htmlspecialchars($p['material']) ?></p></li>
                                    <li><p class="prod-precio">PRECIO: <?= htmlspecialchars($p['precio']) ?> €</p></li>
                                    <li><p class="prod-estado">ESTADO: <?= getEstadoTexto($p['estado']) ?></p></li>
                                    <?php if (!empty($p['medidas'])): ?>
                                        <li><p class='prod-medidas'>MEDIDAS: <?= htmlspecialchars($p['medidas']) ?></p></li>
                                    <?php endif; ?>
                                    <?php if (!empty($p['detalles'])): ?>
                                        <li><p class='prod-detalles'>DETALLES: <?= htmlspecialchars($p['detalles']) ?></p></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>

                        <p class="prod-nombre"><u><?= htmlspecialchars($p['nombre']) ?></u></p>
                        <p class="prod-talla">Talla <?= htmlspecialchars($p['talla']) ?></p>
                        <p class="prod-precio"><?= htmlspecialchars($p['precio']) ?> €</p>
                        
                        <form method="POST">
                            <input type="hidden" name="id_producto" value="<?= $p['id'] ?>">
                            <?php if ($p['activo'] == 2): ?>
                                <button type="button" class="btn-1 disabled"><i class="fa-solid fa-lock"></i> RESERVADO</button>
                            <?php elseif (isset($_SESSION['carrito'][$p['id']])): ?>
                                <button type="button" class="btn-1 disabled" disabled><i class="fa-solid fa-cart-arrow-down"></i>Ya en el carrito</button>
                            <?php else: ?>
                                <button type="submit" class="btn-1"><i class="fa-solid fa-cart-plus"></i>Añadir</button>
                            <?php endif; ?>
                        </form>
                    </div>
                <?php endforeach; ?>
            </article>

            <hr>
            <p class="boton-todo">
                <i class="fa-solid fa-ellipsis"></i>
                <a href="productos_todos.php">Ver todo</a>
                <i class="fa-solid fa-ellipsis"></i>
            </p>
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