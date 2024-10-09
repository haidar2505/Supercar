<?php
    require("Fonctions/supprimer.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multysis</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        .table{
            width: 96%;
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
                        <a href="admin.php" class="nav-link">Home</a>
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
                        <a href="client_admin.php" class="nav-link fw-bold">Utilisateurs</a>
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
    <!-- Tableau utilisateurs -->
    <div class="d-flex flex-column align-items-center justify-content-center">
        <table class="evenement table align-middle mb-0 bg-white border table-hover shadow">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Ville</th>
                    <!-- <th>Mot de passe</th> -->
                </tr>
            </thead>
            <tbody>
                <?php
                    include("../Database/connexion.php");
                    $admin_client_query = "SELECT * FROM inscription_client ORDER BY Id_inscription;";
                    $admin_client_result = mysqli_query($bdd,$admin_client_query);
                    if ($admin_client_result) {
                        while ($row = mysqli_fetch_assoc($admin_client_result)){
                            $id = $row["Id_inscription"];
                            $nom = $row["Nom"];
                            $prenom = $row["Prenom"];
                            $ville = $row["Ville"];
                            $numtel = $row["NumTel"];
                            $email = $row["Email"];
                            $username = $row["Username"];
                ?>
                <tr>
                    <td>
                        <p class="text-muted"><?php echo $id?></p>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="fw-bold mb-1"><?php echo $nom.' '.$prenom.' ('.$username.')'?></p>
                                <p class="text-muted mb-0"><?php echo $email ?></p>
                                <p class="text-muted mb-0"><?php echo $numtel ?></p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="fw-normal mb-1"><?php echo $ville ?></p>
                    </td>
                    <!-- <td>
                        <p class="text-muted mb-1"><?php echo $client['motdepasse'] ?></p>
                    </td> -->
                </tr>
                <?php
                        }
                    mysqli_free_result($admin_client_result);
                    } else {
                        echo "Error: " . mysqli_error($bdd);
                    }
                    mysqli_close($bdd);
                ?>
            </tbody>
        </table>
    </div>
    <!--  -->
</body>