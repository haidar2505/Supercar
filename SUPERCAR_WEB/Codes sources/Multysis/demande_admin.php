<?php
    require("Fonctions/demande_actions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multysis</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
                        <a href="demande_admin.php" class="nav-link fw-bold">Demandes</a>
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
    <!-- Tableau demande -->
    <div class="d-flex flex-column align-items-center justify-content-center">
        <table class="evenement table align-middle mb-0 bg-white border table-hover shadow">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Demande</th>
                    <th>Statut</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
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
                            $statut = $row["Statut"];
                            $nom = $row["Nom"];
                            $prenom = $row["Prenom"];
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
                        <p class="fw-bold mb-1"><?php echo $marque.' '.$modele?></p>
                        <p class="fw-normal mb-1"><?php echo $jour ?> à <?php echo $heure ?></p>
                    </td>
                    <td>
                        <?php
                            if($statut == "En attente"){
                        ?>
                            <span class="px-2 rounded-pill d-inline" style="background-color: #FFC000; font-weight: 500; color: #FFFF8F;"><?php echo $statut ?></span>
                        <?php
                            }elseif($statut == "Confirmé"){
                        ?>
                            <span class="px-2 rounded-pill d-inline" style="background-color: #E4D00A; font-weight: 500; color: #DFFF00;"><?php echo $statut ?></span>
                        <?php
                            }elseif($statut == "Terminé"){
                        ?>
                            <span class="px-2 rounded-pill d-inline" style="background-color: #228B22; font-weight: 500; color: #7CFC00;"><?php echo $statut ?></span>
                        <?php
                            }elseif($statut == "Annulé"){
                        ?>
                            <span class="px-2 rounded-pill d-inline" style="background-color: #8B0000; font-weight: 500; color: #FF4433;"><?php echo $statut ?></span>
                        <?php
                            }
                        ?>
                    </td>
                    <td>
                        <div class="d-flex align-items-center justify-content-center">
                            <form action="" method="POST">
                                <input type="hidden" value="<?php echo $id ?>" name="id_demande">
                                <?php
                                    if($statut == "En attente"){
                                ?>
                                    <input class="rounded-pill px-2 py-2 ms-1 border-0" type="submit" value="CONFIRMER" name="confimer_demande">
                                    <input class="rounded-pill px-2 py-2 ms-1 border-0" type="submit" value="ANNULER" name="annuler_demande">
                                <?php
                                    }elseif($statut == "Confirmé"){
                                ?>
                                    <input class="rounded-pill px-2 py-2 ms-1 border-0" type="submit" value="TERMINER" name="terminer_demande">
                                    <input class="rounded-pill px-2 py-2 ms-1 border-0" type="submit" value="ANNULER" name="annuler_demande">
                                <?php
                                    }elseif($statut == "Terminé"){
                                ?>
                                    <p class="nav-link" style="font-size: 40px; color: green;"><i class='bx bx-check'></i></p>
                                <?php
                                    }elseif($statut == "Annulé"){
                                ?>
                                    <p class="nav-link" style="font-size: 40px; color: red;"><i class='bx bx-x'></i></p>
                                <?php
                                    }
                                ?>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php
                        }
                    mysqli_free_result($admin_demande_result);
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