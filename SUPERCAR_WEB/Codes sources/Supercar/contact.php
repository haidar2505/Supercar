<?php 
    require("Fonctions/contact_sent.php");
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
    <link rel="stylesheet" href="../Supercar-css/navbar.css">
    <link rel="stylesheet" href="../Supercar-css/contact.css">
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
            height: 80vh;
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
    <!-- Formulaire -->
    <form action="" method="POST">
            <div class="centered d-flex justify-content-center align-items-center w-100">
                <div class="row w-100 d-flex justify-content-center align-items-center">
                    <div class="col-3 d-flex flex-column border rounded">
                        <h4 class="text-center mt-3">Contactez-nous</h4>
                        <label for="recipient-name" class="col-form-label">Nom de famille<span>*</span></label>
                        <input type="text" class="form-control" name="Nom" value="<?php echo $nom ?>">
                        <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $nom_error ?></p>
                        <label for="recipient-name" class="col-form-label">Prénom<span>*</span></label>
                        <input type="text" class="form-control" name="Prenom" value="<?php echo $prenom ?>">
                        <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $prenom_error ?></p>
                        <label for="recipient-name" class="col-form-label">E-mail<span>*</span></label>
                        <input type="text" class="form-control" name="Email" value="<?php echo $email ?>">
                        <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $email_error ?></p>
                        <label for="recipient-name" class="col-form-label">Message<span>*</span></label>
                        <textarea rows="5" name="Message" id="message"><?php echo $message ?></textarea>
                        <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $message_error ?></p>
                        <div class="d-flex align-items-center justify-content-around w-100 mt-3 mb-3">
                            <input class="btn rounded w-25" type="submit" value="Envoyer" name="envoyer" id="btn-1">
                            <input type="submit" class="btn rounded" name="clear" value="Clear Form" id="btn-1">
                        </div>
                    </div>
                    <div class="col-4 d-flex flex-column border rounded">
                        <div class="d-flex w-100">
                            <div class="d-flex flex-column w-100">
                            <label for="recipient-name" class="col-form-label">Location :</label>
                            <input type="text" disabled class="form-control" name="Nom" value="MCCI Business School LTD">
                            </div>
                            <div class="d-flex flex-column w-100">
                            <label for="recipient-name" class="col-form-label">Numéro téléphone :</label>
                            <input type="tel" disabled class="form-control" name="Nom" value="454 8950">
                            </div>
                            </div>
                        <iframe class="mt-3 mb-3" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3743.300603102708!2d57.48671831126459!3d-20.246364181135945!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x217c5b1ef2170f63%3A0xd1a78020fc096491!2sMCCI%20BUSINESS%20SCHOOL%20(Mauritius%20Chamber%20of%20Commerce%20and%20Industry)!5e0!3m2!1sfr!2smu!4v1726557321099!5m2!1sfr!2smu" width="100%" height="423" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>