<?php
    session_start();
    if(!isset($_SESSION["rol"])) {
        header("location:../index.php");
        die();
    }

    include("../db/db.inc");

    // PAGINADOR
    $num_lineas = 10;
    $pagina = isset($_GET['pag']) ? max(1, intval($_GET['pag'])) : 1;
    $offset = ($pagina - 1) * $num_lineas;

    // TOTAL DE REGISTROS
    $total_resultado = $conn -> query(
        "SELECT COUNT(*) AS total FROM clientes"
    );
    $total_filas = $total_resultado -> fetch_assoc()['total'];
    $total_paginas = ceil($total_filas / $num_lineas);

    // OBTENER clientes
    $resultado = $conn->query(
        "SELECT * FROM clientes 
        ORDER BY id DESC 
        LIMIT $num_lineas OFFSET $offset"
    );
    $clientes = $resultado->fetch_all(MYSQLI_ASSOC);

    // LÓGICA DE RANGO PARA EL HTML
    $rango = 1; // cuántas páginas mostrar a cada lado de la actual
    $inicio = max(1, $pagina - $rango);
    $fin = min($total_paginas, $pagina + $rango);

    // ELIMINAR CLIENTE
    if (isset($_GET["eliminar"])) {
        $id_cliente = intval($_GET["eliminar"]);

        $stmt = $conn -> prepare("DELETE FROM clientes WHERE id = ?");
        $stmt -> bind_param("i", $id_cliente);
        $stmt -> execute();
        $stmt -> close();

        header("location:gestion_clientes.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Clientes</title>
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
        // ALERTAS DE CREACIÓN DE CLIENTE
        if (isset($_GET["cli"])) {
            if ($_GET["cli"] == 0) { // registro correcto
                echo '<div class="alerta"><i class="fa-solid fa-circle-check check"></i>
                Cliente insertado correctamente.</div>';
            }
            if ($_GET["cli"] == 1) { // email ya existe
                echo '<div class="alerta"><i class="fa-solid fa-circle-exclamation exclamacion"></i>
                El email ya existe en la base de datos.</div>';
            }
            if ($_GET["cli"] == 2) { // problema al insertar
                echo '<div class="alerta"><i class="fa-solid fa-circle-xmark xmark"></i>
                Ha ocurrido un error al intentar insertar el usuario.</div>';
            }
        }

        // ALERTAS DE MODIFICACIÓN DE CLIENTE
        if (isset($_GET["upt"])) {
            if ($_GET["upt"] == 0) { // actualización correcta
                echo '<div class="alerta"><i class="fa-solid fa-circle-check check"></i>
                Cliente actualizado correctamente.</div>';
            }
            if ($_GET["upt"] == 1) { // problema al actualizar
                echo '<div class="alerta"><i class="fa-solid fa-circle-xmark xmark"></i>
                Ha ocurrido un error al intentar actualizar el usuario.</div>';
            }
        }
    ?>

    <main>
        <section class="panel-control">
            <div class="section-header">
                <i class="fa-solid fa-users icono-header"></i>
                <h2>Gestión de clientes</h2>
            </div>

            <hr>

            <a href="ins_cliente.php" class="boton-insertar">
                <i class="fa-regular fa-square-plus"></i>
                Insertar cliente
            </a>

            <div class="caja-overflow">
                <table>
                    <thead>
                        <tr>
                            <th>Acciones</th>
                            <th>ID Cliente</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>Género</th>
                            <th>Dirección</th>
                            <th>Cod. Postal</th>
                            <th>Población</th>
                            <th>Provincia</th>
                            <th>Creación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clientes as $c): ?>
                        <tr>
                            <td>
                                <a href="edit_cliente.php?edit=<?= $c['id'] ?>">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                                <a href="?eliminar=<?= $c['id'] ?>" 
                                onclick="return confirm('¿Eliminar cliente?');">
                                    <i class="fa-regular fa-trash-can"></i>
                                </a>
                            </td>
                            <td>#<?= $c['id'] ?></td>
                            <td><?= htmlspecialchars($c['nombre']) ?></td>
                            <td><?= htmlspecialchars($c['apellidos']) ?></td>
                            <td><?= htmlspecialchars($c['email']) ?></td>
                            <td><?= $c['genero'] ?></td>
                            <td><?= htmlspecialchars($c['direccion']) ?></td>
                            <td><?= $c['codpostal'] ?></td>
                            <td><?= htmlspecialchars($c['poblacion']) ?></td>
                            <td><?= htmlspecialchars($c['provincia']) ?></td>
                            <td> <?= date('d/m/Y H:i', strtotime($c['creado'])) ?> </td>
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