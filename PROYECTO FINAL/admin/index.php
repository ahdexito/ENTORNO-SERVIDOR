<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="css/index/index.css">
</head>
<body>
    <header>
        <img src="img/logotipo.png" alt="logotipo" class="logo">

        <input type="search" placeholder="Buscar aquí..." class="searchbar">

        <div class="actions">
            <div class="favoritos">
                <a href="#"><img src="icon/corazon.png" alt="icono corazón"></a>
                <p>Favoritos</p>
            </div>

            <div class="carrito">
                <a href="#"><img src="icon/carrito.png" alt="icono carrito"></a>
                <p>Carrito</p>
            </div>

            <div class="Perfil">
                <?php
                    if (isset($_SESSION["nombre"])) {
                        echo '<a><img src="icon/usuario.png" alt="icono usuario"></a>';
                        echo "<p>" . $_SESSION["nombre"] . "</p>";
                    }
                    else {
                        echo '<a href="login.php"><img src="icon/usuario.png" alt="icono usuario"></a>';
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
            <div class="section-title">
                <img src="icon/fuego.png" alt="icono fuego">
                <h2>Últimas novedades</h2>
            </div>

            <hr>

            <article>
                <a href="#"><img src="img/chaqueta.png" alt=""></a>
                <a href="#"><img src="img/pantalon.png" alt=""></a>
                <a href="#"><img src="img/botas.png" alt=""></a>
                <a href="#"><img src="img/pantalon.png" alt=""></a>
                <a href="#"><img src="img/chaqueta.png" alt=""></a>
            </article>

            <hr>

            <p>- - - <a href="nuevos.php">Ver todo</a> - - -</p>
        </section>
    </main>

    <footer>

    </footer>
</body>
</html>