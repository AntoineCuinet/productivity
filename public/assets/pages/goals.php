<?php require('db.php'); 

if(empty($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$title = 'Kirsao';
$title_page = 'Mes objectifs';
$description_page = 'My goals';
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


//requete select
$req = $db->prepare("SELECT * FROM objective WHERE user_id = :user_id");
$req->bindValue(':user_id', $user->id, PDO::PARAM_INT);
$req->execute();
$objectives = $req->fetchAll();

foreach ($objectives as $objective) {
    $longTermeValue = $objective->longTerme;
}


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


    $req  = $db->prepare("INSERT INTO objective (user_id, longTerme, moyenTerme, pourquoi, redoute, contrat) VALUES (:user_id, :longTerme, :moyenTerme, :pourquoi, :redoute, :contrat)");
    $req->bindValue(':user_id', $user->id, PDO::PARAM_INT);
    $req->bindValue(':longTerme', $longTerme, PDO::PARAM_STR);
    $req->bindValue(':moyenTerme', $moyenTerme, PDO::PARAM_STR);
    $req->bindValue(':pourquoi', $pourquoi, PDO::PARAM_STR);
    $req->bindValue(':redoute', $redoute, PDO::PARAM_STR);
    $req->bindValue(':contrat', $contrat, PDO::PARAM_STR);
    //$req->execute();

    header('Location: dashboard.php');
    exit();
}


?>

<?php include('header.php'); ?>

<div class="dashboard-container">
    <h4><?= $user->firstname; ?>, voici les objectifs entré lors de t'on inscription, tu peux les lire et les modifier ici.</h4>
    <br><br>

    <form method="POST" action="goals.php" role="objectifs" class="form">
        <div class="obj-container">
            <h3>Objectif(s) long terme</h3>
            <p>C'est le but que tu t'es fixé.</p>
            <br>
            <div class="textaera-container">
                <textarea class="textarea" id="long-terme" name="long-terme" autocomplete="off" placeholder="Entre t'on objectif long terme (sur une année), il correspond au but que tu t'es fixé !" maxlength="1000" rows="5" cols="33" spellcheck="true" required>
<?php $longTermeValue[1]; ?></textarea>
            </div>
        </div>
        <br><br>

        <div class="obj-container">
            <h3>Objectif(s) moyen terme</h3>
            <p>La meilleur façon d'atteindre cet objectif et de le diviser en plusieurs étapes.</p>
            <p>Voici t'on objectif sur le moyen terme (atteignable en 90jours).</p>
            <br>
            <div class="textaera-container">
                <textarea class="textarea" id="moyen-terme" name="moyen-terme" autocomplete="off" placeholder="Entre t'on objectif moyen terme (sur 90jours)" maxlength="1000" rows="5" cols="33" spellcheck="true" required>
<?php $notes[2]; ?></textarea>
            </div>
        </div>
        <br><br>

        <div class="obj-container">
            <h3>T'on pourquoi</h3>
            <p>Voici le pourquoi qui t'as amené ici, c'est ce qu'il te permet de continuer les jours difficiles</p>
            <p>Tu as un objectif et il y a une raison à cela !</p>
            <br>
            <div class="textaera-container">
                <textarea class="textarea" id="pourquoi" name="pourquoi" autocomplete="off" placeholder="Ecrit le pourquoi qui t'as amené ici" maxlength="1000" rows="5" cols="33" spellcheck="true" required>
<?php $notes[2]; ?></textarea>
            </div>
        </div>
        <br><br>

        <div class="obj-container">
            <h3>Ce que tu redoute</h3>
            <p>Tu vois ici que tu ne veux surtout pas dans t'as vie !</p>
            <p></p>
            <br>
            <div class="textaera-container">
                <textarea class="textarea" id="redoute" name="redoute" autocomplete="off" placeholder="Ecrit ce que tu ne veux pas être" maxlength="1000" rows="5" cols="33" spellcheck="true" required>
<?php $notes[2]; ?></textarea>
            </div>
        </div>
        <br><br>

        <div class="obj-container">
            <h3>LE CONTRAT</h3>
            <p>Modifie et re-signe t'on contrat qui te lieras avec t'es objectifs, à toi de faire en sorte de le respecter.</p>
            <br>
            <div class="textaera-container">
                <textarea class="textarea" id="contrat" name="contrat" autocomplete="off" placeholder="Ecrit le contrat que tu ne romperas jamais et qui te rendra INVAINCIBLE." maxlength="5000" rows="5" cols="33" spellcheck="true" required>
<?php $notes[2]; ?></textarea>
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
