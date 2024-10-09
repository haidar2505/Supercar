<?php
    include("../Database/connexion.php");
    $modifier_voiture_form = NULL;
    $clicked_modifier = false;
    $error = false;
    $modele_modified_error = $typemoteur_modified_error = $moteur_modified_error = $prix_modified_error = $chevaux_modified_error = $topspeed_modified_error = $speedtime_modified_error = $description_modified_error = NULL;
    if(isset($_POST['modifier_voiture_form'])){
        // $modele_modified = $typemoteur_modified = $moteur_modified = $prix_modified = $chevaux_modified = $topspeed_modified = $speedtime_modified = $description_modified = NULL;
        $id_modele_modifier = htmlspecialchars($_POST['id_voiture_modifier'], ENT_QUOTES, 'UTF-8');
        $infos_voiture_query = "SELECT * FROM voiture a JOIN marque b ON a.Id_marque = b.Id_marque WHERE a.Id_voiture = $id_modele_modifier;";
        $infos_voiture_result = mysqli_query($bdd,$infos_voiture_query);
        if ($row = mysqli_fetch_assoc($infos_voiture_result)){
            $id_modele_modified = $row["Id_voiture"];
            $marque_current = $row["Marque"];
            $modele_modified = $row["Modele"];
            $photo_modified = $row["Photo"];
            $prix_modified = $row["Prix"];
            $moteur_modified = $row["Moteur"];
            $typemoteur_modified = $row["TypeMoteur"];
            $chevaux_modified = $row["Chevaux"];
            $topspeed_modified = $row["Topspeed"];
            $speedtime_modified = $row["Speedtime"];
            $description_modified = $row["Description_voiture"];
        }
        $clicked_modifier = true;
        $modifier_voiture_form = ".voiture{display:none;} .modifier_voiture_form{display: block;} .form_voiture{display:none;}";
    }
    if(isset($_POST["modifier_voiture"])){
        $clicked_modifier = true;
        $modifier_voiture_form = ".voiture{display:none;} .modifier_voiture_form{display: block;} .form_voiture{display:none;}";
        $id_modele_modified = htmlspecialchars($_POST['id_voiture_modifier'], ENT_QUOTES, 'UTF-8');
        $marque_current = htmlspecialchars($_POST['marque_current'], ENT_QUOTES, 'UTF-8');
        $modele_modified = htmlspecialchars($_POST['modele_modified'], ENT_QUOTES, 'UTF-8');
        $prix_modified = htmlspecialchars($_POST['prix_modified'], ENT_QUOTES, 'UTF-8');
        $moteur_modified = htmlspecialchars($_POST['moteur_modified'], ENT_QUOTES, 'UTF-8');
        $typemoteur_modified = htmlspecialchars($_POST['typemoteur_modified'], ENT_QUOTES, 'UTF-8');
        $chevaux_modified = htmlspecialchars($_POST['chevaux_modified'], ENT_QUOTES, 'UTF-8');
        $topspeed_modified = htmlspecialchars($_POST['topspeed_modified'], ENT_QUOTES, 'UTF-8');
        $speedtime_modified = htmlspecialchars($_POST['speedtime_modified'], ENT_QUOTES, 'UTF-8');
        $description_modified = htmlspecialchars($_POST['description_modified'], ENT_QUOTES, 'UTF-8');
        $photo_modified = htmlspecialchars($_POST['photo_modified'], ENT_QUOTES, 'UTF-8');
        if (!$photo_modified){
            $show_photo_query = "SELECT Photo FROM voiture WHERE Id_voiture = $id_modele_modified";
            $show_photo_result = mysqli_query($bdd, $show_photo_query);
            if ($row = mysqli_fetch_assoc($show_photo_result)){
                $photo_modified = $row['Photo'];
            }
        }else{
            $photo_modified = htmlspecialchars($_POST['photo_modified'], ENT_QUOTES, 'UTF-8');
        }
        if (empty($prix_modified)){
            $prix_modified_error = "Entrez un prix (euros)";
            $error = true;
        }elseif(!is_numeric($prix_modified)){
            $prix_modified_error = "Elle doit contenir que des chiffres";
            $error = true;
        }
        $prix_query = "SELECT * FROM voiture a JOIN marque b ON a.Id_marque = b.Id_marque WHERE a.Id_voiture = $id_modele_modified;";
        $prix_result = mysqli_query($bdd,$prix_query);
        if($row = mysqli_fetch_assoc($prix_result)){
            $prix_ancien = $row["Prix"];
        }
        $prix_25pourcent = $prix_ancien / (25/100);
        if($prix_modified > $prix_25pourcent){
            $prix_modified_error = "Le nouveau prix ne doit pas dépasser 25% (>".$prix_25pourcent.")";
            $error = true;
        }
        if (empty($modele_modified)){
            $modele_modified_error = "Entrez un modèle";
            $error = true;
        }
        if ($typemoteur_modified == ''){
            $typemoteur_modified_error = "Choisir un type de moteur";
            $error = true;
        }
        if ($moteur_modified == ''){
            $moteur_modified_error = "Entrez le nom du moteur";
            $error = true;
        }
        if ($chevaux_modified == ''){
            $chevaux_modified_error = "Entrez un cheveau";
            $error = true;
        }elseif (!is_numeric($chevaux_modified)){
            $chevaux_modified_error = "Elle doit contenir que des chiffres";
            $error = true;
        }
        if ($speedtime_modified == ''){
            $speedtime_modified_error = "Entrez un temps de vitesse";
            $error = true;
        }elseif (!is_numeric($speedtime_modified)){
            $speedtime_modified_error = "Elle doit contenir que des chiffres";
            $error = true;
        }
        if ($topspeed_modified == ''){
            $topspeed_modified_error = "Entrez la vitesse maximal";
            $error = true;
        }elseif (!is_numeric($topspeed_modified)){
            $topspeed_modified_error = "Elle doit contenir que des chiffres";
            $error = true;
        }
        if (empty($description_modified)){
            $description_modified_error = "Entrez une description";
            $error = true;
        }
        if(!$error){
            $modify_bdd_query = "UPDATE voiture SET Modele = '$modele_modified', Prix = '$prix_modified', Moteur = '$moteur_modified', TypeMoteur = '$typemoteur_modified', Chevaux = '$chevaux_modified', Speedtime = '$speedtime_modified', Topspeed = '$topspeed_modified', 
            Description_voiture = '$description_modified'";
            if ($photo_modified !== ''){
                $modify_bdd_query .= ", Photo = '$photo_modified'";
            }
            $modify_bdd_query .= " WHERE Id_voiture = $id_modele_modified";
            mysqli_query($bdd, $modify_bdd_query);
        }
    }

    // Modifier évènements
    $modifier_evenement_form = NULL;
    $theme_modified_error = $date_d_modified_modified_error = $description_modified_error_evenement = $prix_modified_error_evenement = $photo_modified_error = $location_modified_error = NULL;
    if(isset($_POST['modifier_evenement_form'])){
        // $modele_modified = $typemoteur_modified = $moteur_modified = $prix_modified = $chevaux_modified = $topspeed_modified = $speedtime_modified = $description_modified = NULL;
        $id_evenement_modifier = htmlspecialchars($_POST['id_event'], ENT_QUOTES, 'UTF-8');
        $infos_evenement_query = "SELECT * FROM evenement a JOIN marque b ON a.Id_marque = b.Id_marque WHERE a.Id_evenement = $id_evenement_modifier;";
        $infos_evenement_result = mysqli_query($bdd,$infos_evenement_query);
        if ($row = mysqli_fetch_assoc($infos_evenement_result)){
            $id_evenement_modified = $row["Id_evenement"];
            $theme_modified = $row["Theme"];
            $date_d_modified = $row["Date_debut"];
            $date_f_modified = $row["Date_fin"];
            $description_modified_evenement = $row["Description"];
            $prix_modified_evenement = $row["Prix"];
            $photo_modified = $row["Photos"];
            $location_modified = $row["Location"];
            $marque_current = $row["Marque"];
        }
        $clicked_modifier = true;
        $modifier_evenement_form = ".evenement{display:none;} .evenement_form{display: none;} .modifier_evenement_form{display:block;}";
    }
    if(isset($_POST["modifier_evenement"])){
        $clicked_modifier = true;
        $modifier_evenement_form = ".evenement{display:none;} .evenement_form{display: none;} .modifier_evenement_form{display:block;}";
        $id_evenement_modified = htmlspecialchars($_POST['id_event'], ENT_QUOTES, 'UTF-8');
        $theme_modified = htmlspecialchars($_POST['theme_modified'], ENT_QUOTES, 'UTF-8');
        $date_d_modified = htmlspecialchars($_POST['date_d_modified'], ENT_QUOTES, 'UTF-8');
        $date_f_modified = htmlspecialchars($_POST['date_f_modified'], ENT_QUOTES, 'UTF-8');
        $description_modified_evenement = htmlspecialchars($_POST['description_modified'], ENT_QUOTES, 'UTF-8');
        $prix_modified_evenement = htmlspecialchars($_POST['prix_modified'], ENT_QUOTES, 'UTF-8');
        $location_modified = htmlspecialchars($_POST['location_modified'], ENT_QUOTES, 'UTF-8');
        $photo_modified = htmlspecialchars($_POST['photo_modified'], ENT_QUOTES, 'UTF-8');
        if (!$photo_modified){
            $show_photo_query = "SELECT Photos FROM evenement WHERE Id_evenement = $id_evenement_modified";
            $show_photo_result = mysqli_query($bdd, $show_photo_query);
            if ($row = mysqli_fetch_assoc($show_photo_result)){
                $photo_modified = $row['Photos'];
            }
        }else{
            $photo_modified = htmlspecialchars($_POST['photo_modified'], ENT_QUOTES, 'UTF-8');
        }
        if($theme_modified == ''){
            $theme_modified_error = "Entrez un thème";
            $error = true;
        }
        if ($prix_modified_evenement == ''){
            $prix_modified_error_evenement = "Entrez un prix (euros)";
            $error = true;
        }elseif (!is_numeric($prix_modified)){
            $prix_modified_error_evenement = "Elle doit contenir que des chiffres";
            $error = true;
        }
        if ($location_modified == ''){
            $location_modified_error = "Entrez une location";
            $error = true;
        }
        if ($date_d_modified == ''){
            $date_d_modified_error = "Entrez une date";
            $error = true;
        }
        if ($description_modified_evenement == ''){
            $description_modified_error_evenement = "Entrez une description";
            $error = true;
        }
        if(!$error){
            $modify_bdd_query = "UPDATE evenement SET Theme = '$theme_modified', Date_debut = '$date_d_modified', Date_fin = '$date_f_modified', Description = '$description_modified_evenement', Prix = '$prix_modified_evenement', 
            Location = '$location_modified'";
            if ($photo_modified !== ''){
                $modify_bdd_query .= ", Photos = '$photo_modified'";
            }
            $modify_bdd_query .= " WHERE Id_evenement = $id_evenement_modified";
            mysqli_query($bdd, $modify_bdd_query);
        }
    }
?>