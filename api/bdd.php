<?php

class bdd
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
            return true;
        } catch (PDOException $e) {
            // Gérez les erreurs de connexion
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    function identification($matricule)
    {
        $conn = $this->conn;

        $stmt = $conn->prepare('SELECT * FROM medecin WHERE matricule = ?');
        $stmt->execute(array($matricule));
        return $stmt;

    }

    function listPatient($idmedecin)
    {
        $conn = $this->conn;

        $stmt = $conn->prepare('SELECT * FROM sejour join utilisateur on (sejour.patient = utilisateur.id) WHERE medecin = ? AND entre = 1 AND sortie = 0');
        $stmt->execute(array($idmedecin));
        return $stmt;
    }

    function listAvis($idPatient)
    {
        $conn = $this->conn;

        $stmt = $conn->prepare('SELECT * FROM avis WHERE patient = ?');
        $stmt->execute(array($idPatient));
        return $stmt;
    }

    function ajouterAvis($titre,$date,$description,$medecin,$patient)
    {
        $conn = $this->conn;

        $stmt = $conn->prepare('INSERT INTO avis (titre,date,description,medecin,patient) VALUES (?,?,?,?,?)');
        $stmt->execute(array($titre,$date,$description,$medecin,$patient));
        return $stmt;
    }

    function consultationAvis($id)
    {
        $conn = $this->conn;

        $stmt = $conn->prepare('SELECT * FROM avis WHERE id = ?');
        $stmt->execute(array($id));
        return $stmt;
    }

    function listPrescription($idPatient)
    {
        $conn = $this->conn;

        $stmt = $conn->prepare('SELECT * FROM prescription WHERE patient = ?');
        $stmt->execute(array($idPatient));
        return $stmt;
    }

    function ajouterPrescription($liste_medicament,$posologie,$date_debut,$date_fin,$patient)
    {
        $conn = $this->conn;

        $stmt = $conn->prepare('INSERT INTO prescription (liste_medicament,posologie,date_debut,date_fin,patient) VALUES (?,?,?,?,?)');
        $stmt->execute(array($liste_medicament,$posologie,$date_debut,$date_fin,$patient));
        return $stmt;
    }

    function modifierPrescription($id,$liste_medicament,$posologie,$date_debut,$date_fin,$patient)
    {
        $conn = $this->conn;

        $stmt = $conn->prepare('UPDATE prescription SET liste_medicament = ? , posologie = ? , date_debut = ? , date_fin = ? , patient = ? WHERE id = ?');
        $stmt->execute(array($liste_medicament,$posologie,$date_debut,$date_fin,$patient,$id));
        return $stmt;
    }

    function consultationPriscription($id)
    {
        $conn = $this->conn;

        $stmt = $conn->prepare('SELECT * FROM prescription WHERE id = ?');
        $stmt->execute(array($id));
        return $stmt;
    }

}