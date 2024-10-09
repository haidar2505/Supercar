<?php
    require("Fonctions/ajouter1.php");
    require("Fonctions/supprimer.php");
    require("Fonctions/modify.php");
?>
<!DOCTYPE html>
<hl lang="en">
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
        .voiture{
            display: block;
        }
        .form_voiture{
            display: none;
        }
        .modifier_voiture_form{
            display: none;
        }
        .table{
            width: 96%;
        }
        .image{
            width: 350px;
        }
        <?php
            if($clicked_ajouter == true){
                echo $ajouter_voiture_form;
            }
            if($clicked_modifier == true){
                echo $modifier_voiture_form;
            }
        ?>
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="voiture navbar navbar-expand-lg navbar-light bg-white mb-3 border sticky-top">
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
                        <a href="voiture_admin.php" class="nav-link fw-bold">Voitures</a>
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
    <!-- Tableau voiture -->
    <div class="voiture d-flex flex-column align-items-center justify-content-center">
        <form action="" method="POST" class="voiture btn_ajouter mb-3 border bg-white shadow">
            <input type="submit" name="ajouter_voiture_form" class="btn border-0" value="Ajouter un modèle">
        </form>
        <table class="voiture table align-middle mb-0 bg-white border table-hover shadow">
            <thead>
                <tr>
                <th>ID</th>
                <th width="20%">Modèle</th>
                <th>Description</th>
                <th>Image</th>
                <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include("../Database/connexion.php");
                    $admin_voiture_query = "SELECT * FROM voiture a JOIN marque b ON a.Id_marque = b.Id_marque ORDER BY Id_voiture;";
                    $admin_voiture_result = mysqli_query($bdd,$admin_voiture_query);
                    if ($admin_voiture_result) {
                        while ($row = mysqli_fetch_assoc($admin_voiture_result)){
                            $id = $row["Id_voiture"];
                            $marque = $row["Marque"];
                            $modele = $row["Modele"];
                            $photo = $row["Photo"];
                            $prix = $row["Prix"];
                            $moteur = $row["Moteur"];
                            $typemoteur = $row["TypeMoteur"];
                            $ch = $row["Chevaux"];
                            $tpspeed = $row["Topspeed"];
                            $spdtime = $row["Speedtime"];
                            $description = $row["Description_voiture"];
                ?>
                <tr>
                    <td>
                        <p class="text-muted"><?php echo $id ?></p>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="fw-bold mb-1"><?php echo $marque.' '.$modele ?></p>
                                <p class="text-muted mb-0"><?php echo $typemoteur.', '.$moteur.', '.$ch.'ch' ?></p>
                                <p class="text-muted mb-0"><?php echo $tpspeed.'km/h, 0-100km/h : '.$spdtime.'s' ?></p>
                                <p class="text-muted mb-0"><?php echo $prix.' €' ?></p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="fw-normal mb-1"><?php echo $description ?></p>
                    </td>
                    <td>
                        <img class="image rounded" src="<?php echo '../Images/Voiture/'.$marque.'/'.$photo ?>" alt="Voiture image">
                    </td>
                    <td>
                        <button type="button" class="btn btn-link btn-sm btn-rounded d-flex">
                            <form action="" method="POST">
                                <input type="hidden" value="<?php echo $id ?>" name="id_voiture_modifier">
                                <input class="rounded-pill px-2 py-2 me-1 border-0" type="submit" value="MODIFIER" name="modifier_voiture_form" id="btn_actions">
                            </form>
                            <form action="" method="POST">
                                <input type="hidden" value="<?php echo $id ?>" name="id_voiture">
                                <input class="rounded-pill px-2 py-2 ms-1 border-0" type="submit" value="SUPPRIMER" name="supprimer_voiture" id="btn_actions">
                            </form>
                        </button>
                    </td>
                </tr>
                <?php
                        }
                    mysqli_free_result($admin_voiture_result);
                    } else {
                        echo "Error: " . mysqli_error($bdd);
                    }
                    mysqli_close($bdd);
                ?>
            </tbody>
        </table>
    </div>
    <!--  -->
    <!-- Modifier voiture -->
    <a href="voiture_admin.php" class="modifier_voiture_form"><button class="button border bg-light px-3 py-2 mt-2 ms-2">Retour</button></a>
    <form action="" method="POST" class="modifier_voiture_form mb-5">
        <div class="w-100 d-flex align-items-center justify-content-center mt-3">
            <div class="border w-50 py-4">
                <input type="hidden" name="marque_current" value="<?php echo $marque_current ?>">
                <h1 class="text-center mb-3"><?php echo $marque_current.' '.$modele_modified ?></h1>
                <div class="ms-5 me-5 d-flex flex-column">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex flex-column w-100 me-2">
                            <label for="recipient-name" class="col-form-label">Modèle<span>*</span></label>
                            <input type="text" class="form-control" name="modele_modified" value="<?php echo $modele_modified ?>">
                            <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $modele_modified_error ?></p>
                        </div>
                        <div class="flex-column w-100 ms-2">
                            <label for="recipient-name" class="col-form-label">Type moteur<span>*</span></label>
                            <select class="form-select" aria-label="Default select example" name="typemoteur_modified">
                                <option selected><?php echo $typemoteur_modified ?></option>
                                <option>Électrique</option>
                                <option>Hybride rechargeable</option>
                                <option>Combustion</option>
                            </select>
                            <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $typemoteur_modified_error ?></p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="flex-column w-100">
                            <label for="recipient-name" class="col-form-label">Moteur<span>*</span></label>
                            <input type="text" class="form-control" name="moteur_modified" value="<?php echo $moteur_modified ?>">
                            <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $moteur_modified_error ?></p>
                        </div>
                        <div class="flex-column w-100 ms-2">
                            <label for="recipient-name" class="col-form-label">Prix :<span>*</span></label>
                            <input type="text" class="form-control" name="prix_modified" value="<?php echo $prix_modified ?>">
                            <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $prix_modified_error ?></p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="flex-column w-100 me-2">
                            <label for="recipient-name" class="col-form-label">Chevaux (hp)<span>*</span></label>
                            <input type="text" class="form-control" name="chevaux_modified" value="<?php echo $chevaux_modified ?>">
                            <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $chevaux_modified_error ?></p>
                        </div>
                        <div class="flex-column w-100 me-2 ms-2">
                            <label for="recipient-name" class="col-form-label">Vitesse maximale (km/h)<span>*</span></label>
                            <input type="text" class="form-control" name="topspeed_modified" value="<?php echo $topspeed_modified ?>">
                            <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $topspeed_modified_error ?></p>
                        </div>
                        <div class="flex-column w-100 ms-2">
                            <label for="recipient-name" class="col-form-label">Temps de vitesse (0-100 km/h) :<span>*</span></label>
                            <input type="text" class="form-control" name="speedtime_modified" value="<?php echo $speedtime_modified ?>">
                            <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $speedtime_modified_error ?></p>
                        </div>
                    </div>
                    <label for="recipient-name" class="col-form-label">Description<span>*</span></label>
                    <textarea rows="8" cols="80" name="description_modified"><?php echo htmlspecialchars_decode($description_modified, ENT_QUOTES) ?></textarea>
                    <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $description_modified_error ?></p>
                    <div class="d-flex align-items-center justify-content-center mt-3">
                        <div class="d-flex flex-column">
                            <label for="recipient-name" class="col-form-label">Image<span>*</span></label>
                            <input type="file" class="form-control me-3" name="photo_modified">
                        </div>
                        <img src="../Images/Voiture/<?php echo $marque_current."/". $photo_modified ?>" width="500px" class="rounded ms-3" alt="Voiture image">
                    </div>
                    <div class="d-flex align-items-center justify-content-around w-100 mt-3 mb-3">
                        <input class="btn rounded border" type="submit" value="Modifier" name="modifier_voiture">
                        <input type="hidden" name="id_voiture_modifier" value="<?php echo $id_modele_modified ?>">
                        <input type="submit" class="btn rounded border" name="modifier_voiture_form" value="Réinitialiser">
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--  -->
    <!-- Ajouter voiture formulaire -->
    <a href="voiture_admin.php" class="form_voiture"><button class="button border bg-light px-3 py-2 mt-2 ms-2">Retour</button></a>
    <form action="" method="POST" class="form_voiture">
        <div class="w-100 d-flex align-items-center justify-content-center mt-3">
            <div class="border w-50 py-4">
                <h1 class="text-center mb-3">Ajouter un modèle</h1>
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
                        <label for="recipient-name" class="col-form-label">Modèle<span>*</span></label>
                        <input type="text" class="form-control" name="modele_ajouter" value="<?php echo $modele_ajouter ?>">
                        <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $modele_ajouter_error ?></p>
                    </div>
                    <div class="flex-column w-50 ms-2">
                        <label for="recipient-name" class="col-form-label">Prix<span>*</span></label>
                        <input type="text" class="form-control" name="prix_ajouter" value="<?php echo $prix_ajouter ?>">
                        <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $prix_ajouter_error ?></p>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex flex-column w-100 me-2">
                        <label for="recipient-name" class="col-form-label">Moteur<span>*</span></label>
                        <input type="text" class="form-control" name="moteur_ajouter" value="<?php echo $moteur_ajouter ?>">
                        <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $moteur_ajouter_error ?></p>
                    </div>
                    <div class="flex-column w-100 ms-2">
                        <label for="recipient-name" class="col-form-label">Type moteur<span>*</span></label>
                        <select class="form-select" aria-label="Default select example" name="typemoteur_ajouter">
                            <option selected><?php echo $typemoteur_ajouter ?></option>
                            <option>Électrique</option>
                            <option>Hybride rechargeable</option>
                            <option>Combustion</option>
                        </select>
                        <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $typemoteur_ajouter_error ?></p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="flex-column w-100 me-2">
                        <label for="recipient-name" class="col-form-label">Chevaux (hp)<span>*</span></label>
                        <input type="text" class="form-control" name="ch_ajouter" value="<?php echo $chevaux_ajouter ?>">
                        <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $chevaux_ajouter_error ?></p>
                    </div>
                    <div class="flex-column w-100 me-2 ms-2">
                        <label for="recipient-name" class="col-form-label">Topspeed<span>*</span></label>
                        <input type="text" class="form-control" name="tpspeed_ajouter" value="<?php echo $topspeed_ajouter ?>">
                        <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $topspeed_ajouter_error ?></p>
                    </div>
                    <div class="flex-column w-100 ms-2">
                        <label for="recipient-name" class="col-form-label">Speedtime (0-100km/h)<span>*</span></label>
                        <input type="text" class="form-control" name="spdtime_ajouter" value="<?php echo $speedtime_ajouter ?>">
                        <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $speedtime_ajouter_error ?></p>
                    </div>
                </div>
                <label for="recipient-name" class="col-form-label">Description<span>*</span></label>
                <textarea rows="8" name="description_ajouter"><?php echo $description_ajouter ?></textarea>
                <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $description_ajouter_error ?></p>
                <label for="recipient-name" class="col-form-label">Image<span>*</span></label>
                <input type="file" name="image_ajouter" value="<?php echo $image_ajouter ?>">
                <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $image_ajouter_error ?></p>
                <div class="d-flex align-items-center justify-content-around w-100 mt-3 mb-3">
                    <input class="btn rounded w-25 border" type="submit" value="Ajouter" name="ajouter_voiture">
                    <input type="submit" class="btn rounded border" name="ajouter_form_clear" value="Annuler">
                </div>
            </div>
        </div>
    </form>
    <!--  -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>