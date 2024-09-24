<?php
    $frogotpassword = $confirmfrogotpassword = $password_error = $password_error_identique = $email = $email_error = NULL;
    $errors = false;
    $showmodal = false;
    $pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
    include("../Database/connexion.php");
    if (isset($_POST['resetpassword'])){
        $email = mysqli_real_escape_string($bdd, $_POST["email"]);
        $frogotpassword = mysqli_real_escape_string($bdd, $_POST["frogotpassword"]);
        $confirmfrogotpassword = mysqli_real_escape_string($bdd, $_POST["confirmfrogotpassword"]);
        if ($email == ""){
            $email_error = "Entrez votre E-mail";
            $errors = true;
        }else{
            $verify_email_query = "SELECT Email FROM inscription_client WHERE Email = '$email'";
            $verify_email = mysqli_query($bdd, $verify_email_query);
            if (!mysqli_num_rows($verify_email) > 0){
                $email_error = 'Email incorrect';
                $errors = true;
            }
        }        
        if ($frogotpassword == ""){
            $password_error = "Votre mot de passe doit contenir au moins une lettre capitale, un minuscule, un chiffre et un caractère spéciale";
            $errors = true;
        }elseif (!preg_match('/[A-Z]/', $frogotpassword)){
            $password_error = "Votre mot de passe doit contenir au moins une lettre capitale";
            $errors = true;
        }elseif (!preg_match('/[a-z]/', $frogotpassword)){
            $password_error = "Votre mot de passe doit contenir au moins une lettre minuscule";
            $errors = true;
        }
        elseif (!preg_match('/[0-9]/', $frogotpassword)){
            $password_error = "Votre mot de passe doit contenir au moins un chiffre";
            $errors = true;
        }elseif (!preg_match($pattern, $frogotpassword)){
            $password_error = "Votre mot de passe doit contenir au moins un caractère spéciale sauf '<', '>', '/' '\'";
            $errors = true;
        }elseif (strlen($frogotpassword) < 12){
            $password_error = "Votre mot de passe doit contenir 8 ou plus de caractère";
            $errors = true;
        }
        if($frogotpassword != $confirmfrogotpassword){
            $password_error_identique = "Mot de passe non identique";
            $errors = true;
        }
        if (!$errors){
            // $hash_frogotpassword = password_hash($confirmfrogotpassword, PASSWORD_DEFAULT);
            $insert = "UPDATE inscription_client SET Mot_de_passe = '$confirmfrogotpassword' WHERE Email = '$email';";
            mysqli_query($bdd, $insert);
            $showModal = true;
        }
    }
    if (isset($_POST['annuler'])){
        $frogotpassword = $confirmfrogotpassword = $password_error = $password_error_identique = $email = $email_error = NULL;
        header("Location: connection.php");
        exit();
    }
?>