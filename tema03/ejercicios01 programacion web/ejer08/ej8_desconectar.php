<?php
    session_start();
    session_destroy();
    header("Location:ej08_sesiones.php");
?>