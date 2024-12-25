<?php
session_start();

// Inclure les fichiers nécessaires
require_once 'app/controller/UserController.php';
require_once 'app/controller/AdminController.php';
require_once 'app/controller/CatalogController.php';
require_once 'app/controller/CartController.php';

// Définir l'action par défaut
$action = isset($_GET['action']) ? $_GET['action'] : 'catalog'; // Définit 'catalog' comme action par défaut

// Initialiser les contrôleurs
$userController = new UserController();
$adminController = new AdminController();
$catalogController = new CatalogController();
$cartController = new CartController();

// Routage selon l'action
switch ($action) {
    case 'register':
        $userController->register();
        break;

    case 'login':
        $userController->login();
        break;

    case 'admin':
        // Vérifier si l'utilisateur est connecté et est un administrateur
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            $adminController->showOrders();  // Afficher les commandes pour l'administrateur
        } else {
            echo "Accès non autorisé. Vous devez être administrateur pour accéder à cette page.";
        }
        break;

    case 'manage_products':
        // Afficher la liste des produits
        $adminController->manageProducts();
        break;
    case 'edit_product':
        // Modifier un produit
        $adminController->editProduct();
        break;

    case 'add_product':
        $adminController->addProduct();
        break;

    case 'delete_product':
        // Vérifier que l'ID est passé et est valide
        if (isset($_GET['id'])) {
            $adminController->deleteProduct($_GET['id']);
        }
        break;

    case 'catalog':
        $catalogController->showCatalog(); // Afficher le catalogue par défaut
        break;

    case 'product':
        if (isset($_GET['id'])) {
            $catalogController->showProductDetails($_GET['id']); // Afficher les détails du produit
        }
        break;

    case 'cart':
        $cartController->showCart(); // Afficher le panier
        break;

    case 'add_to_cart':
        if (isset($_GET['id'])) {
            $cartController->addToCart($_GET['id']); // Ajouter au panier
        }
        break;

    case 'confirmation':
        $cartController->confirmOrder(); // Confirmer la commande
        header('Location: app/view/confirmation.php'); // Rediriger vers la page de confirmation
        break;

    case 'remove_from_cart':
        if (isset($_GET['id'])) {
            $cartController->removeFromCart($_GET['id']); // Retirer du panier
        }
        break;

    default:
        $catalogController->showCatalog(); // Afficher le catalogue si aucune action spécifique
        break;
}
?>
