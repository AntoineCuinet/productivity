<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $description_page ?? ''; ?>">
    <link rel="shortcut icon" type="image/icon" href="../favicon/favicon.png"/>
    <link rel="meta" type="application/json" href="./meta.json">
    <link href="../../style.css" rel="stylesheet" type="text/css">
    <title><?= $title_page ?? ''; ?></title>
</head>
<body>
    <header>
        <?php if(empty($_SESSION['user'])): ?>
            <a href="../../index.php">Accueil</a>
            <a href="./inscription.php">Inscription</a>
            <a href="./login.php">Connexion</a>
        <?php else: ?>
            <a href="../../index.php">Accueil</a>
            <a href="./dashboard.php">Mon compte</a>
            <a href="./logout.php">Déconnexion</a>
        <?php endif; ?>
        
    </header>