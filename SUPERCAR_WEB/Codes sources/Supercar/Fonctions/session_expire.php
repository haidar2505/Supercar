<?php
    if(isset($_SESSION['sestime']) && (time() - $_SESSION['sestime'] > 600)) {
        session_unset();
        session_destroy();
        header("Location: connection.php");
        exit;
        }
        $_SESSION['sestime'] = time();
?>