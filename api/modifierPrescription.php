<?php
include ("bdd.php");
$bdd = new bdd();
$return = $bdd->connexion();
if ($return){
    try {
        $bdd->modifierPrescription($_GET['id'],$_GET['liste_medicament'],$_GET['posologie'],$_GET['date_debut'],$_GET['date_fin'],$_GET['patient']);
    }catch (PDOException $e){
        echo "Erreur : " . $e->getMessage();
    }
}
