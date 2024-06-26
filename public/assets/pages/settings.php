<?php require('db.php'); 

//poour supprimer la session
//session_destroy();

if(empty($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$title = 'Kirsao';
$title_page = 'Paramètres';
$description_page = 'Paramètres';
$user = $_SESSION['user'];
$title_dashboard = $user->firstname.' que veut-tu modifier ?';
$firstnameError = $lastnameError = $emailError = $photoError = "";

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
    $succes = '';
    
    if(empty($firstname) || strlen($firstname) < 3) {
        $firstnameError = 'Le prénom n\'est pas valide.';
    }
    if(empty($lastname) || strlen($lastname) < 3) {
        $lastnameError = 'Le nom n\'est pas valide.';
    }
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'L\'email n\'est pas valide.';
    }

    if(empty($firstnameError) && empty($lastnameError) && empty($emailError)){
        $req = $db->prepare('SELECT * FROM users WHERE email = :email AND id != :id');
        $req->bindValue(':email', $email, PDO::PARAM_STR);
        $req->bindValue(':id', $user->id, PDO::PARAM_INT);
        $req->execute();

        if($req->rowCount() > 0) {
            $emailError = 'L\'Email est déjà utilisé.';
        }

        // traitement image
        if(!empty($_FILES['file']['name'])){
            $photo = $_FILES['file'];
            $filepath = 'photos/'.$user->id;
            @mkdir($filepath, 0777, true);
            $allowedExt = ['jpeg', 'jpg', 'png'];
            $ext = strtolower(pathinfo($photo['name'], PATHINFO_EXTENSION));

            if(!in_array($ext, $allowedExt)) {
                $photoError = 'Le fichier n\'est pas autorisé.';
            } else {
                $info = getimagesize($photo['tmp_name']);
                $width = $info[0];
                $height = $info[1];

                if($width < 150 || $height < 150) {
                    $photoError = 'L\'image est trop petite.';
                } else {
                    $filename = uniqid($user->id, true).'.'.$ext;
                    move_uploaded_file($photo['tmp_name'], $filepath.'/'.$filename);
                }
            }
        }

        if(empty($emailError) && empty($photoError)) {
            $req = $db->prepare('SELECT * FROM users WHERE id = :id');
            $req->bindValue(':id', $user->id, PDO::PARAM_INT);
            $req->execute();

            $user = $req->fetch();

            if($user->file) {
                $oldFilePath = 'photos/'.$user->id.'/'.$user->file;
            }

            $req = $db->prepare('UPDATE users SET firstname=:firstname, lastname=:lastname, email=:email, file=:file WHERE id = :id');
            $req->bindValue(':firstname', $firstname, PDO::PARAM_STR);
            $req->bindValue(':lastname', $lastname, PDO::PARAM_STR);
            $req->bindValue(':email', $email, PDO::PARAM_STR);
            $req->bindValue(':file', $filename ?? $user->file, PDO::PARAM_STR);
            $req->bindValue(':id', $user->id, PDO::PARAM_INT);
            $req->execute();

            $req = $db->prepare('SELECT * FROM users WHERE id = :id');
            $req->bindValue(':id', $user->id, PDO::PARAM_INT);
            $req->execute();

            $user = $req->fetch();

            unset($_SESSION['user']);
            $_SESSION['user'] = $user;

            if(!empty($oldFilePath) && !empty($filename)) {
                @unlink($oldFilePath);
            }
            
            $succes = 'Informations mises à jour.';

            $title_dashboard = $user->firstname.' que veut-tu modifier ?';
        }
    }
}
?>

<?php include('header.php'); ?>

<section class="login-container setting">
    <div class="wrapper wrapper-setting">
        <div class="wrapper-contain">

            <h2><?= $title_page; ?></h2>
            <br><br> 
            <?php if(!empty($user->file)): ?>
                <a href="photos/<?= $user->id.'/'.$user->file; ?>" style="float: right;" class="user-picture">
                    <img src="photos/<?= $user->id.'/'.$user->file; ?>" alt="photo de profil">
                </a>
            <?php endif; ?>
            <h4><?= $title_dashboard; ?></h4>
            <br>

            <?php if(!empty($succes)): ?>
                <div class="alert alert-succes">
                    <p><?= $succes; ?></p>
                </div>
            <?php endif; ?>

            <form method="POST" action="settings.php" role="modification" enctype="multipart/form-data" class="form">

                <div class="form-group">
                    <input type="file" name="file" value="" style="cursor: pointer;">
                    <i class='bx bx-image-add'></i>
                    <span>Votre photo de profil</span>
                    <!-- afficher message erreur -->
                    <?php if(!empty($photoError)): ?>
                        <div class="alert alert-danger">
                            <p><?= $photoError; ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                <br>

                <div class="form-group">
                    <input type="text" name="firstname" placeholder="Ton prénom" value="<?= $firstname ?? $user->firstname; ?>" required>
                    <i class='bx bx-user'></i>
                    <span>Votre prénom</span>
                    <!-- afficher message erreur -->
                    <?php if(!empty($firstnameError)): ?>
                        <div class="alert alert-danger">
                            <p><?= $firstnameError; ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                <br>

                <div class="form-group">
                    <input type="text" name="lastname" placeholder="Ton nom" value="<?= $lastname ?? $user->lastname; ?>" required>
                    <i class='bx bx-user'></i>
                    <span>Votre nom</span>
                    <!-- afficher message erreur -->
                    <?php if(!empty($lastnameError)): ?>
                        <div class="alert alert-danger">
                            <p><?= $lastnameError; ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                <br>
                
                <div class="form-group">
                    <input type="email" name="email" placeholder="Ton email" value="<?= $email ?? $user->email; ?>" required>
                    <i class='bx bx-envelope' ></i>
                    <span>Ton email</span>
                    <!-- afficher message erreur -->
                    <?php if(!empty($emailError)): ?>
                        <div class="alert alert-danger">
                            <p><?= $emailError; ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                <br>

                <input type="submit" value="Modifier" name="valider" class="btn btn-login">
            </form>

            <br><br>
            <div class="redirect-lien">
                <p><a href="password.php">Modifier mon mot de passe.</a></p>
            </div>
            
            <br><br>
            <a href="./logout.php" class="btn btn-danger delate">Déconnexion</a>
            <br>
            <a onclick="return confirm('Confirmer la suppression de votre compte ?');" href="delate.php" class="btn btn-danger delate">Supprimer mon compte.</a>

            <br>
            <a href="./dashboard.php" class="btn btn-succes delate">Mon espace</a>
        </div>
    </div>
</section>

<?php include('./footer.php'); ?>
