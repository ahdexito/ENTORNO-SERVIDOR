<?php
session_start();
include("db/db.inc");

/**
 * Función auxiliar para obtener el texto del estado del producto
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

// OBTENER PRODUCTOS (Limitado a 8 para novedades)
$resultado = $conn->query("SELECT * FROM productos ORDER BY id DESC LIMIT 8");
$productos = $resultado->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio | Tienda</title>
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
            <div class="favoritos">
                <a href="#"><i class="fa-solid fa-heart icono-accion"></i></a>
                <p>Favoritos</p>
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
            $categorias = ["Monos", "Chaquetas", "Pantalones", "Botas", "Liquidación", "Mujer"];
            foreach ($categorias as $cat): ?>
                <li><a href="#"><?= $cat ?></a></li>
            <?php endforeach; ?>
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
                                <p class="prod-nombre"><?= htmlspecialchars($p['nombre']) ?></p>
                                <ul>
                                    <li><p>Talla: <?= htmlspecialchars($p['talla']) ?></p></li>
                                    <li><p style="text-transform: capitalize;">Género: <?= htmlspecialchars($p['genero']) ?></p></li>
                                    <li><p style="text-transform: capitalize;">Material: <?= htmlspecialchars($p['material']) ?></p></li>
                                    <li><p class="prod-precio"><?= htmlspecialchars($p['precio']) ?> €</p></li>
                                    <li><p>Estado: <?= getEstadoTexto($p['estado']) ?></p></li>
                                    
                                    <?php if (!empty($p['detalles'])): ?>
                                        <li><p class='prod-detalles'>Detalles: <?= htmlspecialchars($p['detalles']) ?></p></li>
                                    <?php endif; ?>
                                    
                                    <?php if (!empty($p['medidas'])): ?>
                                        <li><p class='prod-medidas'>Medidas: <?= htmlspecialchars($p['medidas']) ?></p></li>
                                    <?php endif; ?>
                                </ul>
                                
                                <a href="#" class="btn-agregar-carrito">
                                    <i class="fa-solid fa-cart-arrow-down"></i> Añadir
                                </a>
                            </div>
                        </div>

                        <p class="prod-nombre"><?= htmlspecialchars($p['nombre']) ?></p>
                        <p class="prod-talla">Talla <?= htmlspecialchars($p['talla']) ?></p>
                        <p class="prod-precio"><?= htmlspecialchars($p['precio']) ?> €</p>
                        <a href="#" class="btn-agregar-carrito">
                            <i class="fa-solid fa-cart-arrow-down"></i> Añadir
                        </a>
                    </div>
                <?php endforeach; ?>
            </article>

            <hr>
            <p class="boton-todo">
                <i class="fa-solid fa-ellipsis"></i>
                <a href="nuevos.php">Ver todo</a>
                <i class="fa-solid fa-ellipsis"></i>
            </p>
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