<?php
class ConnexionBdd
{
    protected string $host = "localhost";
    protected string $username = "root";
    protected string $password = "";
    protected string $dbName = "s-quiz_game";

    public function Connextion()
    {
        try {
            $bdd  = new PDO("mysql:host=$this->host;dbname=$this->dbName;charset=utf8", $this->username, $this->password);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $bdd;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}
