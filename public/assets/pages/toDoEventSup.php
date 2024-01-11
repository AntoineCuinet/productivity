<?php require('db.php'); 

if(empty($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$req = $db->prepare("DELETE FROM todo WHERE todo_id = :todo_id");
$req->bindValue(":todo_id", $_POST['id'], PDO::PARAM_INT);
$req->execute();


?>