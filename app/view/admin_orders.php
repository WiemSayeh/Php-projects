<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commandes - Admin</title>
    <style>
        /* Styles généraux */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        /* Tableau */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #007BFF; /* Bleu vif */
            color: white;
            font-weight: bold;
        }

        td {
            background-color: #e7f3ff; /* Bleu clair */
        }

        tr:nth-child(even) td {
            background-color: #d0e7ff; /* Bleu pâle */
        }

        tr:hover td {
            background-color: #c5d8f7; /* Bleu plus foncé au survol */
        }

        /* Boutons d'action */
        .action-buttons {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .btn-action, .btn-back {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-action:hover, .btn-back:hover {
            background-color: #0056b3;
        }

        /* Section des messages */
        p {
            text-align: center;
            font-size: 18px;
            color: #888;
        }

        /* Bouton "Retour" */
        .btn-back {
            margin-top: 20px;
            display: block;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Commandes des Clients</h1>

        <?php if (count($orders) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?php echo $order['id']; ?></td>
                            <td><?php echo $order['user_id']; ?></td>
                            <td><?php echo number_format($order['total_price'], 2, ',', ' '); ?> €</td>
                            <td><?php echo ucfirst($order['status']); ?></td>
                            <td><?php echo date('d-m-Y H:i', strtotime($order['created_at'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Aucune commande trouvée.</p>
        <?php endif; ?>

        <!-- Boutons d'action pour l'admin -->
        <div class="action-buttons">
            <a href="index.php?action=manage_products" class="btn-action">Gérer les Produits</a>
            <a href="index.php?action=add_product" class="btn-action">Ajouter un Produit</a>
            <a href="index.php?action=admin_orders" class="btn-action">Voir les Commandes</a>
        </div>

        <a href="index.php" class="btn-back">Retour à l'accueil</a>
    </div>
</body>
</html>
