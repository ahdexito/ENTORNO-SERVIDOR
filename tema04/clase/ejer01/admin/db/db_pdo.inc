<?php
    //Sirve para cualquier base de datos

    $host = "localhost";//Dirección del servidor
    $nombreBD = "videojuegos";//Nombre de la BD
    $usuario = "root";//usuario con acceso a la BD
    $password = "";//Contraseña del usuario

    $dsn = "mysql:host=$host;dbname=$nombreBD";//nombre del host y de la base de datos,   para crear la conexión

    try { // Crear conexión
        $pdo = new PDO($dsn, $usuario, $password);//se establece la conexión
        // La conexión fue exitosa
        echo "Conexión exitosa con PDO.";
    } catch (\PDOException $e) {
        // La conexión falló
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
?>