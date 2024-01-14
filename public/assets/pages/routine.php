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


    $req  = $db->prepare("INSERT INTO routine (user_id, title, color, recursivity, create_at) VALUES (:user_id, :title, :color, :recursivity, NOW())");
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
        <input type="color" name="color" value="#9fc8b9" class="color">
        <i class='bx bxs-color-fill'></i>
        <span>Donne une couleur à t'as tâche</span>
    </div>
    <br>
    <div class="form-group">
        <div class="todolist">
            <div class="row-todolist routine-todolist">
                <label class="todo-title" style="display: inline-block;" for="text-todo-1">Lundi</label>
                <div class="todocheck-label"><input id="text-todo-1" type="checkbox" name="d1"><span></span></div>
            </div>
            <div class="row-todolist routine-todolist">
                <label class="todo-title" style="display: inline-block;" for="text-todo-2">Mardi</label>
                <div class="todocheck-label"><input id="text-todo-2" type="checkbox" name="d2"><span></span></div>
            </div>
            <div class="row-todolist routine-todolist">
                <label class="todo-title" style="display: inline-block;" for="text-todo-3">Mercredi</label>
                <div class="todocheck-label"><input id="text-todo-3" type="checkbox" name="d3"><span></span></div>
            </div>
            <div class="row-todolist routine-todolist">
                <label class="todo-title" style="display: inline-block;" for="text-todo-4">Jeudi</label>
                <div class="todocheck-label"><input id="text-todo-4" type="checkbox" name="d4"><span></span></div>
            </div>
            <div class="row-todolist routine-todolist">
                <label class="todo-title" style="display: inline-block;" for="text-todo-5">Vendredi</label>
                <div class="todocheck-label"><input id="text-todo-5" type="checkbox" name="d5"><span></span></div>
            </div>
            <div class="row-todolist routine-todolist">
                <label class="todo-title" style="display: inline-block;" for="text-todo-6">Samedi</label>
                <div class="todocheck-label"><input id="text-todo-6" type="checkbox" name="d6"><span></span></div>
            </div>
            <div class="row-todolist routine-todolist">
                <label class="todo-title" style="display: inline-block;" for="text-todo-7">Dimanche</label>
                <div class="todocheck-label"><input id="text-todo-7" type="checkbox" name="d7"><span></span></div>
            </div>
        </div>
    </div>
    <br><br><br>

    <input type="submit" style="margin-bottom: 50px;" value="Valider" name="valider" class="btn btn-login">
</form>
</div>

<?php include('./footer.php'); ?>
