<?php


use PHPUnit\Framework\TestCase;

class configBDDTest extends TestCase
{

    public function init(){
        include_once ("../configBDD.php");
    }

    public function testConnexion()
    {
        $this->init();
        $bdd = new configBDD();
        $return = $bdd->connexion();
        $this->assertTrue($return);
    }

    public function testAddMedecin()
    {
        $this->init();
        $bdd = new configBDD();
        $bdd->connexion();
        $return = $bdd->addMedecin("fogeron","jules","généraliser",1);
        $this->assertSame($return,true);
    }

    public function testMedecin_id()
    {
        $this->init();
        $bdd = new configBDD();
        $bdd->connexion();
        $return = $bdd->medecin_id("fogeron . jules");
        $test = [
            'id' => 1,
            0 => 1,
        ];
        $this->assertSame($return,$test);
    }

    public function testInfo_medecin()
    {
        $this->init();
        $bdd = new configBDD();
        $bdd->connexion();
        $return = $bdd->info_medecin("fogeron . jules");
        $test = [
            'nom' => 'fogeron',
            0 => 'fogeron',
            'prenom' => 'jules',
            1 => 'jules',
            'specialite' => 'généraliser',
            2 => 'généraliser',
            'matricule' => 1,
            3 => 1,
        ];
        $this->assertSame($return,$test);
    }

    public function testInscription()
    {
        $this->init();
        $bdd = new configBDD();
        $bdd->connexion();
        $return = $bdd->inscription("julesfogeron@gmail.com","fogeron","jules","1050 route du moulin, Lavilledieu","salut");
        $this->assertSame($return,1);
    }

    public function testConexion()
    {
        $this->init();
        $bdd = new configBDD();
        $bdd->connexion();
        $return = $bdd->conexion("julesfogeron@gmail.com","salut");
        $this->assertSame($return,1);
    }

    public function testMedecin()
    {
        $this->init();
        $bdd = new configBDD();
        $bdd->connexion();
        $return = $bdd->medecin(1);
        $test = [
            'nom' => 'fogeron',
            0 => 'fogeron',
        ];
        $this->assertSame($return,$test);

    }

    public function testListe_medecin()
    {
        $this->init();
        $bdd = new configBDD();
        $bdd->connexion();
        $return = $bdd->liste_medecin();
        $test = [
            0 => [
            'nom' => 'fogeron',
            0 => 'fogeron',
            'prenom' => 'jules',
            1 => 'jules',
            ],
        ];
        $this->assertSame($return->fetchAll(),$test);


    }

    public function testSejour()
    {
        $this->init();
        $bdd = new configBDD();
        $bdd->connexion();
        session_start();
        $_SESSION["id_user"] = 1;
        $return = $bdd->sejour("2024-01-29 15:05:39","malade","generaliste",1);
        $this->assertSame($return,true);
    }

    public function testUtilisateur_sejour()
    {
        $this->init();
        $bdd = new configBDD();
        $bdd->connexion();
        session_start();
        $_SESSION["id_user"] = 1;
        $return = $bdd->utilisateur_sejour("tout");
        $test = [
            0 => [
                'date' => '2024-01-29 15:05:39',
                0 => '2024-01-29 15:05:39',
                'motif' => 'malade',
                1 => 'malade',
                'specialite' => 'generaliste',
                2 => 'generaliste',
                'medecin' => 1,
                3 => 1,
            ],
        ];
        $this->assertSame($return->fetchAll(),$test);
    }
}
