<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_producto'])) {
    $id = $_POST['id_producto'];

    if (!isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id] = true;
    }
}

header("Location:index.php");
exit;