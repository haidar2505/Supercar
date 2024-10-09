<?php
    include("../Database/connexion.php");
    if (isset($_POST['confimer_demande'])){
        $id_confirmer_demande = htmlspecialchars($_POST['id_demande'], ENT_QUOTES, 'UTF-8');
        $confirmer_demande_query = "UPDATE demande_essaie SET Statut = 'Confirmé' WHERE Id_demande = $id_confirmer_demande";
        mysqli_query($bdd, $confirmer_demande_query);
        header("Location:demande_admin.php");
    }

    if(isset($_POST['terminer_demande'])){
        $id_terminer_demande = htmlspecialchars($_POST['id_demande'], ENT_QUOTES, 'UTF-8');
        $terminer_demande_query = "UPDATE demande_essaie SET Statut = 'Terminé' WHERE Id_demande = $id_terminer_demande";
        mysqli_query($bdd, $terminer_demande_query);
        header("Location:demande_admin.php");
    }


    if (isset($_POST['annuler_demande'])){
        $id_annuler_demande = htmlspecialchars($_POST['id_demande'], ENT_QUOTES, 'UTF-8');
        $annuler_demande_query = "UPDATE demande_essaie SET Statut = 'Annulé' WHERE Id_demande = $id_annuler_demande";
        mysqli_query($bdd, $annuler_demande_query);
        header("Location:demande_admin.php");
    }
?>