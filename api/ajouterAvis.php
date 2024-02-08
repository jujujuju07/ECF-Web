<?php
include ("bdd.php");
$bdd = new bdd();
$return = $bdd->connexion();
if ($return){
    try {
        $bdd->ajouterAvis($_GET['TitreAvis'],$_GET['Date'],$_GET['Description'],$_GET['NomPrenomMedecin'],$_GET['patient']);
    }catch (PDOException $e){
        echo "Erreur : " . $e->getMessage();
    }
}
