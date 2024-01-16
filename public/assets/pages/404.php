<?php //require('./assets/pages/db.php'); 
 
$title = 'Kirsao';
$title_page = '404';
$description_page = '404';
?>

<?php include('header.php'); ?>
   <!-- on met ici tout le contenu du site (dans des sections) -->
   <section class="section">
        <div class="section-container">
            <br><br><br>
            <div class="h1">
                <h1 class="titre-page"><?= $title_page; ?></h1>
            </div>
            <br><br>
            <h2 class="titre-page"><?= $title_page; ?> not found 🔦</h2>
            <br><br><br>
        </div>
    </section>

    <section class="section">
        <div class="section-container">
            <br><br><br>

            <div class="template-container quatre-cent-quatre">
                <h1>La page n'a pas été trouvée.</h1>
                <br>
                <p>Il n'y a rien à voir ici... </p>
                <br>
                <a class="btn btn-margin-left" href="../../index.php">Retour sur le site</a>
            </div>
            <br><br><br><br><br>
        </div>
    </section>
<?php include('./footer.php'); ?>
