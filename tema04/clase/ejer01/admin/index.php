<?php
    include("db/db.inc");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" href=""><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>index</title>
</head>
<body>
    




    <main>
        <section>
            <article>
            <h1>Iniciar sesión</h1>
            <?php
    if(isset($_POST["email"]) && !empty($_POST["email"]) && filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
        if(isset($_POST["password"]) && !empty($_POST["password"])){
            $email = htmlspecialchars(trim($_POST["email"]));
            $password = htmlspecialchars(sha1($_POST["password"]));
            $check = $conn->prepare("SELECT nombre, email, rol FROM usuarios WHERE email = ? AND password =?");
            //Utilizamos bind_param para evitar inyecciones de código sql
            //Asocio las variables PHP a los placeholders (?) de la consulta preparada, indicando el tipo de dato.
            //Esta cadena indica el tipo de dato de cada parámetro, en orden:s → string (cadena) s → string
            $check->bind_param("ss", $email, $password);
            $check->execute(); //Ejecutamos la consulta
            $check->store_result(); //Guardamos el resultado del SELECT
            if ($check->num_rows > 0) { 
                //Si las credenciales son válidas -> hay una fila coincidente en la BD
                session_start();
                // Vinculo las variables donde se guardarán los resultados de la consulta
                $check->bind_result($nombre, $emailDB, $rol);
                $check->fetch(); 
                //Extraigo la fila de resultados y lleno esas variables.
                $_SESSION["nombre"] = $nombre;
                $_SESSION["rol"] = $rol;
                $_SESSION["email"] = $emailDB;
                header("location:./clientes/gestion_clientes.php");
                die();
            }
            else{ 
                //Si no existe el email
                echo '<div class="alert alert-warning">⚠️ El email y la
                contraseña NO existen.</div>';
                }
        }
        else{ 
            //Si password mal
            echo '<div class="alert alert-warning">⚠️ Error en el campo
            Password.</div>';
        }
    }
    else{ 
        //Si no existe el email
        if(isset($_POST["email"]))
            echo '<div class="alert alert-warning">⚠️ El email no es
            válido.</div>';
    }
?>
                <form>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
            </article>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>