<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les Produits</title>
    <style>
        /* Styles généraux */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        h1 {
            color: #333;
        }

        .btn-back {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn-back:hover {
            background-color: #0056b3;
        }

        /* Styles du tableau */
        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .product-table th, .product-table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .product-table th {
            background-color: #007BFF;
            color: white;
            font-weight: bold;
        }

        .product-table td {
            background-color: #e7f3ff;
        }

        .product-table tr:nth-child(even) td {
            background-color: #d0e7ff;
        }

        .product-table tr:hover td {
            background-color: #c5d8f7;
        }

        /* Styles des boutons */
        .btn-edit, .btn-delete {
            padding: 5px 10px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin: 5px;
        }

        .btn-edit:hover, .btn-delete:hover {
            background-color: #0056b3;
        }

        .btn-delete {
            background-color: #d9534f;
        }

        .btn-delete:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>Gestion des Produits</h1>
            <a href="index.php?action=admin" class="btn-back">Retour à la gestion des commandes</a>
        </header>

        <main>
            <?php if (count($products) > 0): ?>
                <table class="product-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <!--<th>Description</th>-->
                            <th>Prix</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?php echo $product['id']; ?></td>
                                <td><?php echo $product['name']; ?></td>
                                <!--<td><?php //echo $product['description']; ?></td>-->
                                <td><?php echo number_format($product['price'], 2, ',', ' '); ?> €</td>
                                <td><?php echo $product['stock']; ?></td>
                                <td>
                                    <a href="index.php?action=edit_product&id=<?php echo $product['id']; ?>" class="btn-edit">Modifier</a>
                                    <a href="index.php?action=delete_product&id=<?php echo $product['id']; ?>" class="btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucun produit trouvé.</p>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>
