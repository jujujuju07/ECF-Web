<?php
include ("bdd.php");
$bdd = new bdd();
$return = $bdd->connexion();
if ($return){
    $returne = $bdd->listAvis($_GET["idPatient"]);
    $listAvis = array();
    while ($row = $returne->fetch()){
        $avis = array();
        $avis['id'] = $row['id'];
        $avis['titre'] = $row['titre'];
        $avis['patient'] = $row['patient'];
        $listAvis[] = $avis;
    }
    $json = json_encode($listAvis);
    if ($json != "[]"){
        echo $json;
    }else{
        header('HTTP/1.0 404 Not Found');
    }
}
