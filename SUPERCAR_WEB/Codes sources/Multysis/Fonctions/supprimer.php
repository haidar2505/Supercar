<?php
    include("../Database/connexion.php");
    if(isset($_POST['supprimer_voiture'])){
        $id_voiture_supprimer = htmlspecialchars($_POST['id_voiture'], ENT_QUOTES, encoding: 'UTF-8');
        $supprimer_voiture_query = "DELETE FROM voiture WHERE Id_voiture = $id_voiture_supprimer;";
        $supprimer_voiture = mysqli_query($bdd, $supprimer_voiture_query);
        header("Location:voiture_admin.php");
    }
    if(isset($_POST['supprimer_evenement'])){
        $id_evenement_supprimer = htmlspecialchars($_POST['id_event'], ENT_QUOTES, encoding: 'UTF-8');
        $supprimer_evenement_query = "DELETE FROM evenement WHERE Id_evenement = $id_evenement_supprimer;";
        $supprimer_evenement = mysqli_query($bdd, $supprimer_evenement_query);
        header("Location:evenement_admin.php");
    }
    if(isset($_POST['supprimer_employe'])){
        $id_employe_supprimer = htmlspecialchars($_POST['id_employe'], ENT_QUOTES, encoding: 'UTF-8');
        $supprimer_employe_query = "DELETE FROM admin WHERE Id_admin = $id_employe_supprimer;";
        $supprimer_employe = mysqli_query($bdd, $supprimer_employe_query);
        header("Location:employe_admin.php");
    }
?>