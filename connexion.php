<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="css/connexion.css">
</head>
<body>
<?php



if (isset($_POST['Se_Connecter'])) {
// Récupérez les données du formulaire
    $email = $_POST['e-mail'];
    $password = $_POST['mot-de-passe'];
    $pass = true;




    if (empty($email)) {
        echo "Erreur : le mail ne peut pas être vide. ";
        $pass = false;
    } else if (empty($password)) {
        echo "Erreur : le mot de passe ne peut pas être vide. ";
        $pass = false;
    }
    if ($pass){

        try {
            include ("configBDD.php");
            $database = new configBDD();
            $database->connexion();
            $pass = $database->conexion($email, $password);
            switch ($pass){
                case 0:
                    echo "adresse mail ou mot de passe incorrect";
                    break;
                case 1:
                    header('Location: espace_utilisateur.php');
                    break;
                case 2:
                    header('Location: gestion_plannings_medecin.php');
                    break;
            }

        } catch (PDOException $e) {
            // Gérez les erreurs de connexion
            echo "Erreur : " . $e->getMessage();
        }
    }
}

if (isset($_POST['S\'inscrire'])) {
    header('Location: inscription.php');
}


?>

<?php include("header.php") ?>
<form method="post" class="connexion-compte-utilisateur">
    <div class="frame-info">
        <div class="group-e-mail">
            <input type="email" class="frame-e-mail" id="e-mail" name="e-mail" value=<?php if (!empty($_POST['e-mail'])){echo $_POST['e-mail'];}?>>
            <label class="e-mail" for="e-mail">E-Mail</label>
        </div>
        <div class="group-mot-de-passe">
            <input type="password" class="frame-mot-de-passe" id="mot-de-passe" name="mot-de-passe" value=<?php if (!empty($_POST['mot-de-passe'])){echo $_POST['mot-de-passe'];}?>>
            <label class="mot-de-passe" for="mot-de-passe">Mot de Passe</label>
        </div>
    </div>
    <div class="frame-button">
        <input type="submit" class="frame-se-connecter" value="Se Connecter" name="Se_Connecter">
        <input type="submit" class="frame-s-inscrire" value="S'inscrire" name="S'inscrire">
    </div>
</form>


<?php
if (!empty($_POST['e-mail'])){
    $_POST['e-mail'] = "";
}

if (!empty($_POST['mot-de-passe'])){
    $_POST['mot-de-passe'] = "";
}



?>
</body>
</html>