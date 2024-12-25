<?php
require_once 'app/model/UserModel.php';

class UserController {

    public function __construct() {
        // Démarrer la session si elle n'est pas déjà active
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function showLoginForm() {
        include 'app/view/login.php';  // Affiche le formulaire de connexion
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Vérifier si les champs requis sont présents
            if (isset($_POST['name'], $_POST['email'], $_POST['password'], $_POST['phone'], $_POST['address'])) {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
                $role = 'user';  // Valeur par défaut pour les utilisateurs
    
                // Créer une instance du modèle UserModel
                $userModel = new UserModel();
                // Insérer l'utilisateur dans la base de données
                $userModel->register($name, $email, $password, $phone, $address, $role);
    
                // Vérifier les identifiants après l'inscription
                $user = $userModel->verifyLogin($email, $password);  // Utiliser la méthode qui vérifie l'utilisateur
    
                if ($user) {
                    // Démarrer la session et stocker les informations de l'utilisateur
                    session_start();
                    $_SESSION['user'] = $user;  // Stocker les informations de l'utilisateur
                    $_SESSION['role'] = $user['role'];  // Stocker le rôle de l'utilisateur
                    
                    // Rediriger selon le rôle
                    if ($user['role'] == 'admin') {
                        header('Location: index.php?action=admin');
                    } else {
                        //header(header: 'Location: index.php?action=confirmation');
                        header(header: 'Location: index.php?action=catalog');
                    }
                    exit();
                } else {
                    echo "Erreur lors de la connexion après l'inscription.";
                }
            } else {
                echo "Tous les champs doivent être remplis.";
            }
        } else {
            include 'app/view/register.php';  // Affiche le formulaire d'inscription
        }
    }
    

  
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Vérifier si les champs email et password sont remplis
            if (isset($_POST['email'], $_POST['password'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];
        
                $userModel = new UserModel();
                $user = $userModel->login($email, $password);
        
                if ($user) {
                    // Stocker l'utilisateur dans la session
                    $_SESSION['user'] = $user;
                    $_SESSION['role'] = $user['role'];
        
                    // Vérifier le rôle et rediriger en conséquence
                    if ($user['role'] == 'admin') {
                        // Rediriger vers index.php?action=admin
                        header('Location: index.php?action=admin');
                    } else {
                        // Rediriger vers la page de confirmation ou tableau de bord utilisateur
                        header('Location: index.php?action=confirmation');
                    }
                    exit();  // Terminer l'exécution du script
                } else {
                    echo "Identifiants incorrects.";
                }
            } else {
            // Afficher le formulaire de connexion
            include 'app/view/login.php';
        }}}
          
        
        }

?>
