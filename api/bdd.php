<?php

class bdd
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

    function identification($matricule)
    {
        $conn = $this->conn;

        $stmt = $conn->prepare('SELECT * FROM medecin WHERE matricule = ?');
        $stmt->execute(array($matricule));
        return $stmt;

    }

}