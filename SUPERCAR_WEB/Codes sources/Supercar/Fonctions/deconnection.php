<?php
    if (isset($_POST["deconnection"])){
        session_start();
        session_unset();
        session_destroy();
        header("Location: ../index.php");
        exit;
    }
?>