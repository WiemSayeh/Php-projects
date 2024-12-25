<?php
// Démarrer la session si elle n'est pas déjà active
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">

            <a class="navbar-brand" href="index.php">
                <img src="public/images/Logo MH.png" alt="Logo de la société" width="200" height="auto">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=catalogue">Catalogue</a>
                    </li>
                    <?php if (isset($_SESSION['user'])): ?>
                        <!-- Afficher le lien de déconnexion si l'utilisateur est connecté -->
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=logout">Se déconnecter</a>
                        </li>
                    <?php else: ?>
                        <!-- Afficher le lien de connexion si l'utilisateur n'est pas connecté -->
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=login">Se connecter</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <!-- Affichage du nom et du rôle de l'utilisateur connecté dans le contenu principal -->
        <?php if (isset($_SESSION['user'])): ?>
            <div class="alert alert-info text-center">
                <strong>Bienvenue, <?= htmlspecialchars($_SESSION['user']['name']); ?> <?= htmlspecialchars($_SESSION['role']); ?></strong>
            </div>
        <?php endif; ?>

        <h1 class="text-center">Catalogue de Produits</h1>
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-md-4 mb-4">
                    <div class="card" style="width: 18rem;">
                        <img src="../public/images/<?= $product['image']; ?>" class="card-img-top product-image" alt="<?= $product['name']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($product['name']); ?></h5>
                            <p class="card-text"><?= htmlspecialchars($product['price']); ?>€</p>
                            <a href="index.php?action=product&id=<?= $product['id']; ?>" class="btn btn-primary">Voir le produit</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Lien vers Bootstrap JS (pour les fonctionnalités interactives) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
