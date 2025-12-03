<?php
    session_start();
    if(!isset($_SESSION["nombre"])) {
        header("location:../index.php");
        die();
    }
    include("../db/db.inc");//mysqli
    
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
            <div class="card-header bg-primary">
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
                            <label for="genero" class="form-label">Genero:</label>
                            <select name="genero" id="genero" class="form-select">
                                <option value="default" selected disabled>Selecciona una opción</option>
                                <option value="H">Hombre</option>
                                <option value="M">Mujer</option>
                            </select>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="direccion" class="form-label">Direccion:</label>
                            <input type="text" class="form-control" id="direccion" name="direccion">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="cp" class="form-label">Codigo Postal:</label>
                            <input type="text" class="form-control" id="cp" name="cp">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="poblacion" class="form-label">Poblacion:</label>
                            <input type="text" class="form-control" id="poblacion" name="poblacion">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="provincia" class="form-label">Provicia:</label>
                            <input type="text" class="form-control" id="provincia" name="provincia">
                        </div>
                        <button type="submit" class="btn btn-primary mt-5">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>