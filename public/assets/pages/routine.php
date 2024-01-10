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
    $recurence = "";

    for($i = 1; $i <= 7; ++$i) {
        if(isset($_POST['d'.$i])) {
            $recurence .= $i;
        }
    }


    $req  = $db->prepare("INSERT INTO routine (user_id, title, color, recursivity) VALUES (:user_id, :title, :color, :recursivity)");
    $req->bindValue(':user_id', $user->id, PDO::PARAM_INT);
    $req->bindValue(':title', $task, PDO::PARAM_STR);
    $req->bindValue(':color', $color, PDO::PARAM_STR);
    $req->bindValue(':recursivity', $recurence, PDO::PARAM_STR);
    $req->execute();

    header('Location: dashboard.php');
    exit();
}
?>

<?php include('header.php'); ?>



<div class="dashboard-container note-of-the-day">
<form method="POST" action="routine.php" role="ajout" class="form">
    <div class="form-group">
        <input type="text" name="title" value="" required>
        <i class='bx bx-task'></i>
        <span>T'as tache</span>
    </div>
    <br>

    <div class="form-group">
        <input type="color" name="color" value="" class="color">
        <i class='bx bxs-color-fill'></i>
        <span>Donne une couleur à t'as tâche</span>
    </div>
    <br>
    <div class="form-group">
        <div class="todolist">
            <div class="row-todolist routine-todolist">
                <p>Lundi</p>
                <label style="display: inline-block;" for="text-todo-1"><input id="text-todo-'.$j.'" class="todocheck" type="checkbox" name="d1"><span></span></label>
            </div>
            <div class="row-todolist routine-todolist">
                <p>Mardi</p>
                <label style="display: inline-block;" for="text-todo-1"><input id="text-todo-'.$j.'" class="todocheck" type="checkbox" name="d2"><span></span></label>
            </div>
            <div class="row-todolist routine-todolist">
                <p>Mercredi</p>
                <label style="display: inline-block;" for="text-todo-1"><input id="text-todo-'.$j.'" class="todocheck" type="checkbox" name="d3"><span></span></label>
            </div>
            <div class="row-todolist routine-todolist">
                <p>Jeudi</p>
                <label style="display: inline-block;" for="text-todo-1"><input id="text-todo-'.$j.'" class="todocheck" type="checkbox" name="d4"><span></span></label>
            </div>
            <div class="row-todolist routine-todolist">
                <p>Vendredi</p>
                <label style="display: inline-block;" for="text-todo-1"><input id="text-todo-'.$j.'" class="todocheck" type="checkbox" name="d5"><span></span></label>
            </div>
            <div class="row-todolist routine-todolist">
                <p>Samedi</p>
                <label style="display: inline-block;" for="text-todo-1"><input id="text-todo-'.$j.'" class="todocheck" type="checkbox" name="d6"><span></span></label>
            </div>
            <div class="row-todolist routine-todolist">
                <p>Dimanche</p>
                <label style="display: inline-block;" for="text-todo-1"><input id="text-todo-'.$j.'" class="todocheck" type="checkbox" name="d7"><span></span></label>
            </div>
        </div>
    </div>
    <br><br><br>

    <input type="submit" style="margin-bottom: 50px;" value="Valider" name="valider" class="btn btn-login">
</form>
</div>

<?php include('./footer.php'); ?>
