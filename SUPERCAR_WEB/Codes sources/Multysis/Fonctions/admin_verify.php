<?php
    $admin_password_bdd = $password_admin = $username_admin = NULL;
    $username_admin_error = $motdepasse_error = NULL;
    $error = false;
    include("../Database/connexion.php");
    if (isset($_POST["open_admin"])){
        $username_admin = htmlspecialchars($_POST['username_admin'], ENT_QUOTES, 'UTF-8');
        $password_admin = htmlspecialchars($_POST['Mot_de_passe_Admin'], ENT_QUOTES, 'UTF-8');
        if (empty($username_admin)){
            $username_admin_error = 'Entrez votre username';
            $error = true;
        }else{
            $verify_admin_query = "SELECT Mot_de_passe FROM admin WHERE Username = '$username_admin';";
            $admin_reslut = mysqli_query($bdd, $verify_admin_query);
            if (!mysqli_num_rows($admin_reslut) > 0){
                $username_admin_error = 'Username invalide';
                $error = true;
            }else{
                $get_admin = mysqli_fetch_assoc($admin_reslut);
                $admin_password_bdd = $get_admin['Mot_de_passe'];
            }
        }
        if ($password_admin == ""){
            $motdepasse_error = 'Entrez votre mot de passe';
            $error = true;
        }elseif ($password_admin != $admin_password_bdd){
            $motdepasse_error = 'Mot de passe incorrect';
            $error = true;
        }else{
            if ($admin_password_bdd == $password_admin){
                session_start();
                $_SESSION["username"] = $username_admin;
                header("Location: admin.php");
                exit();
            }
        }
    }
    if (isset($_POST["fermer"])){
        $admin_password_bdd = $password_admin = $username_admin = NULL;
        $username_admin_error = $motdepasse_error = NULL;
    }
?>