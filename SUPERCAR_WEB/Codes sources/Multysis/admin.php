<?php
    require("Fonctions/deconnection_admin.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css">
    <title>Multysis</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
        * {
            margin: 0; 
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        #icon{
            font-size: 100px;
        }
        .card_link,.col-2{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 400px;
            width: 300px;
            transition: all 1s ease-in-out;
        }
        .col-2:hover{
            border: 1px solid black;
        }
        .col-4{
            height: 80vh;
        }
        .col-4:hover{
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white mb-3 border sticky-top">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarLeftAlignExample">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a href="admin.php" class="nav-link fw-bold">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="accueil_admin.php" class="nav-link">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a href="voiture_admin.php" class="nav-link">Voitures</a>
                    </li>
                    <li class="nav-item">
                        <a href="evenement_admin.php" class="nav-link">Évènements</a>
                    </li>
                    <li class="nav-item">
                        <a href="demande_admin.php" class="nav-link">Demandes</a>
                    </li>
                    <li class="nav-item">
                        <a href="contact_admin.php" class="nav-link">Contacts</a>
                    </li>
                    <li class="nav-item">
                        <a href="client_admin.php" class="nav-link">Utilisateurs</a>
                    </li>
                    <li class="nav-item">
                        <a href="employe_admin.php" class="nav-link">Employées</a>
                    </li>
                </ul>
                <form action="" method="POST" class="d-flex">
                    <i class="ri-logout-circle-line"></i><input type="submit" class="nav-link border-0 bg-white" name="deconnection" value="Déconnexion">
                </form>
            </div>
        </div>
    </nav>
    <!--  -->
    <!-- Tableau admin -->
    <div class="mt-5 d-flex">
        <div class="row mb-0">
            <a href="client_admin.php" class="col-2 card_link nav-link ms-5 me-5 rounded-4 shadow">
                <p class="text-center mb-0"><i class="ri-user-3-line" id="icon"></i></p>
                <?php
                    include("../Database/connexion.php");
                    $nb_utilisateurs_query = "SELECT COUNT(Id_inscription) AS client_total FROM inscription_client;";
                    $nb_utilisateurs_result = mysqli_query($bdd, $nb_utilisateurs_query);
                    if($nb_utilisateurs_result->num_rows > 0){
                        $nb_utilisateurs = $nb_utilisateurs_result->fetch_assoc();
                ?>
                <h1 class="text-center fw-normal mt-0"><?php echo $nb_utilisateurs['client_total'] ?></h1>
                <?php
                    }
                ?>
                <h5 class="text-muted text-center mb-4">Clients</h5>
            </a>
            <a href="voiture_admin.php" class="col-2 card_link nav-link ms-5 me-5 rounded-4 shadow">
                <p class="text-center mb-0"><i class="ri-car-line" id="icon"></i></p>
                <?php
                    include("../Database/connexion.php");
                    $nb_voitures_query = "SELECT COUNT(Id_voiture) AS voiture_total FROM voiture;";
                    $nb_voitures_result = mysqli_query($bdd, $nb_voitures_query);
                    if($nb_voitures_result->num_rows > 0){
                        $nb_voitures = $nb_voitures_result->fetch_assoc();
                ?>
                <h1 class="text-center fw-normal mt-0"><?php echo $nb_voitures['voiture_total'] ?></h1>
                <?php
                    }
                ?>
                <h5 class="text-muted text-center mb-4">Voitures</h5>
            </a>
            <a href="employe_admin.php" class="card_link nav-link col-2 ms-5 me-5 rounded-4 shadow">
                <p class="text-center mb-0"><i class="ri-user-3-line" id="icon"></i></p>
                <?php
                    include("../Database/connexion.php");
                    $nb_admin_query = "SELECT COUNT(Id_admin) AS admin_total FROM admin;";
                    $nb_admin_result = mysqli_query($bdd, $nb_admin_query);
                    if($nb_admin_result->num_rows > 0){
                        $nb_admin = $nb_admin_result->fetch_assoc();
                ?>
                <h1 class="text-center fw-normal mt-0"><?php echo $nb_admin['admin_total'] ?></h1>
                <?php
                    }
                ?>
                <h5 class="text-muted text-center mb-4">Employé(e)s</h5>
            </a>
            <div class="border ms-5 me-5">
                <p>.</p>
            </div>
        </div>
        <a href="demande_admin.php" class="nav-link col-4 px-4 py-4 ms-5 me-5 shadow rounded-4">
            <h3 class="text-center mb-4">Demandes d'essai</h3>
            <?php
                include("../Database/connexion.php");
                setlocale(LC_TIME, 'fr_FR.UTF-8', 'fra');
                $admin_demande_query = "SELECT * FROM demande_essaie a JOIN inscription_client b ON a.Id_inscription = b.Id_inscription JOIN marque c ON a.Id_marque = c.Id_marque ORDER BY Id_demande;";
                $admin_demande_result = mysqli_query($bdd,$admin_demande_query);
                if ($admin_demande_result) {
                    while ($row = mysqli_fetch_assoc($admin_demande_result)){
                        $date = new DateTime($row['Jour']);
                        $date_lettres = strftime('%d %B %Y', $date->getTimestamp());
                        $heure = new DateTime(datetime: $row['Heure']);
                        $heure_new = $heure->format('H:i');
                        $id = $row["Id_demande"];
                        $marque = $row["Marque"];
                        $modele = $row["Modele"];
                        $jour = $date_lettres;
                        $heure = $heure_new;
                        $numtel = $row["NumTel"];
                        $nom = $row["Nom"];
                        $prenom = $row["Prenom"];
                        $email = $row["Email"];
                        $username = $row["Username"];
            ?>
            <p><?php echo $nom.' '.$prenom.' ('.$username.') : '.$marque.' '.$modele.'pour le '.$jour.' à '.$heure ?></p>
            <?php
                    }
                }
            ?>
        </a>
    </div>
    <!--  -->
</body>
</html>