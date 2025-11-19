<?php
    session_start();
    session_destroy();
    header("Location:ej9_form_login.php");
?>