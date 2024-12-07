<?php

class Database
{
    private $host = "localhost";
    private $db_name = "ecommerce";
    private $username = "root";
    private $password = "";
    private $conn;

    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Test: Si la connexion réussie, afficher un message
            echo "Connexion réussie à la base de données.";
        } catch (PDOException $exception) {
            // Si la connexion échoue, afficher l'erreur
            echo "Connexion échouée: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
