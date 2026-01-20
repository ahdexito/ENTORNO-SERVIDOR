<?php
    session_start();
    if(!isset($_SESSION["rol"])) {
        header("location:../index.php");
        die();
    }

    include("../db/db.inc");

    if (isset($_POST["nombre"]) && !empty($_POST["nombre"])) {
        $nombre = htmlspecialchars(($_POST["nombre"]));
        $apellidos = htmlspecialchars(($_POST["apellidos"]));
        $email = htmlspecialchars(($_POST["email"]));
        $password = htmlspecialchars((sha1($_POST["password"])));
        $direccion = htmlspecialchars(($_POST["direccion"]));
        $genero = htmlspecialchars(($_POST["genero"]));
        $codpostal = htmlspecialchars(($_POST["codpostal"]));
        $poblacion = htmlspecialchars(($_POST["poblacion"]));
        $provincia = htmlspecialchars(($_POST["provincia"]));

        $sql = "SELECT * FROM clientes WHERE email = '$email'";
        $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) > 0) {
            header("location:gestion_clientes.php?cli=1");
            die();
        }

        $sql = "INSERT INTO clientes(nombre, apellidos, genero, direccion, codpostal, poblacion, provincia, password, email)
            VALUES ('$nombre', '$apellidos', '$genero', '$direccion', '$codpostal', '$poblacion', '$provincia', '$password', '$email');";

        if (mysqli_query($conn, $sql)) {
            header("location:gestion_clientes.php?cli=0");
        }

        else {
            header("location:gestion_clientes.php?cli=2");
        }

        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/admin/ins_cliente/ins_cliente.css">
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
                <a href="gestion_clientes.php"><i class="fa-regular fa-circle-left icono-accion"></i></a>
                <p>Atrás</p>
            </div>
            <div class="panel">
                <a href="panel_admin.php"><i class="fa-solid fa-bars-progress icono-accion"></i></a>
                <p>Panel</p>
            </div>
            <div class="usuario dropdown">
                <i class="fa-solid fa-user icono-usuario dropdown-btn icono-accion" id="dropdown-btn"></i>
                <?php echo "<p>" . $_SESSION["nombre"] . "</p>"?>

                <div class="dropdown-content">
                    <a href="#"><i class="fa-solid fa-gear icono-dropdown"></i>Ajustes</a>
                    <hr>
                    <a href="desconectar_admin.php"><i class="fa-solid fa-arrow-right-from-bracket icono-dropdown"></i>Cerrar sesión</a>
                </div>
            </div>
        </div>
    </header>
    
    <main>
        <section class="panel-control">
            <div class="section-header">
                <i class="fa-regular fa-square-plus icono-header"></i>
                <h2>Insertar cliente</h2>
            </div>

            <hr>

            <form action="" method="POST">
                <div class="form">
                    <div class="casilla">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" placeholder="Texto">
                    </div>

                    <div class="casilla">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" name="apellidos" id="apellidos" placeholder="Texto">
                    </div>

                    <div class="casilla">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="Texto">
                    </div>

                    <div class="casilla">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" id="password" placeholder="Texto">
                    </div>

                    <div class="casilla">
                        <label for="direccion">Dirección</label>
                        <input type="text" name="direccion" id="direccion" placeholder="Texto">
                    </div>

                    <div class="casilla">
                        <label for="codpostal">Código Postal</label>
                        <input type="text" name="codpostal" id="codpostal" placeholder="Carácteres (máx. 5)">
                    </div>

                    <div class="casilla">
                        <label for="poblacion">Población</label>
                        <input type="text" name="poblacion" id="poblacion" placeholder="Texto">
                    </div>

                    <div class="casilla">
                        <label for="provincia">Provincia</label>
                        <input type="text" name="provincia" id="provincia" placeholder="Texto">
                    </div>

                    <div class="casilla">
                        <label for="genero">Género</label>
                        <select name="genero" id="genero" class="seleccion" required>
                            <option value="" selected disabled>Selecciona...</option>
                            <option value="H">Hombre</option>
                            <option value="M">Mujer</option>
                            <option value="O">Otro</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="guardar"><i class="fa-solid fa-floppy-disk"></i> Guardar cliente</button>
            </form>
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
    <script src="../js/dropdown.js"></script>
</body>
</html>