<?php

require_once '../config/database.php'; // Inclure la connexion à la base de données
require_once '../app/models/User.php'; // Inclure le modèle User

class UserController
{
    private $db;

    // Le constructeur initialise la connexion à la base de données
    public function __construct()
    {
        // Initialiser la connexion à la base de données
        $database = new Database();
        $this->db = $database->connect();
    }

    /**
     * Gère l'enregistrement d'un nouvel utilisateur.
     */
    public function register($name, $email, $password)
    {
        // Valider les données
        if (empty($name) || empty($email) || empty($password)) {
            echo "Tous les champs sont obligatoires.";
            return;
        }

        // Vérifier si l'utilisateur existe déjà avec cet e-mail
        $userModel = new User($this->db); // Instancier le modèle User avec la connexion DB
        $existingUser = $userModel->getUserByEmail($email);

        if ($existingUser) {
            echo "Cet e-mail est déjà utilisé.";
            return;
        }

        // Hasher le mot de passe pour des raisons de sécurité
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Créer l'utilisateur
        $userId = $userModel->create($name, $email, $hashedPassword);

        if ($userId) {
            echo "Utilisateur enregistré avec succès. ID : " . $userId;
        } else {
            echo "Erreur lors de l'enregistrement.";
        }
    }
}
