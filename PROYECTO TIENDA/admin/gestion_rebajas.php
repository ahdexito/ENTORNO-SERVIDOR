<?php

session_start();

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
    <title>Gestión Rebajas</title>
    <link rel="stylesheet" href="../css/admin/panel_admin/panel_admin.css">
    <script src="https://kit.fontawesome.com/bc8e4b1cda.js" crossorigin="anonymous"></script>
    <style>
        article { display: flex; flex-direction: column; align-items: center; gap: 30px; }
        h3 { color: #fff; font-size: 3em; margin-top: 30px; text-align: center; }
    </style>
</head>
<body>
    <header>
        <a href="../index.php">
            <img src="../img/logo-horizontal.png" alt="logotipo" class="logo logo-large">
            <img src="../img/logo-horizontal-recortado.png" alt="logotipo" class="logo logo-small">
        </a>
        
        <div class="actions">
            <div class="atras">
                <a href="panel_admin.php"><i class="fa-regular fa-circle-left icono-accion"></i></a>
                <p>Atrás</p>
            </div>

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
                <i class="fa-solid fa-tags icono-header"></i>
                <h2>Gestión de rebajas</h2>
            </div>

            <hr>

            <article>
                <h3><i class="fa-solid fa-person-digging"></i>  Lo sentimos, esta función aún no está disponible...</h3>

                <a href="panel_admin.php" class="boton">
                    <i class="fa-regular fa-circle-left"></i>
                    <p>Volver</p>
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