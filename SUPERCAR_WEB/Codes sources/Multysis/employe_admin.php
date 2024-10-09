<?php
    require("Fonctions/ajouter1.php");
    require("Fonctions/supprimer.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multysis</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        /* .employe{
            display: block;
        } */
        .employe_form{
            display: none;
        }
        .table{
            width: 96%;
        }
        <?php
            if($clicked_ajouter_employe == true){
                echo $ajouter_employe_form;
            }
        ?>
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="employe navbar navbar-expand-lg navbar-light bg-white mb-3 border sticky-top">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarLeftAlignExample">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a href="admin.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="accueil_admin.php" class="nav-link">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a href="voiture_admin.php" class="nav-link">Voitures</a>
                    </li>
                    <li class="nav-item">
                        <a href="evenement_admin.php" class="nav-link">Évènements</a>
                    </li>
                    <li class="nav-item">
                        <a href="demande_admin.php" class="nav-link">Demandes</a>
                    </li>
                    <li class="nav-item">
                        <a href="contact_admin.php" class="nav-link">Contacts</a>
                    </li>
                    <li class="nav-item">
                        <a href="client_admin.php" class="nav-link">Utilisateurs</a>
                    </li>
                    <li class="nav-item">
                        <a href="employe_admin.php" class="nav-link fw-bold">Employées</a>
                    </li>
                </ul>
                <form action="" method="POST" class="d-flex">
                    <i class="ri-logout-circle-line"></i><input type="submit" class="nav-link border-0 bg-white" name="deconnection" value="Déconnexion">
                </form>
            </div>
        </div>
    </nav>
    <!--  -->
    <!-- Tableau employées -->
    <div class="d-flex flex-column align-items-center justify-content-center">
        <form action="" method="POST" class="employe btn_ajouter mb-3 border bg-white shadow">
            <input type="submit" name="ajouter_employe_form" class="btn border-0" value="Ajouter un employé(e)">
        </form>
        <table class="employe table align-middle mb-0 bg-white border table-hover shadow">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Employe</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include("../Database/connexion.php");
                    $admin_employe_query = "SELECT * FROM admin ORDER BY Id_admin;";
                    $admin_employe_result = mysqli_query($bdd,$admin_employe_query);
                    if ($admin_employe_result) {
                        while ($row = mysqli_fetch_assoc($admin_employe_result)){
                            $id = $row["Id_admin"];
                            $nom = $row["Nom"];
                            $prenom = $row["Prenom"];
                            $numtel = $row["NumTel"];
                            $email = $row["Email"];
                            $username = $row["Username"];
                ?>
                <tr>
                    <td>
                        <p class="text-muted"><?php echo $id ?></p>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="fw-bold mb-1"><?php echo $nom.' '.$prenom.' ('.$username.')'?></p>
                                <p class="text-muted mb-0"><?php echo $email ?></p>
                                <p class="text-muted mb-0"><?php echo $numtel ?></p>
                            </div>
                        </div>
                    </td>
                    <!-- <td>
                        <p class="text-muted mb-1"><?php echo $motdepasse ?></p>
                    </td> -->
                    <td>
                        <button type="button" class="btn btn-link btn-sm btn-rounded d-flex">
                            <form action="" method="POST">
                                <input type="hidden" value="<?php echo $id ?>" name="id_employe">
                                <input class="rounded-pill px-2 py-2 ms-1 border-0" type="submit" value="SUPPRIMER" name="supprimer_employe">
                            </form>
                        </button>
                    </td>
                </tr>
                <?php
                        }
                    mysqli_free_result($admin_employe_result);
                    } else {
                        echo "Error: " . mysqli_error($bdd);
                    }
                    mysqli_close($bdd);
                ?>
            </tbody>
        </table>
    </div>
    <!--  -->
    <!-- Ajouter employé form -->
    <a href="employe_admin.php" class="employe_form"><button class="button border bg-light px-3 py-2 mt-2 ms-2">Retour</button></a>
    <form action="" method="POST" class="employe_form">
        <div class="w-100 d-flex align-items-center justify-content-center mt-3">
            <div class="border w-50 py-4">
                <h1 class="text-center mb-3">Ajouter un employé(e)</h1>
                <div class="ms-5 me-5 d-flex flex-column">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex flex-column w-100 me-2">
                            <label for="recipient-name" class="col-form-label">Nom<span>*</span></label>
                            <input type="text" class="form-control" name="nom_ajouter" value="<?php echo $nom_ajouter ?>">
                            <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $nom_ajouter_error ?></p>
                        </div>
                        <div class="flex-column w-100 ms-2">
                            <label for="recipient-name" class="col-form-label">Prenom<span>*</span></label>
                            <input type="text" class="form-control" name="prenom_ajouter" value="<?php echo $prenom_ajouter ?>">
                            <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $prenom_ajouter_error ?></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex flex-column w-100 me-2">
                            <label for="recipient-name" class="col-form-label">Numéro téléphonique<span>*</span></label>
                            <input type="text" class="form-control" name="numtel_ajouter" value="<?php echo $numtel_ajouter ?>">
                            <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $numtel_ajouter_error ?></p>
                        </div>
                        <div class="flex-column w-100 ms-2">
                            <label for="recipient-name" class="col-form-label">E-mail<span>*</span></label>
                            <input type="text" class="form-control" name="email_ajouter" value="<?php echo $email_ajouter ?>">
                            <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $email_ajouter_error ?></p>
                        </div>
                    </div>
                    <div class="flex-column w-100">
                        <label for="recipient-name" class="col-form-label">Username<span>*</span></label>
                        <input type="text" class="form-control" name="username_ajouter" value="<?php echo $username_ajouter ?>">
                        <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $username_ajouter_error ?></p>
                    </div>
                    <div class="d-flex">
                        <div class="flex-column w-100 me-2">
                            <label for="recipient-name" class="col-form-label">Mot de passe<span>*</span></label>
                            <input type="text" class="form-control" name="mot_de_passe_ajouter" value="<?php echo $mot_de_passe_ajouter ?>">
                            <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $mot_de_passe_ajouter_error ?></p>
                        </div>
                        <div class="flex-column w-100 ms-2">
                            <label for="recipient-name" class="col-form-label">Confirmer mot de passe<span>*</span></label>
                            <input type="text" class="form-control" name="mot_de_passe__confirmer_ajouter" value="<?php echo $mot_de_passe__confirmer_ajouter ?>">
                            <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $mot_de_passe__confirmer_ajouter_error ?></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-around w-100 mt-3 mb-3">
                        <input class="btn rounded w-25 border" type="submit" value="Ajouter" name="ajouter_employe">
                        <input type="submit" class="btn rounded border" name="ajouter_form_clear" value="Annuler">
                    </div>
            </div>
        </div>
    </form>
    <!--  -->
</body>