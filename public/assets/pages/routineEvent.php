<?php require('db.php'); 

if(empty($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$req = $db->prepare("INSERT INTO realized VALUES (:routine_id, CURRENT_DATE())");
$req->bindValue(":routine_id", $_POST['id'], PDO::PARAM_INT);
$req->execute();

?>