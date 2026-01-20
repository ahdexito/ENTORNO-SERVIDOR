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
        <a href="../index.php">
            <img src="../img/logo-horizontal.png" alt="logotipo" class="logo logo-large">
            <img src="../img/logo-horizontal-recortado.png" alt="logotipo" class="logo logo-small">
        </a>
        
        <div class="actions">
            <div class="atras">
                <a href="gestion_productos.php"><i class="fa-regular fa-circle-left icono-accion"></i></a>
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
                <h2>Insertar producto</h2>
            </div>

            <hr>

            <form method="POST" enctype="multipart/form-data">
                <div class="form">
                    <div class="casilla">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" placeholder="Texto" required>
                    </div>
                    
                    <div class="casilla">
                        <label for="precio">Precio</label>
                        <input type="number" step="0.01" name="precio" placeholder="Número decimal" required>
                    </div>
                    
                    <div class="casilla">
                        <label for="marca">Marca</label>
                        <input type="text" name="marca" placeholder="Texto">
                    </div>

                    <div class="casilla">
                        <label for="material">Material</label>
                        <input type="text" name="material" placeholder="Texto">
                    </div>
                    
                    <div class="casilla">
                        <label for="talla">Talla</label>
                        <input type="text" name="talla" placeholder="Texto">
                    </div>
                    
                    <div class="casilla">
                        <label for="medidas">Medidas</label>
                        <textarea name="medidas" class="area-texto" placeholder="Área de texto"></textarea>
                    </div>

                    <div class="casilla">
                        <label for="genero">Género</label>
                        <select name="genero" id="genero" class="seleccion" required>
                            <option value="default" selected disabled>Selecciona...</option>
                            <option value="hombre">Hombre</option>
                            <option value="mujer">Mujer</option>
                            <option value="unisex">Unisex</option>
                        </select>
                    </div>

                    <div class="casilla">
                        <label for="tipo">Tipo</label>
                        <select name="tipo" id="tipo" class="seleccion" required>
                            <option value="default" selected disabled>Selecciona...</option>
                            <option value="chaqueta">Chaqueta</option>
                            <option value="pantalon">Pantalón</option>
                            <option value="mono">Mono</option>
                            <option value="guantes">Guantes</option>
                            <option value="botas">Botas</option>
                        </select>
                    </div>

                    <div class="casilla">
                        <p>Activo</p>
                        <div class="checkbox-background" id="checkbox-background">
                            <span class="checkbox-info" id="checkbox-info">Activado</span>
                            <input type="checkbox" name="activo" id="checkbox" class="checkbox" checked>
                        </div>
                    </div>

                    <div class="casilla">
                        <label for="imagen">Imagen</label>
                        <input type="file" name="imagen" id="imagen" accept="image/*" class="imagen" required>
                    </div>
                </div>

                <button type="submit" class="guardar"><i class="fa-solid fa-floppy-disk"></i> Guardar producto</button>
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
        <script src="../js/check-activo.js"></script>
    </footer>
    <script src="../js/dropdown.js"></script>
</body>
</html>