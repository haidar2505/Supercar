<?php
    include("../Database/connexion.php");
    // Ajouter voiture
    $ajouter_voiture_form = NULL;
    $clicked_ajouter = false;
    $error = false;
    if(isset($_POST['ajouter_voiture_form'])){
        $clicked_ajouter = true;
        $ajouter_voiture_form = ".voiture{display:none;} .form_voiture{display:block;} .modifier_voiture_form{display: none;}";
        $marque_ajouter = $modele_ajouter = $typemoteur_ajouter = $moteur_ajouter = $chevaux_ajouter = $topspeed_ajouter = $speedtime_ajouter = $description_ajouter = $image_ajouter = $prix_ajouter = NULL;
        $marque_ajouter_error = $modele_ajouter_error = $prix_ajouter_error = $typemoteur_ajouter_error = $moteur_ajouter_error = $chevaux_ajouter_error = $topspeed_ajouter_error = $speedtime_ajouter_error = $description_ajouter_error = $image_ajouter_error = NULL;
    }
    if(isset($_POST['ajouter_voiture'])){
        $clicked_ajouter = true;
        $ajouter_voiture_form = ".voiture{display:none;} .form_voiture{display:block;} .modifier_voiture_form{display: none;}";
        $marque_ajouter = htmlspecialchars($_POST['marque_ajouter'], ENT_QUOTES, 'UTF-8');
        echo $marque_ajouter."dassa";
        $modele_ajouter = htmlspecialchars($_POST['modele_ajouter'], ENT_QUOTES, 'UTF-8');
        $prix_ajouter = htmlspecialchars($_POST['prix_ajouter'], ENT_QUOTES, 'UTF-8');
        $typemoteur_ajouter = htmlspecialchars($_POST['typemoteur_ajouter'], ENT_QUOTES, 'UTF-8');
        $moteur_ajouter = htmlspecialchars($_POST['moteur_ajouter'], ENT_QUOTES, 'UTF-8');
        $chevaux_ajouter = htmlspecialchars($_POST['ch_ajouter'], ENT_QUOTES, 'UTF-8');
        $topspeed_ajouter = htmlspecialchars($_POST['tpspeed_ajouter'], ENT_QUOTES, 'UTF-8');
        $speedtime_ajouter = htmlspecialchars($_POST['spdtime_ajouter'], ENT_QUOTES, 'UTF-8');
        $description_ajouter = htmlspecialchars($_POST['description_ajouter'], ENT_QUOTES, 'UTF-8');
        $image_ajouter = htmlspecialchars($_POST['image_ajouter'], ENT_QUOTES, 'UTF-8');
        if(empty($marque_ajouter)){
            $marque_ajouter_error = "Choisir une marque";
            $error = true;
        }
        $verify_modele_query = "SELECT Modele FROM voiture WHERE '$modele_ajouter' = Modele";
        $verify_modele_result = mysqli_query($bdd, $verify_modele_query);
        $row_modele = mysqli_num_rows($verify_modele_result);
        if(empty($modele_ajouter)){
            $modele_ajouter_error = "Entrez un modèle de la marque de ' ".$marque_ajouter." '";
            $error = true;
        }elseif($row_modele > 0){
            $modele_ajouter_error = "Modèle existant";
            $error = true;
        }
        if(empty($prix_ajouter)){
            $prix_ajouter_error = "Saisir un prix";
            $error = true;
        }elseif(!is_numeric($prix_ajouter)){
            $prix_ajouter_error = "Elle ne doit contenir que des chiffres";
            $error = true;
        }
        if(empty($typemoteur_ajouter)){
            $typemoteur_ajouter_error = "Choisir un type de moteur";
            $error = true;
        }
        if(empty($moteur_ajouter)){
            $moteur_ajouter_error = "Entrez le nom du moteur";
            $error = true;
        }
        if(empty($chevaux_ajouter)){
            $chevaux_ajouter_error = "Saisir un chevaux";
            $error = true;
        }elseif(!is_numeric($chevaux_ajouter)){
            $chevaux_ajouter_error = "Elle ne doit contenir que des chiffres";
            $error = true;
        }elseif(preg_match('/[.]/', $chevaux_ajouter)){
            $chevaux_ajouter_error = "Saisir un nombre entier";
            $error = true;
        }elseif(strlen($chevaux_ajouter)>4){
            $chevaux_ajouter_error = "Saisir un nombre approprié";
            $error = true;
        }
        if(empty($topspeed_ajouter)){
            $topspeed_ajouter_error = "Saisir la vitesse maximal de ' ".$modele_ajouter." '";
            $error = true;
        }elseif(!is_numeric($topspeed_ajouter)){
            $topspeed_ajouter_error = "Elle ne doit contenir que des chiffres";
            $error = true;
        }elseif(preg_match('/[.]/', $topspeed_ajouter)){
            $topspeed_ajouter_error = "Saisir un nombre entier";
            $error = true;
        }elseif(strlen($topspeed_ajouter)>3){
            $topspeed_ajouter_error = "Saisir un nombre approprié";
            $error = true;
        }
        if(empty($speedtime_ajouter)){
            $speedtime_ajouter_error = "Saisir le temps de vitesse de 0-100km/h";
            $error = true;
        }elseif(!is_numeric($speedtime_ajouter)){
            $speedtime_ajouter_error = "Elle ne doit contenir que des chiffres";
            $error = true;
        }
        elseif(strlen($topspeed_ajouter)>3){
            $topspeed_ajouter_error = "Saisir un nombre approprié";
            $error = true;
        }
        if(empty($description_ajouter)){
            $description_ajouter_error = "Entrez une description";
            $error = true;
        }
        if(empty($image_ajouter)){
            $image_ajouter_error = "Insérez une image";
            $error = true;
        }
        if(!$error){
            $get_id_marque_query = "SELECT Id_marque FROM marque WHERE '$marque_ajouter' = Marque";
            $get_id_marque_result = mysqli_query($bdd, $get_id_marque_query);
            if ($get_id_marque_result) {
                $row = mysqli_fetch_assoc($get_id_marque_result);
                $get_id_marque = $row['Id_marque'];
            }
            $ajouter_voiture_query = "INSERT INTO voiture (Modele, Photo, Prix, Moteur, TypeMoteur, Chevaux, Speedtime, Topspeed, Description_voiture, Id_marque) VALUES ('$modele_ajouter', '$image_ajouter', '$prix_ajouter', '$moteur_ajouter', '$typemoteur_ajouter', '$chevaux_ajouter', '$speedtime_ajouter', '$topspeed_ajouter', '$description_ajouter', '$get_id_marque')";
            mysqli_query($bdd, $ajouter_voiture_query);
        }
    }
    if(isset($_POST['ajouter_form_clear'])){
        $marque_ajouter_error = $modele_ajouter_error = $prix_ajouter_error = $typemoteur_ajouter_error = $moteur_ajouter_error = $chevaux_ajouter_error = $topspeed_ajouter_error = $speedtime_ajouter_error = $description_ajouter_error = $image_ajouter_error = NULL;
        $marque_ajouter = $modele_ajouter = $typemoteur_ajouter = $moteur_ajouter = $chevaux_ajouter = $topspeed_ajouter = $speedtime_ajouter = $description_ajouter = $image_ajouter = $prix_ajouter = NULL;
        $clicked_ajouter = true;
        $ajouter_voiture_form = ".voiture{display:none;} .form_voiture{display:block;} .modifier_voiture_form{display: none;}";
    }
    // Évènements
    $ajouter_evenement_form = NULL;
    $clicked_ajouter_evenement = false;
    $error = false;
    if(isset($_POST['ajouter_evenements_form'])){
        $clicked_ajouter_evenement = true;
        $ajouter_evenement_form = ".evenement{display:none;} .evenement_form{display:block;}";
        $marque_ajouter = $theme_ajouter = $location_ajouter = $prix_ajouter = $date_d_ajouter = $date_f_ajouter = $description_ajouter = $image_ajouter = NULL;
        $marque_ajouter_error = $theme_ajouter_error = $location_ajouter_error = $prix_ajouter_error = $date_d_ajouter_error = $description_ajouter_error = $image_ajouter_error = NULL;
    }
    if(isset($_POST['ajouter_evenement'])){
        $clicked_ajouter_evenement = true;
        $ajouter_evenement_form = ".evenement{display:none;} .evenement_form{display:block;}";
        $marque_ajouter = htmlspecialchars($_POST['marque_ajouter'], ENT_QUOTES, 'UTF-8');
        $theme_ajouter = htmlspecialchars($_POST['theme_ajouter'], ENT_QUOTES, 'UTF-8');
        $prix_ajouter = htmlspecialchars($_POST['prix_ajouter'], ENT_QUOTES, 'UTF-8');
        $location_ajouter = htmlspecialchars($_POST['location_ajouter'], ENT_QUOTES, 'UTF-8');
        $date_d_ajouter = htmlspecialchars($_POST['date_d_ajouter'], ENT_QUOTES, 'UTF-8');
        $date_f_ajouter = htmlspecialchars($_POST['date_f_ajouter'], ENT_QUOTES, 'UTF-8');
        $description_ajouter = htmlspecialchars($_POST['description_ajouter'], ENT_QUOTES, 'UTF-8');
        $image_ajouter = htmlspecialchars($_POST['image_ajouter'], ENT_QUOTES, 'UTF-8');
        if(empty($marque_ajouter)){
            $marque_ajouter_error = "Choisir une marque";
            $error = true;
        }
        if(empty($theme_ajouter)){
            $theme_ajouter_error = "Entrez un modèle de la marque de ' ".$marque_ajouter." '";
            $error = true;
        }
        if(empty($prix_ajouter)){
            $prix_ajouter_error = "Saisir un prix";
            $error = true;
        }elseif(!is_numeric($prix_ajouter)){
            $prix_ajouter_error = "Elle ne doit contenir que des chiffres";
            $error = true;
        }
        if(empty($location_ajouter)){
            $location_ajouter_error = "Choisir un type de moteur";
            $error = true;
        }
        if(empty($date_d_ajouter)){
            $date_d_ajouter_error = "Entrez le nom du moteur";
            $error = true;
        }
        if(empty($description_ajouter)){
            $description_ajouter_error = "Entrez une description";
            $error = true;
        }
        if(empty($image_ajouter)){
            $image_ajouter_error = "Insérez une image";
            $error = true;
        }
        if(!$error){
            $get_id_marque_query = "SELECT Id_marque FROM marque WHERE '$marque_ajouter' = Marque";
            $get_id_marque_result = mysqli_query($bdd, $get_id_marque_query);
            if ($get_id_marque_result) {
                $row = mysqli_fetch_assoc($get_id_marque_result);
                $get_id_marque = $row['Id_marque'];
            }
            $ajouter_evenement_query = "INSERT INTO evenement (Theme, Date_debut, Date_fin, Description, Photos, Prix, Location, Id_marque) VALUES ('$theme_ajouter', '$date_d_ajouter', '$date_f_ajouter', '$description_ajouter', '$image_ajouter', '$prix_ajouter', '$location_ajouter', '$get_id_marque')";
            mysqli_query($bdd, $ajouter_evenement_query);
        }
    }
    if(isset($_POST['ajouter_form_clear'])){
        $marque_ajouter = $theme_ajouter = $location_ajouter = $prix_ajouter = $date_d_ajouter = $date_f_ajouter = $description_ajouter = $image_ajouter = NULL;
        $marque_ajouter_error = $theme_ajouter_error = $location_ajouter_error = $prix_ajouter_error = $date_d_ajouter_error = $description_ajouter_error = $image_ajouter_error = NULL;
        $clicked_ajouter_evenement = true;
        $ajouter_evenement_form = ".evenement{display:none;} .evenement_form{display:block;}";
    }
    // Employées
    $ajouter_employe_form = NULL;
    $clicked_ajouter_employe = false;
    $error = false;
    if(isset($_POST['ajouter_employe_form'])){
        $clicked_ajouter_employe = true;
        $ajouter_employe_form = ".employe{display:none;} .employe_form{display:block;}";
        $nom_ajouter = $prenom_ajouter = $numtel_ajouter = $email_ajouter = $username_ajouter = $mot_de_passe_ajouter = $mot_de_passe__confirmer_ajouter = NULL;
        $nom_ajouter_error = $prenom_ajouter_error = $numtel_ajouter_error = $email_ajouter_error = $username_ajouter_error = $mot_de_passe_ajouter_error = $mot_de_passe__confirmer_ajouter_error = NULL;
    }
    if(isset($_POST['ajouter_employe'])){
        $nom_ajouter_error = $prenom_ajouter_error = $numtel_ajouter_error = $email_ajouter_error = $username_ajouter_error = $mot_de_passe_ajouter_error = $mot_de_passe__confirmer_ajouter_error = NULL;

        $clicked_ajouter_employe = true;
        $ajouter_employe_form = ".employe{display:none;} .employe_form{display:block;}";
        $pattern_email = '/[^@\s]+@[^@\s]+\.[^@\s]+/';
        $pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
        $nom_ajouter = htmlspecialchars($_POST['nom_ajouter'], ENT_QUOTES, 'UTF-8');
        $prenom_ajouter = htmlspecialchars($_POST['prenom_ajouter'], ENT_QUOTES, 'UTF-8');
        $numtel_ajouter = htmlspecialchars($_POST['numtel_ajouter'], ENT_QUOTES, 'UTF-8');
        $email_ajouter = htmlspecialchars($_POST['email_ajouter'], ENT_QUOTES, 'UTF-8');
        $username_ajouter = htmlspecialchars($_POST['username_ajouter'], ENT_QUOTES, 'UTF-8');
        $mot_de_passe_ajouter = htmlspecialchars($_POST['mot_de_passe_ajouter'], ENT_QUOTES, 'UTF-8');
        $mot_de_passe__confirmer_ajouter = htmlspecialchars($_POST['mot_de_passe__confirmer_ajouter'], ENT_QUOTES, 'UTF-8');
        if(empty($nom_ajouter)){
            $nom_ajouter_error = "Choisir une marque";
            $error = true;
        }
        if(empty($prenom_ajouter)){
            $prenom_ajouter_error = "Entrez un modèle de la marque de";
            $error = true;
        }
        if (empty($numtel_ajouter)){
            $numtel_ajouter_error = 'Entrez un numéro de téléphone';
            $error = true;
        }elseif (!is_numeric($numtel_ajouter)){
            $numtel_ajouter_error = 'Le numéro de téléphone ne doit contenir que des chiffres';
            $error = true;
        }elseif (strlen($numtel_ajouter) != 8){
            $numtel_ajouter_error = 'Le numéro de téléphone doit contenir exactement 8 chiffres';
            $error = true;
        }
        if (empty($email_ajouter)){
            $email_ajouter_error = 'Entrez votre email';
            $error = true;
        }elseif (!preg_match($pattern_email, $email_ajouter)){
            $email_ajouter_error = 'Email invalide';
            $error = true;
        }
        if(empty($username_ajouter)){
            $username_ajouter_error = "Entrez le nom du moteur";
            $error = true;
        }
        if (empty($mot_de_passe_ajouter)){
            $mot_de_passe_ajouter_error = "Votre mot de passe doit contenir au moins une lettre capitale, un minuscule, un chiffre et un caractère spéciale";
            $error = true;
        }elseif (!preg_match('/[A-Z]/', $mot_de_passe_ajouter)){
            $mot_de_passe_ajouter_error = "Votre mot de passe doit contenir au moins une lettre capitale";
            $error = true;
        }elseif (!preg_match('/[a-z]/', $mot_de_passe_ajouter)){
            $mot_de_passe_ajouter_error = "Votre mot de passe doit contenir au moins une lettre minuscule";
            $error = true;
        }
        elseif (!preg_match('/[0-9]/', $mot_de_passe_ajouter)){
            $mot_de_passe_ajouter_error = "Votre mot de passe doit contenir au moins un chiffre";
            $error = true;
        }elseif (!preg_match($pattern, $mot_de_passe_ajouter)){
            $mot_de_passe_ajouter_error = "Votre mot de passe doit contenir au moins un caractère spéciale";
            $error = true;
        }elseif (strlen($mot_de_passe_ajouter) < 8){
            $mot_de_passe_ajouter_error = "Votre mot de passe doit contenir 8 ou plus de caractère";
            $error = true;
        }
        $verify_email = "SELECT Email FROM admin WHERE Email = '$email_ajouter'";
        $email_result = mysqli_query($bdd, $verify_email);
        if (mysqli_num_rows($email_result) !=0){
            $email_ajouter_error = "Ce email a déjà un compte";
            $error = true;
        }else{
            $verify_username = "SELECT Username FROM admin WHERE Username = '$username_ajouter'";
            $username_result = mysqli_query($bdd, $verify_username);
            if (mysqli_num_rows($username_result) != 0){
                $username_ajouter_error = "Ce username est déjà prise";
                $error = true;
            }else{
                if($mot_de_passe_ajouter != $mot_de_passe__confirmer_ajouter){
                    $mot_de_passe__confirmer_ajouter_error = "Mot de passe non identique";
                    $error = true;
                }
            }
        }
        if(!$error){
            $ajouter_employe_query = "INSERT INTO admin (Nom, Prenom, Email, NumTel, Username, Mot_de_passe) VALUES ('$nom_ajouter', '$prenom_ajouter', '$email_ajouter', '$numtel_ajouter', '$username_ajouter', '$mot_de_passe__confirmer_ajouter')";
            mysqli_query($bdd, $ajouter_employe_query);
        }
    }
    if(isset($_POST['ajouter_form_clear'])){
        $nom_ajouter = $prenom_ajouter = $numtel_ajouter = $email_ajouter = $username_ajouter = $mot_de_passe_ajouter = $mot_de_passe__confirmer_ajouter = NULL;
        $nom_ajouter_error = $prenom_ajouter_error = $numtel_ajouter_error = $email_ajouter_error = $username_ajouter_error = $mot_de_passe_ajouter_error = $mot_de_passe__confirmer_ajouter_error = NULL;
        $clicked_ajouter_employe = true;
        $ajouter_employe_form = ".employe{display:none;} .employe_form{display:block;}";
    }
?>