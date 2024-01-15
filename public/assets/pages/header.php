<?php
$currentScript = basename($_SERVER['SCRIPT_FILENAME']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $description_page ?? ''; ?>">
    <link rel="shortcut icon" type="image/icon" href="../favicon/favicon.png"/>
    <link rel="meta" type="application/json" href="./meta.json">
    <link href="../../style.css" rel="stylesheet" type="text/css">
    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Gemunu+Libre:wght@700&display=swap" rel="stylesheet">

    <!-- icon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css"> -->
    <title><?= $title.' - '.$title_page ?? ''; ?></title>
</head>
<body>
    <header>
    <?php if ($currentScript !== 'begining_account.php'): ?>
        <!-- menu principal -->
        <nav id="navbar">
            <div class="first-container">
                
                <?php if(empty($_SESSION['user'])): ?>
                <!-- logo -->
                <a href="../../index.php" class="nav-icon" aria-label="Visit homepage" aria-current="page">
                    <img src="../favicon/icon.png" alt="Web site icon">
                    <span><?= $title; ?></span>
                </a>
                <?php else: ?>
                    <?php if ($currentScript !== 'dashboard.php'): ?>
                        <a href="./dashboard.php">Mon espace</a>
                    <?php else: ?>
                        <div class="link-head-dashboard"><a class="" href="dashboard.php">Général</a></div>
                        <div class="link-head-dashboard"><a href="dashboard.php">Poids</a></div>
                        <?php
                        foreach($routines as $routine) {
                            echo '<div class="link-head-dashboard"><a href="dashboard.php">'. $routine->title .'</a></div>';
                        } 
                    endif; ?>
                <?php endif; ?>

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
                        <a class="repositionne-link" href="./goals.php"><i class='bx bx-line-chart'></i></a>
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
    <?php endif; ?>
    </header>
