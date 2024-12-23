<?php
require_once 'config/database.php';

class UserModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function register($name, $email, $password, $phone, $address, $role) {
        // Hachage du mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insérer l'utilisateur dans la base de données
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password, phone, address, role, created_at) 
                                    VALUES (?, ?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("ssssss", $name, $email, $hashedPassword, $phone, $address, $role);
        $stmt->execute();
    }

 // UserController.php
public function login() {
    // Vérifier si les données de formulaire ont été soumises
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Récupérer l'email et le mot de passe depuis le formulaire
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Appeler la méthode qui vérifie les identifiants
        $user = $this->verifyLogin($email, $password);

        if ($user) {
            // Démarrer la session et stocker les informations de l'utilisateur
            session_start();
            $_SESSION['user'] = $user;  // Storing user info
            $_SESSION['role'] = $user['role'];  // Storing user role (e.g., 'admin' or 'user')
            
            // Vérifier le rôle de l'utilisateur
            if ($user['role'] === 'admin') {
                // Si l'utilisateur est un administrateur, rediriger vers la page admin
                header("Location: index.php?action=admin");
            } else {
                // Si l'utilisateur est un simple utilisateur, rediriger vers le catalogue
                header("Location: index.php?action=confirmation");
            }
            exit();
        } else {
            // En cas d'échec de connexion, afficher un message d'erreur
            $error_message = "Identifiants incorrects. Veuillez réessayer.";
            include 'app/view/login.php';  // Assurez-vous que ce fichier existe
        }
    } else {
        // Si la requête n'est pas de type POST, afficher le formulaire de connexion
        include 'app/view/login.php';
    }
}
public function verifyLogin($email, $password) {
    // Rechercher l'utilisateur par email
    $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Vérifier le mot de passe
        if (password_verify($password, $user['password'])) {
            return $user;  // Retourne l'utilisateur si les identifiants sont valides
        }
    }
    return false;  // Retourne false si l'email n'existe pas ou le mot de passe est incorrect
}}

?>