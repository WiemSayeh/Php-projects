<?php
// app/controller/AdminController.php
require_once 'app/model/OrdersModel.php';


class AdminController {
    private $ordersModel;
    private $productModel;


    public function __construct() {
        $this->ordersModel = new OrdersModel();  // Assurez-vous que le modèle des commandes est bien créé
    }

    public function showOrders() {
        // Récupérer les commandes depuis le modèle
        $orders = $this->ordersModel->getAllOrders();

        // Inclure la vue pour afficher les commandes
        require 'app/view/admin_orders.php';
    }

    public function manageProducts() {
        // Récupérer tous les produits
        $products = ProductModel::getAllProducts(); // Assure-toi que tu as une méthode getAllProducts dans ton modèle ProductModel
    
        // Afficher la vue des produits
        require_once 'app/view/admin_manage_products.php'; // La vue où les produits seront affichés
    }


    public function editProduct() {
        // Récupérer l'ID du produit depuis l'URL
        $productId = $_GET['id'];
    
        // Récupérer les données du produit à partir du modèle
        $product = ProductModel::getProductById($productId);
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Traiter la mise à jour du produit
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $stock = $_POST['stock'];
    
            // Mettre à jour le produit dans la base de données
            ProductModel::updateProduct($productId, $name, $description, $price, $stock);
    
            // Rediriger vers la liste des produits après la mise à jour
            header('Location: index.php?action=manage_products');
            exit();
        }
    
        // Afficher la vue de modification du produit
        require_once 'app/view/admin_edit_product.php';
    }

    // Fonction de suppression de produit
    public function deleteProduct($id) {
        // Appeler la méthode de suppression dans le modèle
        $deleted = ProductModel::deleteProduct($id); // Utiliser la méthode statique directement sur la classe
    
        if ($deleted) {
            // Rediriger vers la page des produits après suppression
            header('Location: index.php?action=manage_products');
            exit();
        } else {
            // Afficher un message d'erreur si la suppression échoue
            echo "Erreur lors de la suppression du produit.";
        }
    }

    public function addProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $stock = $_POST['stock'];
            
            // Gérer l'upload de l'image
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['image']['tmp_name'];
                $fileName = $_FILES['image']['name'];
                $fileSize = $_FILES['image']['size'];
                $fileType = $_FILES['image']['type'];
                
                // Définir le dossier de destination pour les images
                $uploadDir = 'public/images/';
                $destPath = $uploadDir . $fileName;
                
                // Déplacer le fichier téléchargé vers le dossier de destination
                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    // Ajouter le produit avec l'image
                    ProductModel::addProduct($name, $description, $price, $stock, $fileName);
                    
                    // Rediriger vers la gestion des produits après ajout
                    header('Location: index.php?action=manage_products');
                    exit();
                } else {
                    echo "Erreur lors de l'upload de l'image.";
                }
            } else {
                // Ajouter le produit sans image (si aucune image n'est téléchargée)
                ProductModel::addProduct($name, $description, $price, $stock);
                header('Location: index.php?action=manage_products');
                exit();
            }
        }
    
        // Afficher la vue pour ajouter un produit
        require_once 'app/view/admin_add_product.php';
    }

    

}

?>
