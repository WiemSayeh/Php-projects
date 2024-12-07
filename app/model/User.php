<?php

class User
{
    private $conn;

    // Le constructeur reçoit une connexion à la base de données
    public function __construct($db)
    {
        $this->conn = $db;
    }

    /**
     * Crée un nouvel utilisateur dans la base de données.
     */
    public function create($name, $email, $password)
    {
        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId(); // Retourne l'ID du dernier utilisateur créé
        } else {
            return false;
        }
    }

    /**
     * Récupère un utilisateur par son e-mail.
     */
    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne un tableau associatif si trouvé
    }
}
