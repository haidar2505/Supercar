<?php 
    require("Fonctions/deconnection.php"); 
    require("Fonctions/session_expire.php");
    require("Fonctions/demande_essaie_form.php");
    $is_logged_in = isset($_SESSION["username"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../Supercar-css/index.css">
    <link rel="stylesheet" href="../Supercar-css/navbar.css">
    <link rel="stylesheet" href="../Supercar-css/footer.css">
    <title>Supercar</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        body {
            overflow-x: hidden;
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
                    <!-- <form action="Fonctions/deconnection.php" method="POST" >
                        <div class="btn-group dropstart d-flex align-items-center justify-content-center">
                            <button type="button" class="btn rounded-circle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false" id="profile">
                                <i class='bx bx-user' style="font-size: 25px; color: #999999;"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><button class="dropdown-item" type="button">Another action</button></li>
                                <li><button class="dropdown-item" type="button">Something else here</button></li>
                                <li><input class="dropdown-item border-0" type="submit" value="Se déconnecter" name="deconnection"></li>
                            </ul>
                        </div>
                    </form> -->
                <?php } ?>
            </div>
        </div>
    </nav>
    <!--  -->
    <!-- Bande annonce -->
    <?php
        include("../Database/connexion.php");
        $bande_annonce_query = "SELECT a.Photo, c.Marque, c.Logo, b.Id_voiture, b.Modele FROM accueil a JOIN voiture b ON a.Id_voiture = b.Id_voiture JOIN marque c ON b.Id_marque = c.Id_marque WHERE a.Id = 1;";
        $bande_annonce_result = mysqli_query($bdd,$bande_annonce_query);
        $row = mysqli_fetch_assoc($bande_annonce_result);
            if ($row) {
                $id_modele = $row["Id_voiture"];
                $video = $row["Photo"];
                $marque = $row["Marque"];
                $logo = $row["Logo"];
                $modele = $row["Modele"];
            }
            mysqli_free_result($bande_annonce_result);
            mysqli_close($bdd);
    ?>
    <div class="d-flex align-items-center justify-content-center mt-5 mb-5">
        <div class="position-relative w-75">
            <video class="w-100 rounded-0" autoplay loop muted>
                <source src="../Images/Index/<?php echo $video ?>" type="video/mp4">
            </video>
            <div class="position-absolute top-0 mt-3 ms-3 w-100">
                <img src="../Images/Logos/<?php echo $logo ?>" alt="Logo" id="video_logo">
            </div>
            <div class="position-absolute bottom-0 start-0 mb-3 w-100 d-flex align-items-center">
                <h2 class="text-center text-white ms-4 mb-3" id="modele"><?php echo $marque, ' ', $modele ?></h2>
                <div class="position-absolute bottom-0 end-0 d-flex flex-column align-items-end me-4 mb-3" id="div_bande_annonce_btn">
                    <button type="button" class="btn text-white py-3 px-2 mb-3 w-75" id="explorer"><i class='bx bx-copy-alt me-3'></i>Explorer</button>
                    <form action="demande_essaie.php" method="POST">
                         <input type="hidden" name="Id_modele" value="<?php echo $id_modele ?>">
                        <input class="btn border text-white py-3 px-2 w-100" type="submit" id="bande_annonce_btn" value="Essayer ce modèle" name="essayer">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--  -->
    <!-- Entreprise -->
    <?php
        include("../Database/connexion.php");
        $propos_query = "SELECT Entreprise FROM propos;";
        $propos_result = mysqli_query($bdd, $propos_query);
        $row = mysqli_fetch_assoc($propos_result);
        if($row){
            $entreprise = $row["Entreprise"];
        }
        mysqli_free_result($propos_result);
        mysqli_close($bdd);
    ?>
    <div class="d-flex flex-column align-items-center justify-content-center" id="propos">
        <h2 class="mt-5 mb-5"><u>SUP</u>ERCAR</h2>
        <p class="text-center mb-5 w-50"><?php echo $entreprise ?></p>
        <button type="button" class="btn text-white rounded-0 py-4 px-4 mt-2" id="explorer"><i class="ri-error-warning-line me-3" id="propos_icon"></i>À PROPOS DE NOUS</button>
    </div>
    <!--  -->
    <!-- Produits et services -->
    <div class="mt-5 row d-flex align-item-center justify-content-center">
        <?php
            include("../Database/connexion.php");
            $product_query = "SELECT a.Photo, a.Description, b.Marque FROM accueil a JOIN marque b ON a.Id_marque = b.Id_marque WHERE a.Id IN (2,3,4);";
            $product_result = mysqli_query($bdd, $product_query);
            while($row = mysqli_fetch_assoc($product_result)){
                $marque = $row["Marque"];
                $image = $row["Photo"];
                $description = $row["Description"];
        ?>
        <a href="<?php echo $marque.'.php' ?>" class="position-relative mt-5" id="product">
            <img src="../Images/Index/<?php echo $image ?>" alt="Ferrari product" class="img-fluid shadow"  id="product_img">
            <div class="position-absolute bottom-0">
                <h3 class="text-white ms-3 mb-0"><?php echo $marque ?></h3>
                <p class="text-white ms-4"><?php echo $description ?></p>
            </div>
        </a>
        <?php
            }
            mysqli_free_result($product_result);
            mysqli_close($bdd);
        ?>
        <?php
            include("../Database/connexion.php");
            $evenement_product_query = "SELECT a.Description, b.Photos FROM accueil a JOIN evenement b WHERE a.Id = 5 ORDER BY b.Date_debut DESC LIMIT 1;";
            $evenement_product__result = mysqli_query($bdd, $evenement_product_query);
            $row = mysqli_fetch_assoc($evenement_product__result);
            if($row){
                $image = $row["Photos"];
                $description = $row["Description"];
        ?>
        <a href="evenements.php" class="position-relative mt-5" id="product">
            <img src="../Images/Evenements/<?php echo $image ?>" alt="Ferrari product" class="img-fluid shadow"  id="product_img">
            <div class="position-absolute bottom-0">
                <h3 class="text-white ms-3 mb-0">Évènement</h3>
                <p class="text-white ms-4"><?php echo $description ?></p>
            </div>
        </a>
        <?php
            }
            mysqli_free_result($evenement_product__result);
            mysqli_close($bdd);
        ?>
    </div>
    <!--  -->
    <!-- Voiture récent -->
    <?php
        include("../Database/connexion.php");
        $recent_query = "SELECT * FROM voiture a JOIN marque b ON a.Id_marque = b.Id_marque ORDER BY a.Annee DESC LIMIT 1;";
        $recent_result = mysqli_query($bdd, $recent_query);
        if($row = mysqli_fetch_assoc($recent_result)){
            $id = $row["Id_voiture"];
            $marque = $row["Marque"];
            $modele = $row["Modele"];
            $photo = $row["Photo"];
            $description = $row["Description_voiture"];
        }
        mysqli_free_result($recent_result);
        mysqli_close($bdd);
    ?>
    <div class="d-flex justify-content-center align-items-center" id="recent">
        <div class="position-relative w-75 ">
            <img src="<?php echo '../Images/Voiture/'.$marque.'/'.$photo?>" alt="Récent voiture" class="img-fluid">
            <div class="position-absolute bottom-0 start-0 py-5 px-5" id="recent_description_blank"></div>
            <div class="position-absolute bottom-0 start-0 py-5 px-5" id="recent_description">
                <p class="text-white"><?php echo $description ?></p>
            </div>
            <div class="position-absolute bottom-0 end-0 d-flex flex-column align-items-end me-3 mb-3" id="div_bande_annonce_btn">
                <button type="button" class="btn text-white py-3 px-2 mb-3 w-75" id="explorer"><i class='bx bx-copy-alt me-3'></i>Explorer</button>
                <form action="demande_essaie.php" method="POST">
                    <input type="hidden" name="Id_modele" value="<?php echo $id ?>">
                    <input class="btn border text-white py-3 px-2 w-100" type="submit" id="bande_annonce_btn" value="Essayer ce modèle" name="essayer">
                </form>
            </div>
        </div>
    </div>
    <!--  -->
    <!-- Footer -->
    <div class="w-100 mt-5" style="background-color: black;">
        <div class="row d-flex align-items-center justify-content-around">
            <div class="col-2 d-flex flex-column justify-content-center text-white mt-4 mb-4">
                <h4 class="mb-3">Nos produits</h4>
                <a href="ferrari.php" class="ms-3 nav-link">> Ferrari</a>
                <a href="porsche.php" class="ms-3 nav-link">> Porsche</a>
                <a href="jeep.php" class="ms-3 nav-link">> Jeep</a>
            </div>
            <div class="col-2 border">
            </div>
            <div class="col-2 border">
                
            </div>
            <hr>
        </div>
    </div>
    <!--  -->
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
                    <a href="index.php" style="font-family: Poppins, sans-serif;"><button type="submit" class="btn btn-secondary w-25 position-absolute bottom-0 end-0">Close</button></a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>