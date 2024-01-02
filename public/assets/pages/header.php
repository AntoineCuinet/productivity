<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $description_page ?? ''; ?>">
    <link rel="shortcut icon" type="image/icon" href="../favicon/favicon.png"/>
    <link rel="meta" type="application/json" href="./meta.json">
    <link href="../../style.css" rel="stylesheet" type="text/css">
    <!-- icon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title><?= $title.' - '.$title_page ?? ''; ?></title>
</head>
<body>
    <header>
        <!-- menu principal -->
        <nav id="navbar">
            <div class="first-container">
                
                <!-- logo -->
                <a href="../../index.php" class="nav-icon" aria-label="Visit homepage" aria-current="page">
                    <img src="../favicon/icon.png" alt="Web site icon">
                    <span><?= $title; ?></span>
                </a>

                <!-- hamburger -->
                <div class="main-navlinks">
                    <button class="hamburger" type="button" aria-label="Toggle navigation" aria-expanded="false">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>

                <!-- différents liens dns la navigation -->
                <div class="navlinks-container">
                    <?php if(empty($_SESSION['user'])): ?>
                        <a href="../../index.php">Accueil</a>
                        <a href="./inscription.php">Inscription</a>
                        <a href="./login.php">Connexion</a>
                    <?php else: ?>
                        <!-- <a href="../../index.php">Accueil</a> -->
                        <a href="./dashboard.php">Mon espace</a>
                        <a class="param" href="./settings.php">Paramètres</a>

                        <?php if(!empty($user->file)): ?>
                            <a href="./settings.php" style="float: right;" class="picture">
                                <img src="photos/<?= $user->id.'/'.$user->file; ?>" alt="photo de profil">
                            </a>
                        <?php else: ?>
                            <a class="param-unpicture" href="./settings.php">Paramètres</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>
