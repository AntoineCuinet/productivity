<?php require('db.php'); 

unset($_SESSION['user']);
session_destroy();

header('Location: ../../index.php');
exit();
