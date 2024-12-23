<?php
require_once 'app/model/CatalogModel.php';

class CatalogController {
    private $catalogModel;

    public function __construct() {
        $this->catalogModel = new CatalogModel();
    }

    public function showCatalog() {
        $products = $this->catalogModel->getAllProducts();
        require 'app/view/catalog_list.php';
    }

    public function showProductDetails($productId) {
        $product = $this->catalogModel->getProductById($productId);
        require 'app/view/product_details.php';
    }
}
?>
