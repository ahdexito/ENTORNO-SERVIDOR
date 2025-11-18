<?php
    setcookie("nombreusu", "", time() - 3600);
    setcookie("colorusu", "", time() - 3600);

    header("Location:ej7_index.php");
?>