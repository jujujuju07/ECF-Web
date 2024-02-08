<?php
include ("bdd.php");
$bdd = new bdd();
$return = $bdd->connexion();
if ($return){
    $returne = $bdd->listPatient($_GET["idMedecin"]);
    $patients = array();
    while ($row = $returne->fetch()){
        $patient = array();
        $patient['id'] = $row['id'];
        $patient['nom'] = $row['nom'];
        $patient['prenom'] = $row['prenom'];
        $patients[] = $patient;
    }
    $json = json_encode($patients);
    if ($json != "[]"){
        echo $json;
    }else{
        header('HTTP/1.0 404 Not Found');
    }
}
