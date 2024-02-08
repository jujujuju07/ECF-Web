<?php
include ("bdd.php");
$bdd = new bdd();
$return = $bdd->connexion();
if ($return){
    $returne = $bdd->identification($_GET["matricule"]);
    $utilisateur = array();
    while ($row = $returne->fetch()){
        $utilisateur = array();
        $utilisateur['id'] = $row['id'];
        $utilisateur['nom'] = $row['nom'];
        $utilisateur['prenom'] = $row['prenom'];
        $utilisateur['specialite'] = $row['specialite'];
        $utilisateur['matricule'] = $row['matricule'];
    }
    $json = json_encode($utilisateur);
    if ($json != "[]"){
        echo $json;
    }else{
        header('HTTP/1.0 404 Not Found');
    }
}
