<?php
    // Voitures
    $voitures_clicked = False;
    $display_voiture = null;
    $voitures = [];
    if (isset($_POST["voir_voitures"])){
        include("../Database/connexion.php");
        $view_voiture_query = "SELECT * FROM voiture a JOIN marque b WHERE a.Id_marque = b.Id_marque ORDER BY a.Id_voiture;";
        $view_voiture_result = mysqli_query($bdd, $view_voiture_query);
        $voitures = [];
        while($row = mysqli_fetch_assoc($view_voiture_result)){
            $voitures[] = [
                'id_voiture' => $row["Id_voiture"],
                'modele' => $row["Modele"],
                'moteur' => $row["Moteur"],
                'typemoteur' => $row["TypeMoteur"],
                'chevaux' => $row["Chevaux"],
                'speedtime' => $row["Speedtime"],
                'topspeed' => $row["Topspeed"],
                'description' => $row["Description_voiture"],
                'marque' => $row["Marque"],
                'photo' => $row["Photo"],
            ];
        }
        mysqli_free_result($view_voiture_result);
        $voitures_clicked = True;
        $display_voiture = ".voiture{display:block;}";
    }

    // Demande
    $demandes_clicked = False;
    $display_demande = null;
    $demandes = [];
    if (isset($_POST["voir_demandes"])){
        include("../Database/connexion.php");
        setlocale(LC_TIME, 'fr_FR.UTF-8', 'fra');
        $view_demande_query = "SELECT a.*, b.Nom, b.Prenom, b.Email, b.Username FROM demande_essaie a JOIN inscription_client b WHERE a.Id_inscription = b.Id_inscription;";
        $view_demande_result = mysqli_query($bdd, $view_demande_query);
        while($row = mysqli_fetch_assoc($view_demande_result)){
            $date = new DateTime($row['Jour']);
            $date_lettres = strftime('%d %B %Y', $date->getTimestamp());
            $heure = new DateTime(datetime: $row['Heure']);
            $heure_new = $heure->format('H:i');
            $demandes[] = [
                'id_demande' => $row["Id_demande"],
                'id_voiture' => $row["Id_voiture"],
                'modele' => $row["Modele"],
                'jour' => $date_lettres,
                'heure' => $heure_new,
                'date' => $row["Jour"],
                'time' => $row["Heure"],
                'numtel' => $row["NumTel"],
                'nom' => $row["Nom"],
                'prenom' => $row["Prenom"],
                'username' => $row["Username"],
                'email' => $row["Email"],
            ];
        }
        mysqli_free_result($view_demande_result);
        $demandes_clicked = True;
        $display_demande = ".demande{display:block;}";
    }

    // Contact
    $contacts_clicked = False;
    $display_contact = null;
    $contacts = [];
    if (isset($_POST["voir_contacts"])){
        include("../Database/connexion.php");
        $view_contact_query = "SELECT * FROM contact;";
        $view_contact_result = mysqli_query($bdd, $view_contact_query);
        while($row = mysqli_fetch_assoc($view_contact_result)){
            $contacts[] = [
                'id_contact' => $row["Id_contact"],
                'nom' => $row["Nom"],
                'prenom' => $row["Prenom"],
                'email' => $row["Email"],
                'message' => $row["Message"],
            ];
        }
        mysqli_free_result($view_contact_result);
        $contacts_clicked = True;
        $display_contact = ".contact{display:block;}";
    }

    // Clients
    $clients_clicked = False;
    $display_client = null;
    $clients = [];
    if (isset($_POST["voir_clients"])){
        include("../Database/connexion.php");
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

    // Évènements
    $evenements_clicked = False;
    $evenement = null;
    $evenements = [];
    if (isset($_POST["voir_evenements"])){
        include("../Database/connexion.php");
        setlocale(LC_TIME, 'fr_FR.UTF-8', 'fra');
        $view_evenement_query = "SELECT * FROM evenement a JOIN marque b ON a.Id_marque = b.Id_marque";
        $view_evenement_result = mysqli_query($bdd, $view_evenement_query);
        while($row = mysqli_fetch_assoc($view_evenement_result)){
            $date_debut = new DateTime($row['Date_debut']);
            $date_debut_lettres = strftime('%d %B %Y', $date_debut->getTimestamp());
            if (!empty($row['Date_fin'])) {
                $date_fin = new DateTime($row['Date_fin']);
                $date_fin_lettres = strftime('%d %B %Y', $date_fin->getTimestamp());
            } else {
                $date_fin_lettres = '';
            }
            $evenements[] = [
                'id_evenement' => $row["Id_evenement"],
                'theme' => $row["Theme"],
                'description' => $row["Description"],
                'prix' => $row["Prix"],
                'location' => $row["Location"],
                'marque' => $row["Marque"],
                'photo' => $row["Photos"],
                'date_debut' => $date_debut_lettres,
                'date_fin' => $date_fin_lettres,
            ];
        }
        mysqli_free_result($view_evenement_result);
        $evenements_clicked = True;
        $display_evenement = ".evenement{display:block;}";
    }

    // Accueil
    $accueil_clicked = False;
    $accueil = null;
    $accueils = [];
    if (isset($_POST["voir_accueil"])){
        include("../Database/connexion.php");
        $view_accueil_query = "SELECT * FROM accueil a JOIN marque b ON a.Id_marque = b.Id_marque ORDER BY Id;";
        $view_accueil_result = mysqli_query($bdd, $view_accueil_query);
        while($row = mysqli_fetch_assoc($view_accueil_result)){
            $accueils[] = [
                'id_accueil' => $row["Id"],
                'marque' => $row["Marque"],
                // 'modele' => $row["Modele"],
                'video' => $row["Video"],
                'description' => $row["Description"],
                'lien_btn' => $row["Lien"],
                'photo' => $row["Photo"],
            ];
        }
        mysqli_free_result($view_accueil_result);
        $accueil_clicked = True;
        $display_accueil = ".accueil{display:block;}";
    }

    // Employées
    $employe_clicked = False;
    $employe = null;
    $employes = [];
    if (isset($_POST["voir_employe"])){
        include("../Database/connexion.php");
        $view_employe_query = "SELECT * FROM admin ORDER BY Id_admin;";
        $view_employe_result = mysqli_query($bdd, $view_employe_query);
        while($row = mysqli_fetch_assoc($view_employe_result)){
            $employes[] = [
                'id_admin' => $row["Id_admin"],
                'nom' => $row["Nom"],
                'motdepasse' => $row["Mot_de_passe"],
            ];
        }
        mysqli_free_result($view_employe_result);
        $employe_clicked = True;
        $display_employe = ".employe{display:block;}";
    }
    
?>