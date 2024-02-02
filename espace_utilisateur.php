<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace Utilisateur</title>
    <link rel="stylesheet" href="css/espace_utilisateur.css">
</head>
<body>
<?php include("header_connecter.php") ?>
<div class="espace-utilisateur">
    <div class="ajouter_sejour" onclick="window.location.href = 'création_séjour.php'">
        <div class="cree-un-sejour">Crée un séjour</div>
    </div>
    <div class="frame-titre">
        <div class="historique">Historique</div>
    </div>
    <form method="post" class="frame-filtre">
        <input type="submit" class="tout" value="Tout" name="tout">
        <input type="submit" class="effectuer" value="effectué" name="effectuer">
        <input type="submit" class="en-cours" value="en cours" name="en-cours">
        <input type="submit" class="venir" value="à venir" name="venir">
    </form>
    <table class="table-tableau">
        <thead class="titre-tab">
            <tr class="tr-titre">
                <th class="tableau">Motif du Séjour</th>
                <th class="tableau">Date</th>
                <th class="tableau">Médecin</th>
                <th class="tableau">Spécialité</th>
                <th class="tableau">Statue</th>
            </tr>
        </thead>
        <tbody class="info-tab">
            <?php
            include ("configBDD.php");
            $database = new configBDD();
            $database->connexion();

            if (isset($_POST['tout'])){
                $list = $database->utilisateur_sejour("tout");
            }elseif (isset($_POST['effectuer'])){
                $list = $database->utilisateur_sejour("effectue");
            }elseif (isset($_POST['en-cours'])){
                $list = $database->utilisateur_sejour("en cours");
            }elseif (isset($_POST['venir'])){
                $list = $database->utilisateur_sejour("a venir");
            }else {
                $list = $database->utilisateur_sejour("tout");
            }
            while ($row = $list->fetch()) {
                echo "<tr class='tr-info'>";
                echo "<td class='tableau'>";
                echo  $row['motif'];
                echo "</td>";
                echo "<td class='tableau'>";
                $dateObj = new DateTime($row['date']);
                $date = $dateObj->format('d-m-Y H:i:s');
                echo  $date;
                echo "</td>";
                echo "<td class='tableau'>";
                $medecin = $database->medecin($row['medecin']);
                echo  $medecin['nom'];
                echo "</td>";
                echo "<td class='tableau'>";
                echo  $row['specialite'];
                echo "</td>";
                echo "<td class='tableau'>";
                $dateeff = new DateTime();
                $interval = date_diff($dateObj, $dateeff);
                $datei = $interval->format('%R%H%D%M%Y');
                if ($datei >= +02){
                    echo "effectué";
                }else if ($datei <= -01){
                    echo "a venir";
                }else{
                    echo "en coure";
                }
                echo "</td>";
                echo "</tr>";
            }



            ?>
        </tbody>
    </table>
</div>

</body>
</html>