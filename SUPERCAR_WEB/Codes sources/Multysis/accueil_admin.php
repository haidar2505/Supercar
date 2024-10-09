<?php
    require("Fonctions/ajouter1.php");
    require("Fonctions/supprimer.php");
    require("Fonctions/modify.php");
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
        .table{
            width: 96%;
        }
        .image{
            width: 350px;
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
                    <li class="nav-item fw-bold">
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
    <!-- Tableau accueil -->
    <div class="d-flex flex-column align-items-center justify-content-center">
        <table class="table align-middle mb-0 bg-white border table-hover shadow">
            <thead>
                <tr>
                <th>ID</th>
                <th>Modèle</th>
                <th>Image/Video</th>
                <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include("../Database/connexion.php");
                    $admin_accueil_query = "SELECT * FROM accueil ORDER BY Id;";
                    $admin_accueil_result = mysqli_query($bdd,$admin_accueil_query);
                    if ($admin_accueil_result) {
                        while ($row = mysqli_fetch_assoc($admin_accueil_result)){
                            $id = $row["Id"];
                            // $marque = $row["Marque"];   
                            $video = $row["Video"];
                            $image = $row["Photo"];
                            // $modele = $row["Modele"];
                            // $theme = $row["Theme"];
                ?>
                <tr>
                    <td>
                        <p class="text-muted"><?php echo $id?></p>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div>
                                <!-- <p class="fw-bold"><?php echo $marque.' '.$modele?></p> -->
                                <!-- <p class="fw-bold"><?php echo $theme ?></p> -->
                            </div>
                        </div>
                    </td>
                    <td>
                        <img class="image rounded" src="../Images/Index/Section1/<?php echo $image ?>" alt="Event image">
                    </td>
                    <td>
                        <button type="button" class="btn btn-link btn-sm btn-rounded d-flex">
                            <form action="" method="POST">
                                <input type="hidden" value="<?php echo $id ?>" name="id_event">
                                <input class="rounded-pill px-2 py-2 me-1 border-0" type="submit" value="MODIFIER" name="modifier_evenement_form">
                            </form>
                            <form action="" method="POST">
                                <input type="hidden" value="<?php echo $id ?>" name="id_event">
                                <input class="rounded-pill px-2 py-2 ms-1 border-0" type="submit" value="SUPPRIMER" name="supprimer_evenement" id="btn_actions">
                            </form>
                        </button>
                    </td>
                </tr>
                <?php
                        }
                    mysqli_free_result($admin_accueil_result);
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
</html>