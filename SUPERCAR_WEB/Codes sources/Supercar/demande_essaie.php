<?php 
    require("Fonctions/demande_essaie_form.php");
    require("Fonctions/deconnection.php");
    require("Fonctions/session_expire.php");
    $is_logged_in = isset($_SESSION["username"]);
    include("../Database/connexion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../Supercar-css/navbar.css">
    <link rel="stylesheet" href="../Supercar-css/demande_essaie.css">
    <title>Supercar</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        .centered{
            height: 70vh;
        }
        <?php
            if ($not_connected == 1){
                echo $modal;
            }
        ?>
    </style>
</head>
<body>
<!-- Navbar -->
    <nav class="navbar navbar-expand-lg py-0 shadow">
        <div class="w-100 d-flex" id="image">
            <?php
                include("../Database/connexion.php");
                $logo = "SELECT * FROM marque WHERE Id_marque = 1;";
                $curseur = mysqli_query($bdd,$logo);
                if ($curseur) {
                    $row = mysqli_fetch_assoc($curseur);
                    if ($row) {
                        $supercarlogo = $row["Logo"];
                    }
                    mysqli_free_result($curseur);
                } else {
                    echo "Error: " . mysqli_error($bdd);
                }
                mysqli_close($bdd);
            ?>
            <a class="navbar-brand mx-auto" href="#">
                <img id="logo" src="../Images/Logos/<?php echo $supercarlogo ?>" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 text-center navmenu">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php" id="accueil">Accueil</a>
                    </li>
                    <li class="nav-item dropdown" id="dropdown">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Voitures
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="ferrari.php">Ferrari</a></li>
                            <li><a class="dropdown-item" href="porsche.php">Porsche</a></li>
                            <li><a class="dropdown-item" href="jeep.php">Jeep</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="evenements.php" id="evenements">Évènements</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="demande_essaie.php" id="essai">Demande d'essai</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php" id="contact">Contactez-nous</a>
                    </li>
                </ul>
                <div class="d-flex me-2" id="buttons">
                    <?php if (!$is_logged_in) { ?>
                    <a href="inscrire.php" class="me-2">
                        <button type="button" class="btn rounded-0" id="btn-1">S'inscrire</button>
                    </a>
                    <a href="connection.php">
                        <button type="button" class="btn rounded-0" id="btn-1">Se connecter</button>
                    </a>
                    <?php } else { ?>
                    <form action="Fonctions/deconnection.php" method="POST" class="d-flex">
                        <input class="btn rounded-0" type="submit" value="Se déconnecter" name="deconnection" id="btn-1">
                    </form>
                    <?php } ?>
                </div>
                <?php if ($is_logged_in) { ?>
                    <p class="mt-3" style="font-size: 13px; width: 74px;">Connecté : <?php echo $_SESSION["username"] ?></p>
                    <i class="ri-circle-fill me-2" id="connected"></i>
                <?php } ?>
            </div>
        </div>
    </nav>
    <!--  -->
    <!-- Formulaire -->
    <form action="" method="POST" class="mt-5 mb-5">
        <div class="text-center">
            <h2 class="text-center mb-5">Faire une demande d'essai</h2>
            <p style="margin-top: 4%;">Il n'y a pas de meilleure façon de découvrir la performance d’une voiture que de prendre le volant.</p>
        </div>
        <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row d-flex justify-content-center w-75 border py-5 px-5" id="consignes">
                <div class="col-4 me-5 d-flex">
                    <i class='bx bx-check me-3' id="check"></i><p>Pour faire une demande, veuillez compléter le formulaire et nous vous contacterons par votre E-mail dans les prochains jours pour confirmer votre demande.</p>
                </div>
                <div class="col-4 ms-5 d-flex">
                    <i class='bx bx-check me-3' id="check"></i><p>Veuillez vous assurer que les informations que vous fournissez sont exactes et complètes</p>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-center w-100" style="margin-top: 4%;">
            <div class="w-50">
                <?php
                    include("../Database/connexion.php");
                    if ($is_logged_in){ 
                        $infos_query = "SELECT Id_inscription, Nom, Prenom, Email FROM inscription_client WHERE Username = '$_SESSION[username]';";
                        $infos_result = mysqli_query($bdd, $infos_query);
                        $get_infos = mysqli_fetch_assoc($infos_result);
                        $id = $get_infos['Id_inscription'];
                        $nom = $get_infos['Nom'];
                        $prenom = $get_infos['Prenom'];
                        $email = $get_infos['Email'];
                ?>
                <div class="w-100 d-flex">
                    <div class="w-50 me-3">
                        <label for="recipient-name" class="col-form-label"><h5 class="fw-normal mb-0">Nom</h5></label>
                        <input type="text" disabled class="form-control" id="input" value="<?php echo $nom ?>">
                        <input type="hidden" value="<?php echo $id ?>">
                    </div>
                    <div class="w-50 me-3">
                        <label for="recipient-name" class="col-form-label"><h5 class="fw-normal mb-0">Prénom</h5></label>
                        <input type="text" disabled class="form-control" id="input" value="<?php echo $prenom ?>">
                        <input type="hidden" value="<?php echo $id ?>">
                    </div>
                </div>
                <label for="recipient-name" class="col-form-label"><h5 class="fw-normal mt-2 mb-0">Email</h5></label>
                <input type="text" disabled class="red_outline form-control" id="input" value="<?php echo $email ?>">
                <?php
                        include("../Database/connexion.php");
                        if(isset($_POST["essayer"])){
                            if($_SESSION['selected_model_id']){
                                $selected_modele = "SELECT a.Modele, b.Marque, b.Logo FROM voiture a JOIN marque b ON a.Id_marque = b.Id_marque WHERE $_SESSION[selected_model_id] = a.Id_voiture;";
                                $curseur = mysqli_query($bdd, $selected_modele);
                                $row = mysqli_fetch_assoc($curseur);
                                if($row){
                                    $modele = $row["Modele"];
                                    $marque = $row["Marque"];
                                }
                            }
                        }
                    }
                ?>
                <label class="col-form-label"><h4 class="mb-0 mt-5">Choisir une modèle<span>*</span></h4></label>
                <select class="form-select mt-3" aria-label="Default select example" name="Modele">
                    <option selected value="<?php echo $id_modele ?>"><?php echo $marque.' '.$modele ?></option>
                    <?php
                        include("../Database/connexion.php");
                        $option_modele = "SELECT a.Id_voiture, a.Modele, b.Marque, b.Logo FROM voiture a JOIN marque b WHERE a.Id_marque = b.Id_marque;";
                        $curseur = mysqli_query($bdd, $option_modele);
                        while($row = mysqli_fetch_assoc($curseur)){
                            $id_voiture = $row["Id_voiture"];
                            $modele = $row["Modele"];
                            $marque = $row["Marque"];
                    ?>
                    <option value="<?php echo $id_voiture; ?>" name="id_voiture"><?php echo $marque.' '.$modele ?></option>
                    <?php
                        }
                        mysqli_free_result($curseur);
                        mysqli_close($bdd);
                    ?>
                </select>
                <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $modele_error ?></p>
                <div class="w-100 d-flex mt-4">
                    <div class="w-50 me-3">
                        <label for="recipient-name" class="col-form-label"><h5 class="fw-normal mb-0">Numéro téléphone<span>*</span></h5></label>
                        <input type="tel" class="form-control" name="NumTel" value="<?php echo $numtel ?>">
                        <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $numtel_error ?></p>
                    </div>
                    <div class="w-25 me-3">
                        <label for="recipient-name" class="col-form-label"><h5 class="fw-normal mb-0">Date<span>*</span></h5></label>
                        <input type="date" class="form-control" id="input" name="Date" value="<?php echo $date ?>">
                        <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;"><?php echo $date_error ?></p>
                    </div>
                    <div class="w-25">
                        <label for="recipient-name" class="col-form-label"><h5 class="fw-normal mb-0">Heure<span>*</span></h5></label>
                        <input type="time" class="form-control" id="input" name="Heure" value="<?php echo $heure ?>">
                        <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;"><?php echo $heure_error ?></p>
                    </div>
                </div>
                <div class="d-flex align-items-center w-100 mt-5 mb-5">
                    <div class="d-flex flex-column">
                        <p class="mb-0"><input type="checkbox" name="checked" value="1" <?php if($checked == 1){ ?> checked <?php } ?>><span> *</span>J'ai lu et compris la politique de confidentialité.</p>
                        <p style="color: red; font-size: 15px;"><?php echo $checked_error ?></p>
                    </div>
                    <div class="w-75 d-flex justify-content-end">
                        <input type="submit" class="w-50 py-3 me-2" value="Envoyer" name="envoyer_demande">
                        <input type="submit" class="w-50 py-3" value="Annuler" name="clear_form" >
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Modal sucess -->
    <div class="modal fade <?php if ($showModal) echo 'show'; ?>" id="exampleModal" tabindex="-1" <?php if ($showModal) echo 'style="display: block;" aria-modal="true"'; ?> aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Envoyer</h5>
                </div>
                <div class="modal-body position-relative">
                    <p class="mb-4">Votre demande a bien envoyer. Nous vous contacterons par E-mail dans les prochains jours</p>
                    <a href="demande_essaie.php"><button type="submit" class="btn btn-secondary w-25 position-absolute bottom-0 end-0">Close</button></a>
                </div>
            </div>
        </div>
    </div>
    <!--  -->
    <!-- Modal failed -->
    <div class="modal fade <?php if ($showModalfailed) echo 'show'; ?>" id="exampleModal" tabindex="-1" <?php if ($showModalfailed) echo 'style="display: block;" aria-modal="true"'; ?> aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pas de compte</h5>
                </div>
                <div class="modal-body position-relative">
                    <p>Vous n'aviez pas de compte. Veulliez créer un <a href="inscrire.php">compte</a> avant pour pouvoir faire une demande</p>
                    <p class="mb-4">Si vous aviez déjà un compte <a href="connection.php">connectez-vous</a></p>
                    <a href="demande_essaie.php"><button type="submit" class="btn btn-secondary w-25 position-absolute bottom-0 end-0">Close</button></a>
                </div>
            </div>
        </div>
    </div>
    <!--  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>


