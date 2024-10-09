<?php
    if (isset($_POST["deconnection"])){
        session_start();
        session_unset();
        session_destroy();
        header("Location: admin_connection.php");
        exit;
    }
?>