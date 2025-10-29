<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pagina1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <main class="container">
        <?php
            if (isset($_POST["nombre"]) && !empty($_POST["nombre"]))
                $nombre = $_POST["nombre"];
            else {
                header("Location:formulario.php?error=1");
                die();
            }
            if (isset($_POST["email"]) && !empty($_POST["email"]))
                $email = $_POST["email"];
            else {
                header("Location:formulario.php?error=2");
                die();
            }
            if (isset($_POST["password"]) && !empty($_POST["password"]))
                $password = $_POST["password"];
            else {
                header("Location:formulario.php?error=3");
                die();
            }
        ?>
        <h1>Hola, <?= $nombre ?></h1>
        <p>El email pasado es: <strong><?= $email ?> </strong></p>
        <p>Y la contraseña es: <strong><?= $password ?> </strong></p>
    </main>
    <footer>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </footer>
</body>

</html>