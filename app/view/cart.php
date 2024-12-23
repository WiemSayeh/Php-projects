<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }

        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 30px;
        }

        .cart-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .cart-item {
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .cart-item p {
            margin: 0;
        }

        .cart-item a {
            color: #dc3545;
            text-decoration: none;
            font-weight: bold;
        }

        .cart-item a:hover {
            text-decoration: underline;
        }

        .cart-footer {
            text-align: center;
            margin-top: 30px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .empty-cart-message {
            text-align: center;
            font-size: 18px;
            color: #6c757d;
        }
    </style>
</head>
<body>

    <div class="cart-container">
        <h1>Votre Panier</h1>
        
        <?php if (!empty($_SESSION['cart'])): ?>
            <ul>
                <?php foreach ($_SESSION['cart'] as $productId => $quantity): ?>
                    <li class="cart-item">
                        <p>Produit ID: <?= $productId; ?> | Quantité: <?= $quantity; ?></p>
                        <a href="index.php?action=remove_from_cart&id=<?= $productId; ?>">Retirer</a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <form action="index.php?action=login" method="POST" class="cart-footer">
                <button type="submit" class="btn btn-primary">Confirmer la commande</button>
            </form>

        <?php else: ?>
            <p class="empty-cart-message">Votre panier est vide.</p>
        <?php endif; ?>
    </div>

</body>
</html>
