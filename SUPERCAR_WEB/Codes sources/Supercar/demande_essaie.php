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
    <form action="" method="POST">
        <div class="centered d-flex align-items-center justify-content-center">
            <div class=" d-flex flex-column justify-content-center w-25 border mt-5 px-2 rounded me-5">
                <h4 class="text-center mt-3">Demande d'essai</h4>
                <?php
                    $heure_demande = $modele_demande = $jour_demande = NULL;
                    include("../Database/connexion.php");
                    if ($is_logged_in){ 
                        $infos_query = "SELECT Id_inscription, Nom, Prenom, Email FROM inscription_client WHERE Username = '$_SESSION[username]';";
                        $infos_result = mysqli_query($bdd, $infos_query);
                        $get_infos = mysqli_fetch_assoc($infos_result);
                        $id = $get_infos['Id_inscription'];
                        $nom = $get_infos['Nom'];
                        $prenom = $get_infos['Prenom'];
                        $email = $get_infos['Email'];
                        $demande_query = "SELECT * FROM demande_essaie WHERE Id_inscription = $id;";
                        $demande_result = mysqli_query($bdd, $demande_query);
                ?>
                    <label for="recipient-name" class="col-form-label">Nom complète</label>
                    <input type="text" disabled class="form-control" id="input" value="<?php echo $nom.' '.$prenom ?>">
                    <input type="hidden" value="<?php echo $id ?>">
                    <label for="recipient-name" class="col-form-label">Email</label>
                    <input type="text" disabled class="red_outline form-control" id="input" value="<?php echo $email ?>">
                <?php                
                    }
                ?>
                <label for="recipient-name" class="col-form-label">Numéro téléphone<span>*</span></label>
                <input type="tel" class="red_outline form-control" name="NumTel" value="<?php echo $numtel ?>">
                <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $numtel_error ?></p>
                <label for="recipient-name" class="col-form-label">Choisir une modèle<span>*</span></label>
                <select class="red_outline form-select" aria-label="Default select example" name="Modele">
                    <option selected value="<?php echo $id_modele ?>"><?php echo $marque.' '.$modele ?></option>
                    <?php
                        include("../Database/connexion.php");
                        $option_modele = "SELECT a.Id_voiture, a.Modele, b.Marque, b.Logo FROM voiture a JOIN marque b WHERE a.Id_marque = b.Id_marque;";
                        $curseur = mysqli_query($bdd, $option_modele);
                        if ($curseur){
                            while($row = mysqli_fetch_assoc($curseur)){
                                $id_voiture = $row["Id_voiture"];
                                $modele = $row["Modele"];
                                $marque = $row["Marque"];
                                $selected = '';
                            if (isset($_SESSION['selected_model_id']) && $_SESSION['selected_model_id'] == $id_voiture) {
                                $selected = 'selected';
                            }
                            echo "<option value=\"$id_voiture\" $selected>$marque $modele</option>";
                    ?>
                    <option value="<?php echo $id_voiture; ?>" name="id_voiture"><?php echo $marque.' '.$modele ?></option>
                    <img src="../Images/Logos/<?php echo $logo ?>">
                    <?php
                        }
                        mysqli_free_result($curseur);
                        } else {
                            echo "Error: " . mysqli_error($bdd);
                        }
                        mysqli_close($bdd);
                    ?>
                </select>
                <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $modele_error ?></p>
                <div class="d-flex w-100">
                    <div class="d-felx flex-column w-100">
                        <label for="recipient-name" class="col-form-label">Date<span>*</span></label>
                        <input type="date" class="red_outline form-control" id="input" name="Date" value="<?php echo $date ?>">
                        <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $date_error ?></p>
                    </div>
                    <div class="d-felx flex-column w-100">
                        <label for="recipient-name" class="col-form-label">Heure<span>*</span></label>
                        <input type="time" class="red_outline form-control" id="input" name="Heure" value="<?php echo $heure ?>">
                        <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $heure_error ?></p>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-around w-100 mt-4 mb-3">
                    <input class="w-25 p-2" type="submit" value="Envoyer" name="envoyer_demande" id="btn-1">
                    <input type="submit" class="w-25 p-2" name="clear_form" value="Annuler" id="btn-1">
                </div>
            </div>
            <?php
            if ($is_logged_in){
            ?>
            <div class="d-flex flex-column justify-content-center w-25 border mt-5 rounded ms-5 px-3">
                <h4 class="text-center mt-3">Demande d'essai faite</h4>
                <?php
                    include("../Database/connexion.php");
                    if (mysqli_num_rows($demande_result) > 0) {
                        $demande_query1 = "SELECT Id_inscription, Modele, Jour, Heure FROM demande_essaie WHERE Id_inscription = $id;";
                        $demande_result1 = mysqli_query($bdd, $demande_query1);
                        while ($get_demande = mysqli_fetch_assoc($demande_result1)) {
                            $id_demande = $get_demande['Id_inscription'];
                            $modele_demande = $get_demande['Modele'];
                            $jour_demande = $get_demande['Jour'];
                            $jour_demande_letters = new DateTime($jour_demande);
                            $jour_demande_new = $jour_demande_letters->format('d F Y');
                            $heure_demande = $get_demande['Heure'];
                            $heure_demande_A = new DateTime($heure_demande);
                            $heure_demande_new = $heure_demande_A->format('H:i');
                            echo "<p class='text-justify mt-4'>Vous avez soumis une demande d'essai pour le modèle $modele_demande pour le $jour_demande_new à $heure_demande_new.</p>";
                        }
                    }else{
                        echo "<p class='text-center mt-4'>Aucun demande essaie faite.</p>";

                    }
                ?>
            </div>
            <?php
            }
            ?>
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


