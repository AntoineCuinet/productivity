<?php require('db.php'); 

//poour supprimer la session
//session_destroy();

if(empty($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$title = 'Kirsao';
$title_page = 'Note du jour';
$description_page = 'Note du jour';
$day = 'Note du '.date("D. M. Y"); // Utilise la date du jour comme titre


if($_SERVER["REQUEST_METHOD"] == "POST") {
    $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

    //fonction de vérif
	function verifyInput($var) {
		$var = trim($var);
		$var = stripslashes($var);
		$var = htmlspecialchars($var);
	  
		return $var;
	}
    $star = $_POST["star"];
    $story = verifyInput($_POST["story"]);

    $user_id = $_SESSION['user'];

    $req = $db->prepare("INSERT INTO note_of_the_day (user_id, title, rating, content, create_at) VALUES (:user_id, :title, :rating, :content, NOW())");
    $req->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $req->bindValue(':title', $day, PDO::PARAM_STR);
    $req->bindValue(':rating', $star, PDO::PARAM_INT);
    $req->bindValue(':content', $story, PDO::PARAM_STR);
    $req->execute();

    header('Location: dashboard.php');
    exit();


    var_dump($user_id, $day, $star, $story);
}

?>

<?php include('header.php'); ?>

<div class="dashboard-container note-of-the-day">
    <h1>T'as note du jour</h1>
    <br>
    <h3><?= $day; ?></h3>

    <form method="POST" action="noteOfTheDay.php" role="note" class="form">
        <div class="ratings"> 
            <input type="radio" name="star" id="star1" required><label for="star1"></label>
            <input type="radio" name="star" id="star2"><label for="star2"></label>
            <input type="radio" name="star" id="star3"><label for="star3"></label>
            <input type="radio" name="star" id="star4"><label for="star4"></label>
            <input type="radio" name="star" id="star5"><label for="star5"></label>
        </div>
        <br>
        <div class="textaera-container">
            <textarea class="textarea" id="story" name="story" autocomplete="off" placeholder="Entre t'as note ici" maxlength="256" rows="5" cols="33" spellcheck="true" required></textarea>
        </div>
        <br>
        <input type="submit" value="Enregister" name="valider" class="btn btn-succes">
    </form>
    <br>

    <div class="redirect-lien">
        <a href="./dashboard.php">Retourner sur mon espace</a>
    </div>
</div>



<?php include('./footer.php'); ?>