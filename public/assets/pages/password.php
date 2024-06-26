<?php require('db.php'); 

if(empty($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$title = 'Kirsao';
$title_page = 'Changer de mot de passe';
$description_page = 'Espace personelle';
$user = $_SESSION['user'];
$actual = $password_confirmation = $password = "";
$actualError = $password_confirmationError = $passwordError = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

    $actual = $_POST["actual"];
    $password = $_POST["password"];
    $password_confirmation = $_POST["password_confirmation"];
    
    if(!password_verify($actual, $user->password)) {
        $actualError = 'Le mot de passe actuel est incorrect.';
    }
    if(empty($password) || strlen($password) < 7) {
        $passwordError = 'Le nouveau mot de passe doit contenir au moins 7 charactères.';
    }
    if($password != $password_confirmation) {
        $password_confirmationError = 'Les nouveaux mots de passe ne correspondent pas.';
    }

    if(empty($passwordError) && empty($password_confirmationError) && empty($actualError)){
        $req = $db->prepare('UPDATE users SET password=:password WHERE id=:id');
        $req->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
        $req->bindValue(':id', $user->id, PDO::PARAM_INT);
        $req->execute();

        $succes = 'Mot de passe mis à jour.';
    }
}
?>


<?php include('header.php'); ?>


<section class="login-container">
    

    <div class="wrapper">
        <div class="wrapper-contain">
            <h2 class="login-title"><?= $title_page; ?></h2>

            <form method="POST" action="password.php" role="changer mot de passe" class="form">

                <?php if(!empty($succes)): ?>
                    <div class="alert alert-succes">
                        <p><?= $succes; ?></p>
                    </div>
                <?php endif; ?>
                
                <div class="form-group">
                    <input type="password" name="actual" placeholder="" value="" required>
                    <span>Ton mot de passe actuel</span>
                    <!-- afficher message erreur -->
                    <?php if(!empty($actualError)): ?>
                        <div class="alert alert-danger">
                            <p><?= $actualError; ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                <br>

                <div class="form-group">
                    <input type="password" name="password" placeholder="" value="" required>
                    <span>Ton nouveau mot de passe</span>
                    <!-- afficher message erreur -->
                    <?php if(!empty($passwordError)): ?>
                        <div class="alert alert-danger">
                            <p><?= $passwordError; ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <input type="password" name="password_confirmation" placeholder="" value="" required>
                    <span>Confirme ton nouveau mot de passe</span>
                    <!-- afficher message erreur -->
                    <?php if(!empty($password_confirmationError)): ?>
                        <div class="alert alert-danger">
                            <p><?= $password_confirmationError; ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                <br>

                <input type="submit" value="Changer" name="valider" class="btn btn-login">
            </form>

            <div class="redirect-lien">
                <p><a href="./settings.php">Revenir sur mes paramètres</a></p>
            </div>
        </div>
    </div>
</section>
<?php include('./footer.php'); ?>
