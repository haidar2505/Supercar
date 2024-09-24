<?php
    // Voiture
    $voiture_click = False;
    if (isset($_POST['modify_voiture'])){
        $voiture_click = True;
        $voiture_form_block = ".voiture_form{
            display: block;";
        include("../Database/connexion.php");
        $id_voiture = mysqli_escape_string($bdd, $_POST['id_voiture']);
        $show_voiture_query = "SELECT * FROM voiture a JOIN marque b ON a.Id_marque = b.Id_marque WHERE Id_voiture = $id_voiture";
        $show_details_result = mysqli_query($bdd, $show_voiture_query);
        if ($row = mysqli_fetch_assoc($show_details_result)){
            $id_voiture1 = $row['Id_voiture'];
            $modele = $row['Modele'];
            $photo = $row['Photo'];
            $moteur = $row['Moteur'];
            $typemoteur = $row['TypeMoteur'];
            $chevaux = $row['Chevaux'];
            $speedtime = $row['Speedtime'];
            $topspeed = $row['Topspeed'];
            $description = $row['Description_voiture'];
            $marque = $row['Marque'];
            $image = $row['Photo'];
        }
    }
    if (isset($_POST['modifier_voiture_form'])){
        include("../Database/connexion.php");
        $id_voiture1 = mysqli_escape_string($bdd, $_POST['id_voiture']);
        $modele = mysqli_escape_string($bdd,$_POST['modele_modified']);
        $typemoteur = mysqli_escape_string($bdd, $_POST['typemoteur_modified']);
        $moteur = mysqli_escape_string($bdd, $_POST['moteur_modified']);
        $chevaux = mysqli_escape_string($bdd, $_POST['chevaux_modified']);
        $topspeed = mysqli_escape_string($bdd, $_POST['topspeed_modified']);
        $speedtime = mysqli_escape_string($bdd, $_POST['speedtime_modified']);
        $description = mysqli_escape_string($bdd, $_POST['description_modified']);
        $photo = mysqli_escape_string($bdd, $_POST['photo_modified']);
        $modify_bdd_query = "UPDATE voiture SET Modele = '$modele', Moteur = '$moteur', Typemoteur = '$typemoteur', Chevaux = '$chevaux', Speedtime = '$speedtime', Topspeed = '$topspeed', Description_voiture = '$description'";
        if ($photo !== ''){
            $modify_bdd_query .= ", Photo = $photo";
        }
        $modify_bdd_query .= " WHERE Id_voiture = $id_voiture1";
        mysqli_query($bdd, $modify_bdd_query);
        include("show_visualisation.php");
        $voitures_clicked = True;
        header("Location:visualisation.php");
    }

    //Évènement
    $evenement_click = False;
    if (isset($_POST['modifier_evenement'])){
        $evenement_click = True;
        $evenement_form_block = ".evenement_form{
            display: block;";
        include("../Database/connexion.php");
        $id_evenement = mysqli_escape_string($bdd, $_POST['id_evenement']);
        $show_evenement_query = "SELECT * FROM evenement a JOIN marque b ON a.Id_marque = b.Id_marque WHERE Id_evenement = $id_evenement";
        $show_evenement_result = mysqli_query($bdd, $show_evenement_query);
        if ($row = mysqli_fetch_assoc($show_evenement_result)){
            $id_event = $row['Id_evenement'];
            $theme = $row["Theme"];
            $description = $row["Description"];
            $image = $row["Photos"];
            $prix = $row["Prix"];
            $location = $row["Location"];
            $marque = $row["Marque"];
            $date_d = $row["Date_debut"];
            $dateTime_d = new DateTime($date_d);
            $newdate_d = $dateTime_d->format('d F Y');
            $date_f = $row["Date_fin"];
            $dateTime_f = new DateTime($date_f);
            $newdate_f = $dateTime_f->format('d F Y');
        }
    }
    if (isset($_POST['modifier_evenement_form'])){
        include("../Database/connexion.php");
        $id_event = mysqli_escape_string($bdd, $_POST['id_event']);
        $theme = mysqli_escape_string($bdd,$_POST['theme_modified']);
        $description = mysqli_escape_string($bdd, $_POST['description_modified']);
        $image = mysqli_escape_string($bdd, $_POST['photo_modified']);
        $prix = mysqli_escape_string($bdd, $_POST['prix_modified']);
        $location = mysqli_escape_string($bdd, $_POST['location_modified']);
        $newdate_d = mysqli_escape_string($bdd, $_POST['date_d_modified']);
        $newdate_f = mysqli_escape_string($bdd, $_POST['date_f_modified']);
        $modify_bdd_query = "UPDATE evenement SET Theme = '$theme', Date_debut = '$newdate_d', Date_fin = '$newdate_f', Description = '$description', Prix = '$prix', Location = '$location'";
        if ($image !== ''){
            $modify_bdd_query .= ", Photos = $image";
        }
        $modify_bdd_query .= " WHERE Id_evenement = $id_event";
        mysqli_query($bdd, $modify_bdd_query);
    }

    //Accueil bande_annonce
    $accueil_click = False;
    if (isset($_POST['modifier_accueil'])){
        $accueil_click = True;
        $accueil_form_block = ".accueil_form{
            display: block;";
        include("../Database/connexion.php");
        $id_accueil = mysqli_escape_string($bdd, $_POST['id_accueil']);
        $show_acccueil_query = "SELECT a.*, b.Modele, c.Marque FROM accueil a JOIN voiture b ON a.Id_voiture = b.Id_voiture JOIN marque c ON a.Id_marque = c.Id_marque WHERE Id = $id_accueil;";
        $show_acccueil_result = mysqli_query($bdd, $show_acccueil_query);
        if ($row = mysqli_fetch_assoc($show_acccueil_result)){
            $id_accueil1 = $row['Id'];
            $video = $row["Video"];
            $image = $row["Photo"];
            $description = $row["Description"];
            $lien_btn = $row["Lien"];
            $modele = $row["Modele"];
            $marque = $row["Marque"];
        }
    }


    if (isset($_POST['modifier_accueil_form'])){
        include("../Database/connexion.php");
        $id_accueil1 = mysqli_escape_string($bdd, $_POST['id_accueil']);
        $modele = mysqli_escape_string($bdd,$_POST['modele_modified']);
        $description = mysqli_escape_string($bdd, $_POST['description_modified']);
        $image = mysqli_escape_string($bdd, $_POST['photo_modified']);
        $marque = mysqli_escape_string($bdd, $_POST['marque_modified']);
        $lien_btn = mysqli_escape_string($bdd, $_POST['lien_btn_modified']);
        $get_id_marque_query = "SELECT Id_marque FROM marque WHERE Marque = '$marque';";
        $get_id_marque_result = mysqli_query($bdd, $get_id_marque_query);
        $get_id_marque = mysqli_fetch_assoc($get_id_marque_result);
        $id_marque = $get_id_marque['Id_marque'];
        $get_id_voiture_query = "SELECT Id_voiture FROM voiture WHERE Modele = '$modele';";
        $get_id_voiture_result = mysqli_query($bdd, $get_id_voiture_query);
        $get_id_voiture = mysqli_fetch_assoc($get_id_voiture_result);
        $id_voiture = $get_id_voiture['Id_voiture'];
        if ($id_accueil1 == 1){
            $modify_bdd_query = "UPDATE accueil SET Lien = '$lien_btn', Description = '$description', Id_marque = '$id_marque', Id_voiture = '$id_voiture'";
            if ($image !== ''){
                $modify_bdd_query .= ", Video = $image";
            }
            $modify_bdd_query .= " WHERE Id = $id_accueil1";
            mysqli_query($bdd, $modify_bdd_query);
        }else{
            $modify_bdd_query = "UPDATE accueil SET Lien = '$lien_btn', Description = '$description', Id_marque = '$id_marque', Id_voiture = '$id_voiture'";
            if ($image !== ''){
                $modify_bdd_query .= ", Photo = $image";
            }
            $modify_bdd_query .= " WHERE Id = $id_accueil1";
            mysqli_query($bdd, $modify_bdd_query);
        }
    }
?>