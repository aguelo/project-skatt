<?php
    session_start();
    session_destroy();
    header('Location: v_login.php')
?>
