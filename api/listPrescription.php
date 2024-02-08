<?php
include ("bdd.php");
$bdd = new bdd();
$return = $bdd->connexion();
if ($return){
    $returne = $bdd->listPrescription($_GET["idPatient"]);
    $listPrescription = array();
    while ($row = $returne->fetch()){
        $Prescription = array();
        $Prescription['id'] = $row['id'];
        $Prescription['liste_medicament'] = $row['liste_medicament'];
        $Prescription['patient'] = $row['patient'];
        $listPrescription[] = $Prescription;
    }
    $json = json_encode($listPrescription);
    if ($json != "[]"){
        echo $json;
    }else{
        header('HTTP/1.0 404 Not Found');
    }
}
