<?php
include ("bdd.php");
$bdd = new bdd();
$return = $bdd->connexion();
if ($return){
    try {
        $return =  $bdd->ajouterPrescription($_GET['liste_medicament'],$_GET['posologie'],$_GET['date_debut'],$_GET['date_fin'],$_GET['patient']);
        if ($return){
            echo "oui";
        }
    }catch (PDOException $e){
        header('HTTP/1.0 404 Not Found');
        echo "Erreur : " . $e->getMessage();
    }
}
