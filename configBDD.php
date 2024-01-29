<?php


class configBDD
{
    protected $conn ;
    function connexion()
    {
        $hostname_BDD = "localhost";
        $username_BDD = "ECF";
        $password_BDD = "ECFecfECF";
        $database_BDD = "ecf";
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

        $stmt = $conn->prepare("SELECT * FROM user WHERE email = ? AND password = md5(?)");
        $stmt->execute(array($email,$password));
        $utilisateur = $stmt->fetch();
        if ($utilisateur){
            $_SESSION["id_user"] = $utilisateur["id_user"];
            return 1;
        }else{
            return 0;
        }



    }


}