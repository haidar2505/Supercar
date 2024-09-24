<?php
    $errors = false;
    $nom_error = $prenom_error = $email_error = $message_error = NULL;
    $nom = $prenom = $email = $message = NULL;
    include("../Database/connexion.php");
    if (isset($_POST["envoyer"])){
        $nom = mysqli_real_escape_string($bdd, $_POST["Nom"]);
        $prenom = mysqli_real_escape_string($bdd, $_POST["Prenom"]);
        $email = mysqli_real_escape_string($bdd, $_POST["Email"]);
        $message = mysqli_real_escape_string($bdd, $_POST["Message"]);
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
        }elseif (!str_contains($email, '@')){
            $email_error = 'Entrez un email valide avec un "@"';
            $errors = true;
        }
        if ($message == ""){
            $message_error = 'Entrez votre message';
            $errors = true;
        }
        if (!$errors){
            $insert = "INSERT INTO contact (Nom, Prenom, Email, Message) VALUES ('$nom', '$prenom', '$email', '$message')";
            mysqli_query($bdd, $insert);
        }
    }
    if (isset($_POST['clear_form'])){
        $nom_error = $prenom_error = $email_error = $message_error = NULL;
    }
?>