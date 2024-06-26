<?php require('db.php');

//poour supprimer la session
//session_destroy();

if (empty($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$title = 'Kirsao';
$title_page = 'Note du jour';
$description_page = 'Note du jour';

$joursFrancais = [
    'Mon' => 'Lundi',
    'Tue' => 'Mardi',
    'Wed' => 'Mercredi',
    'Thu' => 'Jeudi',
    'Fri' => 'Vendredi',
    'Sat' => 'Samedi',
    'Sun' => 'Dimanche',
];
$aujourdhui = new DateTime('now', new DateTimeZone('Europe/Paris'));
$day = 'Note du '. $joursFrancais[$aujourdhui->format('D')] . ' ' . $aujourdhui->format('d-m-Y');



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

    //fonction de vérif
    function verifyInput($var)
    {
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);

        return $var;
    }

    if (!empty($_POST["star"])) {
        $star = $_POST["star"];
    } else {
        $star = '1';
    }
    
    $story = verifyInput($_POST["story"]);
    $weight = verifyInput($_POST["weight"]);
    $user_id = $_SESSION['user']->id;

    $req = $db->prepare("INSERT INTO note_of_the_day (user_id, title, rating, content, create_at, weight) VALUES (:user_id, :title, :rating, :content, NOW(), :weight)");
    $req->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $req->bindValue(':title', $day, PDO::PARAM_STR);
    $req->bindValue(':rating', $star, PDO::PARAM_INT);
    $req->bindValue(':content', $story, PDO::PARAM_STR);
    $weight = strval($weight);
    $req->bindValue(':weight', $weight, PDO::PARAM_STR);
    $req->execute();

    header('Location: dashboard.php');
    exit();
}

?>

<?php include('header.php'); ?>

<div class="dashboard-container note-of-the-day">
    <h1>T'as note du jour</h1>
    <br>
    <h3><?= $day; ?></h3>

    <form method="POST" action="noteOfTheDay.php" role="note" class="form">
        <div class="ratings">
            <input type="radio" name="star" value="5" id="star1"><label for="star1"></label>
            <input type="radio" name="star" value="4" id="star2"><label for="star2"></label>
            <input type="radio" name="star" value="3" id="star3"><label for="star3"></label>
            <input type="radio" name="star" value="2" id="star5"><label for="star5"></label>
            <input type="radio" name="star" value="1" id="star4"><label for="star4"></label>
        </div>
        <br>
        <div class="textaera-container">
            <textarea class="textarea" id="story" name="story" autocomplete="off" placeholder="Entre t'as note ici" maxlength="1000" rows="5" cols="33" spellcheck="true" required></textarea>
        </div>
        <br>

        <label for="weight">Ton poids: </label>
        <div class="input-number">
            <i class='bx bx-minus'></i>
            <input id="weight" type="number" name="weight" value="60" placeholder="Kg" min="10" max="200" step="0.001" class="num-input">
            <i class='bx bx-plus'></i>
            <i class='bx bx-tachometer'></i>
        </div>
        <br>
        <!-- <div class="form-group">
            <input type="file" name="file" value="" style="cursor: pointer;">
            <i class='bx bx-image-add'></i>
            <span>T'on physique</span>
        </div>
        <br> -->

        <input type="submit" value="Enregister" name="valider" class="btn btn-succes">
    </form>
    <br>

    <div class="redirect-lien">
        <a href="./dashboard.php">Retourner sur mon espace</a>
    </div>
</div>



<?php include('./footer.php'); ?>