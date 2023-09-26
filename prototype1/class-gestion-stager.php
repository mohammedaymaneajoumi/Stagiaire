<?php

include './calss-stager.php';

class GestionStagiaire
{


    private $serverName = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname  = "addstagiaire";
    private $charset = "utf8mb4";
    private $pdo;


    public function __construct()
    {
        $this->serverName = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "addstagiaire";
        $this->charset = "utf8mb4";

        // Connect to the database 
        try {
            $DB_con = "mysql:host=" . $this->serverName . ";dbname=" . $this->dbname . ";charset=" . $this->charset;
            $this->pdo = new PDO($DB_con, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "is connected";
            return $this->pdo;
        } catch (PDOException $e) {
            // die("Failed to connect with MySQL: " . $e->getMessage());
            echo "Failed to connect with MySQL: " . $e->getMessage();
        }
    }



    public function getStagiaire(){

        $sql = "SELECT * FROM personne";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $personEndData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $NewData = array();

        foreach($personEndData as $personEndData){
            $Personne = new Personne;
            $Personne->setId( $personEndData['id']);
            $Personne->setnom($personEndData['nom']);
            $Personne->setprenom($personEndData['prenom']);
            array_push($NewData, $Personne);
        }

        return $NewData;

    }


}