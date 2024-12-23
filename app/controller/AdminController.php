<?php
// app/controller/AdminController.php
require_once 'app/model/OrdersModel.php';

class AdminController {
    private $ordersModel;

    public function __construct() {
        $this->ordersModel = new OrdersModel();  // Assurez-vous que le modèle des commandes est bien créé
    }

    public function showOrders() {
        // Récupérer les commandes depuis le modèle
        $orders = $this->ordersModel->getAllOrders();

        // Inclure la vue pour afficher les commandes
        require 'app/view/admin_orders.php';
    }
}

?>
