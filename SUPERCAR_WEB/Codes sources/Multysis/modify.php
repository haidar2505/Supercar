<?php require("Fonctions/modify_bdd.php"); 
    // if (isset($_POST['modify_voiture'])){
    //     include("../Database/connexion.php");
    //     $id_voiture = mysqli_escape_string($bdd, $_POST['id_voiture']);
    //     echo $id_voiture;
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <title>Multysis</title>
    <style>
        .voiture_form{
            display: none;
        }
        .evenement_form{
            display: none;
        }
        .accueil_form{
            display: none;
        }
        <?php
            if ($voiture_click == True){
                echo $voiture_form_block;
            }
            if ($evenement_click == True){
                echo $evenement_form_block;
            }
            if ($accueil_click == True){
                echo $accueil_form_block;
            }
        ?>
    </style>
</head>
<body>
    <!-- Voiture -->
    <div class="voiture_form container">
        <div class="row">
            <div class="col-6 d-flex flex-column">
                <form action="" method="POST">
                    <input type="hidden" class="form-control" name="id_voiture" value="<?php echo $id_voiture1 ?>">
                    <label for="recipient-name" class="col-form-label">Modele :</label>
                    <input type="text" class="form-control" name="modele_modified" value="<?php echo $modele ?>">
                    <label for="recipient-name" class="col-form-label">Type moteur :</label>
                    <select class="form-select" aria-label="Default select example" name="typemoteur_modified">
                        <option selected><?php echo $typemoteur ?></option>
                        <option>Électrique</option>
                        <option>Hybride rechargeable</option>
                        <option>Combustion</option>
                    </select>
                    <label for="recipient-name" class="col-form-label">Moteur :</label>
                    <input type="text" class="form-control" name="moteur_modified" value="<?php echo $moteur ?>">
                    <label for="recipient-name" class="col-form-label">Chevaux (hp) :</label>
                    <input type="number" class="form-control" name="chevaux_modified" value="<?php echo $chevaux ?>">
                    <label for="recipient-name" class="col-form-label">Vitesse maximale (km/h) :</label>
                    <input type="number" class="form-control" name="topspeed_modified" value="<?php echo $topspeed ?>">
                    <label for="recipient-name" class="col-form-label">Temps de vitesse (0-100 km/h en s) :
                    </label>
                    <input type="number" class="form-control" name="speedtime_modified" value="<?php echo $speedtime ?>">
                    <label for="recipient-name" class="col-form-label">Description :</label>
                    <textarea rows="8" cols="80" name="description_modified" required><?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8') ?></textarea>
                    <label for="recipient-name" class="col-form-label">Photo :</label>
                    <img src="<?php echo $photo ?>" alt="Photo">
                    <input type="file" class="form-control" name="photo_modified">
                    <br>
                    <input class="btn rounded w-25 border" type="submit" value="Modifier" name="modifier_voiture_form">
                </form>
            </div>
        </div>
    </div>

    <!-- Evenement -->
    <div class="evenement_form container">
        <div class="row">
            <div class="col-6 d-flex flex-column">
                <form action="" method="POST">
                    <input type="hidden" class="form-control" name="id_event" value="<?php echo $id_event ?>">
                    <label for="recipient-name" class="col-form-label">Thème :</label>
                    <input type="text" class="form-control" name="theme_modified" value="<?php echo $theme ?>">
                    <label for="recipient-name" class="col-form-label">Date_début :</label>
                    <input type="date" class="form-control" name="date_d_modified" value="<?php echo $date_d ?>">
                    <label for="recipient-name" class="col-form-label">Date fin :</label>
                    <input type="text" class="form-control" name="date_f_modified" value="<?php echo $date_f ?>">
                    <label for="recipient-name" class="col-form-label">Prix (€) :</label>
                    <input type="number" class="form-control" name="prix_modified" value="<?php echo $prix ?>">
                    <label for="recipient-name" class="col-form-label">Location :</label>
                    <input type="text" class="form-control" name="location_modified" value="<?php echo $location ?>">
                    <label for="recipient-name" class="col-form-label">Description :</label>
                    <textarea rows="8" cols="80" name="description_modified" required><?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8') ?></textarea>
                    <label for="recipient-name" class="col-form-label">Photo :</label>
                    <img src="<?php echo $image ?>" alt="">
                    <input type="file" class="form-control" name="photo_modified">
                    <br>
                    <input class="btn rounded w-25 border" type="submit" value="Modifier" name="modifier_evenement_form">
                </form>
            </div>
        </div>
    </div>

    <!-- Accueil -->
    <div class="accueil_form container">
        <div class="row">
            <div class="col-6 d-flex flex-column">
                <form action="" method="POST">
                    <input type="hidden" class="form-control" name="id_accueil" value="<?php echo $id_accueil1 ?>">
                    <label for="recipient-name" class="col-form-label">Marque :</label>
                    <select class="form-select" aria-label="Default select example" name="marque_modified">
                        <option selected><?php echo $marque ?></option>
                        <option>Ferrari</option>
                        <option>Porsche</option>
                        <option>Jeep</option>
                    </select>
                    <label for="recipient-name" class="col-form-label">Modèle :</label>
                    <input type="text" class="form-control" name="modele_modified" value="<?php echo $modele ?>">
                    <label for="recipient-name" class="col-form-label">Lien du button :</label>
                    <input type="text" class="form-control" name="lien_btn_modified" value="<?php echo $lien_btn ?>">
                    <label for="recipient-name" class="col-form-label">Description :</label>
                    <textarea rows="8" cols="80" name="description_modified" required><?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8') ?></textarea>
                    <label for="recipient-name" class="col-form-label">Video ou photo :</label>
                    <img src="<?php echo $image ?>" alt="">
                    <input type="file" class="form-control" name="photo_modified">
                    <br>
                    <input class="btn rounded w-25 border" type="submit" value="Modifier" name="modifier_accueil_form">
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>