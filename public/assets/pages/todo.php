<?php require('db.php'); 

if(empty($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$title = 'Kirsao';
$title_page = 'Task';
$description_page = 'Créer une tâche';
$user = $_SESSION['user'];

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

    $task = verifyInput($_POST["title"]);
    $color = verifyInput($_POST["color"]);
    $req = $db->prepare("INSERT INTO todo (user_id, title, color, create_at) VALUES (:user_id, :title, :color, NOW())");
    $req->bindValue(':user_id', $user->id, PDO::PARAM_INT);
    $req->bindValue(':title', $task, PDO::PARAM_STR);
    $req->bindValue(':color', $color, PDO::PARAM_STR);
    $req->execute();

    header('Location: dashboard.php');
    exit();
}
?>

<?php include('header.php'); ?>
<div class="dashboard-container note-of-the-day">
<form method="POST" action="todo.php" role="ajout" class="form">
    <div class="form-group">
        <input type="text" name="title" value="" required>
        <i class='bx bx-task'></i>
        <span>T'as tache</span>
    </div>
    <br>
    <div class="form-group">
        <input type="color" name="color" value="#9fc8b9" class="color">
        <i class='bx bxs-color-fill'></i>
        <span>Donne une couleur à t'as tâche</span>
    </div>
    <br>

    <input type="submit" value="Valider" name="valider" class="btn btn-login">
</form>
</div>
<?php include('./footer.php'); ?>
