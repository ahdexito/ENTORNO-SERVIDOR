<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>formulario</title>
    <style>
        body {
            padding: 30px;
        }
        form {
            background-color: lightsteelblue;
            padding: 30px;
            width: 500px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <form method="post" action="ej9_result_form_login.php">
        <h1>Iniciar sesión</h1>

        <label for="nombre">Nombre de usuario</label><br>
        <input type="text" name="nombre" id="nombre" class="form-control-sm" placeholder="Tu usuario">
        
        <br><br>

        <label for="contra">Contraseña</label><br>
        <input type="password" name="contra" id="contra" class="form-control-sm" placeholder="Tu contraseña">
        
        <br><br>

        <input type="checkbox" name="recuerdame" id="recuerdame">
        <label for="recuerdame">Recuérdame</label>
        
        <br><br>

        <a href="#" style="color: #000">¿Olvidaste la contraseña?</a>
        
        <br><br>

        <button type="submit" class="btn btn-primary">Login</button>
        
        <br><br>

        <p>¿Todavía no tienes cuenta? 
            <a href="#" style="color: red;">Regístrate</a>
        </p>
    </form>
    
    <footer><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script></footer>
</body>
</html>