<?php require('db.php'); 

if(empty($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$req = $db->prepare("UPDATE todo SET realized_at = :realized WHERE todo_id = :todo_id");
$req->bindValue(":todo_id", $_POST['id'], PDO::PARAM_INT);
if (isset($_POST['checked'])) {
    $now = new DateTime('now', new DateTimeZone('Europe/Paris'));

    $req->bindValue(":realized", $now->format("Y-m-d H:i:s"), PDO::PARAM_STR);
} else {
    $req->bindValue(":realized", null, PDO::PARAM_NULL);
}
$req->execute();

?>