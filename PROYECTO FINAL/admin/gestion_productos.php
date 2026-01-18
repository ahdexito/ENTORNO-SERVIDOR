<?php
    session_start();
    if(!isset($_SESSION["rol"])) {
        header("location:../index.php");
        die();
    }

    include("../db/db.inc");

    // OBTENER CLIENTES
    $resultado = $conn -> query("SELECT * FROM productos ORDER BY id DESC");
    $productos = $resultado -> fetch_all(MYSQLI_ASSOC);

    // ELIMINAR CLIENTE
    if (isset($_GET["eliminar"])) {
        $id_producto = intval($_GET["eliminar"]);

        $stmt = $conn -> prepare("DELETE FROM productos WHERE id = ?");
        $stmt -> bind_param("i", $id_producto);
        $stmt -> execute();
        $stmt -> close();

        header("location:gestion_productos.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/admin/gestion_productos/gestion_productos.css">
    <script src="https://kit.fontawesome.com/bc8e4b1cda.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <img src="../img/logo-horizontal.png" alt="logotipo" class="logo">

        <div class="actions">
            <div class="atras">
                <a href="panel_admin.php"><i class="fa-regular fa-circle-left"></i></a>
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
    
    <?php
        // ALERTAS DE CREACIÓN DE PRODUCTO
        if (isset($_GET["prod"])) {
            if ($_GET["prod"] == 0) { // inserción correcta
                echo '<div class="alerta"><i class="fa-solid fa-circle-check check"></i>
                Producto insertado correctamente.</div>';
            }
            if ($_GET["prod"] == 1) { // problema al insertar producto
                echo '<div class="alerta"><i class="fa-solid fa-circle-xmark xmark"></i>
                Ha ocurrido un error al intentar insertar el producto.</div>';
            }
            if ($_GET["prod"] == 2) { // problema al insertar imagen
                echo '<div class="alerta"><i class="fa-solid fa-circle-xmark xmark"></i>
                Ha ocurrido un error al intentar insertar la imagen.</div>';
            }
        }

        // ALERTAS DE MODIFICACIÓN DE PRODUCTO
        if (isset($_GET["upt"])) {
            if ($_GET["upt"] == 0) { // actualización correcta
                echo '<div class="alerta"><i class="fa-solid fa-circle-check check"></i>
                Producto actualizado correctamente.</div>';
            }
            if ($_GET["upt"] == 1) { // problema al actualizar
                echo '<div class="alerta"><i class="fa-solid fa-circle-xmark xmark"></i>
                Ha ocurrido un error al intentar actualizar el producto.</div>';
            }
        }
    ?>

    <main>
        <section class="panel-control">
            <div class="section-header">
                <i class="fa-solid fa-shop icono-header"></i>
                <h2>Gestión de productos</h2>
            </div>

            <hr>

            <a href="ins_producto.php" class="boton-insertar">
                <i class="fa-regular fa-square-plus"></i>
                Insertar producto
            </a>

            <div class="caja-overflow">
                <table>
                    <thead>
                        <tr>
                            <th>Acciones</th>
                            <th>Imagen</th>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Activo</th>
                            <th>Marca</th>
                            <th>Material</th>
                            <th>Talla</th>
                            <th>Género</th>
                            <th>Tipo</th>
                            <th class="medidas">Medidas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $p): ?>
                        <tr>
                            <td>
                                <a href="edit_producto.php?edit=<?= $p['id'] ?>">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                                <a href="?eliminar=<?= $p['id'] ?>" 
                                onclick="return confirm('¿Eliminar producto?');">
                                    <i class="fa-regular fa-trash-can"></i>
                                </a>
                            </td>
                            <td>
                                <img src="../img/<?= htmlspecialchars($p['imagen']) ?>" alt="imagen producto">
                            </td>
                            <td><?= $p['id'] ?></td>
                            <td><?= htmlspecialchars($p['nombre']) ?></td>
                            <td><?= number_format($p['precio'], 2) ?> €</td>
                            <td>
                                <?php 
                                if ($p['activo']) echo '<i class="fa-solid fa-check"></i>';
                                else echo '<i class="fa-solid fa-x"></i>';
                                ?>
                            </td>
                            <td><?= htmlspecialchars($p['marca']) ?></td>
                            <td><?= htmlspecialchars($p['material']) ?></td>
                            <td><?= htmlspecialchars($p['talla']) ?></td>
                            <td><?= $p['genero'] ?></td>
                            <td><?= $p['tipo'] ?></td>
                            <td><?= htmlspecialchars($p['medidas']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
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