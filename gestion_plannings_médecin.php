<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Plannings Des Médecin</title>
    <link rel="stylesheet" href="css/gestion_plannings_médecin.css">
</head>
<body>
<?php include("header_connecter.php") ?>

<div class="gestions-des-plannings-des-medecins">
    <div class="frame-choisir-medecin">
        <div class="frame-choisir-medecin2">
            <label class="medecin" for="medecin">Médecin</label>
            <select class="select-medecin" id="medecin">
                <option></option>
            </select>
        </div>
        <form method="post" class="form-ajouter-medecin">
            <div class="frame-ajouter-medecin">
                <label class="medecin" for="ajouter-medecin">Médecin</label>
                <input type="text" class="frame-ajouter" id="ajouter-medecin">
            </div>
            <input type="submit" class="input-button" value="Ajouter Médecin" name="ajouter-medecin">
        </form>
    </div>
    <div class="frame-tableau">
        <div class="frame-info-medecin">
            <div class="frame-nom">
                <label for="nom" class="nom">Nom</label>
                <input type="text" disabled class="input-nom" id="nom">
            </div>
            <div class="frame-prenom">
                <label for="prenom" class="prenom">Prenom</label>
                <input type="text" disabled class="input-prenom" id="prenom">
            </div>
            <div class="frame-specialite">
                <label for="specialite" class="specialite">Specialite</label>
                <input type="text" disabled class="input-specialite" id="specialite">
            </div>
            <div class="frame-matricule">
                <label for="matricule" class="matricule">Matricule</label>
                <input type="text" disabled class="input-matricule" id="matricule">
            </div>
        </div>
        <div class="frame-tableau2">
            <div class="frame-1"></div>
            <div class="frame-2"></div>
            <div class="frame-3"></div>
            <div class="frame-4"></div>
            <div class="frame-5"></div>
        </div>
    </div>
</div>

</body>
</html>