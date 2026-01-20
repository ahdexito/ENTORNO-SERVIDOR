<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
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
            <div class="favoritos">
                <a href="#"><i class="fa-solid fa-heart icono-accion"></i></a>
                <p>Favoritos</p>
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
    
    <nav>
        <ul>
            <li><a href="#">Monos</a></li>
            <li><a href="#">Chaquetas</a></li>
            <li><a href="#">Pantalones</a></li>
            <li><a href="#">Botas</a></li>
            <li><a href="#">Guantes</a></li>
            <li><a href="#">Marcas</a></li>
            <li><a href="#">Liquidación</a></li>
            <li><a href="#">Mujer</a></li>
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
                <a href="#"><img src="img/chaqueta.png" alt=""></a>
                <a href="#"><img src="img/pantalon.png" alt=""></a>
                <a href="#"><img src="img/botas.png" alt=""></a>
                <a href="#"><img src="img/pantalon.png" alt=""></a>
                <a href="#"><img src="img/chaqueta.png" alt=""></a>
                <a href="#"><img src="img/chaqueta.png" alt=""></a>
                <a href="#"><img src="img/botas.png" alt=""></a>
                <a href="#"><img src="img/pantalon.png" alt=""></a>
            </article>

            <hr>

            <p>- - - <a href="nuevos.php">Ver todo</a> - - -</p>
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