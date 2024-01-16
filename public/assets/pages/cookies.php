<?php //require('./assets/pages/db.php'); 
 
$title = 'Kirsao';
$title_page = 'Cookies';
$description_page = 'Cookies';
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
            <h2 class="titre-page"><?= $title_page; ?> & Politique de confidentialité</h2>
            <br><br><br>
        </div>
    </section>

    <section class="section">
        <div class="section-container">
            <br><br><br>

                <h5>Dernière mise à jour : 01/03/2024</h5>
                <br>
                <p>Bienvenue sur votre site <?= $title; ?> pour transformez vos rêves en réalité, l'application ultime de suivi et d'accomplissement personnel. 
                    Nous attachons une grande importance à la protection de votre vie privée et à la 
                    conformité avec les réglementations de protection des données, notamment le Règlement 
                    général sur la protection des données (RGPD) de l'Union européenne. 
                    Cette politique de confidentialité des cookies explique comment nous utilisons les 
                    cookies et d'autres technologies de suivi sur notre site Web.</p>
                <br>
                <h3>1. Qu'est-ce qu'un cookie ?</h3>
                <p>Un cookie est un petit fichier texte stocké sur votre ordinateur ou appareil mobile 
                    lorsque vous visitez notre site Web. Les cookies nous aident à améliorer votre 
                    expérience de navigation et à comprendre comment vous utilisez notre site.</p>
                <br>
                <h3>2. Consentement</h3>
                <p>Lorsque vous visitez notre site, nous sollicitons votre consentement pour utiliser 
                    des cookies conformément aux réglementations de protection des données. Vous pouvez 
                    donner votre consentement en acceptant notre bannière de cookies. Vous pouvez également 
                    gérer vos préférences de cookies en utilisant les paramètres de votre navigateur.</p>
                <br>
                <h3>3. Types de cookies que nous utilisons</h3>
                <br>
                <h4>a. Cookies essentiels</h4>
                <p>Ces cookies sont nécessaires au bon fonctionnement de notre site Web. Ils incluent des 
                    cookies de session, des cookies de préférence, et des cookies de sécurité. Sans ces 
                    cookies, le site ne fonctionnera pas correctement.</p>
                <br>
                <h4>b. Cookies de performance</h4>
                <p>Nous utilisons des cookies de performance pour recueillir des informations anonymes sur 
                    la manière dont les visiteurs utilisent notre site Web. Ces données nous aident à 
                    améliorer le contenu, les fonctionnalités et la convivialité du site.</p>
                <br>
                <h4>c. Cookies de ciblage et de publicité</h4>
                <p>Nous pouvons utiliser des cookies de ciblage et de publicité pour personnaliser le 
                    contenu et les publicités que vous voyez sur notre site et sur d'autres sites Web. 
                    Ces cookies nous aident également à mesurer l'efficacité de nos campagnes publicitaires.</p>
                <br>
                <br>
                <h3>4. Durée de conservation des cookies</h3>
                <p>La durée de conservation des cookies varie en fonction de leur type. Les cookies de session 
                    sont supprimés lorsque vous fermez votre navigateur, tandis que d'autres cookies peuvent être 
                    conservés pendant une période plus longue.</p>
                <br>
                <h3>5. Comment gérer les cookies</h3>
                <p>Vous pouvez gérer vos préférences de cookies en ajustant les paramètres de votre navigateur. 
                    Vous avez également le droit de retirer votre consentement à tout moment. Cependant, veuillez 
                    noter que le blocage ou la suppression des cookies peut affecter votre expérience sur notre 
                    site.</p>
                <br>
                <h3>6. Contactez-nous</h3>
                <p>Si vous avez des questions sur notre politique de confidentialité des cookies, veuillez nous 
                    contacter à l'adresse suivante : <a href="mailto:tristan.amiotte-suchet@edu.univ-fcomtefr">contact@kirsao.fr</a>.</p>
                <br>
                <h3>7. Modifications de la politique de confidentialité des cookies</h3>
                <p>Nous nous réservons le droit de modifier cette politique de confidentialité des cookies à 
                    tout moment. Toute modification sera publiée sur cette page avec la date de la dernière 
                    mise à jour.</p>
                <br>

                <a class="btn btn-margin-left" href="../../index.php">Retour sur le site</a>
                
                <br><br><br><br>
        </div>
    </section>
<?php include('./footer.php'); ?>
