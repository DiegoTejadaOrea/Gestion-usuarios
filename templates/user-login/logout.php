<?php
    session_start();
    session_destroy();
    header("location: login.php"); // redirecciona a la página de login
    exit();
?>
