<?php require('db.php'); 

//permet de rediriger direct sur le dashbord si déjà connecter auparavant
if(!empty($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit();
}

$title = 'Kirsao';
$title_page = 'Connexion';
$description_page = 'Page de connexion';
$email = $password = "";
$emailError = $passwordError = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

    //fonction de vérif
	function verifyInput($var) {
		$var = trim($var);
		$var = stripslashes($var);
		$var = htmlspecialchars($var);
	  
		return $var;
	}
    $email = verifyInput($_POST["email"]);
    $password = $_POST["password"];
    
    
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'L\'email n\'est pas valide.';
        $email = '';
    }
    if(empty($password) || strlen($password) < 7) {
        $passwordError = 'Le mot de passe doit contenir au moins 7 charactères.';
    }

    if(empty($emailError) && empty($passwordError)){
        $req = $db->prepare('SELECT * FROM users WHERE email = :email');
        $req->bindValue(':email', $email, PDO::PARAM_STR);
        $req->execute();

        $user = $req->fetch();
        if($user && password_verify($password, $user->password)) {
            $_SESSION['user'] = $user;

            $req = $db->prepare("SELECT * FROM objective WHERE user_id = :user_id");
            $req->bindValue(':user_id', $user->id, PDO::PARAM_INT);
            $req->execute();
            $objectif = $req->fetchAll();

            if (empty($objectif[0]->contrat)){
                header('Location: begining_account.php');
                exit();
            } else {
                header('Location: dashboard.php');
                exit();
            }
        }
        $passwordError = 'Mauvais identifiants.';
    }
}


include("./mobileDetect.php");
$detect = new Mobile_Detect();
?>


<?php include('header.php'); ?>

<section class="login-container">
    <?php if($detect->isMobile()): ?>
        <img src="../pictures/bglog-mobile.png" alt="bg">
    <?php else: ?>
        <img src="../pictures/bglog.png" alt="bg">
    <?php endif; ?>
   
    <div class="wrapper">
        <div class="wrapper-contain">
        
            <h2 class="login-title"><?= $title_page; ?></h2>

            <form method="POST" action="login.php" role="inscription" class="form">
                
                <div class="form-group">
                    <input type="email" name="email" value="<?= $email ?? ''; ?>" required>
                    <i class='bx bx-envelope' ></i>
                    <span>T'on meilleur Email</span>

                    <!-- afficher message erreur -->
                    <?php if(!empty($emailError)): ?>
                        <div class="alert alert-danger">
                            <p><?= $emailError; ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                <br>

                <div class="form-group">
                    <input type="password" name="password" value="" required>
                    <i class='bx bx-lock-alt' ></i>
                    <span>T'on meilleur mot de passe</span>
                    
                    <!-- afficher message erreur -->
                    <?php if(!empty($passwordError)): ?>
                        <div class="alert alert-danger">
                            <p><?= $passwordError; ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                <br>

                <input type="submit" value="Me connecter" name="valider" class="btn btn-login">
            </form>

            <div class="redirect-lien">
                <p>Tu n'as pas de compte ? <a href="./inscription.php">Inscrit toi !</a></p>
            </div>

        </div>
    </div>
</section>
<?php include('./footer.php'); ?>
