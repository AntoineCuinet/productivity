<?php require('db.php'); 

//poour supprimer la session
//session_destroy();

if(empty($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$title = 'Kirsao';
$title_page = 'Mon espace';
$description_page = 'Espace personelle';
$user = $_SESSION['user'];
$title_dashboard = 'Salut '.$user->firstname.' !';
$firstnameError = $lastnameError = $emailError = $photoError = "";

?>

<?php include('header.php'); ?>

<div class="dashboard-container">
    <h4><?= $title_dashboard; ?></h4>
    <br>
</div>
    

<?php include('./footer.php'); ?>
