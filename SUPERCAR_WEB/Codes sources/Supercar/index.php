<?php 
    require("Fonctions/deconnection.php"); 
    require("Fonctions/session_expire.php");
    session_start();
    $is_logged_in = isset($_SESSION["username"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css">
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
    <!-- First section -->
    <?php
        include("../Database/connexion.php");
        $section1 = "SELECT a.Video, a.Lien, a.Description, b.Marque, b.Logo, c.Modele FROM accueil a JOIN marque b ON a.Id_marque = b.Id_marque Join voiture c ON a.Id_voiture = c.Id_voiture WHERE a.Id = 1;";
        $curseur = mysqli_query($bdd,$section1);
        if ($curseur) {
            $row = mysqli_fetch_assoc($curseur);
            if ($row) {
                $video = $row["Video"];
                $lien = $row["Lien"];
                $description = $row["Description"];
                $marque = $row["Marque"];
                $logo = $row["Logo"];
                $modele = $row["Modele"];
            }
            mysqli_free_result($curseur);
        } else {
            echo "Error: " . mysqli_error($bdd);
        }
        mysqli_close($bdd);
    ?>
    <div class="d-flex justify-content-center align-items-center mt-3">
        <div class="position-relative w-75 d-flex justify-content-center align-items-center">
            <video class="w-100 mt-5 mb-5 border border-light" autoplay loop muted>
                <source src="../Images/Index/Section1/<?php echo $video ?>" type="video/mp4" />
            </video>
            <div class="position-absolute top-0 mt-5 w-100">
                <img src="../Images/Logos/<?php echo $logo ?>" alt="Porsche logo" id="video_logo">
            </div>
            <div class="position-absolute d-flex justify-content-center align-items-center flex-column bottom-0 end-0 mb-5">
                <h3 class="text-white" id="modele"><?php echo $marque, ' ', $modele ?></h3>
                <a class="btn d-flex justify-content-center align-items-center" href="" role="button" id="explorer">Explorer</a>
            </div>
        </div>
    </div>
    <!--  -->
    <!-- Second section -->
    <h1 class="mt-5" style="margin: 0 0 0 13%; font-weight: 700; "><u>Trouvez vo</u>tre voiture</h1>
    <div class="d-flex align-items-center justify-content-center mb-5">
        <?php
            include("../Database/connexion.php");
            $section2 = "SELECT a.Photo, a.Lien, a.Description, b.Marque, b.Logo, c.Modele FROM accueil a JOIN marque b ON a.Id_marque = b.Id_marque JOIN voiture c ON a.Id_voiture = c.Id_voiture WHERE a.Id IN (2, 3);";
            $curseur = mysqli_query($bdd,$section2);
            if ($curseur) {
                while ($row = mysqli_fetch_assoc($curseur)){
                    $image = $row["Photo"];
                    $modele = $row["Modele"];
                    $lien = $row["Lien"];
                    $description = $row["Description"];
                    $marque = $row["Marque"];
                    $logo = $row["Logo"];
        ?>
        <div class="position-relative w-50 ms-5 me-5 mt-5 mb-5">
            <img class="image_shadow w-100" style="height: 100%; object-fit: cover; border-radius: 15px;" src="../Images/Index/Section2/<?php echo $image ?>" alt="">
            <div class="position-absolute top-0">
                <img src="../Images/Logos/<?php echo $logo ?>" alt="Logos" id="logos">
            </div>
            <div class="position-absolute d-flex justify-content-center align-items-center flex-column bottom-0 end-0">
                <h3 class="text-white" id="font"><?php echo $marque, ' ', $modele ?></h3>
                <a class="btn d-flex justify-content-center align-items-center w-50" id="explorer" href="" role="button">Explorer</a>
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
    </div>
    <!--  -->
    <!-- Third section -->
    <h1 class="mt-5" style="margin: 0 0 0 13%; font-weight: 700;"><u>Évèn</u>ements</h1>
    <div class="d-flex align-items-center justify-content-center mb-5">
        <?php
            include("../Database/connexion.php");
            $section3 = "SELECT a.Theme, a.Photos, c.Logo FROM evenement a JOIN accueil b JOIN marque c ON a.Id_marque = c.Id_marque WHERE b.Id_evenement = a.Id_evenement;";
            $curseur = mysqli_query($bdd,$section3);
            if ($curseur) {
                while ($row = mysqli_fetch_assoc($curseur)){
                    $theme = $row["Theme"];
                    $image = $row["Photos"];
                    $logo = $row["Logo"];
        ?>
        <div class="position-relative ms-5 me-5 mt-5 mb-5" style="height: 700px; width: 34.5%;">
            <img class="image_shadow w-100 " style="height: 100%; object-fit: cover; border-radius: 15px;" src="../Images/Evenements/<?php echo $image;?>" alt="">
            <div class="position-absolute top-0">
                <img src="../Images/Logos/<?php echo $logo ?>" alt="Logos" id="logos">
            </div>
            <div class="position-absolute bottom-0" id="events_text">
                <h1 class="text-white"><?php echo $theme ?></h1>
                <a class="btn d-flex justify-content-center align-items-center w-50" id="explorer" href="<?php echo $lien ?>" role="button">Explorer</a>
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
    </div>
    <!--  -->
    <!-- Fourth section -->
    <h2 class="mt-5" style="margin: 0 0 0 13%; font-weight: 700;"><u>Actu</u>alités</h2>
    <h1 style="margin: 0 0 0 13%; font-weight: 700; font-size: 80px;"><u>SUPERC</u>AR WORLD</h1>
    <div class="d-flex align-items-center justify-content-center flex-column" style="height: auto;">
    <?php
        include("../Database/connexion.php");
        $section4 = "SELECT * FROM accueil WHERE ID BETWEEN 4 AND 6;";
        $curseur = mysqli_query($bdd,$section4);
        if ($curseur) {
            while ($row = mysqli_fetch_assoc($curseur)){
                $imagenews = $row["Photo"];
                $liennews = $row["Lien"];
                $descriptionnews = $row["Description"];
    ?>
        <div class="row w-75 d-flex align-items-center justify-content-center mt-4 mb-5">
            <div class="col-6">
                <img class="image_shadow card-img-top" src="../Images/Index/Section3/<?php echo $imagenews ?>" alt="Actualité">
            </div>
            <div class="col-1"></div>
            <div class="col-5">
                <h3 class="card-text mb-5"><?php echo $descriptionnews ?></h3>
                <a href="<?php echo $liennews ?>"><button type="button" class="w-50 border" id="news_button" style="height: 60px;">Lire plus</button></a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>