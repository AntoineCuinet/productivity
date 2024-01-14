<?php require('db.php'); 

if(empty($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$title = 'Kirsao';
$title_page = 'Mon espace';
$description_page = 'Espace personelle';
$user = $_SESSION['user'];

$joursFrancais = [
    'Mon' => 'Lundi',
    'Tue' => 'Mardi',
    'Wed' => 'Mercredi',
    'Thu' => 'Jeudi',
    'Fri' => 'Vendredi',
    'Sat' => 'Samedi',
    'Sun' => 'Dimanche',
];
$aujourdhui = new DateTime();
$aujourdhuiFormat = $joursFrancais[$aujourdhui->format('D')] . ' ' . $aujourdhui->format('d/m/Y') . ' à ' . $aujourdhui->format('H:i.');

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

    //fonction de vérif
	function verifyInput($var) {
		$var = trim($var);
		$var = stripslashes($var);
		$var = htmlspecialchars($var);
	  
		return $var;
	}
    $longTerme = verifyInput($_POST["long-terme"]);
    $moyenTerme = verifyInput($_POST["moyen-terme"]);
    $pourquoi = verifyInput($_POST["pourquoi"]);
    $redoute = verifyInput($_POST["redoute"]);
    $contrat = verifyInput($_POST["contrat"]);


    $req  = $db->prepare("INSERT INTO objective (user_id, longTerme, moyenTerme, pourquoi, redoute, contrat, create_at) VALUES (:user_id, :longTerme, :moyenTerme, :pourquoi, :redoute, :contrat, NOW())");
    $req->bindValue(':user_id', $user->id, PDO::PARAM_INT);
    $req->bindValue(':longTerme', $longTerme, PDO::PARAM_STR);
    $req->bindValue(':moyenTerme', $moyenTerme, PDO::PARAM_STR);
    $req->bindValue(':pourquoi', $pourquoi, PDO::PARAM_STR);
    $req->bindValue(':redoute', $redoute, PDO::PARAM_STR);
    $req->bindValue(':contrat', $contrat, PDO::PARAM_STR);
    $req->execute();

    header('Location: dashboard.php');
    exit();
}


?>

<?php include('header.php'); ?>

<div class="dashboard-container">
    <h4><?= $user->firstname; ?>, toute l'équipe te souhaite la bienvenu sur <?= $title; ?></h4>
    <br>
    <p>La première étape permettant d'évoluer est de planifier ses objectifs.</p>
    <p>C'est ce que nous allons faire dès maintenant !</p>
    <p>Noté que ces renseignement sons personnelle et que personne n'y aura accès appart vous. Tout ce que vous écrirez n'engage que vous.</p>
    <br><br>

    <form method="POST" action="begining_account.php" role="objectifs" class="form">
        <div class="obj-container">
            <h3>Objectif(s) long terme</h3>
            <br>
            <div class="textaera-container">
                <textarea class="textarea" id="long-terme" name="long-terme" autocomplete="off" placeholder="Entre t'on objectif long terme (sur une année), il correspond au but que tu t'es fixé !" maxlength="1000" rows="5" cols="33" spellcheck="true" required></textarea>
            </div>
        </div>
        <br><br>

        <div class="obj-container">
            <h3>Objectif(s) moyen terme</h3>
            <p>La meilleur façon d'atteindre cet objectif et de le diviser en plusieurs étapes.</p>
            <p>Entre ici t'on objectif sur le moyen terme (atteignable en 90jours)</p>
            <br>
            <div class="textaera-container">
                <textarea class="textarea" id="moyen-terme" name="moyen-terme" autocomplete="off" placeholder="Entre t'on objectif moyen terme (sur 90jours)" maxlength="1000" rows="5" cols="33" spellcheck="true" required></textarea>
            </div>
        </div>
        <br><br>

        <div class="obj-container">
            <h3>T'on pourquoi</h3>
            <p>Entre le pourquoi qui t'as amené ici, c'est ce qu'il te permettra de continuer les jours difficiles</p>
            <p>Tu as un objectif et il y a une raison à cela !</p>
            <br>
            <div class="textaera-container">
                <textarea class="textarea" id="pourquoi" name="pourquoi" autocomplete="off" placeholder="Ecrit le pourquoi qui t'as amené ici" maxlength="1000" rows="5" cols="33" spellcheck="true" required></textarea>
            </div>
        </div>
        <br><br>

        <div class="obj-container">
            <h3>Ce que tu redoute</h3>
            <p>Entre ce que tu ne veux surtout pas dans t'as vie !</p>
            <p></p>
            <br>
            <div class="textaera-container">
                <textarea class="textarea" id="redoute" name="redoute" autocomplete="off" placeholder="Ecrit ce que tu ne veux pas être" maxlength="1000" rows="5" cols="33" spellcheck="true" required></textarea>
            </div>
        </div>
        <br><br>

        <div class="obj-container">
            <h3>LE CONTRAT</h3>
            <p>Tu t'aprète maintenant à signer un contrat qui te lieras avec t'es objectifs, à toi de faire en sorte de le respecter.</p>
            <p>Voici un template de contrat, modifie le à t'as convenance avant d'enregistrer toutes t'es informations et de le signer.</p>
            <br>
            <div class="textaera-container">
                <textarea class="textarea" id="contrat" name="contrat" autocomplete="off" placeholder="Ecrit le contrat que tu ne romperas jamais et qui te rendra INVAINCIBLE." maxlength="5000" rows="5" cols="33" spellcheck="true" required>
    OBJET: ENGAGEMENT PERSONNEL ENVERS LES OBJECTIFS FIXÉS

    CONTEXTE:
Considérant que le Souscripteur aspire à atteindre certains objectifs personnels et professionnels dans sa vie;
Considérant que le Souscripteur reconnaît l'importance de l'engagement personnel pour la réalisation de ces objectifs;

    CLAUSES:
    Définition des Objectifs:
Le Souscripteur s'engage à atteindre les objectifs écrit précédement.

    Obligations du Souscripteur:
Le Souscripteur s'engage à consacrer le temps, l'énergie et les ressources nécessaires à la réalisation des objectifs définis. Il s'engage à faire preuve de persévérance, de détermination et de discipline dans la poursuite de ces objectifs.

    Suivi et Évaluation:
Le Souscripteur établira régulièrement des évaluations de ses progrès envers les objectifs fixés. Il ajustera ses stratégies si nécessaire pour garantir une progression constante.

    Durée de l'Engagement:
Cet engagement entre en vigueur à la date de sa signature et reste en vigueur jusqu'à ce que tous les objectifs spécifiés soient atteints.</textarea>
            </div>
        </div>
        <br><br>


        <p><span>Je sousigné <?= $user->lastname; ?> <?= $user->firstname; ?> reconnaît avoir lu, compris et accepté les termes de cet Engagement Personnel envers les Objectifs Fixés.</span></p>
        <p>Date: le <?= $aujourdhuiFormat; ?></p>
        <br>
        <input type="submit" value="Signer" name="valider" class="btn btn-succes">
    </form>
    <br><br>
</div>
<?php include('./footer.php'); ?>
