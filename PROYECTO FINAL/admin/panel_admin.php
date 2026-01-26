<?php
/**
 * ARCHIVO: admin/panel_admin.php
 * DESCRIPCIÓN: Menú principal de administración. 
 * Solo accesible para usuarios con el rol adecuado.
 */

session_start();

/**
 * CONTROL DE ACCESO
 * Si no existe la variable de sesión 'rol', expulsamos al usuario.
 */
if (!isset($_SESSION["rol"])) {
    header("location:../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control Admin</title>
    <link rel="stylesheet" href="../css/admin/panel_admin/panel_admin.css">
    <script src="https://kit.fontawesome.com/bc8e4b1cda.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <a href="../index.php">
            <img src="../img/logo-horizontal.png" alt="logotipo" class="logo logo-large">
            <img src="../img/logo-horizontal-recortado.png" alt="logotipo" class="logo logo-small">
        </a>
        
        <div class="actions">
            <div class="usuario dropdown">
                <i class="fa-solid fa-user icono-usuario dropdown-btn icono-accion"></i>

                <div class="dropdown-content">
                    <a href="#"><i class="fa-solid fa-gear icono-dropdown"></i>Ajustes</a>
                    <hr>
                    <a href="desconectar_admin.php"><i class="fa-solid fa-arrow-right-from-bracket icono-dropdown"></i>Cerrar sesión</a>
                </div>

                <p><?= htmlspecialchars($_SESSION["nombre"]) ?></p>
            </div>
        </div>
    </header>
    
    <main>
        <section class="panel-control">
            <div class="section-header">
                <i class="fa-solid fa-bars-progress icono-header"></i>
                <h2>Panel de control</h2>
            </div>

            <hr>

            <article>
                <a href="gestion_clientes.php" class="boton">
                    <i class="fa-solid fa-users"></i>
                    <p>Clientes</p>
                </a>
                <a href="gestion_productos.php" class="boton">
                    <i class="fa-solid fa-shop"></i>
                    <p>Productos</p>
                </a>
                <a href="gestion_pedidos.php" class="boton">
                    <i class="fa-solid fa-truck-ramp-box"></i>
                    <p>Pedidos</p>
                </a>
                <a href="#" class="boton">
                    <i class="fa-solid fa-tags"></i>
                    <p>Rebajas</p>
                </a>
            </article>
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