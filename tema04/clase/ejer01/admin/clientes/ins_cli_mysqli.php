<?php
    session_start();
    if(!isset($_SESSION["nombre"])) {
        header("location:../index.php");
        die();
    }
    include("../db/db.inc");//mysqli
    if(isset($_POST["nombre"]) && !empty($_POST["nombre"])) {
        $nombre = htmlspecialchars(($_POST["nombre"]));
        $apellidos = htmlspecialchars(($_POST["apellidos"]));
        $email = htmlspecialchars(($_POST["email"]));
        $password = htmlspecialchars((sha1($_POST["password"])));
        $direccion = htmlspecialchars(($_POST["direccion"]));
        $genero = htmlspecialchars(($_POST["genero"]));
        $codpostal = htmlspecialchars(($_POST["codpostal"]));
        $poblacion = htmlspecialchars(($_POST["poblacion"]));
        $provincia = htmlspecialchars(($_POST["provincia"]));

        $sql = "SELECT * FROM clientes WHERE email='$email'";
        $res = mysqli_query($conn, $sql);
        if (mysqli_num_rows($res) > 0) { // si el email existe en db
            header("location:gestion_cliente.php?cli=1");
            die();
        }
        
        $sql = "INSERT INTO clientes(nombre, apellidos, genero, direccion, codpostal, poblacion, provincia, password, email)
        VALUES ('$nombre', '$apellidos', '$genero', '$direccion', '$codpostal', '$poblacion', '$provincia', '$password', '$email');";
        
        if (mysqli_query($conn, $sql)) {
            header("location:gestion_clientes.php?cli=0");
        }
        else {
            header("location:gestion_clientes.php?cli=2");
        }
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <main class="container mt-5">
        <div class="card">
            <div class="card-header bg-secondary">
                <h2 class="text-light">Registro de Cliente con MySQL</h2>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="apellidos" class="form-label">Apellidos:</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="direccion" class="form-label">Dirección:</label>
                            <input type="text" class="form-control" id="direccion" name="direccion">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="codpostal" class="form-label">Código Postal:</label>
                            <input type="text" class="form-control" id="codpostal" name="codpostal">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="poblacion" class="form-label">Población:</label>
                            <input type="text" class="form-control" id="poblacion" name="poblacion">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="provincia" class="form-label">Provincia:</label>
                            <input type="text" class="form-control" id="provincia" name="provincia">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="genero" class="form-label">Género:</label>
                            <select name="genero" id="genero" class="form-select">
                                <option value="default" selected disabled>Selecciona una opción</option>
                                <option value="H">Hombre</option>
                                <option value="M">Mujer</option>
                                <option value="O">Otro</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success mt-5">Guardar cliente</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>