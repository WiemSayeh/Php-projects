<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Produit</title>
    <style>
        /* Styles généraux */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }

        header h1 {
            margin: 0;
            font-size: 2rem;
        }

        .btn-back {
            color: #fff;
            text-decoration: none;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 10px;
            display: inline-block;
        }

        .btn-back:hover {
            background-color: #0056b3;
        }

        main {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .product-form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .form-group textarea {
            resize: vertical;
            height: 120px;
        }

        button.btn-submit {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            width: 200px;
            margin-top: 20px;
            align-self: center;
        }

        button.btn-submit:hover {
            background-color: #218838;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Ajouter un Nouveau Produit</h1>
            <a href="index.php?action=manage_products" class="btn-back">Retour à la gestion des produits</a>
        </header>

        <main>
            <form action="index.php?action=add_product" method="POST" enctype="multipart/form-data" class="product-form">
                <div class="form-group">
                    <label for="name">Nom du produit :</label>
                    <input type="text" name="name" id="name" required>
                </div>

                <div class="form-group">
                    <label for="description">Description :</label>
                    <textarea name="description" id="description" required></textarea>
                </div>

                <div class="form-group">
                    <label for="price">Prix :</label>
                    <input type="number" name="price" id="price" required step="0.01">
                </div>

                <div class="form-group">
                    <label for="stock">Stock :</label>
                    <input type="number" name="stock" id="stock" required>
                </div>

                <div class="form-group">
                    <label for="image">Image du produit :</label>
                    <input type="file" name="image" id="image" accept="image/*">
                </div>

                <button type="submit" class="btn-submit">Ajouter le produit</button>
            </form>
        </main>
    </div>

    <footer>
        <!-- Ajouter un footer si nécessaire -->
    </footer>
</body>
</html>
