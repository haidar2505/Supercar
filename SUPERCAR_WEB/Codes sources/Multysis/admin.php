<?php require("Fonctions/show_visualisation.php") ?>
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
        body{
            background-color: #f3f4f8;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white mb-3 border sticky-top">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarLeftAlignExample">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a href="admin.php" class="nav-link">Home</a>
                    </li>
                    <form action="visualisation.php" method="POST" class="d-flex">
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
                    </form>
                </ul>
            </div>
        </div>
    </nav>
    
    

</body>
</html>