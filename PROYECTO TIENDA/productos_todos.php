<?php

session_start();
include("db/db.inc");

/**
 * GESTIÓN DEL CARRITO
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_producto'])) {
    $id = htmlspecialchars(trim($_POST['id_producto']));

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    if (!isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id] = true;
    }

    // Redirección para evitar reenvío de formulario al refrescar (F5)
    // Mantenemos los parámetros GET (filtros y página) en la redirección
    $queryString = !empty($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '';
    header("Location: " . $_SERVER['PHP_SELF'] . $queryString);
    exit();
}

// Inicialización de contador de carrito
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}
$total_carrito = count($_SESSION['carrito']);

/**
 * LÓGICA DE FILTRADO Y CONSULTA
 */
$filtro = $_GET['f'] ?? null;
$where = "WHERE activo > 0";

if ($filtro) {
    // Escapado para evitar inyecciones en la cláusula WHERE
    $f = $conn->real_escape_string($filtro);

    if ($f == 'mujer') $where .= " AND genero != 'hombre'";
    else $where .= " AND tipo = '$f'";
}

/**
 * SISTEMA DE PAGINACIÓN
 * Calcula el total de registros para determinar el número de páginas.
 */
$total_res = $conn->query("SELECT COUNT(*) as t FROM productos $where");
$total_filas = $total_res->fetch_assoc()['t'];
$articulos_por_pagina = 14;
$total_paginas = ceil($total_filas / $articulos_por_pagina);

// Página actual y cálculo de desplazamiento (OFFSET)
$pagina = isset($_GET['pag']) ? (int)$_GET['pag'] : 1;
if ($pagina < 1) $pagina = 1;
$offset = ($pagina - 1) * $articulos_por_pagina;

// Obtención de productos limitados por la página actual
$productos = $conn->query(
    "SELECT * FROM productos 
    $where ORDER BY id DESC 
    LIMIT $articulos_por_pagina OFFSET $offset"
);

/**
 * FUNCIÓN: getEstadoTexto
 * Traduce el valor numérico de la DB a una etiqueta legible.
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="css/cliente/index/index.css">
    <script src="https://kit.fontawesome.com/bc8e4b1cda.js" crossorigin="anonymous"></script>
    <style>
        article { display: flex; justify-content: flex-start; flex-wrap: wrap; }
        article .p-card { max-width: 15vw; min-width: 180px; }
        article .p-card .dropdown-btn { width: 10vw !important; min-width: 150px; } 
        article .p-card p { font-size: 1em; }
        article .p-card .btn-1 { font-size: 1em; }
        a.activo { color: #fff; background-color: #1d1d1d; }
        article h3 { color: #fff; font-size: 3em; padding: 50px; text-align: center;}
    </style>
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
        <?php
        // Función para verificar si el filtro coincide
        function is_active($current_filter, $f_url) {
            return ($current_filter === $f_url) ? 'class="activo"' : '';
        }
        ?>
        <li><a href="productos_todos.php?f=chaqueta" <?= is_active($filtro, 'chaqueta') ?> >Chaquetas</a></li>
        <li><a href="productos_todos.php?f=pantalon" <?= is_active($filtro, 'pantalon') ?> >Pantalones</a></li>
        <li><a href="productos_todos.php?f=botas" <?= is_active($filtro, 'botas') ?> >Botas</a></li>
        <li><a href="productos_todos.php?f=mono" <?= is_active($filtro, 'mono') ?> >Monos</a></li>
        <li><a href="productos_todos.php?f=mujer" <?= is_active($filtro, 'mujer') ?> >Mujer</a></li>
        <li><a href="productos_todos.php" <?= is_active($filtro, null) ?> >Ver todo</a></li>
    </ul>
</nav>

    <main>
        <section class="articulos">
            <article>
                <?php if ($productos->num_rows > 0): ?>
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
                <?php else: ?>
                    <h3>No hay artículos disponibles en esta categoría...</h3>
                <?php endif; ?>
            </article>

            <?php
                /**
                 * RENDERIZADO DEL PAGINADOR
                 * Genera los enlaces de navegación entre páginas manteniendo el filtro actual.
                 */
                $url_f = $filtro ? "&f=" . urlencode($filtro) : "";
                $rango = 1; 
                $inicio = max(1, $pagina - $rango);
                $fin = min($total_paginas, $pagina + $rango);
            ?>

            <div class="paginador">
                <?php if ($pagina > 1): ?>
                    <a href="?pag=<?= $pagina - 1 ?><?= $url_f ?>" class="icono-flecha">
                        <i class="fa-solid fa-angle-left"></i>
                    </a>
                <?php endif; ?>

                <?php if ($inicio > 1): ?>
                    <a href="?pag=1<?= $url_f ?>" class="pagina-limite">1</a>
                    <?php if ($inicio > 2): ?><span>...</span><?php endif; ?>
                <?php endif; ?>

                <?php for ($i = $inicio; $i <= $fin; $i++): ?>
                    <a href="?pag=<?= $i ?><?= $url_f ?>" class="<?= $i == $pagina ? 'activo' : '' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>

                <?php if ($fin < $total_paginas): ?>
                    <?php if ($fin < $total_paginas - 1): ?><span>...</span><?php endif; ?>
                    <a href="?pag=<?= $total_paginas ?><?= $url_f ?>" class="pagina-limite"><?= $total_paginas ?></a>
                <?php endif; ?>

                <?php if ($pagina < $total_paginas): ?>
                    <a href="?pag=<?= $pagina + 1 ?><?= $url_f ?>" class="icono-flecha">
                        <i class="fa-solid fa-angle-right"></i>
                    </a>
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
        <script src="js/dropdown.js"></script>
    </footer>
</body>
</html>