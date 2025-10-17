<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <main class="container mt-3">
        <?php 
            if(isset($_GET["error"]) && !empty($_GET["error"])) {
                if ($_GET["error"] == 1)  
                    echo "<div class='alert alert-error' role='alert'>❌ Error: Debe rellenar el campo nombre correctamente</div>";
                else if ($_GET["error"] == 2)  
                    echo "<div class='alert alert-error' role='alert'>❌ Error: Debe rellenar el campo email correctamente</div>";
                else if ($_GET["error"] == 3)  
                    echo "<div class='alert alert-error' role='alert'>❌ Error: Debe rellenar el campo contraseña correctamente</div>";
            }
        ?>
        <form name="registro" method="post" action="pagina1.php">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" ariadescribedby="nombreHelp" name="nombre">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" ariadescribedby="emailHelp" name="email">
                <div id="emailHelp" class="form-text">Nunca compartiremos tu email con
                nadie.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary w-100" name="enviar"> Enviar</button>
        </form>
    </main>
    <footer>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </footer>
</body>
</html>