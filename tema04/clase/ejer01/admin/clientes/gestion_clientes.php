<?php
    session_start();
    if(!isset($_SESSION["nombre"])) {
        header("location:../index.php");
        die();
    }

    // Incluimos la conexión a la BD
    include("../db/db_pdo.inc"); 
    // Obtener todos los clientes
    $clientes = $pdo->query("SELECT * FROM clientes ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
    $nombre = $_SESSION["nombre"];
    $rol = $_SESSION["rol"];

    if (isset($_GET["eliminar"])) {
        $id_cliente = intval($_GET["eliminar"]); // código en mi bd del cliente a eliminar
        $pdo->prepare("DELETE FROM clientes WHERE id = ?")->execute([$id_cliente]);
        header("location:gestion_clientes.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Clientes</title>
    <link rel="stylesheet" href="css/gestion_clientes.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <aside class="float-start aside bg-secondary">
        <div>

        </div>

        <ul>
            <li><a href="gestion_clientes.php">Clientes</a></li>
            <li>Productos</li>
            <li>Pedidos</li>
            <li>Productos</li>
            <li>Pedidos</li>
            <li>Productos</li>
            <li>Pedidos</li>
            <li>Productos</li>
            <li>Pedidos</li>
        </ul>
    </aside>
    <div class="container mt-4">
    <h2 class="text-center mb-4">📋 Gestión de Clientes</h2>
    <!-- Tabla de clientes -->
    <div class="card shadow">
        <div class="card-header bg-primary text-white">📋 Lista de Clientes</div>
            <div class="card-body">
                <?php
                    if (isset($_GET["cli"])) {
                        if ($_GET["cli"] == 0) { // registro correcto
                            echo '<div class="alert alert-success">✅ Cliente insertado
                            correctamente.</div>';
                        }
                        if ($_GET["cli"] == 1) { // email ya existe
                            echo '<div class="alert alert-warning">⚠️ El email ya existe
                            en la base de datos.</div>';
                        }
                        if ($_GET["cli"] == 2) { // problema al insertar
                            echo '<div class="alert alert-danger">❌ Ha ocurrido un error
                            al intentar insertar el usuario.</div>';
                        }
                    }
                ?>

                <div class="row mb-3 me-2 float-end">
                    <a href="ins_cli_mysqli.php" class="btn btn-success">➕ Nuevo Cliente</a>
                </div>
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>      
                            <th>Email</th>
                            <th>Género</th>
                            <th>Dirección</th>
                            <th>Código Postal</th>
                            <th>Población</th>
                            <th>Provincia</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clientes as $c): ?>
                        <tr>
                            <td><?= $c['id'] ?></td>
                            <td><?= htmlspecialchars($c['nombre']) ?></td>
                            <td><?= htmlspecialchars($c['apellidos']) ?></td>
                            <td><?= htmlspecialchars($c['email']) ?></td>
                            <td><?= $c['genero'] ?></td>
                            <td><?= htmlspecialchars($c['direccion']) ?></td>
                            <td><?= $c['codpostal'] ?></td>
                            <td><?= htmlspecialchars($c['poblacion']) ?></td>
                            <td><?= htmlspecialchars($c['provincia']) ?></td>
                            <td>
                                <a href="edit_cli_mysqli.php?edit" class="btn btn-sm btn-warning">✏️</a>
                                <a href="?eliminar=<?= $c['id'] ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Eliminar cliente?');">🗑️</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
