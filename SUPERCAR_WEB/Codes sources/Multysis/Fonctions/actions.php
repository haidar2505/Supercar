<?php
    require("show_visualisation.php");
    // $confirmer_demande = false;
    // $annuler_demande = false;
    $message = "À confirmer";
    $statut = NULL;
    if (isset($_POST['confimer_demande'])){
        // $confirmer_demande = true;
        $id_demande = mysqli_escape_string($bdd, $_POST ["id_demande"]);
        $message = "Confirmé";
        $date_today = date('Y-m-d');
        $view_demande_query = "SELECT Jour FROM demande_essaie a.Id_inscription = b.Id_inscription;";
        if ($date > $date_today) {
            $statut = "En attente";
        }else {
            $statut = "Terminé";
        }
    }
    if (isset($_POST['annuler_demande'])){
        $annuler_demande = true;        
    }
    // if ($confirmer_demande == true){

    // }
    // if($annuler_demande == true){
    //     $message = "Annulé";
    // }
?>