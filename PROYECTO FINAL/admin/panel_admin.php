<?php
    session_start();
    if(!isset($_SESSION["rol"])) {
        header("location:../index.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/admin/panel_admin/panel_admin.css">
    <script src="https://kit.fontawesome.com/bc8e4b1cda.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <img src="../img/logo-horizontal.png" alt="logotipo" class="logo">

        <div class="actions">
            <div class="inicio">
                <a href="../index.php"><i class="fa-regular fa-house"></i></a>
                <p>Inicio</p>
            </div>
            <div class="desconectar">
                <a href="desconectar_admin.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                <p>Logout</p>
            </div>
        </div>
    </header>
    
    <main>
        <section class="panel-control">
            <div class="section-header">
                <i class="fa-solid fa-gear engranaje"></i>
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
                <a href="#" class="boton">
                    <i class="fa-solid fa-tags"></i>
                    <p>Rebajas</p>
                </a>
                <a href="#" class="boton">
                    <i class="fa-solid fa-bars-progress"></i>
                    <p>Ajustes</p>
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
    </footer>
</body>
</html>