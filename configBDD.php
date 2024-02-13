<?php


class configBDD
{
    protected $conn ;
    function connexion()
    {
        $hostname_BDD = "localhost";
        $username_BDD = "ECF";
        $password_BDD = "ECFecfECF";
        $database_BDD = "foju5697_ecf";
        try {
            $this->conn = new PDO("mysql:host=$hostname_BDD;dbname=$database_BDD", $username_BDD, $password_BDD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            // Gérez les erreurs de connexion
            echo "Erreur : " . $e->getMessage();
        }
    }

    function inscription($email, $nom, $prenom, $adresse, $password)
    {
        $conn = $this->conn;

        $stmt = $conn->prepare("SELECT * FROM utilisateur WHERE nom = ? and prenom = ? and adresse = ?");
        $stmt->execute(array($nom,$prenom,$adresse));
        $utilisateur = $stmt->fetch();
        if ($utilisateur){
            return 0;
        }

        $stmt = $conn->prepare('INSERT INTO utilisateur (nom,prenom,adresse) VALUES (?,?,?)');
        $stmt->execute(array($nom,$prenom,$adresse));

        $stmt = $conn->prepare("SELECT * FROM utilisateur WHERE nom = ? and prenom = ? and adresse = ?");
        $stmt->execute(array($nom,$prenom,$adresse));
        $utilisateur = $stmt->fetch();

        $stmt = $conn->prepare('INSERT INTO user (email,password,id_user) VALUES (?,?,?)');
        $stmt->execute(array($email, md5($password), $utilisateur['id']));
        return 1;

    }

    function conexion($email, $password)
    {
        session_start();
        $conn = $this->conn;

        $stmt = $conn->prepare("SELECT id,id_user FROM user WHERE email = ? AND password = md5(?)");
        $stmt->execute(array($email,$password));
        $utilisateur = $stmt->fetch();
        if ($utilisateur){
            if ($utilisateur['id_user'] == null){
                return 2;
            }else{
                $_SESSION["id_user"] = $utilisateur["id_user"];
                return 1;
            }
        }else{
            return 0;
        }



    }

    function utilisateur_sejour($filtre)
    {
        session_start();
        $id_user = $_SESSION["id_user"];
        if (!$id_user){
            header('Location: espace_utilisateur.php');
        }
        $conn = $this->conn;

        switch ($filtre){
            case "tout":
                $stmt = $conn->prepare("SELECT date,motif,specialite,medecin FROM sejour WHERE patient = ?");
                $stmt->execute(array($id_user));
                break;
            case "effectue":
                $dateeff = new DateTime();
                $dateeff->add(DateInterval::createFromDateString('-2 hours'));
                $stmt = $conn->prepare("SELECT date,motif,specialite,medecin FROM sejour WHERE patient = ? and date <= ?");
                $stmt->execute(array($id_user,$dateeff->format('y-m-j H:i:s')));
                break;
            case "en cours":
                $dateeff = new DateTime();
                $dateeffe = new DateTime();
                $dateeffe->add(DateInterval::createFromDateString('-2 hours'));
                $stmt = $conn->prepare("SELECT date,motif,specialite,medecin FROM sejour WHERE patient = ? and date >= ? and date <= ?");
                $stmt->execute(array($id_user,$dateeffe->format('Y-m-j H:i:s'),$dateeff->format('Y-m-j H:i:s')));
                break;
            case "a venir":
                $dateeff = new DateTime();
                $stmt = $conn->prepare("SELECT date,motif,specialite,medecin FROM sejour WHERE patient = ? and date >= ?");
                $stmt->execute(array($id_user,$dateeff->format('y-m-j H:i:s')));
                break;
        }

        return $stmt;

    }

    function medecin($id)
    {
        $conn = $this->conn;

        $stmt = $conn->prepare("SELECT nom FROM medecin WHERE id = ?");
        $stmt->execute(array($id));
        return $stmt->fetch();


    }

    function liste_medecin()
    {
        $conn = $this->conn;

        return $conn->query("SELECT nom,prenom FROM medecin");
    }

    function medecin_id($nomP)
    {
        $conn = $this->conn;
        $TabNom = explode(" ", $nomP);


        $stmt = $conn->prepare("SELECT id FROM medecin WHERE nom = ? AND prenom = ?");
        $stmt->execute(array($TabNom[0],$TabNom[1]));
        return $stmt->fetch();

    }

    function sejour($date,$motif,$specialite,$medecin)
    {
        $id_user = $_SESSION["id_user"];
        $conn = $this->conn;



        $stmt = $conn->prepare("INSERT INTO sejour (date,motif,specialite,medecin,patient) VALUES (?,?,?,?,?)");
        return $stmt->execute(array($date,$motif,$specialite,$medecin,$id_user));

    }

    function addMedecin($nom,$prenom,$specialite,$matricule)
    {
        $conn = $this->conn;

        $stmt = $conn->prepar("SELECT id FROM medecin WHERE matricule = ?");
        $pass = $stmt->execute(array($matricule));
        if ($pass){
            $stmt = $conn->prepare("INSERT INTO medecin (nom,prenom,specialite,matricule) VALUES (?,?,?,?)");
            $stmt->bindParam(1,$nom);
            $stmt->bindParam(2,$prenom);
            $stmt->bindParam(3,$specialite);
            $stmt->bindParam(4,$matricule);
            return $stmt->execute();
        }else{
            return 0;
        }


    }

    function info_medecin($nomP)
    {
        $conn = $this->conn;
        $TabNom = explode(" . ", $nomP);

        $stmt = $conn->prepare("SELECT nom,prenom,specialite,matricule FROM medecin WHERE nom = ? AND prenom = ?");
        $stmt->execute(array($TabNom[0],$TabNom[1]));
        return $stmt->fetch();

    }



}