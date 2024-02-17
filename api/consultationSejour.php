<?php
include ("bdd.php");
$bdd = new bdd();
$return = $bdd->connexion();
if ($return){
    $returne = $bdd->consultationSejour($_GET["idSejour"]);
    $sejour = array();
    while ($row = $returne->fetch()){
        $sejour['id'] = $row['id'];
        $sejour['date'] = $row['date'];
        $sejour['motif'] = $row['motif'];
        $sejour['specialite'] = $row['specialite'];
        $sejour['entre'] = $row['entre'];
        $sejour['sortie'] = $row['sortie'];
        $sejour['medecin'] = $row['medecin'];
        $sejour['patient'] = $row['patient'];
    }
    $json = json_encode($sejour);
    if ($json != "[]"){
        echo $json;
    }else{
        header('HTTP/1.0 404 Not Found');
    }
}
