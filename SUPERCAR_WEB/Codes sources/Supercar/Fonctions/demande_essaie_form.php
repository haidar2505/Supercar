<?php
    $errors = false;
    $numtel_error = $modele_error = $heure_error = $date_error = NULL;
    $numtel = $id_modele = $date = $heure = $modele = $marque = NULL;
    $opened = "09:00";
    $closed = "17:00";
    // $red = 0;
    // $red_outline = ".red_outline{border-color: red;}";
    session_start();
    $showModalfailed = false;
    $showModal = false;
    include("../Database/connexion.php");
    if (isset($_POST["essayer"])){
        if (!isset($_SESSION["username"])){
            $showModalfailed = true;
        }else{
            $id_modele = mysqli_real_escape_string($bdd, $_POST["Id_modele"]);
            $_SESSION['selected_model_id'] = $id_modele;
            header("Location: demande_essaie.php");
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
            if ($numtel == ""){
                $numtel_error = 'Entrez un numéro de téléphone';
                $errors = true;
                $red_outline = ".red_outline{border-color: red;}";
            }elseif (!is_numeric($numtel)){
                $numtel_error = 'Le numéro de téléphone ne doit contenir que des chiffres';
                $errors = true;
                $red_outline = ".red_outline{border-color: red;}";
            }elseif (strlen($numtel) != 8){
                $numtel_error = 'Le numéro de téléphone doit contenir exactement 8 chiffres';
                $errors = true;
                $red_outline = ".red_outline{border-color: red;}";
            }
            if ($id_modele == ""){
                $modele_error = 'Entrez une modèle que vous voulez essayer';
                $errors = true;
                $red_outline = ".red_outline{border-color: red;}";
            }else{
                $modele_query = "SELECT a.Modele, b.Marque FROM voiture a JOIN marque b ON a.Id_marque = b.Id_marque WHERE Id_voiture = '$id_modele';";
                $modele_result = mysqli_query($bdd, $modele_query);
                $get_modele = mysqli_fetch_assoc($modele_result);
                $modele = $get_modele['Modele'];
                $marque = $get_modele['Marque'];
            }
            if ($date == ""){
                $date_error = 'Entrez une date';
                $errors = true;
                $red_outline = ".red_outline{border-color: red;}";
            }elseif (strtotime($date) <= strtotime(date("Y-m-d"))){
                $date_error = 'Entrez une date valide';
                $errors = true;
                $red_outline = ".red_outline{border-color: red;}";
            }
            if ($heure == ""){
                $heure_error = 'Entrez une heure';
                $errors = true;
                $red_outline = ".red_outline{border-color: red;}";
            }elseif (strtotime($heure) < strtotime($opened) || strtotime($heure) > strtotime($closed)){
                $heure_error = 'Entrez une heure les alentours de 09:00 à 17:00';
                $errors = true;
                $heure_class = ".red_outline{border-color: red;}";
            }
            if (!$errors){
                $username_query = "SELECT Id_inscription FROM inscription_client WHERE Username = '$_SESSION[username]';";
                $username_result = mysqli_query($bdd, $username_query);
                $get_id_client = mysqli_fetch_assoc($username_result);
                $id_client = $get_id_client['Id_inscription'];
                $insert_demande = "INSERT INTO demande_essaie (Modele, Jour, Heure, NumTel, Id_voiture, Id_inscription) VALUES ('$modele', '$date', '$heure', '$numtel', '$id_modele', '$id_client')";
                mysqli_query($bdd, $insert_demande);
                $showModal = true;
            }
        }
    }
    if (isset($_POST['clear_form'])){
        $numtel_error = $modele_error = $heure_error = $date_error = $_SESSION['selected_model_id'] = NULL;
    }

                        
?>