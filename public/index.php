<?php require('./assets/pages/db.php'); 
 
$title_page = 'Kirsao';
$description_page = 'Page d\'accueil du site';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $description_page ?? ''; ?>">
    <link rel="shortcut icon" type="image/icon" href="./assets/favicon/favicon.png"/>
    <link rel="meta" type="application/json" href="./meta.json">
    <link href="style.css" rel="stylesheet" type="text/css">
    <title><?= $title_page.' - Accueil' ?? ''; ?></title>
</head>
<body>
    <header>
        <!-- menu principal -->
        <nav id="navbar">
            <div class="first-container">
                
                <!-- logo -->
                <a href="./index.php" class="nav-icon" aria-label="Visit homepage" aria-current="page">
                    <img src="./assets/favicon/icon.png" alt="Web site icon">
                    <span><?= $title_page; ?></span>
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
                        <a href="./index.php">Accueil</a>
                        <a href="./assets/pages/inscription.php">Inscription</a>
                        <a href="./assets/pages/login.php">Connexion</a>
                    <?php else: ?>
                        <a href="./index.php">Accueil</a>
                        <a href="./assets/pages/dashboard.php">Mon espace</a>
                        <a href="./assets/pages/logout.php">Déconnexion</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>

    </header>

    <!-- on met ici tout le contenu du site (dans des sections) -->
    <div class="contenu">
        <section class="section">
            <div class="section-container">
                <div class="h1">
                    <h1 class="titre-page"><?= $title_page; ?></h1>
                </div>
                <h2 class="titre-page"><?= $title_page; ?></h2>
                <br>
                <p>Lorem <a href="">coucou</a> ipsum dolor sit amet consectetur adipisicing elit. Praesentium eveniet atque unde nisi. Consequuntur, quasi ea blanditiis illum dignissimos eum rem. Similique eaque alias eos aliquid, veritatis mollitia quia, voluptatem, quam tenetur repellat officia. Quam, earum amet debitis suscipit repellat perspiciatis vel? Quibusdam tempora ad eaque impedit laborum. Ipsa repudiandae voluptatem qui, natus et expedita nostrum perspiciatis, labore, assumenda reiciendis nulla quia! Inventore suscipit accusantium repudiandae harum illo voluptate, sequi, ea laborum aspernatur exercitationem nostrum dolores. Sapiente, eos obcaecati quidem itaque velit quo deleniti, qui totam accusantium magnam amet aliquid ab sit cum explicabo deserunt quia recusandae hic? Laboriosam eum deleniti sint magnam itaque molestias perspiciatis, cumque ullam numquam recusandae culpa ut dicta, in praesentium asperiores fugit aliquid? Dignissimos porro nulla nemo, voluptatum asperiores nesciunt corrupti, itaque est delectus assumenda nihil consectetur. Sequi id, in error maxime ut perferendis temporibus sunt debitis quae repudiandae praesentium dolor aperiam optio eaque ipsa odio eos quam neque amet! Placeat nobis ullam doloremque impedit modi, deserunt ad deleniti dolores veniam illo repellendus commodi voluptas maxime non necessitatibus odit minus corrupti omnis sit maiores. Praesentium voluptatem enim suscipit minima blanditiis? Sequi magnam, harum nihil, accusamus pariatur provident quia tempore adipisci, asperiores maxime aspernatur in eius modi ullam repellat voluptatem tenetur sit placeat dolorum nesciunt dignissimos libero amet. Consequuntur expedita dicta deserunt nam, ducimus quidem vero velit unde eveniet laborum autem ut! Molestias atque possimus doloremque odit totam quaerat quo provident dolore animi, earum in ratione ad dignissimos sunt itaque ullam impedit autem cumque qui adipisci assumenda explicabo distinctio vel mollitia. Et numquam delectus debitis incidunt. Rerum soluta quibusdam, quisquam dolorem provident ipsa amet voluptas quae commodi sed aspernatur dolore alias ea expedita aliquam, quasi corrupti mollitia deserunt blanditiis laudantium fugiat perspiciatis sint vero. Dignissimos facere, vel sapiente vero, et nesciunt debitis quae est quibusdam nostrum aliquid dicta magnam, quaerat dolor. Consectetur dolorum, aliquam quaerat error ratione ducimus nobis eveniet dicta architecto excepturi necessitatibus, debitis commodi totam neque quibusdam consequuntur aut atque minus nam sunt a? Sed repudiandae hic placeat architecto tempora repellendus sunt voluptates nemo cumque enim amet, natus esse distinctio sequi molestiae maiores, eos at suscipit quasi consequuntur. Recusandae, quisquam? Vel tempore exercitationem alias harum illum quae ratione. Neque reiciendis magnam architecto rerum voluptatem aspernatur consequatur eius asperiores velit beatae omnis cupiditate, dignissimos optio? Soluta quisquam aliquid distinctio exercitationem, dignissimos obcaecati atque adipisci animi! Numquam officia aliquid omnis similique ducimus. Quia, accusamus? Eum, quasi. Voluptates modi impedit voluptatibus voluptas! Harum doloremque a explicabo minus quaerat qui ratione ducimus accusamus aliquid inventore quis, quasi dolorem tempora? Eveniet nisi facere repellat vitae commodi praesentium quo doloremque nostrum culpa ut maxime, corrupti neque dolore obcaecati inventore quasi perferendis officia voluptatem autem esse ea! Non delectus quibusdam ipsum totam, provident sit esse vitae libero, id quae eum, rem animi repellendus ad impedit maxime! Doloribus eaque tenetur sapiente atque illum neque magnam modi, distinctio voluptates est tempore deleniti rerum. Adipisci, consequatur doloribus totam eveniet mollitia sequi ad hic et sunt, aliquam, rem itaque quam distinctio vero? Cumque doloremque qui itaque illum inventore optio! Enim qui natus cum distinctio minima sequi laudantium autem? Eveniet aperiam magni, quasi temporibus dolor praesentium dolorum nostrum, ea rem eos nobis. Minus sequi doloremque ducimus expedita fugit tempore, sit, maxime, facilis illo fuga ad culpa! Dolores tempora ut quidem mollitia animi culpa porro ducimus? Deleniti, vero. Voluptatibus, est. Atque, perspiciatis temporibus. Ea doloremque optio accusamus asperiores cupiditate mollitia esse dolores itaque? Alias obcaecati, consequatur eum quasi, vitae quisquam nulla in unde quidem culpa veniam doloremque voluptatum maiores corporis possimus magnam quaerat? Recusandae veritatis alias voluptatem corporis, laboriosam, fugiat quia ullam magnam voluptate molestias error dignissimos.</p>
                <br>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium eveniet atque unde nisi. Consequuntur, quasi ea blanditiis illum dignissimos eum rem. Similique eaque alias eos aliquid, veritatis mollitia quia, voluptatem, quam tenetur repellat officia. Quam, earum amet debitis suscipit repellat perspiciatis vel? Quibusdam tempora ad eaque impedit laborum. Ipsa repudiandae voluptatem qui, natus et expedita nostrum perspiciatis, labore, assumenda reiciendis nulla quia! Inventore suscipit accusantium repudiandae harum illo voluptate, sequi, ea laborum aspernatur exercitationem nostrum dolores. Sapiente, eos obcaecati quidem itaque velit quo deleniti, qui totam accusantium magnam amet aliquid ab sit cum explicabo deserunt quia recusandae hic? Laboriosam eum deleniti sint magnam itaque molestias perspiciatis, cumque ullam numquam recusandae culpa ut dicta, in praesentium asperiores fugit aliquid? Dignissimos porro nulla nemo, voluptatum asperiores nesciunt corrupti, itaque est delectus assumenda nihil consectetur. Sequi id, in error maxime ut perferendis temporibus sunt debitis quae repudiandae praesentium dolor aperiam optio eaque ipsa odio eos quam neque amet! Placeat nobis ullam doloremque impedit modi, deserunt ad deleniti dolores veniam illo repellendus commodi voluptas maxime non necessitatibus odit minus corrupti omnis sit maiores. Praesentium voluptatem enim suscipit minima blanditiis? Sequi magnam, harum nihil, accusamus pariatur provident quia tempore adipisci, asperiores maxime aspernatur in eius modi ullam repellat voluptatem tenetur sit placeat dolorum nesciunt dignissimos libero amet. Consequuntur expedita dicta deserunt nam, ducimus quidem vero velit unde eveniet laborum autem ut! Molestias atque possimus doloremque odit totam quaerat quo provident dolore animi, earum in ratione ad dignissimos sunt itaque ullam impedit autem cumque qui adipisci assumenda explicabo distinctio vel mollitia. Et numquam delectus debitis incidunt. Rerum soluta quibusdam, quisquam dolorem provident ipsa amet voluptas quae commodi sed aspernatur dolore alias ea expedita aliquam, quasi corrupti mollitia deserunt blanditiis laudantium fugiat perspiciatis sint vero. Dignissimos facere, vel sapiente vero, et nesciunt debitis quae est quibusdam nostrum aliquid dicta magnam, quaerat dolor. Consectetur dolorum, aliquam quaerat error ratione ducimus nobis eveniet dicta architecto excepturi necessitatibus, debitis commodi totam neque quibusdam consequuntur aut atque minus nam sunt a? Sed repudiandae hic placeat architecto tempora repellendus sunt voluptates nemo cumque enim amet, natus esse distinctio sequi molestiae maiores, eos at suscipit quasi consequuntur. Recusandae, quisquam? Vel tempore exercitationem alias harum illum quae ratione. Neque reiciendis magnam architecto rerum voluptatem aspernatur consequatur eius asperiores velit beatae omnis cupiditate, dignissimos optio? Soluta quisquam aliquid distinctio exercitationem, dignissimos obcaecati atque adipisci animi! Numquam officia aliquid omnis similique ducimus. Quia, accusamus? Eum, quasi. Voluptates modi impedit voluptatibus voluptas! Harum doloremque a explicabo minus quaerat qui ratione ducimus accusamus aliquid inventore quis, quasi dolorem tempora? Eveniet nisi facere repellat vitae commodi praesentium quo doloremque nostrum culpa ut maxime, corrupti neque dolore obcaecati inventore quasi perferendis officia voluptatem autem esse ea! Non delectus quibusdam ipsum totam, provident sit esse vitae libero, id quae eum, rem animi repellendus ad impedit maxime! Doloribus eaque tenetur sapiente atque illum neque magnam modi, distinctio voluptates est tempore deleniti rerum. Adipisci, consequatur doloribus totam eveniet mollitia sequi ad hic et sunt, aliquam, rem itaque quam distinctio vero? Cumque doloremque qui itaque illum inventore optio! Enim qui natus cum distinctio minima sequi laudantium autem? Eveniet aperiam magni, quasi temporibus dolor praesentium dolorum nostrum, ea rem eos nobis. Minus sequi doloremque ducimus expedita fugit tempore, sit, maxime, facilis illo fuga ad culpa! Dolores tempora ut quidem mollitia animi culpa porro ducimus? Deleniti, vero. Voluptatibus, est. Atque, perspiciatis temporibus. Ea doloremque optio accusamus asperiores cupiditate mollitia esse dolores itaque? Alias obcaecati, consequatur eum quasi, vitae quisquam nulla in unde quidem culpa veniam doloremque voluptatum maiores corporis possimus magnam quaerat? Recusandae veritatis alias voluptatem corporis, laboriosam, fugiat quia ullam magnam voluptate molestias error dignissimos.</p>
            </div>
            <div class="card section-container">
                <div class="wrapper">
                    <a href="">
                        <img src="./assets/pictures/IMG_1158 2 Small.jpeg" alt="">
                    </a>
                </div>
            </div>
        </section>
        <br>
        <section class="section">
            <div class="section-container">
                <ul class="accordion">
                    <li>
                        <input type="radio" name="accordion" value="" id="first" >
                        <label for="first">C'est payant ?</label>
                        <div class="content-accordion">
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Qui, natus totam autem neque error incidunt deserunt unde ea quibusdam quidem dolor nesciunt nihil aut ad quia nostrum fugiat. Tempore, ab.</p>
                        </div>
                    </li>
                    <li>
                        <input type="radio" name="accordion" value="" id="second">
                        <label for="second">C'est vraiment fait pour moi ?</label>
                        <div class="content-accordion">
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Qui, natus totam autem neque error incidunt deserunt unde ea quibusdam quidem dolor nesciunt nihil aut ad quia nostrum fugiat. Tempore, ab.</p>
                        </div>
                    </li>
                    <li>
                        <input type="radio" name="accordion" value="" id="third">
                        <label for="third">Comment ça fonctionne ?</label>
                        <div class="content-accordion">
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Qui, natus totam autem neque error incidunt deserunt unde ea quibusdam quidem dolor nesciunt nihil aut ad quia nostrum fugiat. Tempore, ab.</p>
                        </div>
                    </li>
                    <li>
                        <input type="radio" name="accordion" value="" id="fourth">
                        <label for="fourth">Je peux tout traquer ?</label>
                        <div class="content-accordion">
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Qui, natus totam autem neque error incidunt deserunt unde ea quibusdam quidem dolor nesciunt nihil aut ad quia nostrum fugiat. Tempore, ab.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    

<?php include('./footer_index.php'); ?>
