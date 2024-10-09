<?php
    $errors = false;
    $username_error = $mot_de_passe_error = NULL;
    $username_connection = $mot_de_passe_connection = $motdepasse = NULL;
    include("../Database/connexion.php");
    if (isset($_POST["connection"])){
        $username_connection = mysqli_real_escape_string($bdd, $_POST["Username_connection"]);
        $mot_de_passe_connection = mysqli_real_escape_string($bdd, $_POST["Mot_de_passe_connection"]);
        if ($username_connection == ""){
            $username_error = 'Entrez votre username';
            $errors = true;
        }else {
            $verify_connection = "SELECT Mot_de_passe FROM inscription_client WHERE Username = '$username_connection'";
            $verify_result = mysqli_query($bdd, $verify_connection);
            if (!mysqli_num_rows($verify_result) > 0){
                $username_error = 'Username incorrect';
                $errors = true;
            }else{
                $row = mysqli_fetch_assoc($verify_result);
                $motdepasse = $row["Mot_de_passe"];
            }
        }
        $hash_motdepasse = sha1($mot_de_passe_connection);
        if ($hash_motdepasse == ""){
            $mot_de_passe_error = 'Entrez votre mot de passe';
            $errors = true;
        }elseif ($hash_motdepasse != $motdepasse){
            $mot_de_passe_error = 'Mot de passe incorrect';
            $errors = true;
        }else{
            if($hash_motdepasse == $motdepasse){
                session_start();
                $_SESSION["username"] = $username_connection;
                header("Location: index.php");
                exit();
            }
        }
    }
    if (isset($_POST['clear_form'])){
        $username_error = $mot_de_passe_error = NULL;
    }
?>