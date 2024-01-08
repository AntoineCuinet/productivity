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

    $task = verifyInput($_POST["title"]);;
    $req  = $db->prepare("INSERT INTO todo (user_id, title) VALUES (:user_id, :title)");
    $req->bindValue(':user_id', $user->id, PDO::PARAM_INT);
    $req->bindValue(':title', $task, PDO::PARAM_STR);
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
        <span>T'on meilleur Email</span>
    </div>
    <br>

    <input type="submit" value="Valider" name="valider" class="btn btn-login">
</form>
</div>
<?php include('./footer.php'); ?>
