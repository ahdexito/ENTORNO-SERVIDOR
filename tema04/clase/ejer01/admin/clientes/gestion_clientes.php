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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <header>
        <h2 class="text-center m-4">📋 Gestión de Clientes</h2>
    </header>
    <main>
        <div class="float-start d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px;"> <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none"> <svg class="bi pe-none me-2" width="40" height="32" aria-hidden="true"><use xlink:href="#bootstrap"></use></svg> <span class="fs-4">Menú</span> </a> 
        <hr> 
        <ul class="nav nav-pills flex-column mb-auto"> 
            <li class="nav-item"> 
                <a href="#" class="nav-link active" aria-current="page"> <svg class="bi pe-none me-2" width="16" height="16" aria-hidden="true"><use xlink:href="#home"></use></svg>
                Clientes</a>
            </li> 
            <li>
                <a href="#" class="nav-link text-white"> <svg class="bi pe-none me-2" width="16" height="16" aria-hidden="true"><use xlink:href="#speedometer2"></use></svg>
                Productos</a>
            </li> 
            <li>
                <a href="#" class="nav-link text-white"> <svg class="bi pe-none me-2" width="16" height="16" aria-hidden="true"><use xlink:href="#table"></use></svg>
                Pedidos</a>
            </li>
        </ul> 
        <hr> 
        <div class="dropdown"> <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2"> <strong>mdo</strong> </a> <ul class="dropdown-menu dropdown-menu-dark text-small shadow" style=""> <li><a class="dropdown-item" href="#">New project...</a></li> <li><a class="dropdown-item" href="#">Settings</a></li> <li><a class="dropdown-item" href="#">Profile</a></li> <li><hr class="dropdown-divider"></li> <li><a class="dropdown-item" href="#">Sign out</a></li> </ul> </div> </div>

        <div class="container mt-4">
        
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
                        if (isset($_GET["upt"])) {
                            if ($_GET["upt"] == 0) { // actualización correcta
                                echo '<div class="alert alert-success">✅ Cliente actualizado
                                correctamente.</div>';
                            }
                            if ($_GET["upt"] == 1) { // problema al actualizar
                                echo '<div class="alert alert-danger">❌ Ha ocurrido un error
                                al intentar actualizar el usuario.</div>';
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
                                    <a href="edit_cli_mysqli.php?edit=<?= $c['id'] ?>" class="btn btn-sm btn-warning">✏️</a>
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
    </main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
