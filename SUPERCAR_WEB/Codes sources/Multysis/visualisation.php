<?php 
    require("Fonctions/show_visualisation.php");
    require("Fonctions/actions.php");
    require("Fonctions/ajouter_bdd.php");
    require("Fonctions/supprimer_bdd.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <title>Multysis</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        .table{
            width: 96%;
        }
        #btn_actions{
            font-weight: 600;
            background-color: white;
            transition: all 0.5s ease-out;
        }
        #btn_actions:hover{
            background-color: #8b96d2;
            color: white;
        }
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
        .employe{
            display: none;
        }
        .image, video{
            width: 350px;
        }
        .btn_ajouter:hover{
            background-color: #EDEADE;
        }
        body{
            background-color: #f3f4f8;
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
            if ($employe_clicked == True){
                echo $display_employe;
            }
        ?>
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white mb-3 border sticky-top">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarLeftAlignExample">
                <form action="" method="POST">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a href="admin.php" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <input type="submit" class="nav-link border-0 bg-white" value="Accueil" name="voir_accueil">
                        </li>
                        <li class="nav-item">
                            <input type="submit" class="nav-link border-0 bg-white" value="Voitures" name="voir_voitures">
                        </li>
                        <li class="nav-item">
                            <input type="submit" class="nav-link border-0 bg-white" value="Évènements" name="voir_evenements">
                        </li>
                        <li class="nav-item">
                            <input type="submit" class="nav-link border-0 bg-white" value="Demande essaie" name="voir_demandes">
                        </li>
                        <li class="nav-item">
                            <input type="submit" class="nav-link border-0 bg-white" value="Contact" name="voir_contacts">
                        </li>
                        <li class="nav-item">
                            <input type="submit" class="nav-link border-0 bg-white" value="Utilisateurs" name="voir_clients">
                        </li>
                        <li class="nav-item">
                            <input type="submit" class="nav-link border-0 bg-white" value="Employés" name="voir_employe">
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </nav>

    <div class="d-flex flex-column align-items-center justify-content-center">

        <!-- Accueil -->
        <table class="accueil table align-middle mb-0 bg-white border table-hover">
            <thead>
                <tr>
                <th>ID</th>
                <th>Modèle</th>
                <th>Description</th>
                <!-- <th>Status</th> -->
                <th>Image</th>
                <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($accueils as $accueil) {?>
                <tr>
                    <td>
                        <p class="text-muted"><?php echo $accueil['id_accueil']?></p>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="fw-bold mb-1"><?php echo $accueil['marque']?></p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="fw-normal mb-1"><?php echo $accueil['description']?></p>
                    </td>
                    <td>
                        <?php 
                            if (!$accueil['video']){
                            $section2 = "../Images/Index/Section2/". $accueil['photo'];
                            $section3 = "../Images/Index/Section3/". $accueil['photo'];
                        ?>
                        <img class="image rounded" src="<?php echo $section2 ?>" alt="">
                        <img class="image rounded" src="<?php echo $section3 ?>" alt="">

                        <?php }else{
                            $video = "../Images/Index/Section1/". $accueil['video']; 
                        ?>
                        <video autoplay loop muted class="rounded">
                            <source src="<?php echo $video?>" type="video/mp4" />
                        </video>
                        <?php } ?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-link btn-sm btn-rounded d-flex">
                            <form action="modify.php" method="POST">
                                <input type="hidden" value="<?php echo $accueil['id_accueil'] ?>" name="id_accueil">
                                <input class="rounded-pill px-2 py-2 me-1 border-0" type="submit" value="MODIFIER" name="modifier_accueil" id="btn_actions">
                            </form>
                        </button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Voiture -->
        <form action="ajouter.php" method="POST" class="voiture btn_ajouter mb-3 border bg-white shadow">
            <button name="ajouter_voitures_form" class="btn border-0 ">Ajouter un modèle</button>
        </form>
        <table class="voiture table align-middle mb-0 bg-white border table-hover shadow">
            <thead>
                <tr>
                <th>ID</th>
                <th width="20%">Modèle</th>
                <th>Description</th>
                <th>Image</th>
                <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($voitures as $voiture) {?>
                <tr>
                    <td>
                        <p class="text-muted"><?php echo $voiture['id_voiture']?></p>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="fw-bold mb-1"><?php echo $voiture['marque'].' '.$voiture['modele']?></p>
                                <p class="text-muted mb-0"><?php echo $voiture['typemoteur'].', '.$voiture['moteur'].', '.$voiture['chevaux'].'ch' ?></p>
                                <p class="text-muted mb-0"><?php echo '0-100km/h : '.$voiture['speedtime'].' s , '.$voiture['topspeed'].'km/h'  ?></p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="fw-normal mb-1"><?php echo $voiture['description']?></p>
                    </td>
                    <td>
                        <?php $image_path = "../Images/Voiture/" . $voiture['marque'] . "/" . $voiture['photo']; ?>
                        <img class="image rounded" src="<?php echo $image_path ?>" alt="Voiture image">
                    </td>
                    <td>
                        <button type="button" class="btn btn-link btn-sm btn-rounded d-flex">
                            <form action="modify.php" method="POST">
                                <input type="hidden" value="<?php echo $voiture['id_voiture'] ?>" name="id_voiture">
                                <input class="rounded-pill px-2 py-2 me-1 border-0" type="submit" value="MODIFIER" name="modify_voiture" id="btn_actions">
                            </form>
                            <form action="" method="POST">
                                <input class="rounded-pill px-2 py-2 ms-1 border-0" type="submit" value="SUPPRIMER" name="supprimer_voiture" id="btn_actions">
                            </form>
                        </button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Évènements -->
        <form action="ajouter.php" method="POST" class="evenement btn_ajouter mb-3 border bg-white shadow">
            <button name="ajouter_evenements_form" class="btn border-0">Ajouter un évènement</button>
        </form>
        <table class="evenement table align-middle mb-0 bg-white border table-hover shadow">
            <thead>
                <tr>
                <th>ID</th>
                <th>Modèle</th>
                <th width="20%">Spécifiques</th>
                <th>Description</th>
                <th>Image</th>
                <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($evenements as $evenement) {?>
                <tr>
                    <td>
                        <p class="text-muted"><?php echo $evenement['id_evenement']?></p>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="fw-bold"><?php echo $evenement['marque']?></p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="fw-bold mb-1"><?php echo $evenement['theme'] ?></p>
                        <p class="mb-0"><?php echo $evenement['location'] ?></p>
                        <?php
                            if (!$evenement['date_fin']){
                        ?>
                        <p class="text-muted mb-0"><?php echo $evenement['date_debut']?></p>
                        <?php
                            }else{
                        ?>
                        <p class="text-muted mb-0"><?php echo $evenement['date_debut'] ?> à <?php echo $evenement['date_fin'] ?></p>
                        <?php
                            }
                        ?>
                        <?php
                            if (!$evenement['prix']){
                        ?>
                        <p class="text-muted mb-0">Gratuit</p>
                        <?php 
                            }else{
                        ?>
                        <p class="text-muted mb-0"><?php echo "Prix : ".$evenement['prix']." €" ?></p>
                        <?php
                            }
                        ?>
                    </td>
                    <td>
                        <p class="fw-normal mb-1"><?php echo $evenement['description']?></p>
                    </td>
                    <td>
                        <img class="image rounded" src="../Images/Evenements/<?php echo $evenement['photo']?>" alt="Event image">
                    </td>
                    <td>
                        <button type="button" class="btn btn-link btn-sm btn-rounded d-flex">
                            <form action="modify.php" method="POST">
                                <input type="hidden" value="<?php echo $evenement['id_evenement'] ?>" name="id_evenement">
                                <input class="rounded-pill px-2 py-2 me-1 border-0" type="submit" value="MODIFIER" name="voir_evenements" id="btn_actions">
                            </form>
                            <form action="" method="POST">
                                <input class="rounded-pill px-2 py-2 ms-1 border-0" type="submit" value="SUPPRIMER" name="supprimer_evenement" id="btn_actions">
                            </form>
                        </button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Demande d'essaie -->
        <table class="demande table align-middle mb-0 bg-white border table-hover shadow">
            <thead>
                <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Demande</th>
                <th>Statut</th>
                <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($demandes as $demande) {?>
                <tr>
                    <td>
                        <p class="text-muted"><?php echo $demande['id_demande']?></p>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="fw-bold mb-1"><?php echo $demande['nom'].' '.$demande['prenom'].' ('.$demande['username'].')'?></p>
                                <p class="text-muted mb-0"><?php echo $demande['email'] ?></p>
                                <p class="text-muted mb-0"><?php echo $demande['numtel'] ?></p>

                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="fw-bold mb-1"><?php echo $demande['modele']?></p>
                        <p class="fw-normal mb-1"><?php echo $demande['jour'] ?> à <?php echo $demande['heure'] ?></p>
                    </td>
                    <td>
                        <span class="rounded-pill px-2 py-1" style="background-color: #49af41; color: white;"><?php echo $message ?></span>
                        <?php
                            if ($statut){
                        ?>
                        <span class="rounded-pill px-2 py-1" style="background-color: #f7e35e; color: white;"><?php echo $statut ?></span>
                        <?php
                            }
                        ?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-link btn-sm btn-rounded d-flex">
                            <form action="" method="POST">
                                <input type="text" value="<?php echo $demande['id_demande'] ?>" name="id_demande">
                                <input class="rounded-pill px-2 py-2 ms-1 border-0" type="submit" value="CONFIRMER" name="confimer_demande" id="btn_actions">
                                <input class="rounded-pill px-2 py-2 ms-1 border-0" type="submit" value="ANNULER" name="annuler_demande" id="btn_actions">
                            </form>
                        </button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Contact -->
        <table class="contact table align-middle mb-0 bg-white border table-hover shadow">
            <thead>
                <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Message</th>
                <!-- <th class="text-center">Actions</th> -->
                </tr>
            </thead>
            <tbody>
            <?php foreach ($contacts as $contact) {?>
                <tr>
                    <td>
                        <p class="text-muted"><?php echo $contact['id_contact']?></p>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="fw-bold mb-1"><?php echo $contact['nom'].' '.$contact['prenom']?></p>
                                <p class="text-muted mb-0"><?php echo $contact['email'] ?></p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="fw-normal mb-1"><?php echo $contact['message'] ?></p>
                    </td>
                    <!-- <td>
                        <button type="button" class="btn btn-link btn-sm btn-rounded d-flex">
                            <form action="" method="POST">
                                <input class="rounded-pill px-2 py-2 ms-1 border-0" type="submit" value="SUPPRIMER" name="" id="btn_actions">
                            </form>
                        </button>
                    </td> -->
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Utilisateur -->
        <table class="client table align-middle mb-0 bg-white border table-hover shadow">
            <thead>
                <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Ville</th>
                <th>Mot de passe</th>
                <!-- <th class="text-center">Actions</th> -->
                </tr>
            </thead>
            <tbody>
            <?php foreach ($clients as $client) {?>
                <tr>
                    <td>
                        <p class="text-muted"><?php echo $client['id_inscription']?></p>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="fw-bold mb-1"><?php echo $client['nom'].' '.$client['prenom'].' ('.$client['username'].')'?></p>
                                <p class="text-muted mb-0"><?php echo $client['email'] ?></p>
                                <p class="text-muted mb-0"><?php echo $client['numtel'] ?></p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="fw-normal mb-1"><?php echo $client['ville'] ?></p>
                    </td>
                    <td>
                        <p class="text-muted mb-1"><?php echo $client['motdepasse'] ?></p>
                    </td>
                    <!-- <td>
                        <button type="button" class="btn btn-link btn-sm btn-rounded d-flex">
                            <form action="" method="POST">
                                <input class="rounded-pill px-2 py-2 ms-1 border-0" type="submit" value="SUPPRIMER" name="" id="btn_actions">
                            </form>
                        </button>
                    </td> -->
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Employées -->
        <table class="employe table align-middle mb-0 bg-white border table-hover shadow">
            <thead>
                <tr>
                <th>ID</th>
                <th>Employé</th>
                <th>Mot de passe</th>
                <!-- <th class="text-center">Actions</th> -->
                </tr>
            </thead>
            <tbody>
            <?php foreach ($employes as $employe) {?>
                <tr>
                    <td>
                        <p class="text-muted"><?php echo $employe['id_admin']?></p>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="fw-bold mb-1"><?php echo $employe['nom']?></p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="text-muted mb-1"><?php echo $employe['motdepasse'] ?></p>
                    </td>
                    <!-- <td>
                        <button type="button" class="btn btn-link btn-sm btn-rounded d-flex">
                            <form action="" method="POST">
                                <input class="rounded-pill px-2 py-2 ms-1 border-0" type="submit" value="SUPPRIMER" name="" id="btn_actions">
                            </form>
                        </button>
                    </td> -->
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>