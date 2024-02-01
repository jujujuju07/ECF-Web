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
    <div>
        <label id="erreur"></label>
        <div class="frame-choisir-medecin">
            <form method="post" class="choisir-medecin">
                <div class="frame-choisir-medecin2">
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
                            echo $row['nom'] . " . " . $row['prenom'];
                            echo "</option>";
                        }
                        ?>

                    </select>
                </div>
                <button type="submit" class="image-valider" name="choisi-medecin" ><img class="image-valider" src="image/valider.png" alt="Valider"></button>
            </form>

            <form method="post" class="form-ajouter-medecin">
                <input type="submit" class="input-button" value="Ajouter Médecin" name="ajouter-medecin">
            </form>
        </div>
    </div>
    <form method="post" class="frame-tableau">
        <div class="frame-info-medecin">
            <div class="frame-nom">
                <label for="nom" class="nom">Nom</label>
                <input type="text" <?php if (!isset($_POST['ajouter-medecin'])){ echo "disabled"; } ?> class="input-nom" id="nom" name="nom">
            </div>
            <div class="frame-prenom">
                <label for="prenom" class="prenom">Prenom</label>
                <input type="text" <?php if (!isset($_POST['ajouter-medecin'])){ echo "disabled"; } ?> class="input-prenom" id="prenom" name="prenom">
            </div>
            <div class="frame-specialite">
                <label for="specialite" class="specialite">Specialite</label>
                <input type="text" <?php if (!isset($_POST['ajouter-medecin'])){ echo "disabled"; } ?> class="input-specialite" id="specialite" name="specialite">
            </div>
            <div class="frame-matricule">
                <label for="matricule" class="matricule">Matricule</label>
                <input type="text" <?php if (!isset($_POST['ajouter-medecin'])){ echo "disabled"; } ?> class="input-matricule" id="matricule" name="matricule">
            </div>
        </div>
        <div class="ajouter-medecin" id="ajouter-medecin">
            <input type="submit" class="confirmation" value="Confirmation" name="Confirmation">
        </div>
        <div class="frame-tableau2">
            <div class="frame-1"></div>
            <div class="frame-2"></div>
            <div class="frame-3"></div>
            <div class="frame-4"></div>
            <div class="frame-5"></div>
        </div>
    </form>
</div>



<script>
    <?php
    if (!isset($_POST['ajouter-medecin'])) {
        echo "suppbutton();";
    }


    if (isset($_POST['Confirmation'])){
        // Récupérez les données du formulaire
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $specialit = $_POST['specialite'];
        $matricule = $_POST['matricule'];
        $pass = true;

        if (empty($nom)){
            echo "erreur('Erreur : le nom ne peut pas être vide.'); ";
            $pass = false;
        }
        if (empty($prenom)) {
            echo "erreur(' Erreur : le prenom ne peut pas être vide.'); ";
            $pass = false;
        }
        if (empty($specialit)) {
            echo "erreur(' Erreur : la Spécialité ne peut pas être vide.'); ";
            $pass = false;
        }
        if (empty($matricule)) {
            echo "erreur(' Erreur : le matricule ne peut pas être vide.'); ";
            $pass = false;
        }
        echo "affichage_medecin('$nom','$prenom','$specialit','$matricule');";

        if ($pass){
            try {
                $database->connexion();
                $pass = $database->addMedecin($nom,$prenom,$specialit,$matricule);
                if ($pass){
                    header("Location: gestion_plannings_medecin.php");
                }else{
                    echo "erreur('Le Matricule exist déja');";
                }


            } catch (PDOException $e) {
                // Gérez les erreurs de connexion
                echo "Erreur : " . $e->getMessage();
            }

        }


    }

    if (isset($_POST['choisi-medecin'])){
        // Récupérez les données du formulaire
        $medecin = $_POST['medecin'];
        $pass = true;

        if (empty($medecin)){
            echo "erreur('Erreur : le medecin ne peut pas être vide.');";
            $pass = false;
        }

        if ($pass){
            $database->connexion();
            $info = $database->info_medecin($medecin);

            $nom = $info['nom'];
            $prenom = $info['prenom'];
            $specialit = $info['specialite'];
            $matricule = $info['matricule'];

            echo "affichage_medecin('$nom','$prenom','$specialit','$matricule');";
        }


    }


    ?>

    function erreur(value) {
        document.getElementById("erreur").textContent += value;
    }

    function suppbutton() {
        const divajouter = document.getElementById("ajouter-medecin");
        divajouter.parentNode.removeChild(divajouter);
    }

    function affichage_medecin(nom,prenom,specialite,matricule){
        document.getElementById("nom").value = nom;
        document.getElementById("prenom").value = prenom;
        document.getElementById("specialite").value = specialite;
        document.getElementById("matricule").value = matricule;
    }
</script>

</body>
</html>