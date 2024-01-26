<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Création Séjour</title>
    <link rel="stylesheet" href="css/création_séjour.css">
</head>
<body>
<?php include("header_connecter.php") ?>

<form method="post" class="creation-d-un-sejour">
    <div class="frame-info">
        <div class="frame-date-motif-du-sejour">
            <div class="frame-date">
                <label class="date" for="date">Date</label>
                <input type="datetime-local" class="input-date" id="date">
            </div>
            <div class="frame-motif-du-sejour">
                <label class="motif-du-sejour" for="motif-du-sejour">Motif du Séjour</label>
                <input type="text" class="input-motif-du-sejour" id="motif-du-sejour">
            </div>
        </div>
        <div class="frame-specialit-necessaire-medecin">
            <div class="frame-specialit-necessaire">
                <label class="specialit-necessaire" for="specialit-necessaire">Spécialité Nécessaire</label>
                <input type="text" class="input-specialit-necessaire" id="specialit-necessaire">
            </div>
            <div class="frame-medecin">
                <label class="medecin" for="medecin">Médecin</label>
                <input type="text" class="input-medecin" id="medecin">
            </div>
        </div>
    </div>
    <input type="submit" class="input-confirmation" value="Confirmation" name="confirmation">
</form>

</body>
</html>