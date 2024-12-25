<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Produit</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc; /* Bleu clair pour le fond */
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-size: 16px;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }

        input[type="text"], input[type="number"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        button {
            padding: 10px 20px;
            background-color: #007BFF; /* Bleu vif */
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3; /* Bleu plus foncé au survol */
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007BFF; /* Bleu vif */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }

        a:hover {
            background-color: #0056b3; /* Bleu plus foncé au survol */
        }
    </style>
</head>
<body>
    <h1>Modifier le Produit</h1>

    <form action="index.php?action=edit_product&id=<?php echo $product['id']; ?>" method="post">
        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" value="<?php echo $product['name']; ?>" required><br>

        <label for="description">Description :</label>
        <textarea id="description" name="description" required><?php echo $product['description']; ?></textarea><br>

        <label for="price">Prix :</label>
        <input type="number" id="price" name="price" value="<?php echo $product['price']; ?>" required><br>

        <label for="stock">Stock :</label>
        <input type="number" id="stock" name="stock" value="<?php echo $product['stock']; ?>" required><br>

        <button type="submit">Mettre à jour</button>
    </form>

    <a href="index.php?action=manage_products" class="btn-back">Retour à la gestion des produits</a>
</body>
</html>
