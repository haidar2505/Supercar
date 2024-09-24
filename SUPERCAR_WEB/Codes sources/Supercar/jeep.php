<?php
    require("Fonctions/demande_essaie_form.php");
    require("Fonctions/deconnection.php");
    require("Fonctions/session_expire.php");
    $is_logged_in = isset($_SESSION["username"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css">
    <link rel="stylesheet" href="../Supercar-css/voiture.css">
    <link rel="stylesheet" href="../Supercar-css/navbar.css">
    <title>Supercar</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Shippori+Antique+B1&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Anton&family=Bebas+Neue&family=Shippori+Antique+B1&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
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
                    <p class="mt-3" style="font-family: Poppins, sans-serif; font-size: 13px; width: 74px;">Connecté : <?php echo $_SESSION["username"] ?></p>
                    <i class="ri-circle-fill me-2" id="connected"></i>
                <?php } ?>
            </div>
        </div>
    </nav>
    <!--  -->
    <h1 class="mt-5 mb-5 text-center" style="font-family: Bebas Neue, sans-serif; font-size: 80px;">Jeep</h1>
    <?php
        include("../Database/connexion.php");
        $section2 = "SELECT * FROM voiture WHERE Id_marque = 3;";
        $curseur = mysqli_query($bdd,$section2);
        if ($curseur) {
            while ($row = mysqli_fetch_assoc($curseur)){
                $id = $row["Id_voiture"];
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
    <div class="d-flex justify-content-center align-items-center mt-3 mb-3">
        <div class="w-75 position-relative">
            <img class="w-100 rounded border" src="../Images/Voiture/Jeep/<?php echo $photo ?>">
            <form action="" method="POST">
                <div class="position-absolute d-flex justify-content-center align-items-center flex-column bottom-0 end-0 mb-5">
                    <input class="btn" type="submit" value="Essayer ce modèle" name="essayer" id="essayer">
                    <input type="hidden" value="<?php echo $id ?>" name="Id_modele">
                </div>
            </form>
            <div class="position-absolute top-0 start-50 translate-middle">
                <u><h1 style="font-family: Bebas Neue, sans-serif;"><?php echo $modele ?></h1></u>
            </div>
        </div>
    </div>
    <div class="w-100 d-flex justify-content-center align-items-center mt-4">
        <p class="w-50 text-center" id="description"><?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8') ?></p>
    </div>
    <div class="container mt-3 mb-5">
        <div class="row text-center d-flex align-items-center justify-content-center" id="details">
            <div class="col-12 col-md-6 col-lg-3 mb-3">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <h2><?php echo $moteur ?></h2>
                    <p class="text-muted text-white">MOTEUR <?php echo strtoupper("$typemoteur") ?></p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mb-3">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <h2><?php echo $ch ?> CH</h2>
                    <p class="text-muted text-white">PUISSANCE MAXIMALE (CHEVAUX)</p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mb-3">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <h2><?php echo $tpspeed ?> KM/H</h2>
                    <p class="text-muted text-white">VITESSE MAXIMALE</p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mb-3">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <h2><?php echo $spdtime ?> S</h2>
                    <p class="text-muted text-white">0-100 KM/H</p>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3 mb-3">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <h2><?php echo $prix ?> €</h2>
                    <p class="text-muted text-white">PRIX</p>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
        mysqli_free_result($curseur);
        } else {
            echo "Error: " . mysqli_error($bdd);
        }
        mysqli_close($bdd);
    ?>
    <!-- Modal no account -->
    <div class="modal fade <?php if ($showModalfailed) echo 'show'; ?>" id="exampleModal" tabindex="-1" <?php if ($showModalfailed) echo 'style="display: block;" aria-modal="true"'; ?> aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pas de compte</h5>
                </div>
                <div class="modal-body position-relative">
                    <p style="font-family: Poppins, sans-serif;">Vous n'aviez pas de compte. Veulliez créer un <a href="inscrire.php">compte</a> avant pour pouvoir faire une demande</p>
                    <p class="mb-4" style="font-family: Poppins, sans-serif;">Si vous aviez déjà un compte <a href="connection.php">connectez-vous</a></p>
                    <a href="jeep.php" style="font-family: Poppins, sans-serif;"><button type="submit" class="btn btn-secondary w-25 position-absolute bottom-0 end-0">Close</button></a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>