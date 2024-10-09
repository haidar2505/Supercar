<?php
    if(isset($_SESSION['sestime']) && (time() - $_SESSION['sestime'] > 500)) {
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit;
        }
        $_SESSION['sestime'] = time();
?>