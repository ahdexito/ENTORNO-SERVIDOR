<?php
    session_start();
    if(!isset($_SESSION["rol"])) {
        header("location:../index.php");
        die();
    }

    include("../db/db.inc");

    // PAGINADOR
    $num_lineas = 4;
    $pagina = isset($_GET['pag']) ? max(1, intval($_GET['pag'])) : 1;
    $offset = ($pagina - 1) * $num_lineas;

    // TOTAL DE REGISTROS
    $total_resultado = $conn -> query(
        "SELECT COUNT(*) AS total FROM productos"
    );
    $total_filas = $total_resultado -> fetch_assoc()['total'];
    $total_paginas = ceil($total_filas / $num_lineas);

    // OBTENER PRODUCTOS
    $resultado = $conn->query(
        "SELECT * FROM productos 
        ORDER BY activo DESC, creado DESC
        LIMIT $num_lineas OFFSET $offset"
    );
    $productos = $resultado->fetch_all(MYSQLI_ASSOC);

    // LÓGICA DE RANGO PARA EL HTML
    $rango = 1; // cuántas páginas mostrar a cada lado de la actual
    $inicio = max(1, $pagina - $rango);
    $fin = min($total_paginas, $pagina + $rango);

    // ELIMINAR PRODUCTOS
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
    <title>Gestión Productos</title>
    <link rel="stylesheet" href="../css/admin/tabla_gestion/tabla_gestion.css">
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
                <a href="panel_admin.php"><i class="fa-regular fa-circle-left icono-accion"></i></a>
                <p>Atrás</p>
            </div>
            <div class="panel">
                <a href="panel_admin.php"><i class="fa-solid fa-bars-progress icono-accion"></i></a>
                <p>Panel</p>
            </div>
            <div class="usuario dropdown">
                <i class="fa-solid fa-user icono-usuario dropdown-btn icono-accion" id="dropdown-btn"></i>

                <div class="dropdown-content">
                    <a href="#"><i class="fa-solid fa-gear icono-dropdown"></i>Ajustes</a>
                    <hr>
                    <a href="desconectar_admin.php"><i class="fa-solid fa-arrow-right-from-bracket icono-dropdown"></i>Cerrar sesión</a>
                </div>

                <?php echo "<p>" . $_SESSION["nombre"] . "</p>"?>
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
                            <th>ID Producto</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Activo</th>
                            <th>Estado</th>
                            <th>Marca</th>
                            <th>Material</th>
                            <th>Talla</th>
                            <th>Género</th>
                            <th>Tipo</th>
                            <th>Creación</th>
                            <th class="medidas">Medidas</th>
                            <th class="detalles">Detalles</th>
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
                            <td>#<?= $p['id'] ?></td>
                            <td><?= htmlspecialchars($p['nombre']) ?></td>
                            <td><?= number_format($p['precio'], 2) ?> €</td>
                            <td>
                                <?php
                                if ($p['activo'] == 0) echo '<i class="fa-solid fa-x"></i>'; 
                                elseif ($p['activo'] == 1) echo '<i class="fa-solid fa-check"></i>';
                                elseif ($p['activo'] == 2) echo '<i class="fa-regular fa-bookmark"></i>';
                                ?>
                            </td>
                            <td>
                                <?php
                                    $estado = $p['estado'];
                                    switch ($estado) {
                                    case 1:
                                        echo "<p>A estrenar</p>";
                                        break;
                                    case 2:
                                        echo "<p>Como nuevo</p>";
                                        break;
                                    case 3:
                                        echo "<p>Buen estado</p>";
                                        break;
                                    case 4:
                                        echo "<p>Aceptable</p>";
                                        break;
                                    case 5:
                                        echo "<p>Bastante usado</p>";
                                        break;
                                    default:
                                        echo "<p>Desconocido</p>";
                                        break;
                                    }
                                ?>
                            </td>
                            <td> <?= htmlspecialchars($p['marca']) ?> </td>
                            <td> <?= htmlspecialchars($p['material']) ?> </td>
                            <td> <?= htmlspecialchars($p['talla']) ?> </td>
                            <td> <?= $p['genero'] ?> </td>
                            <td> <?= $p['tipo'] ?> </td>
                            <td> <?= date('d/m/Y H:i', strtotime($p['creado'])) ?> </td>
                            <td class="text-area"> <?= htmlspecialchars($p['medidas']) ?> </td>
                            <td class="text-area"> <?= htmlspecialchars($p['detalles']) ?> </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="paginador">
                <?php if ($pagina > 1): ?>
                    <a href="?pag=<?= $pagina - 1 ?>" class="icono-flecha"><i class="fa-solid fa-angle-left"></i></a>
                <?php endif; ?>

                <?php if ($inicio > 1): ?>
                    <a href="?pag=1" class="pagina-limite">1</a>
                <?php endif; ?>

                <?php for ($i = $inicio; $i <= $fin; $i++): ?>
                    <a href="?pag=<?= $i ?>" class="<?= $i == $pagina ? 'activo' : '' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>

                <?php if ($fin < $total_paginas): ?>
                    <a href="?pag=<?= $total_paginas ?>" class="pagina-limite"><?= $total_paginas ?></a>
                <?php endif; ?>

                <?php if ($pagina < $total_paginas): ?>
                    <a href="?pag=<?= $pagina + 1 ?>" class="icono-flecha"><i class="fa-solid fa-angle-right"></i></a>
                <?php endif; ?>
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
        <script src="../js/dropdown.js"></script>
    </footer>
</body>
</html>