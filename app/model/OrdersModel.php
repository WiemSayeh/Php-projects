<?php
// app/model/OrdersModel.php
class OrdersModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance();
    }

    public function getAllOrders() {
        $query = "SELECT * FROM orders";
        $result = $this->conn->query($query);

        $orders = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }
        }
        return $orders;
    }

    public function createOrder($userId) {
        $query = "INSERT INTO orders (user_id, created_at, status) VALUES (?, NOW(), 'pending')";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $this->conn->insert_id; // Retourne l'ID de la commande créée
    }

    public function addItemToOrder($orderId, $productId, $quantity, $price) {
        $query = "INSERT INTO itemsorder (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iiid", $orderId, $productId, $quantity, $price);
        $stmt->execute();
    }

    public function getItemsByOrderId($orderId) {
        $query = "SELECT i.*, p.name AS product_name 
                  FROM itemsorder i 
                  JOIN products p ON i.product_id = p.id 
                  WHERE i.order_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();

        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        return $items;
    }
}
