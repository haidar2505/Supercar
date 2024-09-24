<?php require("Fonctions/motdepasseoublie_verify.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Supercar-css/navbar.css">
    <link rel="stylesheet" href="../Supercar-css/connection.css">
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
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg py-0 shadow">
        <div class="container-fluid" id="image">
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
                <div class="d-flex" id="buttons">
                    <a href="inscrire.php" class="me-2">
                        <button type="button" class="btn rounded-0" id="btn-1">S'inscrire</button>
                    </a>
                    <a href="connection.php">
                        <button type="button" class="btn rounded-0" id="btn-1">Se connecter</button>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!--  -->    
    <form action="" method="POST">
        <div class="centered d-flex align-items-center justify-content-center">
            <div class="container d-flex flex-column justify-content-center w-25 border mt-5 rounded position-relative" >
                <h4 class="text-center mt-3">Mot de passe oublié</h4>
                <label for="recipient-name" class="col-form-label">E-mail<span>*</span></label>
                <input type="text" class="form-control" name="email" value="<?php echo $email ?>">
                <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $email_error ?></p>
                <label for="recipient-name" class="col-form-label">Mot de passe<span>*</span></label>
                <input type="password" class="form-control" name="frogotpassword" value="<?php echo $frogotpassword ?>">
                <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $password_error ?></p>
                <label for="recipient-name" class="col-form-label">Confirmer mot de passe<span>*</span></label>
                <input type="password" class="form-control" name="confirmfrogotpassword" value="<?php echo $confirmfrogotpassword ?>">
                <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $password_error_identique ?></p>
                <div class="d-flex align-items-center justify-content-around w-100 mt-3 mb-3">
                    <input class="btn rounded" type="submit" value="Reintaliser le mot de passe" name="resetpassword" id="btn-1">
                    <input type="submit" class="btn rounded" name="annuler" value="Annuler" id="btn-1">
                </div>
            </div>
        </div> 
    </form>
    <!--  -->
    <!-- Modal sucess -->
    <div class="modal fade <?php if ($showModal) echo 'show'; ?>" id="exampleModal" tabindex="-1" <?php if ($showModal) echo 'style="display: block;" aria-modal="true"'; ?> aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mot de passe changé</h5>
                </div>
                <div class="modal-body position-relative mt-2">
                    <p class="mb-4">Votre mot de passe a bien été changer.</p>
                    <div class="position-absolute bottom-0 end-0 mb-1">
                        <a href="motdepasseoublie.php"><button type="submit" class="btn btn-secondary">Close</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>