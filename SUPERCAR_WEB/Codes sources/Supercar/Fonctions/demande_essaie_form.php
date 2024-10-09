<?php
    $error = false;
    $numtel_error = $modele_error = $heure_error = $date_error = $checked_error = NULL;
    $numtel = $id_modele = $date = $heure = $modele = $marque = $id_marque = $checked = NULL;
    $_SESSION['selected_model_id'] = NULL;
    $opened = "09:00";
    $closed = "17:00";
    session_start();
    $showModalfailed = false;
    $showModal = false;
    include("../Database/connexion.php");
    if (isset($_POST["essayer"])){
        if (!isset($_SESSION["username"])){
            $showModalfailed = true;
        }else{
            $_SESSION['selected_model_id'] = $id_modele = mysqli_real_escape_string($bdd, $_POST["Id_modele"]);
        }
    }
    elseif (isset($_POST["envoyer_demande"])){
        if (!isset($_SESSION["username"])){
            $showModalfailed = true;
        }else{
            $id_modele = mysqli_real_escape_string($bdd, $_POST["Modele"]);
            $date = mysqli_real_escape_string($bdd, $_POST["Date"]);
            $heure = mysqli_real_escape_string($bdd, $_POST["Heure"]);
            $numtel = mysqli_real_escape_string($bdd, $_POST["NumTel"]);
            $checked = isset($_POST["checked"]) ? mysqli_real_escape_string($bdd, $_POST["checked"]) : '';
            if(empty($checked)){
                $checked_error = 'Ce champ est obligatoire';
                $error = true;
            }elseif($checked = mysqli_real_escape_string($bdd, $_POST["checked"]) == 1){
                $checked = 1;
            }
            if ($numtel == ""){
                $numtel_error = 'Entrez un numéro de téléphone';
                $error = true;
            }elseif (!is_numeric($numtel)){
                $numtel_error = 'Le numéro de téléphone ne doit contenir que des chiffres';
                $error = true;
            }elseif (strlen($numtel) != 8){
                $numtel_error = 'Le numéro de téléphone doit contenir exactement 8 chiffres';
                $error = true;
            }
            if ($id_modele == ""){
                $modele_error = 'Entrez une modèle que vous voulez essayer';
                $error = true;
            }else{
                $modele_query = "SELECT * FROM voiture a JOIN marque b ON a.Id_marque = b.Id_marque WHERE Id_voiture = '$id_modele';";
                $modele_result = mysqli_query($bdd, $modele_query);
                $get_modele = mysqli_fetch_assoc($modele_result);
                $modele = $get_modele['Modele'];
                $id_marque = $get_modele['Id_marque'];
            }
            if ($date == ""){
                $date_error = 'Entrez une date';
                $error = true;
            }elseif (strtotime($date) <= strtotime(date("Y-m-d"))){
                $date_error = 'Entrez une date valide';
                $error = true;
            }
            if ($heure == ""){
                $heure_error = 'Entrez une heure';
                $error = true;
            }elseif (strtotime($heure) < strtotime($opened) || strtotime($heure) > strtotime($closed)){
                $heure_error = 'Entrez une heure les alentours de 09:00 à 17:00';
                $error = true;
                $heure_class = ".red_outline{border-color: red;}";
            }
            if (!$error){
                $username_query = "SELECT Id_inscription FROM inscription_client WHERE Username = '$_SESSION[username]';";
                $username_result = mysqli_query($bdd, $username_query);
                $get_id_client = mysqli_fetch_assoc($username_result);
                $id_client = $get_id_client['Id_inscription'];
                $insert_demande = "INSERT INTO demande_essaie (Modele, Jour, Heure, NumTel, Statut, Id_marque, Id_inscription) VALUES ('$modele', '$date', '$heure', '$numtel', 'En attente', '$id_marque', '$id_client')";
                mysqli_query($bdd, $insert_demande);
                $showModal = true;
            }
        }
    }
    if (isset($_POST['clear_form'])){
        $numtel_error = $modele_error = $heure_error = $date_error = $checked_error = $_SESSION['selected_model_id'] = NULL;
        $numtel = $id_modele = $date = $heure = $modele = $marque = $id_marque = $checked = NULL;
    }

                        
?>