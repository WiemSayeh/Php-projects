<?php
require_once 'app/model/ProductModel.php';
class CartController {
    public function __construct() {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    public function addToCart($productId) {
        if (!isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] = 1;
        } else {
            $_SESSION['cart'][$productId]++;
        }
        // Vérification du contenu du panier pour débogage
        var_dump($_SESSION['cart']);  // Afficher le contenu du panier
        header('Location: index.php?action=cart');
        exit;
    }

    public function showCart() {
        require 'app/view/cart.php';
    }

    public function removeFromCart($productId) {
        if (isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }
        header('Location: index.php?action=cart');
        exit;
    }

    public function confirmOrder() {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit();
        }
    
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        
        if (empty($cart)) {
            echo "Votre panier est vide.";
            return;
        }
        
        $userId = $_SESSION['user']['id'];
        $db = Database::getInstance();
        
        // Insérer la commande dans `orders`
        $stmt = $db->prepare("INSERT INTO orders (user_id, created_at) VALUES (?, NOW())");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $orderId = $stmt->insert_id;
        
        // Insérer les éléments du panier dans `order_items`
        $stmt = $db->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        foreach ($cart as $productId => $quantity) {
            $price = ProductModel::getProductPrice($productId);
            $stmt->bind_param("iiid", $orderId, $productId, $quantity, $price);
            $stmt->execute();
        }
        
        $_SESSION['cart'] = [];
        
        header('Location: index.php?action=confirmation');
        exit;
    }
    
    
}


?>
