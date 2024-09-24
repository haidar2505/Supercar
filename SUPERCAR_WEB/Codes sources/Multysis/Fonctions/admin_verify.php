<?php
    $admin_password_bdd = $password_admin = $nom_admin = NULL;
    $nom_error = $motdepasse_error = NULL;
    $errors = false;
    include("../Database/connexion.php");
    if (isset($_POST["open_admin"])){
        $nom_admin = mysqli_real_escape_string($bdd, $_POST["Nom_Admin"]);
        $password_admin = mysqli_real_escape_string($bdd, $_POST["Mot_de_passe_Admin"]);
        if ($nom_admin == ""){
            $nom_error = 'Entrez votre nom';
            $errors = true;
        }else{
            $verify_admin_query = "SELECT Mot_de_passe FROM admin WHERE Nom = '$nom_admin';";
            $admin_reslut = mysqli_query($bdd, $verify_admin_query);
            if (!mysqli_num_rows($admin_reslut) > 0){
                $nom_error = 'Nom invalide';
                $errors = true;
            }else{
                $get_admin = mysqli_fetch_assoc($admin_reslut);
                $admin_password_bdd = $get_admin['Mot_de_passe'];
            }
        }
        if ($password_admin == ""){
            $motdepasse_error = 'Entrez votre mot de passe';
            $errors = true;
        }elseif ($password_admin != $admin_password_bdd){
            $motdepasse_error = 'Mot de passe incorrect';
            $errors = true;
        }else{
            if ($admin_password_bdd == $password_admin){
                session_start();
                $_SESSION["nom_admin"] = $nom_admin;
                header("Location: admin.php");
                exit();
            }
        }
    }
    if (isset($_POST["fermer"])){
        $admin_password_bdd = $password_admin = $nom_admin = NULL;
        $nom_error = $motdepasse_error = NULL;
    }
?>