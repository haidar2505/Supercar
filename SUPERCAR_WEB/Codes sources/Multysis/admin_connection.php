<?php require("Fonctions/admin_verify.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css">
    <title>Multysis</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        span{
            color: red;
        }
        #admin_connect{
            border: #24A0ED;
            background: #24A0ED;
            color: white;
            transition: all 0.3s ease-in-out;
        }
        #admin_connect:hover{
            background: #006DB5;
        }
        .login{
            width: 750px;
        }
        #input{
            width: 95%;
        }
        i{
            font-size: 50px;
        }
    </style>
</head>
<body>
    <form action="" method="POST">
        <div class="d-flex align-items-center justify-content-center" style="height: 100vh;">
            <div class="login d-flex align-items-center justify-content-center flex-column border rounded-5">
                <i class="ri-admin-fill mt-2"></i>
                <h2 class="mb-5"><u>AD</u>MIN</h2>
                <div class="d-flex w-100">
                    <div class="d-felx flex-column w-100 ms-3">
                        <label for="recipient-name" class="col-form-label">Username<span>*</span></label>
                        <input type="text" class="form-control" name="username_admin" id="input" value="<?php echo $username_admin ?>">
                        <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $username_admin_error ?></p>
                    </div>
                    <div class="d-felx flex-column w-100">
                        <label for="recipient-name" class="col-form-label">Mot de passe<span>*</span></label>
                        <input type="password" class="form-control" name="Mot_de_passe_Admin" id="input" value="<?php echo $password_admin ?>">
                        <p style="color: red; font-size: 15px; margin: 1% 0 -0.1% 0;" class="ms-1"><?php echo $motdepasse_error ?></p>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-center w-100 mt-3 mb-3">
                    <input class="mb-5 btn rounded mt-5 py-2 px-3 me-5" type="submit" value="Connecter" id="admin_connect" name="open_admin">
                    <input class="mb-5 btn rounded mt-5 py-2 px-3 ms-5" type="submit" value="Annuler" id="admin_connect" name="fermer">
                </div>
            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>