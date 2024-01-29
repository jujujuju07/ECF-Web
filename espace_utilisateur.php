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
    <div class="frame-titre">
        <div class="historique">Historique</div>
    </div>
    <form method="post" class="frame-filtre">
        <input type="submit" class="tout" value="Tout" name="tout">
        <input type="submit" class="effectuer" value="effectué" name="effectuer">
        <input type="submit" class="en-cours" value="en cours" name="en cours">
        <input type="submit" class="venir" value="à venir" name="venir">
    </form>
    <div class="frame-tableau">
        <div class="frame-info">
            <div class="motif-du-sejour">Motif du Séjour</div>
            <div class="date">Date</div>
            <div class="medecin">Médecin</div>
            <div class="specialit">Spécialité</div>
            <div class="statue">Statue</div>
        </div>
        <div class="frame-17">
            <div class="motif-du-sejour2">Motif du Séjour</div>
            <div class="date2">Date</div>
            <div class="medecin2">Médecin</div>
            <div class="specialit2">Spécialité</div>
            <div class="statue2">Statue</div>
        </div>
    </div>
</div>

</body>
</html>