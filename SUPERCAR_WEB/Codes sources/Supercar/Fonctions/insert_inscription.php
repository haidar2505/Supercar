<?php
    $nom = $prenom = $email = $numtel = $ville = $username = $motdepasse = $motdepasse_confirm = NULL;
    $nom_error = $prenom_error = $numtel_error = $ville_error = $email_error = $username_error = $password_error = $password_error_identique = NULL;
    $errors = false;
    $pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
    $pattern_email = '/[^@\s]+@[^@\s]+\.[^@\s]+/';
    include("../Database/connexion.php");
    if (isset($_POST["inscrire"])){
        $nom = mysqli_real_escape_string($bdd, $_POST["Nom"]);
        $prenom = mysqli_real_escape_string($bdd, $_POST["Prenom"]);
        $email = mysqli_real_escape_string($bdd, $_POST["Email"]);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $numtel = mysqli_real_escape_string($bdd, $_POST["NumTel"]);
        $ville = mysqli_real_escape_string($bdd, $_POST["Ville"]);
        $username = mysqli_real_escape_string($bdd, $_POST["Username"]);
        $motdepasse = mysqli_real_escape_string($bdd, $_POST["Mot_de_passe"]);
        $motdepasse_confirm = mysqli_real_escape_string($bdd, $_POST["Mot_de_passe_confirm"]);
        if ($nom == ""){
            $nom_error = 'Entrez votre nom';
            $errors = true;
        }elseif (is_numeric($nom)){
            $nom_error = 'Un nom ne peut pas contenir des chiffres';
            $errors = true;
        }
        if ($prenom == ""){
            $prenom_error = 'Entrez votre prénom';
            $errors = true;
        }elseif (is_numeric($prenom)){
            $prenom_error = 'Un prénom ne peut pas contenir des chiffres';
            $errors = true;
        }
        if ($email == ""){
            $email_error = 'Entrez votre email';
            $errors = true;
        }elseif (!preg_match($pattern_email, $email)){
            $email_error = 'Email invalide';
            $errors = true;
        }
        if ($numtel == ""){
            $numtel_error = 'Entrez un numéro de téléphone';
            $errors = true;
            $red_outline = ".red_outline{border-color: red;}";
        }elseif (!is_numeric($numtel)){
            $numtel_error = 'Le numéro de téléphone ne doit contenir que des chiffres';
            $errors = true;
            $red_outline = ".red_outline{border-color: red;}";
        }elseif (strlen($numtel) != 8){
            $numtel_error = 'Le numéro de téléphone doit contenir exactement 8 chiffres';
            $errors = true;
            $red_outline = ".red_outline{border-color: red;}";
        }
        if ($ville == ""){
            $ville_error = 'Entrez une ville';
            $errors = true;
        }
        if ($username == ""){
            $username_error = "Entrez un username";
        }
        if ($motdepasse == ""){
            $password_error = "Votre mot de passe doit contenir au moins une lettre capitale, un minuscule, un chiffre et un caractère spéciale";
            $errors = true;
        }elseif (!preg_match('/[A-Z]/', $motdepasse)){
            $password_error = "Votre mot de passe doit contenir au moins une lettre capitale";
            $errors = true;
        }elseif (!preg_match('/[a-z]/', $motdepasse)){
            $password_error = "Votre mot de passe doit contenir au moins une lettre minuscule";
            $errors = true;
        }
        elseif (!preg_match('/[0-9]/', $motdepasse)){
            $password_error = "Votre mot de passe doit contenir au moins un chiffre";
            $errors = true;
        }elseif (!preg_match($pattern, $motdepasse)){
            $password_error = "Votre mot de passe doit contenir au moins un caractère spéciale";
            $errors = true;
        }elseif (strlen($motdepasse) < 8){
            $password_error = "Votre mot de passe doit contenir 8 ou plus de caractère";
            $errors = true;
        }
        $verify_email = "SELECT Email FROM inscription_client WHERE Email = '$email'";
        $email_result = mysqli_query($bdd, $verify_email);
        if (mysqli_num_rows($email_result) !=0){
            $email_error = "Ce email a déjà un compte";
            $errors = true;
        }else{
            $verify_username = "SELECT Username FROM inscription_client WHERE Username = '$username'";
            $username_result = mysqli_query($bdd, $verify_username);
            if (mysqli_num_rows($username_result) != 0){
                $username_error = "Ce username est déjà prise";
                $errors = true;
            }else{
                if($motdepasse != $motdepasse_confirm){
                    $password_error_identique = "Mot de passe non identique";
                    $errors = true;
                }
            }
        }
        if (!$errors){
            $hash_motdepasse = sha1($motdepasse_confirm);
            $insert = "INSERT INTO inscription_client (Nom, Prenom, Ville, NumTel, Email, Username, Mot_de_passe) VALUES ('$nom', '$prenom', '$ville', '$numtel', '$email', '$username', '$hash_motdepasse')";
            mysqli_query($bdd, $insert);
            $showModal = true;
        }
    }
?>
<?php
if (isset($_POST['clear'])) {
    $nom = $prenom = $email = $numtel = $ville = $username = $motdepasse = $motdepasse_confirm = NULL;
}
?>
