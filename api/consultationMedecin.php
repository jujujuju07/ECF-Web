<?php
include ("bdd.php");
$bdd = new bdd();
$return = $bdd->connexion();
if ($return){
    $returne = $bdd->consultationMedecin($_GET["idMedecin"]);
    $medecin = array();
    while ($row = $returne->fetch()){
        $medecin['id'] = $row['id'];
        $medecin['nom'] = $row['nom'];
        $medecin['prenom'] = $row['prenom'];
        $medecin['specialite'] = $row['specialite'];
        $medecin['matricule'] = $row['matricule'];
    }
    $json = json_encode($medecin);
    if ($json != "[]"){
        echo $json;
    }else{
        header('HTTP/1.0 404 Not Found');
    }
}
