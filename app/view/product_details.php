<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Produit</title>
    <!-- Intégration de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icônes Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .product-image {
            width: 100%; /* Remplir le conteneur */
            height: auto; /* Garde les proportions */
            max-height: 400px; /* Hauteur maximale */
            object-fit: contain; /* Assure que l'image est contenue sans déformation */
        }
        .product-details {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body style="font-family: 'Roboto', sans-serif; background-color: #e9ecef;">

    <div class="container my-5">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <!-- Image du produit -->
                <img src="../public/images/<?= htmlspecialchars($product['image']); ?>" class="product-image" alt="<?= htmlspecialchars($product['name']); ?>">
            </div>
            <div class="col-lg-6 mb-4">
                <!-- Détails du produit -->
                <div class="product-details">
                    <h1 class="text-primary"><?= htmlspecialchars($product['name']); ?></h1>
                    <p class="h5">Prix: <span class="text-success"><?= htmlspecialchars($product['price']); ?>€</span></p>
                    <p class="mt-4"><?= nl2br(htmlspecialchars($product['description'])); ?></p>
                    
                    <!-- Bouton Ajouter au Panier -->
                    <a href="index.php?action=add_to_cart&id=<?= $product['id']; ?>" class="btn btn-primary mt-3">
                        <i class="bi bi-cart-plus"></i> Ajouter au Panier
                    </a>
                </div>
            </div>
        </div>
        <!-- Bouton Retour -->
        <div class="text-center mt-5">
            <a href="index.php?action=catalog" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Retour à la Liste des Produits
            </a>
        </div>
    </div>

    <!-- Ajout de Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>