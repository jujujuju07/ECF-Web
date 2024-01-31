<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Création Séjour</title>
    <link rel="stylesheet" href="css/création_séjour.css">
</head>
<body>
<?php
session_start();
if (empty($_SESSION['id_user'])){
    header("Location: index.php");
}


if (isset($_POST['confirmation'])){
    // Récupérez les données du formulaire
    $date = $_POST['date'];
    $motif_du_sejour = $_POST['motif-du-sejour'];
    $specialit_necessaire = $_POST['specialit-necessaire'];
    $medecin = $_POST['medecin'];
    $pass = true;

    if (empty($date)){
        echo "Erreur : la date ne peut pas être vide. ";
        $pass = false;
    }
    else if (empty($motif_du_sejour)) {
        echo "Erreur : le motif du sejour ne peut pas être vide. ";
        $pass = false;
    }
    else if (empty($specialit_necessaire)) {
        echo "Erreur : la Spécialité Nécessaire ne peut pas être vide. ";
        $pass = false;
    }
    else if (empty($medecin)) {
        echo "Erreur : le medécin ne peut pas être vide. ";
        $pass = false;
    }

    if ($pass){
        try {
            include ("configBDD.php");
            $database = new configBDD();
            $database->connexion();
            $medecinR = $database->medecin_id($medecin);
            $pass = $database->sejour($date,$motif_du_sejour,$specialit_necessaire,$medecinR['id']);
            if ($pass){
                header('Location: espace_utilisateur.php');
            }


        } catch (PDOException $e) {
            // Gérez les erreurs de connexion
            echo "Erreur : " . $e->getMessage();
        }
    }


}



?>



<?php include("header_connecter.php") ?>

<form method="post" class="creation-d-un-sejour">
    <div class="frame-info">
        <div class="frame-date-motif-du-sejour">
            <div class="frame-date">
                <label class="date" for="date">Date</label>
                <input type="datetime-local" class="input-date" id="date" name="date">
            </div>
            <div class="frame-motif-du-sejour">
                <label class="motif-du-sejour" for="motif-du-sejour">Motif du Séjour</label>
                <input type="text" class="input-motif-du-sejour" id="motif-du-sejour" name="motif-du-sejour">
            </div>
        </div>
        <div class="frame-specialit-necessaire-medecin">
            <div class="frame-specialit-necessaire">
                <label class="specialit-necessaire" for="specialit-necessaire">Spécialité Nécessaire</label>
                <input type="text" class="input-specialit-necessaire" id="specialit-necessaire" name="specialit-necessaire">
            </div>
            <div class="frame-medecin">
                <label class="medecin" for="medecin">Médecin</label>
                <select class="select-medecin" id="medecin" name="medecin">
                    <option></option>
                    <?php
                    include ('configBDD.php');
                    $database = new configBDD();
                    $database->connexion();
                    $list = $database->liste_medecin();
                    while ($row = $list->fetch()){
                        echo "<option>";
                        echo $row['nom'] . " " . $row['prenom'];
                        echo "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <input type="submit" class="input-confirmation" value="Confirmation" name="confirmation">
</form>

</body>
</html>