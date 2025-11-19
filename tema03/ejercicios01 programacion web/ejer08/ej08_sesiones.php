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
    <main>

        <?php
            session_start();
            // si existe la sesión usuario
            if (isset($_SESSION["usuario"])) {
                echo "<h1>Bienvenido, " . $_SESSION["usuario"] . "</h1>";
                echo "<a href='ej8_desconectar.php'>Desconectar</a><br>";
            }
            // si no existe
            else echo "<h1>Bienvenido a mi web</h1>";
            echo "<br>";
        ?>


        <form method="POST" action="ej8_result_form_sesiones.php">
            <h1>Iniciar sesión</h1>

            <label for="nombre">Nombre</label><br>
            <input type="text" name="nombre" id="nombre" class="form-control-sm" placeholder="Tu nombre" required>

            <br><br>

            <label for="apellidos">Apellidos</label><br>
            <input type="text" name="apellidos" id="apellidos" class="form-control-sm" placeholder="Tus apellidos" required>

            <br><br>

            <label for="email">Email</label><br>
            <input type="text" name="email" id="email" class="form-control-sm" placeholder="Tu email" required>
            
            <br><br>

            <label for="password">Contraseña</label><br>
            <input type="password" name="password" id="password" class="form-control-sm" placeholder="Tu contraseña" required>
            
            <br><br>
            
            <legend>Selecciona tu género:</legend>
            <input type="radio" id="masculino" name="genero" value="masculino" required>
            <label for="masculino">Masculino</label>
            <br>
            <input type="radio" id="feminino" name="genero" value="femenino" required>
            <label for="femenino">Femenino</label>
            <br>
            <input type="radio" id="otro" name="genero" value="otro" required>
            <label for="otro">Otro</label>
            
            <br><br>

            <label for="direccion">Dirección</label><br>
            <input type="text" name="direccion" id="direccion" class="form-control-sm" placeholder="Tu direccion" required>

            <br><br>

            <label for="postal">Código Postal</label><br>
            <input type="text" name="postal" id="postal" class="form-control-sm" placeholder="Tu código postal" required>

            <br><br>

            <label for="poblacion">Población</label><br>
            <input type="text" name="poblacion" id="poblacion" class="form-control-sm" placeholder="Tu población" required>

            <br><br>

            <label for="provincia">Provincia</label>
            <select name="provincia" id="provincia" required>
                <option value="" disabled selected>Selecciona una opción</option>
                
                <option value="alava">Álava</option>
                <option value="albacete">Albacete</option>
                <option value="alicante">Alicante</option>
                <option value="almeria">Almería</option>
                <option value="asturias">Asturias</option>
                <option value="avila">Ávila</option>
                <option value="badajoz">Badajoz</option>
                <option value="barcelona">Barcelona</option>
                <option value="burgos">Burgos</option>
                <option value="caceres">Cáceres</option>
                <option value="cadiz">Cádiz</option>
                <option value="cantabria">Cantabria</option>
                <option value="castellón">Castellón</option>
                <option value="ciudadreal">Ciudad Real</option>
                <option value="cordoba">Córdoba</option>
                <option value="cuenca">Cuenca</option>
                <option value="girona">Girona</option>
                <option value="granada">Granada</option>
                <option value="guadalajara">Guadalajara</option>
                <option value="guipuzcoa">Guipúzcoa</option>
                <option value="huelva">Huelva</option>
                <option value="huesca">Huesca</option>
                <option value="baleares">Islas Baleares</option>
                <option value="jaen">Jaén</option>
                <option value="acorunya">A Coruña</option>
                <option value="larioja">La Rioja</option>
                <option value="laspalmas">Las Palmas</option>
                <option value="leon">León</option>
                <option value="lleida">Lleida</option>
                <option value="lugo">Lugo</option>
                <option value="madrid">Madrid</option>
                <option value="malaga">Málaga</option>
                <option value="murcia">Murcia</option>
                <option value="navarra">Navarra</option>
                <option value="ourense">Ourense</option>
                <option value="palencia">Palencia</option>
                <option value="pontevedra">Pontevedra</option>
                <option value="salamanca">Salamanca</option>
                <option value="tenerife">Santa Cruz de Tenerife</option>
                <option value="segovia">Segovia</option>
                <option value="sevilla">Sevilla</option>
                <option value="soria">Soria</option>
                <option value="tarragona">Tarragona</option>
                <option value="teruel">Teruel</option>
                <option value="toledo">Toledo</option>
                <option value="valencia">Valencia</option>
                <option value="valladolid">Valladolid</option>
                <option value="vizcaya">Vizcaya</option>
                <option value="zamora">Zamora</option>
                <option value="zaragoza">Zaragoza</option>
            </select>

            <br><br>

            <a href="#" style="color: #000">¿Olvidaste la contraseña?</a>
            
            <br><br>

            <button type="submit" class="btn btn-primary">Login</button>
            
            <br><br>

            <p>¿Todavía no tienes cuenta? 
                <a href="#" style="color: red;">Regístrate</a>
            </p>
        </form>
    </main>

    <footer><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script></footer>
</body>
</html>