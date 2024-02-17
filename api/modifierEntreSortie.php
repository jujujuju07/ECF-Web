<?php
include ("bdd.php");
$bdd = new bdd();
$return = $bdd->connexion();
if ($return){
    try {
        $bdd->modifierEntreSortie($_GET['id'],$_GET['entre'],$_GET['sortie']);
    }catch (PDOException $e){
        echo "Erreur : " . $e->getMessage();
    }
}
