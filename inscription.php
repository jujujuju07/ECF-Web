<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="css/inscription.css">
</head>
<body>
<?php include("header.php") ?>

<form class="creation-d-un-compte-utilisateur" method="post">
    <div class="frame-info">
        <div class="group-e-mail-mot-de-passe">
            <div class="group-mot-de-passe">
                <input type="password" class="frame-mot-de-passe" id="mot-de-passe" name="mot-de-passe">
                <label class="mot-de-passe" for="mot-de-passe">Mot de Passe</label>
            </div>
            <div class="group-e-mail">
                <input type="email" class="frame-e-mail" id="e-mail" name="e-mail">
                <label class="e-mail" for="e-mail">E-Mail</label>
            </div>
        </div>
        <div class="group-nom-prenom">
            <div class="group-prenom">
                <input type="text" class="frame-prenom" id="prenom" name="prenom">
                <label class="prenom" for="prenom">Prénom</label>
            </div>
            <div class="group-nom">
                <input type="text" class="frame-nom" id="nom" name="nom">
                <label class="nom" for="nom">Nom</label>
            </div>
        </div>
        <div class="group-adresse-postale">
            <input type="text" class="frame-adresse-postale" id="adresse-postale" name="adresse-postale">
            <label class="adresse-postale" for="adresse-postale">Adresse postale</label>
        </div>
    </div>
    <input type="submit" class="frame-button" value="S’inscrire">
</form>

</body>
</html>