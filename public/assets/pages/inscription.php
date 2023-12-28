<?php require('db.php'); 

//permet de rediriger direct sur le dashbord si déjà connecter auparavant
if(!empty($_SESSION['user'])) {
    header('Location: dashboard.php');
}

$title = 'Kirsao';
$title_page = 'Inscription';
$description_page = 'Page d\'inscription';
$firstname = $lastname = $email = $password = "";
$firstnameError = $lastnameError = $emailError = $passwordError = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

    //fonction de vérif
	function verifyInput($var) {
		$var = trim($var);
		$var = stripslashes($var);
		$var = htmlspecialchars($var);
	  
		return $var;
	}

    $firstname = verifyInput($_POST["firstname"]);
    $lastname = verifyInput($_POST["lastname"]);
    $email = verifyInput($_POST["email"]);
    $password = $_POST["password"];
    
    
    if(empty($firstname) || strlen($firstname) < 3) {
        $firstnameError = 'Le prénom n\'est pas valide.';
        $firstname = '';
    }
    if(empty($lastname) || strlen($lastname) < 3) {
        $lastnameError = 'Le nom n\'est pas valide.';
        $lastname = '';
    }
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'L\'email n\'est pas valide.';
        $email = '';
    }
    if(empty($password) || strlen($password) < 7) {
        $passwordError = 'Le mot de passe doit contenir au moins 7 charactères.';
    }

    if(empty($firstnameError) && empty($lastnameError) && empty($emailError) && empty($passwordError)){
        $req = $db->prepare('SELECT * FROM users WHERE email = :email');
        $req->bindValue(':email', $email, PDO::PARAM_STR);
        $req->execute();

        if($req->rowCount() > 0) {
            $emailError = 'Un utilisateur est déjà enregistré avec cet Email.';
        }

        if(empty($firstnameError) && empty($lastnameError) && empty($emailError) && empty($passwordError)) {
            $req = $db->prepare('INSERT INTO users (firstname, lastname, email, password, created_at) VALUES (:firstname, :lastname, :email, :password, NOW())');
            $req->bindValue(':firstname', $firstname, PDO::PARAM_STR);
            $req->bindValue(':lastname', $lastname, PDO::PARAM_STR);
            $req->bindValue(':email', $email, PDO::PARAM_STR);
            $req->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
            $req->execute();

            unset($firstname, $lastname, $email, $password);
            $succes = 'Ton inscription est validée ! <br> Tu peux <a href="login.php">te connecter</a> !';
        }
    }
}
?>


<?php include('header.php'); ?>

<section class="login-container">
    <div class="wrapper">
        <h2 class="login-title"><?= $title_page; ?></h2>

        <?php if(!empty($succes)): ?>
            <div class="alert alert-succes redirect-lien">
                <p><?= $succes; ?></p>
            </div>
        <?php endif; ?>

        <form method="POST" action="inscription.php" role="inscription" class="form">

            <div class="form-group">
                <input type="text" id="name" name="firstname" placeholder="" value="<?= $firstname ?? ''; ?>" required>
                <span>Ton prénom</span>
                <i class='bx bx-user'></i>
                <!-- afficher message erreur -->
                <?php if(!empty($firstnameError)): ?>
                    <div class="alert alert-danger">
                        <p><?= $firstnameError; ?></p>
                    </div>
                <?php endif; ?>
            </div>
            <br>

            <div class="form-group">
                <input type="text" name="lastname" placeholder="" value="<?= $lastname ?? ''; ?>" required>
                <span>Ton nom</span>
                <i class='bx bx-user'></i>
                <!-- afficher message erreur -->
                <?php if(!empty($lastnameError)): ?>
                    <div class="alert alert-danger">
                        <p><?= $lastnameError; ?></p>
                    </div>
                <?php endif; ?>
            </div>
            <br>
            
            <div class="form-group">
                <input type="email" name="email" placeholder="" value="<?= $email ?? ''; ?>" required>
                <span>Ton meilleur Email</span>
                <i class='bx bx-envelope' ></i>
                <!-- afficher message erreur -->
                <?php if(!empty($emailError)): ?>
                    <div class="alert alert-danger">
                        <p><?= $emailError; ?></p>
                    </div>
                <?php endif; ?>
            </div>
            <br>

            <div class="form-group">
                <input type="password" name="password" placeholder="" required>
                <span>Ton meilleur mot de passe</span>
                <i class='bx bx-lock-alt' ></i>
                <!-- afficher message erreur -->
                <?php if(!empty($passwordError)): ?>
                    <div class="alert alert-danger">
                        <p><?= $passwordError; ?></p>
                    </div>
                <?php endif; ?>
            </div>
            <br>

            <input type="submit" value="M'inscrire" name="valider" class="btn btn-login">
        </form>

        <div class="redirect-lien">
            <p>Tu as déjà un compte ? <a href="./login.php">Connecte toi !</a></p>
        </div>

    </div>
</section>
<?php include('./footer.php'); ?>
