<?php
include ("bdd.php");
$bdd = new bdd();
$return = $bdd->connexion();
if ($return){
    $returne = $bdd->consultationAvis($_GET["idAvis"]);
    $avis = array();
    while ($row = $returne->fetch()){
        $avis['id'] = $row['id'];
        $avis['titre'] = $row['titre'];
        $avis['date'] = $row['date'];
        $avis['description'] = $row['description'];
        $avis['medecin'] = $row['medecin'];
        $avis['patient'] = $row['patient'];
    }
    $json = json_encode($avis);
    if ($json != "[]"){
        echo $json;
    }else{
        header('HTTP/1.0 404 Not Found');
    }
}
