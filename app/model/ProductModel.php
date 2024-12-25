<?php
class ProductModel {
    // Récupérer l'instance de la base de données (en utilisant Singleton)
    private static function getDatabaseInstance() {
        return Database::getInstance();
    }

    // Récupérer tous les produits
    public static function getAllProducts() {
        $db = self::getDatabaseInstance();
        $stmt = $db->prepare("SELECT * FROM products");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Récupérer un produit par son ID
    public static function getProductById($productId) {
        $db = self::getDatabaseInstance();
        $stmt = $db->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

     // Mettre à jour un produit
     public static function updateProduct($productId, $name, $description, $price, $stock) {
        $db = self::getDatabaseInstance();
        $stmt = $db->prepare("UPDATE products SET name = ?, description = ?, price = ?, stock = ? WHERE id = ?");
        $stmt->bind_param("ssdii", $name, $description, $price, $stock, $productId);
        return $stmt->execute();
    }


    public static function getProductPrice($productId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT price FROM products WHERE id = ?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $stmt->bind_result($price);
        $stmt->fetch();
        return $price;
    }

    // Supprimer un produit par son ID
    public static function deleteProduct($productId) {
        $db = self::getDatabaseInstance();
        // Supprimer le produit de la table products
        $stmt = $db->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $productId);
        return $stmt->execute();
    }

    // Ajouter un produit
    public static function addProduct($name, $description, $price, $stock, $image = null) {
        $db = self::getDatabaseInstance();
        
        if ($image) {
            $stmt = $db->prepare("INSERT INTO products (name, description, price, stock, image) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssdss", $name, $description, $price, $stock, $image); // Types corrigés
        } else {
            $stmt = $db->prepare("INSERT INTO products (name, description, price, stock) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssdi", $name, $description, $price, $stock); // Types corrigés
        }
    
        return $stmt->execute();
    }


}
