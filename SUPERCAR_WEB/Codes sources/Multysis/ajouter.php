<!-- <?php require("Fonctions/ajouter_bdd.php")?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <title>Multysis</title>
    <style>
        .form_voiture{
            display: none;
        }
        .form_evenement{
            display: none;
        }
        <?php
            if ($form_voiture == True){
                echo $show_form_voiture;
            }
            if ($form_evenement == True){
                echo $show_form_evenement;
            }
        ?>
    </style>
</head>
<body>
    <!-- Formulaire voiture -->
    <div class="form_voiture">
        <form action="" method="POST">
            <div class="d-flex align-items-center justify-content-center mt-5">
                <div class="container d-flex flex-column justify-content-center w-25 border mt-5 rounded">
                    <h4 class="text-center mt-3">Ajouter une voiture</h4>
                    <label for="recipient-name" class="col-form-label">Marque<span>*</span></label>
                    <select class="form-select" aria-label="Default select example" name="Marque">
                        <option selected>-</option>
                        <?php
                            include("../Database/connexion.php");
                            $option_marque_query = "SELECT Id_marque, Marque FROM marque WHERE Id_marque > 1";
                            $option_marque_result = mysqli_query($bdd, $option_marque_query);
                            if ($option_marque_result){
                                while($row = mysqli_fetch_assoc($option_marque_result)){
                                    $id_marque = $row["Id_marque"];
                                    $marque = $row["Marque"];
                        ?>
                        <option value="<?php echo $id_marque?>" name="id_voiture"><?php echo $marque?></option>
                        <?php
                            }
                            mysqli_free_result($option_marque_result);
                            } else {
                                echo "Error: " . mysqli_error($bdd);
                            }
                            mysqli_close($bdd);
                        ?>
                    </select>
                    <label for="recipient-name" class="col-form-label">Modèle<span>*</span></label>
                    <input type="text" class="form-control" required name="Modele">
                    <label for="recipient-name" class="col-form-label">Type moteur<span>*</span></label>
                    <select class="form-select" aria-label="Default select example" name="TypeMoteur">
                        <option selected value="">-</option>
                        <option>Électrique</option>
                        <option>Hybride rechargeable</option>
                        <option>Combustion</option>
                    </select>

                    <div class="d-flex w-100">
                        <div class="d-felx flex-column w-100">
                            <label for="recipient-name" class="col-form-label">Moteur<span>*</span></label>
                            <input type="text" class="form-control" id="input" required name="Moteur">
                        </div>
                        <div class="d-felx flex-column w-100">
                            <label for="recipient-name" class="col-form-label">Chevaux<span>*</span></label>
                            <input type="number" class="form-control" id="input" required name="Chevaux">
                        </div>
                        <div class="d-felx flex-column w-100">
                            <label for="recipient-name" class="col-form-label">Speedtime<span>*</span></label>
                            <input type="number" class="form-control" id="input" required name="Speedtime">
                        </div>
                        <div class="d-felx flex-column w-100">
                            <label for="recipient-name" class="col-form-label">Topspeed<span>*</span></label>
                            <input type="number" class="form-control" id="input" required name="Topspeed">
                        </div>
                    </div>
                    <label for="recipient-name" class="col-form-label">Description<span>*</span></label>
                    <textarea rows="8" name="Description" required></textarea>
                    <label for="recipient-name" class="col-form-label">Image<span>*</span></label>
                    <input type="file" name="Image">
                    <div class="d-flex align-items-center justify-content-around w-100 mt-3 mb-3">
                        <input class="btn rounded w-25" type="submit" value="Envoyer" name="ajouter_voiture">
                        <input type="submit" class="btn rounded" name="clear" value="Clear Form">
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Formulaire évènement -->
    <div class="form_evenement">
        <form action="Fonctions/ajouter_bdd.php" method="POST">
            <div class="form_evenement d-flex align-items-center justify-content-center mt-5">
                <div class="container d-flex flex-column justify-content-center w-25 border mt-5 rounded">
                    <h4 class="text-center mt-3">Ajouter une évènement</h4>
                    <label for="recipient-name" class="col-form-label">Marque<span>*</span></label>
                    <select class="form-select" aria-label="Default select example" name="Marque">
                        <option selected>-</option>
                        <?php
                            include("../Database/connexion.php");
                            $option_marque_query = "SELECT Id_marque, Marque FROM marque WHERE Id_marque > 1";
                            $option_marque_result = mysqli_query($bdd, $option_marque_query);
                            if ($option_marque_result){
                                while($row = mysqli_fetch_assoc($option_marque_result)){
                                    $id_marque = $row["Id_marque"];
                                    $marque = $row["Marque"];
                        ?>
                        <option value="<?php echo $id_marque?>" name="id_voiture"><?php echo $marque?></option>
                        <?php
                            }
                            mysqli_free_result($option_marque_result);
                            } else {
                                echo "Error: " . mysqli_error($bdd);
                            }
                            mysqli_close($bdd);
                        ?>
                    </select>
                    <label for="recipient-name" class="col-form-label">Thème<span>*</span></label>
                    <input type="text" class="form-control" required name="Theme">
                    <div class="d-flex w-100">
                        <div class="d-felx flex-column w-100">
                            <label for="recipient-name" class="col-form-label">Date début<span>*</span></label>
                            <input type="date" class="form-control" id="input" required name="Date_debut">
                        </div>
                        <div class="d-felx flex-column w-100">
                            <label for="recipient-name" class="col-form-label">Date fin<span>*</span></label>
                            <input type="date" class="form-control" id="input" required name="Date_fin">
                        </div>
                        <div class="d-felx flex-column w-100">
                            <label for="recipient-name" class="col-form-label">Location<span>*</span></label>
                            <input type="text" class="form-control" id="input" required name="Location">
                        </div>
                        <div class="d-felx flex-column w-100">
                            <label for="recipient-name" class="col-form-label">Prix<span>*</span></label>
                            <input type="number" class="form-control" id="input" required name="Prix">
                        </div>
                    </div>
                    <label for="recipient-name" class="col-form-label">Description<span>*</span></label>
                    <textarea rows="5" name="Description" required></textarea>
                    <label for="recipient-name" class="col-form-label">Image<span>*</span></label>
                    <input type="file" name="Image">
                    <div class="d-flex align-items-center justify-content-around w-100 mt-3 mb-3">
                        <input class="btn rounded w-25" type="submit" value="Envoyer" name="ajouter_evenement">
                        <input type="submit" class="btn rounded" name="clear" value="Clear Form">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>