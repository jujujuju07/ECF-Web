<?php
include ("bdd.php");
$bdd = new bdd();
$return = $bdd->connexion();
if ($return){
    $returne = $bdd->listPatientDesktop();
    $patients = array();
    while ($row = $returne->fetch()){
        $patient = array();
        $patient['id'] = $row['id'];
        $patient['nom'] = $row['nom'];
        $patient['prenom'] = $row['prenom'];
        $patient['entre'] = $row['entre'];
        $patient['sortie'] = $row['sortie'];
        $patient['date'] = $row['date'];
        $patients[] = $patient;
    }
    $json = json_encode($patients);
    if ($json != "[]"){
        echo $json;
    }else{
        header('HTTP/1.0 404 Not Found');
    }
}
