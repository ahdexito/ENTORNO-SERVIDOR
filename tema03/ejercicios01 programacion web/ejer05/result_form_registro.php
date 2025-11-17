<?php
    // prevenir ataques desde otros dominios
    if (parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) != $_SERVER['HTTP_HOST']) {
        header("Refresh:2; url=ej5_form_registro.php");
        exit;
    }

    
?>