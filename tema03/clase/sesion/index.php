<?php
    if(!isset($_SESSION)) // si existe alguna sesión activa
        session_start();

    $_SESSION["ies"] = "IES Torrevigía";
    $instituto = $_SESSION["ies"];

    print $instituto;
?>