<?php
    session_start();
    if(!isset($_SESSION["rol"])) {
        header("location:../index.php");
        die();
    }

    include("../db/db.inc");

    if (
        isset($_POST["nombre"], $_POST["precio"], $_POST["tipo"], $_POST["genero"]) &&
        $_POST["tipo"] !== "default" &&
        $_POST["genero"] !== "default"
    ) {
        $nombre = htmlspecialchars($_POST["nombre"]);
        $precio = floatval($_POST["precio"]);
        $activo = isset($_POST["activo"]) ? 1 : 0;
        $marca = htmlspecialchars($_POST["marca"]);
        $material = htmlspecialchars($_POST["material"]);
        $talla = htmlspecialchars($_POST["talla"]);
        $medidas = htmlspecialchars($_POST["medidas"]);
        $genero = $_POST["genero"];
        $tipo = $_POST["tipo"];

        $imagen_nombre = $_FILES["imagen"]["name"];
        $imagen_tmp = $_FILES["imagen"]["tmp_name"];

        $extension = pathinfo($imagen_nombre, PATHINFO_EXTENSION);

        $nombre_imagen = $tipo . "_" . $marca . "_" . time() . "." . $extension;

        $ruta_destino = "../imagenes_productos/" . $nombre_imagen;

        if (move_uploaded_file($imagen_tmp, $ruta_destino)) {
            $sql = "INSERT INTO productos (nombre, precio, activo, marca, material, talla, medidas, genero, tipo, imagen)
                VALUES ('$nombre', $precio, $activo, '$marca', '$material', '$talla', '$medidas', '$genero', '$tipo', '$ruta_destino')";

            if (mysqli_query($conn, $sql)) {
                header("location:gestion_productos.php?prod=0");// producto insertado correctamente
            } 
            else {
                header("location:gestion_productos.php?prod=1");// error al insertar producto
            }
        }
        else {
            header("location:gestion_productos.php?prod=2");// error al subir la imagen
        }
        die();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/admin/ins_producto/ins_producto.css">
    <script src="https://kit.fontawesome.com/bc8e4b1cda.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <img src="../img/logo-horizontal.png" alt="logotipo" class="logo">

        <div class="actions">
            <div class="atras">
                <a href="gestion_productos.php"><i class="fa-regular fa-circle-left"></i></a>
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
    
    <main>
        <section class="panel-control">
            <div class="section-header">
                <i class="fa-regular fa-square-plus icono-header"></i>
                <h2>Insertar producto</h2>
            </div>

            <hr>

            <form method="POST" enctype="multipart/form-data">
                <div class="form">
                    <div class="casilla">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" placeholder="Nombre del producto" required>
                    </div>
                    
                    <div class="casilla">
                        <label for="precio">Precio</label>
                        <input type="number" step="0.01" name="precio" placeholder="Precio (€)" required>
                    </div>
                    
                    <div class="casilla">
                        <label for="marca">Marca</label>
                        <input type="text" name="marca" placeholder="Marca">
                    </div>

                    <div class="casilla">
                        <label for="material">Material</label>
                        <input type="text" name="material" placeholder="Material">
                    </div>
                    
                    <div class="casilla">
                        <label for="talla">Talla</label>
                        <input type="text" name="talla" placeholder="Talla">
                    </div>
                    
                    <div class="casilla">
                        <label for="medidas">Medidas</label>
                        <textarea name="medidas" class="area-texto" placeholder="Medidas"></textarea>
                    </div>

                    <div class="casilla">
                        <label for="genero">Género</label>
                        <select name="genero" id="genero" class="seleccion" required>
                            <option value="default" selected disabled>Género</option>
                            <option value="hombre">Hombre</option>
                            <option value="mujer">Mujer</option>
                            <option value="unisex">Unisex</option>
                        </select>
                    </div>

                    <div class="casilla">
                        <label for="tipo">Tipo</label>
                        <select name="tipo" id="tipo" class="seleccion" required>
                            <option value="default" selected disabled>Tipo de prenda</option>
                            <option value="chaqueta">Chaqueta</option>
                            <option value="pantalon">Pantalón</option>
                            <option value="mono">Mono</option>
                            <option value="guantes">Guantes</option>
                            <option value="botas">Botas</option>
                        </select>
                    </div>

                    <div class="casilla">
                        <label for="activo">Activo</label>
                        <div class="check-background" id="check-background">
                            <input type="checkbox" name="activo" id="activo" class="check" checked>
                        </div>
                    </div>

                    <div class="casilla">
                        <label for="imagen">Imagen</label>
                        <input type="file" name="imagen" id="imagen" accept="image/*" class="imagen" required>
                    </div>
                </div>

                <button type="submit" class="guardar">Guardar producto</button>
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
        <script>
            const check = document.getElementById("activo");
            const caja = document.getElementById("check-background");

            check.addEventListener("change", () => {
                if (check.checked) {
                    caja.style.backgroundColor = "#56ee50";
                }
                else {
                    caja.style.backgroundColor = "#c42f2f";
                }
            });
        </script>
    </footer>
</body>
</html>