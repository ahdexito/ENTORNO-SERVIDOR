<?php
    session_start();
    if(!isset($_SESSION["rol"])) {
        header("location:../index.php");
        die();
    }

    include("../db/db.inc");

    // OBTENER CLIENTES
    $resultado = $conn -> query("SELECT * FROM clientes ORDER BY id DESC");
    $clientes = $resultado -> fetch_all(MYSQLI_ASSOC);

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
    <title>Document</title>
    <link rel="stylesheet" href="../css/admin/gestion_clientes/gestion_clientes.css">
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
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>Género</th>
                            <th>Dirección</th>
                            <th>Cod. Postal</th>
                            <th>Población</th>
                            <th>Provincia</th>
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
                            <td><?= $c['id'] ?></td>
                            <td><?= htmlspecialchars($c['nombre']) ?></td>
                            <td><?= htmlspecialchars($c['apellidos']) ?></td>
                            <td><?= htmlspecialchars($c['email']) ?></td>
                            <td><?= $c['genero'] ?></td>
                            <td><?= htmlspecialchars($c['direccion']) ?></td>
                            <td><?= $c['codpostal'] ?></td>
                            <td><?= htmlspecialchars($c['poblacion']) ?></td>
                            <td><?= htmlspecialchars($c['provincia']) ?></td>
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