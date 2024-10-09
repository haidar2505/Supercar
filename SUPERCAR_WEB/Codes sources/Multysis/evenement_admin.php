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
        .evenement{
            display: block;
        }
        .evenement_form{
            display: none;
        }
        .modifier_evenement_form{
            display: none;
        }
        .table{
            width: 96%;
        }
        .image{
            width: 350px;
        }
        <?php
            if ($clicked_ajouter_evenement == true){
                echo $ajouter_evenement_form;
            }
            if($clicked_modifier == true){
                echo $modifier_evenement_form;
            }
        ?>
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="evenement navbar navbar-expand-lg navbar-light bg-white mb-3 border sticky-top">
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
                        <a href="evenement_admin.php" class="nav-link fw-bold">Évènements</a>
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
    <!-- Tableau évènements -->
    <div class="evenement d-flex flex-column align-items-center justify-content-center">
        <form action="" method="POST" class="evenement btn_ajouter mb-3 border bg-white shadow">
            <button name="ajouter_evenements_form" class="btn border-0">Ajouter un évènement</button>
        </form>
        <table class="evenement table align-middle mb-0 bg-white border table-hover shadow">
            <thead>
                <tr>
                <th>ID</th>
                <th>Modèle</th>
                <th width="20%">Spécifiques</th>
                <th>Description</th>
                <th>Image</th>
                <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include("../Database/connexion.php");
                    setlocale(LC_TIME, 'fr_FR.UTF-8', 'fra');
                    $admin_evenement_query = "SELECT * FROM evenement a JOIN marque b ON a.Id_marque = b.Id_marque ORDER BY Id_evenement;";
                    $admin_evenement_result = mysqli_query($bdd,$admin_evenement_query);
                    if ($admin_evenement_result) {
                        while ($row = mysqli_fetch_assoc($admin_evenement_result)){
                            $date_debut = new DateTime($row['Date_debut']);
                            $date_debut_lettres = strftime('%d %B %Y', $date_debut->getTimestamp());
                            if (!empty($row['Date_fin'])) {
                                $date_fin = new DateTime($row['Date_fin']);
                                $date_fin_lettres = strftime('%d %B %Y', $date_fin->getTimestamp());
                            } else {
                                $date_fin_lettres = '';
                            }
                            $id = $row["Id_evenement"];
                            $marque = $row["Marque"];
                            $theme = $row["Theme"];
                            $date_d = $date_debut_lettres;
                            $date_f = $date_fin_lettres;
                            $description = $row["Description"];
                            $image = $row["Photos"];
                            $prix = $row["Prix"];
                            $location = $row["Location"];
                ?>
                <tr>
                    <td>
                        <p class="text-muted"><?php echo $id?></p>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="fw-bold"><?php echo $marque?></p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="fw-bold mb-1"><?php echo $theme ?></p>
                        <p class="mb-0"><?php echo $location ?></p>
                        <?php
                            if (!$date_f){
                        ?>
                        <p class="text-muted mb-0"><?php echo $date_d ?></p>
                        <?php
                            }else{
                        ?>
                        <p class="text-muted mb-0"><?php echo $date_d ?> à <?php echo $date_f ?></p>
                        <?php
                            }
                        ?>
                        <?php
                            if (!$prix){
                        ?>
                        <p class="text-muted mb-0">Gratuit</p>
                        <?php 
                            }else{
                        ?>
                        <p class="text-muted mb-0"><?php echo $prix." €" ?></p>
                        <?php
                            }
                        ?>
                    </td>
                    <td>
                        <p class="fw-normal mb-1"><?php echo $description?></p>
                    </td>
                    <td>
                        <img class="image rounded" src="../Images/Evenements/<?php echo $image ?>" alt="Event image">
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
                    mysqli_free_result($admin_evenement_result);
                    } else {
                        echo "Error: " . mysqli_error($bdd);
                    }
                    mysqli_close($bdd);
                ?>
            </tbody>
        </table>
    </div>
    <!--  -->
    <!-- Modifier évènement -->
    <a href="evenement_admin.php" class="modifier_evenement_form"><button class="button border bg-light px-3 py-2 mt-2 ms-2">Retour</button></a>
    <form action="" method="POST" class="modifier_evenement_form mb-5">
        <div class="w-100 d-flex align-items-center justify-content-center mt-3">
            <div class="border w-50 py-4">
                <h1 class="text-center mb-3"><?php echo $theme_modified ?></h1>
                <div class="ms-5 me-5 d-flex flex-column">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex flex-column w-100 me-2">
                            <input type="hidden" class="form-control" name="id_event" value="<?php echo $id_evenement_modified ?>">
                            <label for="recipient-name" class="col-form-label">Thème<span>*</span></label>
                            <input type="text" class="form-control" name="theme_modified" value="<?php echo $theme_modified ?>">
                            <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $theme_modified_error ?></p>
                        </div>
                        <div class="flex-column w-100 ms-2">
                            <label for="recipient-name" class="col-form-label">Prix (€)<span>*</span></label>
                            <input type="text" class="form-control" name="prix_modified" value="<?php echo $prix_modified ?>">
                            <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $prix_modified_error ?></p>
                        </div>
                    </div>
                    <label for="recipient-name" class="col-form-label">Location<span>*</span></label>
                    <input type="text" class="form-control" name="location_modified" value="<?php echo $location_modified ?>">
                    <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $location_modified_error ?></p>
                    <div class="d-flex">
                        <div class="flex-column w-100 me-2">
                            <label for="recipient-name" class="col-form-label">Date début<span>*</span></label>
                            <input type="date" class="form-control" name="date_d_modified" value="<?php echo $date_d_modified ?>">
                            <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $date_d_modified_modified_error ?></p>
                        </div>
                        <div class="flex-column w-100 ms-2">
                            <label for="recipient-name" class="col-form-label">Date fin<span>*</span></label>
                            <input type="date" class="form-control" name="date_f_modified" value="<?php echo $date_f_modified ?>">
                        </div>
                    </div>
                    <label for="recipient-name" class="col-form-label">Description<span>*</span></label>
                    <textarea rows="8" cols="80" name="description_modified"><?php echo htmlspecialchars_decode($description_modified, ENT_QUOTES) ?></textarea>
                    <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $description_modified_error ?></p>
                    <div class="d-flex align-items-center justify-content-center mt-3">
                        <div class="d-flex flex-column">
                            <label for="recipient-name" class="col-form-label">Image<span>*</span></label>
                            <input type="file" class="form-control me-3" name="photo_modified">
                            <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $photo_modified_error ?></p>
                        </div>
                        <img src="../Images/Evenements/<?php echo $photo_modified ?>" width="500px" class="rounded ms-3" alt="Event image">
                    </div>
                    <div class="d-flex align-items-center justify-content-around w-100 mt-3 mb-3">
                        <input class="btn rounded border" type="submit" value="Modifier" name="modifier_evenement">
                        <input type="submit" class="btn rounded border" name="modifier_evenement_form" value="Réinitialiser">
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--  -->
    <!-- Ajouter évènement form -->
    <a href="evenement_admin.php" class="evenement_form"><button class="button border bg-light px-3 py-2 mt-2 ms-2">Retour</button></a>
    <form action="" method="POST" class="evenement_form">
        <div class="w-100 d-flex align-items-center justify-content-center mt-3">
            <div class="border w-50 py-4">
                <h1 class="text-center mb-3">Ajouter un évènement</h1>
                <div class="ms-5 me-5 d-flex flex-column">
                    <label for="recipient-name" class="col-form-label">Choisir une marque<span>*</span></label>
                    <select class="form-select" aria-label="Default select example" name="marque_ajouter">
                    <option selected><?php echo $marque_ajouter ?></option>
                    <?php
                        include("../Database/connexion.php");
                        $option_marque_query = "SELECT Id_marque, Marque FROM marque WHERE Id_marque > 1";
                        $option_marque_result = mysqli_query($bdd, $option_marque_query);
                            while($row = mysqli_fetch_assoc($option_marque_result)){
                                $id_marque = $row["Id_marque"];
                                $marque = $row["Marque"];
                    ?>
                    <option><?php echo $marque?></option>
                    <?php
                        }
                        mysqli_free_result($option_marque_result);
                        mysqli_close($bdd);
                    ?>
                </select>
                <p style="color: red; font-size: 15px; margin: 1% 0 1% 0;"><?php echo $marque_ajouter_error ?></p>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex flex-column w-100 me-2">
                            <label for="recipient-name" class="col-form-label">Thème<span>*</span></label>
                            <input type="text" class="form-control" name="theme_ajouter" value="<?php echo $theme_ajouter ?>">
                            <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $theme_ajouter_error ?></p>
                        </div>
                        <div class="flex-column w-100 ms-2">
                            <label for="recipient-name" class="col-form-label">Location<span>*</span></label>
                            <input type="text" class="form-control" name="location_ajouter" value="<?php echo $location_ajouter ?>">
                            <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $location_ajouter_error ?></p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="flex-column w-100 me-2">
                            <label for="recipient-name" class="col-form-label">Date début<span>*</span></label>
                            <input type="date" class="form-control" name="date_d_ajouter" value="<?php echo $date_d_ajouter ?>">
                            <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $date_d_ajouter_error ?></p>
                        </div>
                        <div class="flex-column w-100 me-2 ms-2">
                            <label for="recipient-name" class="col-form-label">Date fin<span>*</span></label>
                            <input type="date" class="form-control" name="date_f_ajouter" value="<?php echo $date_f_ajouter ?>">
                        </div>
                        <div class="flex-column w-100 me-2 ms-2">
                            <label for="recipient-name" class="col-form-label">Prix (euros)<span>*</span></label>
                            <input type="text" class="form-control" name="prix_ajouter" value="<?php echo $prix_ajouter ?>">
                            <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $prix_ajouter_error ?></p>
                        </div>
                    </div>
                    <label for="recipient-name" class="col-form-label">Description<span>*</span></label>
                    <textarea rows="8" name="description_ajouter"><?php echo $description_ajouter ?></textarea>
                    <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $description_ajouter_error ?></p>
                    <label for="recipient-name" class="col-form-label">Image<span>*</span></label>
                    <input type="file" name="image_ajouter" value="<?php echo $image_ajouter ?>">
                    <img src="../Images/Evenement/"<?php echo $image_ajouter ?> alt="">
                    <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $image_ajouter_error ?></p>
                    <div class="d-flex align-items-center justify-content-around w-100 mt-3 mb-3">
                        <input class="btn rounded w-25 border" type="submit" value="Ajouter" name="ajouter_evenement">
                        <input type="submit" class="btn rounded border" name="ajouter_form_clear" value="Annuler">
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--  -->
</body>