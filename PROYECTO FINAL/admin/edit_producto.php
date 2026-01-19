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
        $marca = htmlspecialchars($_POST['marca']);
        $material = htmlspecialchars($_POST['material']);
        $talla = htmlspecialchars($_POST['talla']);
        $medidas = htmlspecialchars($_POST['medidas']);
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
            nombre='$nombre', precio=$precio, activo=$activo, marca='$marca', material='$material', 
            talla='$talla', medidas='$medidas', genero='$genero', tipo='$tipo', imagen='$ruta_destino'
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
                    <label for="activo">Activo</label>
                    <div class="check-background" id="check-background">
                        <input type="checkbox" name="activo" id="activo" class="check" <?= $producto['activo']?'checked':'' ?> >
                    </div>
                </div>

                <div class="casilla">
                    <label for="imagen">Imagen</label>
                    <input type="file" name="imagen" accept="image/*" class="imagen">
                    <input type="hidden" name="imagen_actual" value="<?= htmlspecialchars($producto['imagen']) ?>">
                </div>
            </div>
            <button type="submit" class="guardar">Actualizar producto</button>
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