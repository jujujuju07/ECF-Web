<?php
include ("bdd.php");
$bdd = new bdd();
$return = $bdd->connexion();
if ($return){
    $returne = $bdd->consultationPriscription($_GET["idPrescription"]);
    $prescription = array();
    while ($row = $returne->fetch()){
        $prescription['id'] = $row['id'];
        $prescription['liste_medicament'] = $row['liste_medicament'];
        $prescription['posologie'] = $row['posologie'];
        $prescription['date_debut'] = $row['date_debut'];
        $prescription['date_fin'] = $row['date_fin'];
        $prescription['patient'] = $row['patient'];
    }
    $json = json_encode($prescription);
    if ($json != "[]"){
        echo $json;
    }else{
        header('HTTP/1.0 404 Not Found');
    }
}
