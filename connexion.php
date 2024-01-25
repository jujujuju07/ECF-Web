<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="css/connexion.css">
</head>
<body>
<?php include("header.php") ?>
<form method="post" class="connexion-compte-utilisateur">
    <div class="frame-info">
        <div class="group-e-mail">
            <input type="email" class="frame-e-mail" id="e-mail" name="e-mail">
            <label class="e-mail" for="e-mail">E-Mail</label>
        </div>
        <div class="group-mot-de-passe">
            <input type="password" class="frame-mot-de-passe" id="mot-de-passe" name="mot-de-passe">
            <label class="mot-de-passe" for="mot-de-passe">Mot de Passe</label>
        </div>
    </div>
    <div class="frame-button">
        <input type="submit" class="frame-se-connecter" value="Se Connecter">
        <input type="submit" class="frame-s-inscrire" value="S’inscrire">
    </div>
</form>

</body>
</html>