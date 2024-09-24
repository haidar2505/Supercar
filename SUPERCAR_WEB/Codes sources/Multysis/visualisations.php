<?php require("Fonctions/show_visualisation.php") ?>
<?php require("Fonctions/supprimer_bdd.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <title>Multysis</title>
    <style>
        .voiture{
            display:none;
        }
        .demande{
            display:none;
        }
        .contact{
            display: none;
        }
        .client{
            display: none;
        }
        .evenement{
            display: none;
        }
        .accueil{
            display: none;
        }
        .image{
            width: 500px;
        }
        <?php
            if ($voitures_clicked == True){
                echo $display_voiture;
            }
            if ($demandes_clicked == True){
                echo $display_demande;
            }
            if ($contacts_clicked == True){
                echo $display_contact;
            }
            if ($clients_clicked == True){
                echo $display_client;
            }
            if ($evenements_clicked == True){
                echo $display_evenement;
            }
            if ($accueil_clicked == True){
                echo $display_accueil;
            }
        ?>
    </style>
</head>
<body>
    <!-- Voiture -->
    <div class="d-flex">
        <div class="border" style="width:15%;">
            MENU    
        </div>
        <table class="voiture w-75 table">
            <thead>
                <tr>
                    <th scope="col"  style="width: 0%;">ID</th>
                    <th scope="col" style="width: 0.3%;">Modèle</th>
                    <th scope="col" style="width: 1%;">Moteur détailes</th>
                    <th scope="col"  style="width: 1.5%;">Description</th>
                    <th scope="col" style="width: 1.5%;">Photo</th>
                    <th scope="col" style="width: 0.5%;"></th>
                    <th scope="col" style="width: 1.5%;"></th>
                </tr>
            </thead>
            <tbody> 
                <?php
                    foreach ($voitures as $voiture) {?>
                    <tr>
                        <th scope="row"><?php echo $voiture['id_voiture']?></th>
                        <td ><?php echo $voiture['marque'].' '.$voiture['modele']?></td>
                        <td><?php echo '<b>Type de moteur :</b> '.$voiture['typemoteur'].'<br><b>Moteur :</b> '.$voiture['moteur'].'<br><b>Vitesse maximal :</b>  '.$voiture['topspeed'].' km/h <br><b>Chevaux :</b> '.$voiture['chevaux'].' hp'.'<br><b>Temps de vitesse (0-100km/h) :</b>  '.$voiture['speedtime'].' secondes'?></td>
                        <td><?php echo $voiture['description']?></td>
                        <td>
                            <?php $image_path = "../Images/Voiture/" . $voiture['marque'] . "/" . $voiture['photo']; ?>
                            <img class="image" src="<?php echo $image_path ?>" alt=""></td>
                        <td>
                            <form action="modify.php" method="POST">
                                <input type="hidden" value="<?php echo $voiture['id_voiture'] ?>" name="id_voiture"><button name="modify_voiture">Modifier</button>
                            </form>
                        <td>
                            <form action="" method="POST">
                                <input type="hidden" value="<?php echo $voiture['id_voiture'] ?>" name="id_voiture"><button name="supprimer_voiture">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php 
                        }
                    ?>
            </tbody>
        </table>
        <!-- Demandes -->
        <h1 class="text-center mt-2 mb-3">Demande d'essaie</h1>
        <table class="demande w-100 table table-hover">
            <thead class="text-center">
                <tr>
                    <th scope="col" >ID</th>
                    <th scope="col">Modèle</th>
                    <th scope="col">Ville</th>
                    <th scope="col">Détailes</th>
                    <th scope="col">Nom complète</th>
                    <th scope="col">Username</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-center"> 
                <?php
                    foreach ($demandes as $demande) {?>
                    <tr>
                        <th scope="row"><?php echo $demande['id_demande']?></th>
                        <td ><?php echo $demande['modele']?></td>
                        <td ><?php echo $demande['ville']?></td>
                        <td class="text-start"><?php echo '<b>Nom :</b> '.$demande['nom'].' '.$demande['prenom'].'<b>Jour :</b> '.$demande['jour'].'<br><b>Heure :</b> '.$demande['heure'].'<br><b>Num Tel :</b>  '.$demande['numtel'].'<br><b>Email :</b>  '.$demande['email']?></td>
                    </tr>
                    <?php 
                        }
                    ?>
            </tbody>
        </table>

        <!-- Contacts -->
        <h1 class="text-center mt-2 mb-3">Contact</h1>
        <table class="contact w-100 table">
            <thead class="text-center">
                <tr>
                    <th scope="col" >ID</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Message</th>
                </tr>
            </thead>
            <tbody> 
                <?php
                    foreach ($contacts as $contact) {?>
                    <tr>
                        <th scope="row"><?php echo $contact['id_contact']?></th>
                        <td ><?php echo $contact['nom'].' '. $contact['prenom']?></td>
                        <td><?php echo $contact['message']?></td>
                    </tr>
                    <?php 
                        }
                    ?>
            </tbody>
        </table>

        <!-- Clients -->
        <h1 class="text-center mt-2 mb-3">Clients</h1>
        <table class="client w-100 table">
            <thead class="text-center">
                <tr>
                    <th scope="col" >ID</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Détailes</th>
                    <th scope="col">Username</th>
                </tr>
            </thead>
            <tbody> 
                <?php
                    foreach ($clients as $client) {?>
                    <tr>
                        <th scope="row"><?php echo $client['id_inscription']?></th>
                        <td ><?php echo $client['nom'].' '. $client['prenom']?></td>
                        <td class="text-start"><?php echo '<b>Ville :</b> '.$client['ville'].' '.'<br><b>Num Tel :</b>  '.$client['numtel'].'<br><b>Email :</b>  '.$client['email']?></td>
                        <th><?php echo $client['username']?></th>
                    </tr>
                    <?php 
                        }
                    ?>
            </tbody>
        </table>

        <!-- Évènements -->
        <h1 class="text-center mt-2 mb-3">Évènements</h1>
        <table class="evenement w-100 table">
            <thead class="text-center">
                <tr>
                    <th scope="col" >ID</th>
                    <th scope="col">Détailes</th>
                    <th scope="col">Description</th>
                    <th scope="col">Photo</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody> 
                <?php
                    foreach ($evenements as $evenement) {?>
                    <tr>
                        <th scope="row"><?php echo $evenement['id_evenement']?></th>
                        <td class="text-start"><?php echo '<b>Thème :</b>'.$evenement['theme'].' '.'<br><b>Date début et fin :</b> '.$evenement['date_debut'].' --> '.$evenement['date_fin'].'<br><b>Prix :</b> '.$evenement['prix'].'<br><b>Location :</b> '.$evenement['location']?></td>
                        <td><?php echo $evenement['description']?></td>
                        <td><img class="image" src="../Images/Evenements/<?php echo $evenement['photo']?>" alt=""></td>
                        <td>
                            <form action="modify.php" method="POST">
                                <input type="hidden" value="<?php echo $evenement['id_evenement'] ?>" name="id_evenement">
                                <button type="button" class="btn btn-info text-white" id="btn_outils"  name="modifier_evenement">Modifier</button>
                            </form>
                        <td></td>
                        <td>
                            <form action="" method="POST">
                                <input type="hidden" value="<?php echo $evenement['id_evenement'] ?>" name="id_evenement">
                                <button type="button" class="btn btn-danger" id="btn_outils" name="supprimer_evenement">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    <?php 
                        }
                    ?>
            </tbody>
        </table>
    </div>

    <!-- Accueil -->
    <div class="accueil">
    <form action="" method="POST">
    <?php
        include("../Database/connexion.php");
        $section1 = "SELECT a.Video, a.Lien, a.Description, b.Marque, b.Logo, c.Modele FROM accueil a JOIN marque b ON a.Id_marque = b.Id_marque JOIN voiture c ON a.Id_voiture = c.Id_voiture WHERE a.Id = 1;";
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
    <div class="position-relative w-100 d-flex justify-content-center align-items-center mt-3">
        <div class="w-100 d-flex justify-content-center align-items-center">
            <video class="w-75 rounded mt-5 mb-5 border border-light" autoplay loop muted>
                <source src="../Images/Index/Section1/<?php echo $video ?>" type="video/mp4" />
            </video>
            <div class="position-absolute w-75 top-0 mt-5">
                <img src="../Images/Logos/<?php echo $logo ?>" style="width:50px;" alt="Porsche logo" id="logos">
            </div>
            <div class="position-absolute d-flex justify-content-between align-items-end w-75 bottom-0 mb-5">
                <h3 class="text-white w-25" id="modele"><?php echo $marque, ' ', $modele ?></h3>
            </div>
        </div>
    </div>
    <button type="button" name="modifier_bande_annonce" class="btn rounded border" id="btn-1">Bande-annonce</button>
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
    <div class="position-relative w-100 d-flex justify-content-center align-items-center">
        <img class="w-75 rounded" src="../Images/Index/Section2/<?php echo $image ?>" alt="image">
        <div class="position-absolute w-75 top-0">
            <img src="../Images/Logos/<?php echo $logo ?>" style="width:50px;" alt="Logos" id="logos">
        </div>
        <div class="w-75 position-absolute">
            <div class="d-flex justify-content-center align-items-center flex-column">
                <h3 class="text-white" id="font"><?php echo $marque, ' ', $modele ?></h3>
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
        <button type="button" name="voir_offres" class="btn rounded border" id="btn-1">Offres</button>


        <div class="d-flex justify-content-center align-items-center" id="actualite">
    <?php
        include("../Database/connexion.php");
        $section2 = "SELECT * FROM accueil WHERE ID BETWEEN 4 AND 6;";
        $curseur = mysqli_query($bdd,$section2);
        if ($curseur) {
            while ($row = mysqli_fetch_assoc($curseur)){
                $imagenews = $row["Photo"];
                $liennews = $row["Lien"];
                $descriptionnews = $row["Description"];
    ?>
        <div class="card border-0" style="width: 40rem; margin: 50px;">
            <a href="<?php $liennews ?>"><img class="card-img-top" src="../Images/Index/Section3/<?php echo $imagenews ?>" alt="Card image cap"></a>
            <div class="card-body">
                <p class="card-text text-center"><?php echo $descriptionnews ?></p>
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
    <button type="button" name="voir_actualite" class="btn rounded border" id="btn-1">Actualité</button>

    </form>
    </div>
    <!--  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>