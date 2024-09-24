<?php
    if (isset($_POST['supprimer_voiture'])){
        include("../Database/connexion.php");
        $id_voiture = mysqli_escape_string($bdd, $_POST ["id_voiture"]);
        $delete_voiture_query = "DELETE FROM voiture WHERE Id_voiture = $id_voiture;";
        $delete_voiture = mysqli_query($bdd, $delete_voiture_query);
        // Reload
        $view_voiture_query = "SELECT * FROM voiture a JOIN marque b ON a.Id_marque = b.Id_marque ORDER BY a.Id_voiture;";
        $view_voiture_result = mysqli_query($bdd, $view_voiture_query);
        $voitures = [];
        while($row = mysqli_fetch_assoc($view_voiture_result)){
            $voitures[] = [
                'id_voiture' => $row['Id_voiture'],
                'modele' => $row['Modele'],
                'moteur' => $row['Moteur'],
                'typemoteur' => $row['TypeMoteur'],
                'chevaux' => $row['Chevaux'],
                'speedtime' => $row['Speedtime'],
                'topspeed' => $row['Topspeed'],
                'description' => $row['Description_voiture'],
                'marque' => $row['Marque'],
                'photo' => $row["Photo"],
            ];
        }
        mysqli_free_result($view_voiture_result);
        $voitures_clicked = True;
        $display_voiture = ".voiture{display:block;}";
    }
    if (isset($_POST['supprimer_evenement'])){
        include("../Database/connexion.php");
        $id_evenement = mysqli_escape_string($bdd, $_POST ["id_evenement"]);
        $delete_evenement_query = "DELETE FROM evenement WHERE Id_evenement = $id_evenement;";
        $delete_evenement = mysqli_query($bdd, $delete_evenement_query);
        // Reload
        $view_evenement_query = "SELECT * FROM evenement;";
        $view_evenement_result = mysqli_query($bdd, $view_evenement_query);
        while($row = mysqli_fetch_assoc($view_evenement_result)){
            $evenements[] = [
                'id_evenement' => $row["Id_evenement"],
                'theme' => $row["Theme"],
                'date_debut' => $row["Date_debut"],
                'date_fin' => $row["Date_fin"],
                'description' => $row["Description"],
                'prix' => $row["Prix"],
                'location' => $row["Location"],
                'id_marque' => $row["Id_marque"],
                'photo' => $row["Photos"],
            ];
        }
        mysqli_free_result($view_evenement_result);
        $evenements_clicked = True;
        $display_evenement = ".evenement{display:block;}";
    }
    if (isset($_POST['supprimer_inscription'])){
        include("../Database/connexion.php");
        $id_inscription = mysqli_escape_string($bdd, $_POST ["id_inscription"]);
        $delete_inscription_query = "DELETE FROM inscription_client WHERE Id_inscription = $id_inscription;";
        $delete_inscription = mysqli_query($bdd, $delete_inscription_query);
        // Reload
        $view_client_query = "SELECT * FROM inscription_client;";
        $view_client_result = mysqli_query($bdd, $view_client_query);
        while($row = mysqli_fetch_assoc($view_client_result)){
            $clients[] = [
                'id_inscription' => $row["Id_inscription"],
                'nom' => $row["Nom"],
                'prenom' => $row["Prenom"],
                'ville' => $row["Ville"],
                'numtel' => $row["NumTel"],
                'email' => $row["Email"],
                'username' => $row["Username"],
                'motdepasse' => $row["Mot_de_passe"],
            ];
        }
        mysqli_free_result($view_client_result);
        $clients_clicked = True;
        $display_client = ".client{display:block;}";
    }
?>