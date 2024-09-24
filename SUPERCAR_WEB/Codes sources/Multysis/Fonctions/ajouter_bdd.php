<?php
    $form_voiture = False;
    $form_evenement = False;

    //Voiture
    if (isset($_POST['ajouter_voitures_form'])){
        $form_voiture = True;
        $show_form_voiture = ".form_voiture{display:block;}";
    }
        if (isset($_POST['ajouter_voiture'])){
            include("../Database/connexion.php");
            $marque_id = mysqli_real_escape_string($bdd, $_POST["Marque"]);
            $modele = mysqli_real_escape_string($bdd, $_POST["Modele"]);
            $typemoteur = mysqli_real_escape_string($bdd, $_POST["TypeMoteur"]);
            $moteur = mysqli_real_escape_string($bdd, $_POST["Moteur"]);
            $chevaux = mysqli_real_escape_string($bdd, $_POST["Chevaux"]);
            $speedtime = mysqli_real_escape_string($bdd, $_POST["Speedtime"]);
            $topspeed = mysqli_real_escape_string($bdd, $_POST["Topspeed"]);
            $description = mysqli_real_escape_string($bdd, $_POST["Description"]);
            $image = mysqli_real_escape_string($bdd, $_POST["Image"]);
            $verify_existant_query = "SELECT Id_voiture FROM voiture WHERE Modele = '$modele';";
            $verify_existant_result = mysqli_query($bdd, $verify_existant_query);
            if (mysqli_num_rows($verify_existant_result) >0){
                $get_id_voiture = mysqli_fetch_assoc($verify_existant_result);
                echo "Ce modele est déjà existant";
            }else{
                $inserer_query = "INSERT INTO voiture (Modele, Photo, Moteur, TypeMoteur, Chevaux, Speedtime, Topspeed, Description_voiture, Id_marque) VALUES ('$modele', '$image', '$moteur', '$typemoteur', '$chevaux', '$speedtime', '$topspeed', '$description', '$marque_id')";
                mysqli_query($bdd, $inserer_query);
            }
        }
    

    //Évènements
    if (isset($_POST['ajouter_evenements_form'])){
        $form_evenement = True;
        $show_form_evenement = ".form_evenement{display:block;}";
    }
        if (isset($_POST['ajouter_evenement'])){
            include("../../Database/connexion.php");
            $marque_id = mysqli_real_escape_string($bdd, $_POST["Marque"]);
            $theme = mysqli_real_escape_string($bdd, $_POST["Theme"]);
            $date_debut = mysqli_real_escape_string($bdd, $_POST["Date_debut"]);
            $date_fin = mysqli_real_escape_string($bdd, $_POST["Date_fin"]);
            $location = mysqli_real_escape_string($bdd, $_POST["Location"]);
            $prix = mysqli_real_escape_string($bdd, $_POST["Prix"]);
            $description = mysqli_real_escape_string($bdd, $_POST["Description"]);
            $image = mysqli_real_escape_string($bdd, $_POST["Image"]);
            $inserer_query = "INSERT INTO evenement (Theme, Date_debut, Date_fin, Description, Photos, Prix,  Location, Id_marque) VALUES ('$theme', '$date_debut', '$date_fin', '$description', '$image', '$prix', '$location', '$marque_id')";
            mysqli_query($bdd, $inserer_query);
        }
    
?>