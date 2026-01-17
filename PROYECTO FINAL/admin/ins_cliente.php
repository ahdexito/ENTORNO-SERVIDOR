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
        <img src="../img/logo-horizontal.png" alt="logotipo" class="logo">

        <div class="actions">
            <div class="atras">
                <a href="gestion_clientes.php"><i class="fa-regular fa-circle-left"></i></a>
                <p>Atrás</p>
            </div>
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
    
    <hr>

    <main>
        <section class="panel-control">
            <div class="section-header">
                <i class="fa-regular fa-square-plus suma"></i>
                <h2>Añadir cliente</h2>
            </div>

            <hr>

            <form action="" method="POST">
                <div class="form">
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre">
                    <input type="text" name="apellidos" id="apellidos" placeholder="Apellidos">
                    <input type="email" name="email" id="email" placeholder="Email">
                    <input type="password" name="password" id="password" placeholder="Contraseña">
                    <input type="text" name="direccion" id="direccion" placeholder="Dirección">
                    <input type="text" name="codpostal" id="codpostal" placeholder="Código Postal">
                    <input type="text" name="poblacion" id="poblacion" placeholder="Población">
                    <input type="text" name="provincia" id="provincia" placeholder="Provincia">
                    <div class="genero">
                        <label>Género</label>
                        <select name="genero" id="genero">
                            <option value="default" selected disabled>Selecciona una opción</option>
                            <option value="M">Hombre</option>
                            <option value="F">Mujer</option>
                            <option value="O">Otro</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="guardar">Guardar cliente</button>
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
</body>
</html>