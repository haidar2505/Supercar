<?php
    //server name
    $host = "localhost";
    //username
    $login = "root";
    //password
    $pass = "";
    //database name
    $dbname = "supercar";
    $bdd = mysqli_connect($host, $login, $pass, $dbname);
    if($bdd){
    //echo "connexion a MySql réussi <br>";
    }
    else{
        die("La connexion à la base de données a échoué: " . mysqli_connect_error());
    }
    mysqli_set_charset($bdd, "utf8");
?>