<?php
    session_start();
    if(!isset($_SESSION["rol"])) {
        header("location:../index.php");
        die();
    }

    include("../db/db.inc");

    if(!isset($_GET['edit'])) {
        header("location:gestion_productos.php");
        die();
    }

    $id = intval($_GET['edit']);

    $sql = "SELECT * FROM productos WHERE id = $id";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) === 0) {
        header("location:gestion_productos.php");
        die();
    }
    $producto = mysqli_fetch_assoc($res);

    if(isset($_POST['nombre'], $_POST['precio'], $_POST['tipo'], $_POST['genero'])) {
        $nombre = htmlspecialchars($_POST['nombre']);
        $precio = floatval($_POST['precio']);
        $activo = isset($_POST['activo']) ? 1 : 0;
        $estado = intval($_POST['estado']);
        $marca = htmlspecialchars($_POST['marca']);
        $material = htmlspecialchars($_POST['material']);
        $talla = htmlspecialchars($_POST['talla']);
        $medidas = htmlspecialchars($_POST['medidas']);
        $detalles = htmlspecialchars($_POST['detalles']);
        $genero = $_POST['genero'];
        $tipo = $_POST['tipo'];

        if (!empty($_FILES['imagen']['name'])) {
            $imagen_nombre = $_FILES['imagen']['name'];
            $imagen_tmp = $_FILES['imagen']['tmp_name'];

            $fecha = date("YmdHis");
            $extension = pathinfo($imagen_nombre, PATHINFO_EXTENSION);
            $imagen_nombre_nuevo = $tipo . "_" . $marca . "_" . $id . "_" . $fecha . "." . $extension;
            $ruta_destino = "../imagenes_productos/" . $imagen_nombre_nuevo;

            if (!move_uploaded_file($imagen_tmp, $ruta_destino)) {
                header("location:gestion_productos.php?prod=2");// error al actualizar la imagen
            }
        } 
        else {
            $ruta_destino = $_POST['imagen_actual'];
        }

        $sql_update = "UPDATE productos SET 
            nombre='$nombre', precio=$precio, activo=$activo, estado=$estado, marca='$marca', material='$material', 
            talla='$talla', medidas='$medidas', detalles='$detalles', genero='$genero', tipo='$tipo', imagen='$ruta_destino'
            WHERE id=$id";

        if(mysqli_query($conn, $sql_update)) {
            header("location:gestion_productos.php?upt=0"); // actualizado correctamente
        } 
        else {
            header("location:gestion_productos.php?upt=1"); // error al actualizar
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
                <a href=".panel_admin.php"><i class="fa-solid fa-bars-progress icono-accion"></i></a>
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
            <i class="fa-regular fa-pen-to-square icono-header"></i>
            <h2>Actualizar producto</h2>
        </div>
        <hr>
        <form method="POST" enctype="multipart/form-data">
            <div class="form">
                <div class="casilla">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required>
                </div>

                <div class="casilla">
                    <label for="precio">Precio</label>
                    <input type="number" step="0.01" name="precio" value="<?= $producto['precio'] ?>" required>
                </div>

                <div class="casilla">
                    <label for="marca">Marca</label>
                    <input type="text" name="marca" value="<?= htmlspecialchars($producto['marca']) ?>">
                </div>

                <div class="casilla">
                    <label for="material">Material</label>
                    <input type="text" name="material" value="<?= htmlspecialchars($producto['material']) ?>">
                </div>

                <div class="casilla">
                    <label for="talla">Talla</label>
                    <input type="text" name="talla" value="<?= htmlspecialchars($producto['talla']) ?>">
                </div>

                <div class="casilla">
                    <label for="medidas">Medidas</label>
                    <textarea name="medidas" class="area-texto"><?= htmlspecialchars($producto['medidas']) ?></textarea>
                </div>

                <div class="casilla">
                    <label for="detalles">Detalles</label>
                    <textarea name="detalles" class="area-texto"><?= htmlspecialchars($producto['detalles']) ?></textarea>
                </div>

                <div class="casilla">
                    <label for="genero">Género</label>
                    <select name="genero" class="seleccion" required>
                        <option value="default" disabled>Género</option>
                        <option value="hombre" <?= $producto['genero']=='hombre'?'selected':'' ?>>Hombre</option>
                        <option value="mujer" <?= $producto['genero']=='mujer'?'selected':'' ?>>Mujer</option>
                        <option value="unisex" <?= $producto['genero']=='unisex'?'selected':'' ?>>Unisex</option>
                    </select>
                </div>

                <div class="casilla">
                    <label for="tipo">Tipo</label>
                    <select name="tipo" class="seleccion" required>
                        <option value="default" disabled>Tipo de prenda</option>
                        <option value="chaqueta" <?= $producto['tipo']=='chaqueta'?'selected':'' ?>>Chaqueta</option>
                        <option value="pantalon" <?= $producto['tipo']=='pantalon'?'selected':'' ?>>Pantalón</option>
                        <option value="mono" <?= $producto['tipo']=='mono'?'selected':'' ?>>Mono</option>
                        <option value="guantes" <?= $producto['tipo']=='guantes'?'selected':'' ?>>Guantes</option>
                        <option value="botas" <?= $producto['tipo']=='botas'?'selected':'' ?>>Botas</option>
                    </select>
                </div>

                <div class="casilla">
                    <p>Activo</p>
                    <div class="checkbox-background" id="checkbox-background">
                        <span for="checkbox" class="checkbox-info" id="checkbox-info">Activado</span>
                        <input type="checkbox" name="activo" id="checkbox" class="checkbox" <?= $producto['activo']?'checked':'' ?> >
                    </div>
                </div>

                <?php
                    $estados = [
                        1 => "A estrenar",
                        2 => "Como nuevo",
                        3 => "Buen estado",
                        4 => "Aceptable",
                        5 => "Bastante usuado"
                    ];
                ?>

                <div class="casilla">
                    <label for="estado">Estado</label>
                    <select name="estado" class="seleccion" required>
                        <option value="default" disabled>Estado del producto</option>
                        
                        <?php foreach ($estados as $valor => $texto): ?>
                            <option value="<?= $valor ?>" <?= $producto['estado'] == $valor ? 'selected' : '' ?>>
                                <?= $texto ?>
                            </option>
                        <?php endforeach; ?>
                        
                    </select>
                </div>

                <div class="casilla">
                    <label for="imagen">Imagen</label>
                    <input type="file" name="imagen" accept="image/*" class="imagen">
                    <input type="hidden" name="imagen_actual" value="<?= htmlspecialchars($producto['imagen']) ?>">
                </div>
            </div>
            <button type="submit" class="guardar"><i class="fa-solid fa-floppy-disk"></i> Actualizar producto</button>
        </form>
    </section>
    </main>

    <footer>
        <div class="copy">
            <i class="fa-regular fa-copyright" style="color: #63E6BE;"></i>
            <div>
                <p>Todos los derechos reservados.</p>
                <p>Ángel García, 2026.</p>
            </div>
        </div>
        <script src="../js/check-activo.js"></script>
        <script src="../js/dropdown.js"></script>
    </footer>
</body>
</html>