<?php
class ProductModel {
    public static function getProductPrice($productId) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT price FROM products WHERE id = ?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $stmt->bind_result($price);
        $stmt->fetch();
        return $price;
    }
}
